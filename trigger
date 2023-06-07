CREATE TRIGGER `hapus` AFTER DELETE ON `tb_resep`
 FOR EACH ROW BEGIN
	UPDATE tb_obat SET stok = stok + OLD.jumlah
    WHERE kode = OLD.kd_obat;
END

CREATE TRIGGER `resep` AFTER INSERT ON `tb_resep`
 FOR EACH ROW BEGIN
	UPDATE tb_obat SET stok = stok - NEW.Jumlah
    WHERE kode = NEW.kd_obat;
END



CREATE TRIGGER `Tambahstok` AFTER INSERT ON `tb_obatmasuk`
 FOR EACH ROW BEGIN
	UPDATE tb_obat SET stok = stok + NEW.jumlah
    WHERE kode = NEW.kode;
END

CREATE TRIGGER `editstok` AFTER UPDATE ON `tb_obatmasuk`
 FOR EACH ROW BEGIN
	UPDATE tb_obat SET stok = stok - OLD.jumlah + NEW.Jumlah
    WHERE kode = OLD.kode;
END

CREATE TRIGGER `obathapus` AFTER DELETE ON `tb_obatmasuk`
 FOR EACH ROW BEGIN
	UPDATE tb_obat SET stok = stok - OLD.jumlah
    WHERE kode = OLD.kode;
END
