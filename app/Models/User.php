<?php

namespace App\Models;

// Database pertence ao mesmo namespace App\Models.

class User
{
    /** Objetivos do cadastro: chave salva no banco => texto exibido. */
    public const OBJETIVOS = [
        'entender-impostos' => 'Entender impostos e tributos',
        'organizar-dinheiro' => 'Organizar meu dinheiro',
        'sair-das-dividas' => 'Sair das dívidas',
        'comecar-a-investir' => 'Começar a investir',
        'entender-economia' => 'Entender a economia',
        'tudo' => 'Aprender um pouco de tudo',
    ];

    /** Níveis do cadastro: chave salva no banco => texto exibido. */
    public const NIVEIS = [
        'basico' => 'Estou começando',
        'intermediario' => 'Já conheço o básico',
    ];

    public static function all(): array
    {
        return Database::connect()
            ->query('SELECT id, name, email FROM users ORDER BY name')
            ->fetchAll();
    }

    public static function find(int $id): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT id, name, email, phone, photo, objetivo, nivel, meta_semanal FROM users WHERE id = ?'
        );
        $stmt->execute([$id]);
        return $stmt->fetch() ?: null;
    }

    public static function findByEmail(string $email): ?array
    {
        $stmt = Database::connect()->prepare(
            'SELECT id, name, email, password_hash FROM users WHERE email = ?'
        );
        $stmt->execute([$email]);
        return $stmt->fetch() ?: null;
    }

    public static function emailExists(string $email): bool
    {
        $stmt = Database::connect()->prepare('SELECT 1 FROM users WHERE email = ?');
        $stmt->execute([$email]);
        return (bool) $stmt->fetchColumn();
    }

    public static function create(
        string $name,
        string $email,
        string $phone,
        string $password,
        ?string $objetivo = null,
        ?string $nivel = null
    ): int {
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = Database::connect()->prepare(
            'INSERT INTO users (name, email, phone, password_hash, objetivo, nivel) VALUES (?, ?, ?, ?, ?, ?)'
        );
        $stmt->execute([$name, $email, $phone, $passwordHash, $objetivo, $nivel]);
        return (int) Database::connect()->lastInsertId();
    }

    public static function atualizarDados(int $id, string $name, string $phone, ?string $objetivo, ?string $nivel): void
    {
        $stmt = Database::connect()->prepare(
            'UPDATE users SET name = ?, phone = ?, objetivo = ?, nivel = ? WHERE id = ?'
        );
        $stmt->execute([$name, $phone, $objetivo, $nivel, $id]);
    }

    public static function senhaHash(int $id): ?string
    {
        $stmt = Database::connect()->prepare('SELECT password_hash FROM users WHERE id = ?');
        $stmt->execute([$id]);
        $hash = $stmt->fetchColumn();
        return is_string($hash) ? $hash : null;
    }

    public static function atualizarSenha(int $id, string $senha): void
    {
        $stmt = Database::connect()->prepare('UPDATE users SET password_hash = ? WHERE id = ?');
        $stmt->execute([password_hash($senha, PASSWORD_DEFAULT), $id]);
    }

    public static function atualizarFoto(int $id, ?string $arquivo): void
    {
        $stmt = Database::connect()->prepare('UPDATE users SET photo = ? WHERE id = ?');
        $stmt->execute([$arquivo, $id]);
    }

    public static function atualizarMeta(int $id, int $meta): void
    {
        $stmt = Database::connect()->prepare('UPDATE users SET meta_semanal = ? WHERE id = ?');
        $stmt->execute([$meta, $id]);
    }
}