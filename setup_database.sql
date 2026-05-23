-- ============================================================
--  SETUP DATABASE TESTING — Sistem Reservasi Klinik
--  Jalankan script ini di MySQL sebelum menjalankan PHPUnit
-- ============================================================

CREATE DATABASE IF NOT EXISTS klinik_testing
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

USE klinik_testing;

-- Hapus tabel lama jika ada (urutan penting karena FK)
DROP TABLE IF EXISTS unavailabilities;
DROP TABLE IF EXISTS appointments;
DROP TABLE IF EXISTS users;

-- Tabel users
CREATE TABLE users (
    id                 BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name               VARCHAR(255) NOT NULL,
    email              VARCHAR(255) UNIQUE NOT NULL,
    password           VARCHAR(255) NOT NULL,
    role               ENUM('admin','doctor','patient','staff') DEFAULT 'patient',
    date_of_birth      DATE NULL,
    phone              VARCHAR(20) NULL,
    address            TEXT NULL,
    blood_type         VARCHAR(5) NULL,
    gender             ENUM('male','female') NULL,
    specialization     VARCHAR(100) NULL,
    bio                TEXT NULL,
    consultation_fee   DECIMAL(10,2) NULL,
    photo              VARCHAR(255) NULL,
    license_number     VARCHAR(50) NULL,
    email_verified_at  TIMESTAMP NULL,
    remember_token     VARCHAR(100) NULL,
    created_at         TIMESTAMP NULL,
    updated_at         TIMESTAMP NULL
);

-- Tabel appointments
CREATE TABLE appointments (
    id               BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    patient_id       BIGINT UNSIGNED NOT NULL,
    doctor_id        BIGINT UNSIGNED NOT NULL,
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    reason           TEXT NULL,
    status           ENUM('pending','confirmed','completed','cancelled','rejected') DEFAULT 'pending',
    notes            TEXT NULL,
    created_at       TIMESTAMP NULL,
    updated_at       TIMESTAMP NULL,
    FOREIGN KEY (patient_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (doctor_id)  REFERENCES users(id) ON DELETE CASCADE
);

-- Tabel unavailabilities
CREATE TABLE unavailabilities (
    id         BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    doctor_id  BIGINT UNSIGNED NOT NULL,
    date       DATE NOT NULL,
    start_time TIME NULL,
    end_time   TIME NULL,
    reason     VARCHAR(255) NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (doctor_id) REFERENCES users(id) ON DELETE CASCADE
);

-- Verifikasi
SELECT 'Setup selesai! Tabel berhasil dibuat:' AS info;
SHOW TABLES;
