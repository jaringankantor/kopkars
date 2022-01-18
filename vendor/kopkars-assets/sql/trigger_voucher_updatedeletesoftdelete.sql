-- Function: public.trigger_voucher_updatedeletesoftdelete()

-- DROP FUNCTION public.trigger_voucher_updatedeletesoftdelete();

CREATE OR REPLACE FUNCTION public.trigger_voucher_updatedeletesoftdelete()
  RETURNS trigger AS
$BODY$

DECLARE
   last_time timestamp;
BEGIN
   last_time = now();

   --Jika data dihapus catat data sebelumnya pada histori
   IF (TG_OP = 'DELETE') THEN
      INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'kode_voucher', OLD.kode_voucher, null,'DELETE', last_time);
      
      INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'kode_toko', OLD.kode_toko, null,'DELETE', last_time);

      INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'anggota_id', OLD.anggota_id, null,'DELETE', last_time);

      INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'rupiah', OLD.rupiah, null,'DELETE', last_time);

      INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'rupiah_terpakai', OLD.rupiah_terpakai, null,'DELETE', last_time);

      IF (OLD.keterangan IS NOT NULL) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu)
         VALUES (OLD.anggota_id, OLD.id, 'keterangan', OLD.keterangan, null,'DELETE', last_time);
      END IF;

   ELSIF (TG_OP = 'UPDATE') THEN
      --Jika update data kode_voucher berubah catat pada histori
      IF (NEW.kode_voucher != OLD.kode_voucher) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'kode_voucher', OLD.kode_voucher, NEW.kode_voucher, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data kode_toko berubah catat pada histori
      IF (NEW.kode_voucher != OLD.kode_voucher) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'kode_toko', OLD.kode_toko, NEW.kode_toko, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data anggota_id berubah catat pada histori
      IF (NEW.anggota_id != OLD.anggota_id) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'anggota_id', OLD.anggota_id, NEW.anggota_id, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data rupiah berubah catat pada histori
      IF (NEW.rupiah != OLD.rupiah) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'rupiah', OLD.rupiah, NEW.rupiah, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data rupiah_terpakai berubah catat pada histori
      IF (NEW.rupiah_terpakai != OLD.rupiah_terpakai) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'rupiah_terpakai', OLD.rupiah_terpakai, NEW.rupiah_terpakai, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data berakhir_sampai berubah catat pada histori
      IF (NEW.berakhir_sampai != OLD.berakhir_sampai) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'berakhir_sampai', OLD.berakhir_sampai, NEW.berakhir_sampai, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data is_deleted=true catat pada histori
      IF ((NEW.is_deleted != OLD.is_deleted) AND (NEW.is_deleted = TRUE)) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_deleted', OLD.is_deleted, NEW.is_deleted, 'SOFTDELETE TRUE', last_time, NEW.last_softdelete_by);
      END IF;

      --Jika update data is_deleted=false catat pada histori
      IF ((NEW.is_deleted != OLD.is_deleted) AND (NEW.is_deleted = FALSE)) THEN
         INSERT INTO histori_voucher (anggota_id,voucher_id,voucher_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_deleted', OLD.is_deleted, NEW.is_deleted, 'SOFTDELETE FALSE', last_time, NEW.last_softdelete_by);
      END IF;
      
   END IF;

   RETURN NEW;
	 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.trigger_voucher_updatedeletesoftdelete()
  OWNER TO kopkars;
