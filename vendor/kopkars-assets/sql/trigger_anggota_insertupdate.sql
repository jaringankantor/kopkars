CREATE OR REPLACE FUNCTION trigger_anggota_insertupdate() RETURNS "trigger" AS
$BODY$
DECLARE
  chars text[] := '{0,1,2,3,4,5,6,7,8,9,A,B,C,D,E,F,G,H,I,J,K,L,M,N,O,P,Q,R,S,T,U,V,W,X,Y,Z}';
  result_chars text := '';
  key NOMOR_ANGGOTA;
  qry TEXT;
  found TEXT;
  nomor_anggota_boolean BOOLEAN;
BEGIN
   IF (TG_OP = 'INSERT') THEN
      UPDATE anggota
      SET email_last_lock=NEW.email, email_last_lock_verified=FALSE,
      nomor_hp_last_lock=NEW.nomor_hp, nomor_hp_last_lock_verified=FALSE
      WHERE id=NEW.id;

   ELSIF (TG_OP = 'UPDATE') THEN
      --Jika admin mengapprove anggota menjadi 'Aktif', lalu sistem akan memberikan nomor
      IF((NEW.status = 'Aktif') AND (NEW.status != OLD.status)) THEN

         qry := 'SELECT nomor_anggota FROM anggota WHERE nomor_anggota=';

         LOOP
            nomor_anggota_boolean := TRUE;
            FOR i in 1..8 LOOP
               result_chars := result_chars || chars[1+random()*(array_length(chars, 1)-1)];
            END LOOP;

            key := result_chars;

            EXECUTE qry || quote_literal(key) INTO found;

            -- Check to see if found is NULL.
            -- If we checked to see if found = NULL it would always be FALSE
            -- because (NULL = NULL) is always FALSE.
            IF found IS NULL THEN
               -- If we didn't find a collision then leave the LOOP.
               EXIT;
            ELSE
               nomor_anggota_boolean = FALSE;
            END IF;

            IF nomor_anggota_boolean THEN
               -- User supplied ID but it violates the PK unique constraint
               RAISE 'ID % already exists in table %', key, TG_TABLE_NAME;
            END IF;

            -- We haven't EXITed yet, so return to the top of the LOOP
            -- and try again.
         END LOOP;

         UPDATE anggota
         SET nomor_anggota=key
         WHERE id=NEW.id;

      END IF;

      --Jika user mengubah email
      IF ((NEW.email != OLD.email) AND (NEW.email != OLD.email_last_lock)) THEN
         UPDATE anggota
         SET email_last_lock_verified=FALSE
         WHERE id=NEW.id;
      END IF;

      --Jika user tidak jadi mengubah email
      IF ((NEW.email != OLD.email) AND (NEW.email = OLD.email_last_lock)) THEN
         UPDATE anggota
         SET email_last_lock_verified=TRUE
         WHERE id=NEW.id;
      END IF;

      --Jika user mengklik link verifikasi perubahan email
      IF ((NEW.email_last_lock_verified != OLD.email_last_lock_verified) AND (NEW.email_last_lock_verified = TRUE)) THEN
        
         --Catat pada histori jika ada perubahan data email dan sudah klik link verifikasi,
         --kecuali pendaftaran awal krn email_last_lock masih NULL tidak akan dicatat di history
         IF(OLD.email_last_lock != NULL) THEN
            INSERT INTO histori_anggota (anggota_id,anggota_kolom,value_old,value_new)
            VALUES (NEW.id, 'email', OLD.email_last_lock, NEW.email_last_lock);
         END IF;

         UPDATE anggota
         SET email_last_lock=NEW.email
         WHERE id=NEW.id;
      END IF;

      --Jika user mengubah nomor_hp
      IF ((NEW.nomor_hp != OLD.nomor_hp) AND (NEW.nomor_hp != OLD.nomor_hp_last_lock)) THEN
         UPDATE anggota
         SET nomor_hp_last_lock_verified=FALSE
         WHERE id=NEW.id;
      END IF;

      --Jika user tidak jadi mengubah nomor_hp
      IF ((NEW.nomor_hp != OLD.nomor_hp) AND (NEW.nomor_hp = OLD.nomor_hp_last_lock)) THEN
         UPDATE anggota
         SET nomor_hp_last_lock_verified=TRUE
         WHERE id=NEW.id;
      END IF;

      --Jika user mengklik link verifikasi perubahan nomor_hp
      IF ((NEW.nomor_hp_last_lock_verified != OLD.nomor_hp_last_lock_verified) AND (NEW.nomor_hp_last_lock_verified = TRUE)) THEN
         --Catat pada histori jika ada perubahan data nomor_hp dan sudah klik link verifikasi,
         --kecuali pendaftaran awal krn nomor_hp_last_lock masih NULL tidak akan dicatat di history
         IF(OLD.nomor_hp_last_lock != NULL) THEN
            INSERT INTO histori_anggota (anggota_id,anggota_kolom,value_old,value_new)
            VALUES (NEW.id, 'nomor_hp', OLD.nomor_hp_last_lock, NEW.nomor_hp_last_lock);
         END IF;

         UPDATE anggota
         SET nomor_hp_last_lock=NEW.nomor_hp
         WHERE id=NEW.id;
      END IF;

      --Jika user mengubah nama_lengkap catat pada histori
      IF (NEW.nama_lengkap != OLD.nama_lengkap) THEN
         INSERT INTO histori_anggota (anggota_id,anggota_kolom,value_old,value_new)
         VALUES (NEW.id, 'nama_lengkap', OLD.nama_lengkap, NEW.nama_lengkap);
      END IF;

   END IF;

   RETURN NEW;
	 
END;
$BODY$
LANGUAGE plpgsql;
