<?php
namespace App;

class UserRepository
{
    public function __construct(private \PDO $db) {}

    public function savePatient(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password, role, phone_number, date_of_birth, address, gender, created_at)
             VALUES (:name, :email, :password, "patient", :phone_number, :dob, :address, :gender, NOW())'
        );
        $stmt->execute([
            ':name'       => $data['name'],
            ':email'      => $data['email'],
            ':password'   => password_hash($data['password'], PASSWORD_BCRYPT),
            ':phone_number' => $data['phone_number'] ?? $data['phone'] ?? null,
            ':dob'        => $data['date_of_birth'] ?? null,
            ':address'    => $data['address'] ?? null,
            ':gender'     => $data['gender'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function saveDoctor(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO users (name, email, password, role, specialty, department, experience_years, rating, license_number, created_at)
             VALUES (:name, :email, :password, "doctor", :specialty, :department, :experience_years, :rating, :license, NOW())'
        );
        $stmt->execute([
            ':name'           => $data['name'],
            ':email'          => $data['email'],
            ':password'       => password_hash($data['password'], PASSWORD_BCRYPT),
            ':specialty'      => $data['specialty'] ?? $data['specialization'] ?? null,
            ':department'     => $data['department'] ?? null,
            ':experience_years' => $data['experience_years'] ?? null,
            ':rating'         => $data['rating'] ?? null,
            ':license'        => $data['license_number'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row !== false ? $row : null;
    }

    public function findByEmail(string $email): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute([':email' => $email]);
        $row = $stmt->fetch();
        return $row !== false ? $row : null;
    }

    public function findByRole(string $role): array
    {
        $stmt = $this->db->prepare('SELECT * FROM users WHERE role = :role');
        $stmt->execute([':role' => $role]);
        return $stmt->fetchAll();
    }

    public function delete(int $id): bool
    {
        $stmt = $this->db->prepare('DELETE FROM users WHERE id = :id');
        $stmt->execute([':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
