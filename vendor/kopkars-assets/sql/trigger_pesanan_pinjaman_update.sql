-- Function: public.trigger_pesanan_pinjaman_update()

-- DROP FUNCTION public.trigger_pesanan_pinjaman_update();

CREATE OR REPLACE FUNCTION public.trigger_pesanan_pinjaman_update()
  RETURNS trigger AS
$BODY$

DECLARE
   last_time timestamp;
BEGIN
   last_time = now();

   IF (TG_OP = 'UPDATE') THEN
      --Jika update data anggota_id berubah catat pada histori
      IF (NEW.anggota_id != OLD.anggota_id) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'anggota_id', OLD.anggota_id, NEW.anggota_id, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data pesanan_pinjaman_id berubah catat pada histori
      IF (NEW.id != OLD.id) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'pesanan_pinjaman_id', OLD.id, NEW.id, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data saldo_pokok berubah catat pada histori
      IF (NEW.saldo_pokok != OLD.saldo_pokok) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'saldo_pokok', OLD.saldo_pokok, NEW.saldo_pokok, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data saldo_jasa berubah catat pada histori
      IF (NEW.saldo_jasa != OLD.saldo_jasa) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'saldo_jasa', OLD.saldo_jasa, NEW.saldo_jasa, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data total_pembayaran berubah catat pada histori
      IF (NEW.total_pembayaran != OLD.total_pembayaran) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'total_pembayaran', OLD.total_pembayaran, NEW.total_pembayaran, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data is_approved_level1 berubah catat pada histori
      IF (NEW.total_pembayaran != OLD.total_pembayaran) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_approved_level1', OLD.is_approved_level1, NEW.is_approved_level1, 'UPDATE', last_time, NEW.last_update_by);
      END IF;

      --Jika update data is_approved_level2 berubah catat pada histori
      IF (NEW.total_pembayaran != OLD.total_pembayaran) THEN
         INSERT INTO histori_pesanan_pinjaman (anggota_id,pesanan_pinjaman_id,pesanan_pinjaman_kolom,value_old,value_new,jenis_transaksi,waktu,by)
         VALUES (OLD.anggota_id, OLD.id, 'is_approved_level2', OLD.is_approved_level2, NEW.is_approved_level2, 'UPDATE', last_time, NEW.last_update_by);
      END IF;
      
   END IF;

   RETURN NEW;
	 
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;
ALTER FUNCTION public.trigger_pesanan_pinjaman_update()
  OWNER TO kopkars;
