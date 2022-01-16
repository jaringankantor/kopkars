-- Function: public.trigger_pinjaman_updatedeletesoftdelete()

-- DROP FUNCTION public.trigger_pinjaman_updatedeletesoftdelete();

CREATE OR REPLACE FUNCTION public.trigger_pinjaman_updatedeletesoftdelete()
  RETURNS trigger AS
$BODY$

DECLARE
   last_time timestamp;
BEGIN
   last_time = now();

   --Jika data dihapus catat data sebelumnya pada histori
   IF (TG_OP = 'DELETE') THEN
      IF (OLD.nomor_referensi IS NOT NULL) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu)
         VALUES (OLD.anggota_id, OLD.id, 'nomor_referensi', OLD.nomor_referensi, null,'DELETE', last_time);
      END IF;

      INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'saldo_pokok', OLD.saldo_pokok, null,'DELETE', last_time);

      INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'saldo_jasa', OLD.saldo_jasa, null,'DELETE', last_time);

      INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu)
      VALUES (OLD.anggota_id, OLD.id, 'total_pembayaran', OLD.total_pembayaran, null,'DELETE', last_time);

      IF (OLD.keterangan IS NOT NULL) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu)
         VALUES (OLD.anggota_id, OLD.id, 'keterangan', OLD.keterangan, null,'DELETE', last_time);
      END IF;

   ELSIF (TG_OP = 'UPDATE') THEN
      --Jika update data anggota_id berubah catat pada histori
      IF (NEW.anggota_id != OLD.anggota_id) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'anggota_id', OLD.anggota_id, NEW.anggota_id, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data pinjaman_id berubah catat pada histori
      IF (NEW.id != OLD.id) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'pinjaman_id', OLD.id, NEW.id, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data saldo_pokok berubah catat pada histori
      IF (NEW.saldo_pokok != OLD.saldo_pokok) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'saldo_pokok', OLD.saldo_pokok, NEW.saldo_pokok, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data saldo_jasa berubah catat pada histori
      IF (NEW.saldo_jasa != OLD.saldo_jasa) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'saldo_jasa', OLD.saldo_jasa, NEW.saldo_jasa, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data total_pembayaran berubah catat pada histori
      IF (NEW.total_pembayaran != OLD.total_pembayaran) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'total_pembayaran', OLD.total_pembayaran, NEW.total_pembayaran, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data is_deleted=true catat pada histori
      IF ((NEW.is_deleted != OLD.is_deleted) AND (NEW.is_deleted = TRUE)) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_deleted', OLD.is_deleted, NEW.is_deleted, 'SOFTDELETE TRUE', last_time, NEW.last_softdelete_by);
      END IF;

      --Jika update data is_deleted=false catat pada histori
      IF ((NEW.is_deleted != OLD.is_deleted) AND (NEW.is_deleted = FALSE)) THEN
         INSERT INTO histori_pinjaman (anggota_id,pinjaman_id,pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_deleted', OLD.is_deleted, NEW.is_deleted, 'SOFTDELETE FALSE', last_time, NEW.last_softdelete_by);
      END IF;
      
   END IF;

   RETURN NEW;
	 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.trigger_pinjaman_updatedeletesoftdelete()
  OWNER TO kopkars;
