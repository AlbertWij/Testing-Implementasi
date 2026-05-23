<?php
namespace Tests;

use App\UnavailabilityRepository;
use App\UserRepository;

class UnavailabilityRepositoryTest extends BaseTestCase
{
    private UnavailabilityRepository $unavailabilityRepo;
    private int $doctorId;

    protected function setUp(): void
    {
        parent::setUp();
        $this->unavailabilityRepo = new UnavailabilityRepository($this->db);
        $userRepo                 = new UserRepository($this->db);

        $this->doctorId = $userRepo->saveDoctor([
            'name'           => 'dr. Test Unavail',
            'email'          => 'drtu@test.com',
            'password'       => '123',
            'specialty'      => 'Umum',
        ]);
    }

    // Script 8 — Assertion 15 & 16
    public function test_dapat_menyimpan_jadwal_tidak_tersedia_dokter(): void
    {
        $id = $this->unavailabilityRepo->create([
            'doctor_id'  => $this->doctorId,
            'start_time' => '2025-08-25 08:00:00',
            'end_time'   => '2025-08-25 12:00:00',
            'reason'     => 'Menghadiri seminar kedokteran',
        ]);

        $this->assertGreaterThan(0, $id);                                          // Assertion 15
        $records = $this->unavailabilityRepo->findByDoctorAndDate($this->doctorId, '2025-08-25');
        $this->assertCount(1, $records);                                           // Assertion 16
    }

    // Script 9 — Assertion 17 & 18
    public function test_dapat_mengecek_unavailability_dokter_pada_tanggal_tertentu(): void
    {
        $this->unavailabilityRepo->create([
            'doctor_id' => $this->doctorId,
            'start_time' => '2025-08-30 09:00:00',
            'end_time'   => '2025-08-30 17:00:00',
            'reason'    => 'Cuti tahunan',
        ]);

        $unavailDates = $this->unavailabilityRepo->findByDoctorAndDate($this->doctorId, '2025-08-30');
        $availDates   = $this->unavailabilityRepo->findByDoctorAndDate($this->doctorId, '2025-08-31');

        $this->assertNotEmpty($unavailDates);   // Assertion 17
        $this->assertEmpty($availDates);        // Assertion 18
    }
}
