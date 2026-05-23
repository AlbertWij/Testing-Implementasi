<?php
namespace Tests;

use App\UserRepository;

class UserRepositoryTest extends BaseTestCase
{
    private UserRepository $userRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $this->userRepo = new UserRepository($this->db);
    }

    // Script 1 — Assertion 1 & 2
    public function test_dapat_menyimpan_data_pasien_baru(): void
    {
        $id = $this->userRepo->savePatient([
            'name'          => 'Budi Santoso',
            'email'         => 'budi@example.com',
            'password'      => 'password123',
            'phone_number' => '081234567890',
            'date_of_birth' => '1990-05-15',
            'gender'        => 'male',
        ]);

        $this->assertGreaterThan(0, $id);                  // Assertion 1
        $user = $this->userRepo->findById($id);
        $this->assertEquals('patient', $user['role']);     // Assertion 2
    }

    // Script 2 — Assertion 3 & 4
    public function test_dapat_mencari_user_berdasarkan_email(): void
    {
        $this->userRepo->savePatient([
            'name'     => 'Siti Rahayu',
            'email'    => 'siti@klinik.com',
            'password' => 'secret',
            'phone_number' => '089876543210',
        ]);

        $user = $this->userRepo->findByEmail('siti@klinik.com');

        $this->assertNotNull($user);                               // Assertion 3
        $this->assertEquals('Siti Rahayu', $user['name']);         // Assertion 4
    }

    // Script 3 — Assertion 5 & 6
    public function test_dapat_menyimpan_data_dokter_dengan_field_spesialisasi(): void
    {
        $id = $this->userRepo->saveDoctor([
            'name'             => 'dr. Ahmad Fauzi, Sp.PD',
            'email'            => 'dr.ahmad@klinik.com',
            'password'         => 'dokter123',
            'specialty'       => 'Penyakit Dalam',
            'department'      => 'Internal Medicine',
            'experience_years'=> 10,
            'rating'          => 4.8,
            'license_number'   => 'STR/2024/1234',
        ]);

        $dokter = $this->userRepo->findById($id);
        $this->assertEquals('doctor', $dokter['role']);                    // Assertion 5
        $this->assertEquals('Penyakit Dalam', $dokter['specialty']);      // Assertion 6
    }
}
