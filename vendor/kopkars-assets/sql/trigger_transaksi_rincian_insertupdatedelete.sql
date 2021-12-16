CREATE OR REPLACE FUNCTION trigger_transaksi_rincian_insertupdatedelete() RETURNS "trigger" AS
$BODY$
DECLARE
    query TEXT;
    found TEXT;
    sum_subtotal INT;
    sum_diskon INT;
    sum_pajak INT;
    sum_total_penjualan INT;
    sum_pembayaran INT;
    sum_saldo INT;
    all_keterangan TEXT;
BEGIN
    --Yang boleh diupdate yang kaitan dengan rupiah2 dan jumlah barang dan keterangan
    IF (TG_OP = 'INSERT' OR TG_OP = 'UPDATE') THEN
        EXECUTE 'SELECT id FROM transaksi WHERE kode_toko=' || quote_literal(NEW.kode_toko) ||
        'AND kanal_transaksi=' || quote_literal(NEW.kanal_transaksi) ||
        'AND nomor_referensi=' || quote_literal(NEW.nomor_referensi)
        INTO found;
        IF found IS NULL THEN
            INSERT INTO transaksi(kode_toko,kanal_transaksi,nomor_referensi,nomor_pesanan,anggota_id,nama_pelanggan,
            nomor_hp,email,alamat,kurir,nomor_resi,is_bebasongkir,mata_uang,subtotal,
            diskon,pajak,total_penjualan,pembayaran,saldo,keterangan,waktu,insert_by)
            VALUES(NEW.kode_toko,NEW.kanal_transaksi,NEW.nomor_referensi,NEW.nomor_pesanan,NEW.anggota_id,NEW.nama_pelanggan,
            NEW.nomor_hp,NEW.email,NEW.alamat,NEW.kurir,NEW.nomor_resi,NEW.is_bebasongkir,NEW.mata_uang,NEW.subtotal,
            NEW.diskon,NEW.pajak,NEW.total_penjualan,NEW.pembayaran,NEW.saldo,NEW.keterangan,NEW.waktu,NEW.insert_by);
        ELSE
            SELECT INTO sum_subtotal,sum_diskon,sum_pajak,sum_total_penjualan,sum_pembayaran,sum_saldo,all_keterangan 
            SUM(subtotal),SUM(diskon),SUM(pajak),SUM(total_penjualan),SUM(pembayaran),SUM(saldo),string_agg(all_keterangan,'|')
            FROM transaksi_rincian
            WHERE kode_toko = OLD.kode_toko AND kanal_transaksi = OLD.kanal_transaksi AND nomor_referensi = OLD.nomor_referensi;

            UPDATE transaksi
            SET subtotal = sum_subtotal, diskon = sum_diskon, pajak=sum_pajak, total_penjualan = sum_total_penjualan,
            pembayaran = sum_pembayaran, saldo = sum_saldo, keterangan = all_keterangan
            WHERE kode_toko = NEW.kode_toko AND kanal_transaksi = NEW.kanal_transaksi AND nomor_referensi = NEW.nomor_referensi;
        END IF;

   ELSIF (TG_OP = 'DELETE') THEN
        EXECUTE 'SELECT id FROM transaksi WHERE kode_toko=' || quote_literal(OLD.kode_toko) ||
        'AND kanal_transaksi=' || quote_literal(OLD.kanal_transaksi) ||
        'AND nomor_referensi=' || quote_literal(OLD.nomor_referensi)
        INTO found;
        IF found IS NOT NULL THEN
            SELECT INTO sum_subtotal,sum_diskon,sum_pajak,sum_total_penjualan,sum_pembayaran,sum_saldo,all_keterangan 
            COALESCE(SUM(subtotal),0),COALESCE(SUM(diskon),0),COALESCE(SUM(pajak),0),COALESCE(SUM(total_penjualan),0),
            COALESCE(SUM(pembayaran),0),COALESCE(SUM(saldo),0),string_agg(all_keterangan,'|')
            FROM transaksi_rincian
            WHERE kode_toko = OLD.kode_toko AND kanal_transaksi = OLD.kanal_transaksi AND nomor_referensi = OLD.nomor_referensi;

            UPDATE transaksi
            SET subtotal = sum_subtotal, diskon = sum_diskon, pajak=sum_pajak, total_penjualan = sum_total_penjualan,
            pembayaran = sum_pembayaran, saldo = sum_saldo, keterangan = all_keterangan
            WHERE kode_toko = OLD.kode_toko AND kanal_transaksi = OLD.kanal_transaksi AND nomor_referensi = OLD.nomor_referensi;
        END IF;
   END IF;

   RETURN NEW;
	 
END;
$BODY$
LANGUAGE plpgsql;
