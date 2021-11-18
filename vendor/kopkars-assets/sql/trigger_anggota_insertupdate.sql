CREATE OR REPLACE FUNCTION trigger_anggota_insertupdate() RETURNS "trigger" AS
$BODY$
BEGIN
   IF (TG_OP = 'INSERT') THEN
      UPDATE anggota
      SET email_last_lock=NEW.email, email_last_lock_verified=FALSE,
      nomor_hp_last_lock=NEW.nomor_hp, nomor_hp_last_lock_verified=FALSE
      WHERE id=NEW.id;

   ELSIF (TG_OP = 'UPDATE') THEN
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

      --Jika user mengubah nama_lengkap catat pada histori.
      IF (NEW.nama_lengkap != OLD.nama_lengkap) THEN
         INSERT INTO histori_anggota (anggota_id,anggota_kolom,value_old,value_new)
         VALUES (NEW.id, 'nama_lengkap', OLD.nama_lengkap, NEW.nama_lengkap);
      END IF;

   END IF;

   RETURN NEW;
	 
END;
$BODY$
LANGUAGE plpgsql;
