-- tests/schema.sql
CREATE TABLE IF NOT EXISTS patients (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    created_at DATETIME DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS doctors (
    id         INT AUTO_INCREMENT PRIMARY KEY,
    name       VARCHAR(255) NOT NULL,
    email      VARCHAR(255) NOT NULL UNIQUE,
    password   VARCHAR(255) NOT NULL,
    specialty  VARCHAR(255) DEFAULT NULL,
    created_at DATETIME DEFAULT NULL
);

CREATE TABLE IF NOT EXISTS appointments (
    id                INT AUTO_INCREMENT PRIMARY KEY,
    patient_id        INT          NOT NULL,
    doctor_id         INT          NOT NULL,
    doctor_name       VARCHAR(255) DEFAULT NULL,
    doctor_specialty  VARCHAR(255) DEFAULT NULL,
    appointment_date  DATETIME     NOT NULL,
    reason            TEXT         DEFAULT NULL,
    status            VARCHAR(50)  NOT NULL DEFAULT 'scheduled',
    created_at        DATETIME     DEFAULT NULL,
    updated_at        DATETIME     DEFAULT NULL,
    FOREIGN KEY (patient_id) REFERENCES patients(id),
    FOREIGN KEY (doctor_id)  REFERENCES doctors(id)
);