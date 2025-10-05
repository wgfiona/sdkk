-- Create database (adjust name if you prefer)
CREATE DATABASE IF NOT EXISTS voting_app
  CHARACTER SET utf8mb4
  COLLATE utf8mb4_general_ci;

USE voting_app;

-- USERS (students + admin)
-- Field names follow your spec:
-- NAMA_P, KELAS_P, KAD_PENGENALAN_P, USERNAME_P, KATA_KUNCI_P
-- PERANAN is role (voter/admin) for app logic.
CREATE TABLE IF NOT EXISTS users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  NAMA_P VARCHAR(100) NOT NULL,
  KELAS_P VARCHAR(50) NOT NULL,
  KAD_PENGENALAN_P VARCHAR(20) NOT NULL UNIQUE,
  USERNAME_P VARCHAR(50) NOT NULL UNIQUE,
  KATA_KUNCI_P VARCHAR(255) NOT NULL, -- will store password hash (bcrypt)
  PERANAN ENUM('voter','admin') NOT NULL DEFAULT 'voter',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- SUBJECTS for voting
-- You specified NAMA_SUBJEK and KOD_SUBJEK
CREATE TABLE IF NOT EXISTS subjects (
  id INT AUTO_INCREMENT PRIMARY KEY,
  KOD_SUBJEK VARCHAR(20) NOT NULL UNIQUE,
  NAMA_SUBJEK VARCHAR(100) NOT NULL,
  is_active TINYINT(1) NOT NULL DEFAULT 1,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB;

-- VOTES: 1 row per user (enforce one vote per student)
CREATE TABLE IF NOT EXISTS votes (
  id INT AUTO_INCREMENT PRIMARY KEY,
  user_id INT NOT NULL,
  KOD_SUBJEK VARCHAR(20) NOT NULL,
  voted_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  CONSTRAINT fk_votes_user FOREIGN KEY (user_id)
    REFERENCES users(id) ON DELETE CASCADE,
  CONSTRAINT fk_votes_subject FOREIGN KEY (KOD_SUBJEK)
    REFERENCES subjects(KOD_SUBJEK) ON DELETE RESTRICT,
  CONSTRAINT uc_one_vote_per_user UNIQUE (user_id)
) ENGINE=InnoDB;

-- Seed some common subjects (you can edit/extend later via admin page)
INSERT IGNORE INTO subjects (KOD_SUBJEK, NAMA_SUBJEK, is_active) VALUES
('BIO',  'BIOLOGY',         1),
('CHEM', 'CHEMISTRY',       1),
('PHY',  'PHYSICS',         1),
('ADD',  'ADD MATHS',       1),
('BM',   'BAHASA MELAYU',   1),
('BI',   'BAHASA INGGERIS', 1);
