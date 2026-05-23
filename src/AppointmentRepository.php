<?php
namespace App;

class AppointmentRepository
{
    public function __construct(private \PDO $db) {}

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO appointments (patient_id, doctor_id, doctor_name, doctor_specialty, appointment_date, reason, status, created_at)
             VALUES (:patient_id, :doctor_id, :doctor_name, :doctor_specialty, :date, :reason, "scheduled", NOW())'
        );
        $stmt->execute([
            ':patient_id' => $data['patient_id'],
            ':doctor_id'  => $data['doctor_id'],
            ':doctor_name' => $data['doctor_name'] ?? null,
            ':doctor_specialty' => $data['doctor_specialty'] ?? null,
            ':date'       => $data['appointment_date'],
            ':reason'     => $data['reason'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function findById(int $id): ?array
    {
        $stmt = $this->db->prepare('SELECT * FROM appointments WHERE id = :id');
        $stmt->execute([':id' => $id]);
        $row = $stmt->fetch();
        return $row !== false ? $row : null;
    }

    public function findByPatient(int $patientId): array
    {
        $stmt = $this->db->prepare('SELECT * FROM appointments WHERE patient_id = :patient_id');
        $stmt->execute([':patient_id' => $patientId]);
        return $stmt->fetchAll();
    }

    public function findByStatus(string $status): array
    {
        $stmt = $this->db->prepare('SELECT * FROM appointments WHERE status = :status');
        $stmt->execute([':status' => $status]);
        return $stmt->fetchAll();
    }

    public function updateStatus(int $id, string $status, ?string $notes = null): bool
    {
        $stmt = $this->db->prepare(
            'UPDATE appointments SET status = :status, updated_at = NOW() WHERE id = :id'
        );
        $stmt->execute([':status' => $status, ':id' => $id]);
        return $stmt->rowCount() > 0;
    }
}
