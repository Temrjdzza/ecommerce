<?php

class User
{
    public $id;
    public $username;
    public $password;
    public $role;

    protected static $table = 'users';

    public function __construct(array $data)
    {
        $this->id = $data['id'] ?? null;
        $this->username = $data['username'] ?? null;
        $this->password = $data['password'] ?? null;
        $this->role = $data['role'] ?? null;
    }

    // Создание нового пользователя
    public static function create(string $username, string $password, string $role = 'user'): ?self
    {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO " . self::$table . " (username, password, role) VALUES (:username, :password, :role)";
        $success = Database::execute($sql, [
            ':username' => $username,
            ':password' => $hashedPassword,
            ':role' => $role
        ]);

        if ($success) {
            $id = Database::getInstance()->lastInsertId();
            return self::findById($id);
        }

        return null;
    }

    // Получить пользователя по ID
    public static function findById(int $id): ?self
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE id = :id LIMIT 1";
        $result = Database::query($sql, [':id' => $id]);

        if (!empty($result)) {
            return new self($result[0]);
        }

        return null;
    }

    // Получить пользователя по username
    public static function findByUsername(string $username): ?self
    {
        $sql = "SELECT * FROM " . self::$table . " WHERE username = :username LIMIT 1";
        $result = Database::query($sql, [':username' => $username]);

        if (!empty($result)) {
            return new self($result[0]);
        }

        return null;
    }

    // Обновить роль пользователя
    public function updateRole(string $role): bool
    {
        $sql = "UPDATE " . self::$table . " SET role = :role WHERE id = :id";
        $success = Database::execute($sql, [
            ':role' => $role,
            ':id' => $this->id
        ]);

        if ($success) {
            $this->role = $role;
        }

        return $success;
    }

    // Удалить пользователя
    public function delete(): bool
    {
        $sql = "DELETE FROM " . self::$table . " WHERE id = :id";
        return Database::execute($sql, [':id' => $this->id]);
    }

    // Проверка пароля
    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }
}
