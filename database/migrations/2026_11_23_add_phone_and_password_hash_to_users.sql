-- Execute uma vez no banco EducaFin para atualizar a tabela users existente.
ALTER TABLE users
    ADD COLUMN phone VARCHAR(20) NOT NULL AFTER email,
    ADD COLUMN password_hash VARCHAR(255) NOT NULL AFTER phone;
