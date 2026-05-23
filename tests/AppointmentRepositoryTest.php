<?php
namespace Tests;

use App\AppointmentRepository;
use App\UserRepository;

class AppointmentRepositoryTest extends BaseTestCase
{
    private AppointmentRepository $appointmentRepo;
    private UserRepository $userRepo;
    private int $patientId;
    private int $doctorId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->appointmentRepo = new AppointmentRepository($this->db);
        $this->userRepo        = new UserRepository($this->db);

        // Siapkan data dummy untuk relasi FK
        $this->patientId = $this->userRepo->savePatient([
            'name'     => 'Pasien Dummy',
            'email'    => 'pasien.dummy@test.com',
            'password' => '123',
        ]);
        $this->doctorId = $this->userRepo->saveDoctor([
            'name'           => 'Dokter Dummy',
            'email'          => 'dokter.dummy@test.com',
            'password'       => '123',
            'specialty'      => 'Umum',
        ]);
    }

    // Script 4 — Assertion 7 & 8
    public function test_dapat_membuat_appointment_baru(): void
    {
        $appointmentId = $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-08-20 09:00:00',
            'reason'           => 'Kontrol rutin',
        ]);

        $this->assertGreaterThan(0, $appointmentId);                     // Assertion 7
        $appointment = $this->appointmentRepo->findById($appointmentId);
        $this->assertEquals('scheduled', $appointment['status']);         // Assertion 8
    }

    // Script 5 — Assertion 9 & 10
    public function test_dapat_mencari_appointment_berdasarkan_patient_id(): void
    {
        $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-08-10 08:00:00',
        ]);
        $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-08-17 10:00:00',
        ]);

        $appointments = $this->appointmentRepo->findByPatient($this->patientId);

        $this->assertCount(2, $appointments);                              // Assertion 9
        $this->assertEquals($this->patientId, $appointments[0]['patient_id']); // Assertion 10
    }

    // Script 6 — Assertion 11 & 12
    public function test_dapat_mengupdate_status_appointment_menjadi_confirmed(): void
    {
        $apptId = $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-09-01 11:00:00',
        ]);

        $berhasil = $this->appointmentRepo->updateStatus($apptId, 'confirmed', 'Dikonfirmasi oleh admin');

        $this->assertTrue($berhasil);                                      // Assertion 11
        $updated = $this->appointmentRepo->findById($apptId);
        $this->assertEquals('confirmed', $updated['status']);              // Assertion 12
    }

    // Script 7 — Assertion 13 & 14
    public function test_dapat_memfilter_appointment_berdasarkan_status(): void
    {
        $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-09-05 09:00:00',
        ]);
        $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-09-06 10:00:00',
        ]);
        $idCompleted = $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => $this->doctorId,
            'doctor_name'      => 'Dokter Dummy',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-09-07 11:00:00',
        ]);
        $this->appointmentRepo->updateStatus($idCompleted, 'completed');

        $pendingList = $this->appointmentRepo->findByStatus('scheduled');

        $this->assertCount(2, $pendingList);                               // Assertion 13
        $this->assertEquals('scheduled', $pendingList[0]['status']);       // Assertion 14
    }

    // Script 10 — Assertion 19 & 20
    public function test_appointment_gagal_jika_doctor_id_tidak_valid(): void
    {
        $this->expectException(\PDOException::class);                      // Assertion 19

        $this->appointmentRepo->create([
            'patient_id'       => $this->patientId,
            'doctor_id'        => 99999,   // ID dokter yang tidak ada
            'doctor_name'      => 'Tidak Ada',
            'doctor_specialty' => 'Umum',
            'appointment_date' => '2025-09-10',
            'reason'           => 'Test foreign key constraint',
        ]);

        $this->fail('Seharusnya exception dilempar sebelum baris ini');    // Assertion 20
    }
}
