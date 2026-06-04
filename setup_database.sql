-- ===================================
-- SQL Script untuk Database Mahasiswa
-- ===================================

-- Jika tabel sudah ada, hapus terlebih dahulu
DROP TABLE IF EXISTS mahasiswa;

-- Buat tabel mahasiswa dengan struktur yang benar
CREATE TABLE mahasiswa (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nim VARCHAR(12) UNIQUE NOT NULL,
    nama VARCHAR(100) NOT NULL,
    jurusan VARCHAR(50) NOT NULL,
    alamat TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Insert data contoh
INSERT INTO mahasiswa (nim, nama, jurusan, alamat) VALUES
('20230001', 'Ahmad Rifki', 'Teknik Informatika', 'Jl. Merdeka No. 123, Jakarta'),
('20230002', 'Siti Nurhaliza', 'Sistem Informasi', 'Jl. Sudirman No. 456, Bandung'),
('20230003', 'Budi Santoso', 'Teknik Komputer', 'Jl. Gatot Subroto No. 789, Surabaya');

-- Tampilkan data
SELECT * FROM mahasiswa;
