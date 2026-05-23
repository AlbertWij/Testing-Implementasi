<?php
namespace App;

class UnavailabilityRepository
{
    public function __construct(private \PDO $db) {}

    public function create(array $data): int
    {
        $stmt = $this->db->prepare(
            'INSERT INTO unavailabilities (doctor_id, start_time, end_time, reason, created_at)
             VALUES (:doctor_id, :start_time, :end_time, :reason, NOW())'
        );
        $stmt->execute([
            ':doctor_id'  => $data['doctor_id'],
            ':start_time' => $data['start_time'] ?? null,
            ':end_time'   => $data['end_time'] ?? null,
            ':reason'     => $data['reason'] ?? null,
        ]);
        return (int) $this->db->lastInsertId();
    }

    public function findByDoctorAndDate(int $doctorId, string $date): array
    {
        $stmt = $this->db->prepare(
            'SELECT * FROM unavailabilities WHERE doctor_id = :doctor_id AND DATE(start_time) = :date'
        );
        $stmt->execute([':doctor_id' => $doctorId, ':date' => $date]);
        return $stmt->fetchAll();
    }
}
