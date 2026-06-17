<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DoctorAppointment_IntTest extends TestCase
{
    use RefreshDatabase;

    /**
     * =====================================================
     * Doctor dapat melihat daftar appointment miliknya
     * =====================================================
     */
    public function test_doctor_can_view_appointments()
    {
        $doctor = User::factory()->create([
            'role' => 'doctor'
        ]);

        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'doctor_name' => $doctor->name,
            'doctor_specialty' => 'Cardiology',
            'appointment_date' => now(),
            'status' => 'scheduled',
            'reason' => 'Checkup'
        ]);

        $response = $this->actingAs($doctor)
            ->get(route('doctor.appointments.index'));

        $response->assertStatus(200);

        $response->assertViewIs('staff.doctor.my-appointments');

        $response->assertViewHas('appointments');
    }

    /**
     * =====================================================
     * Doctor dapat mengubah status appointment
     * =====================================================
     */
    public function test_doctor_can_update_appointment_status()
    {
        $doctor = User::factory()->create([
            'role' => 'doctor'
        ]);

        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'doctor_name' => $doctor->name,
            'doctor_specialty' => 'Cardiology',
            'appointment_date' => now(),
            'status' => 'scheduled',
            'reason' => 'Checkup'
        ]);

        $response = $this->actingAs($doctor)
            ->patch(route('doctor.appointments.updateStatus', $appointment), [
                'status' => 'confirmed'
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'confirmed'
        ]);
    }

    /**
     * =====================================================
     * Doctor lain tidak boleh mengubah appointment
     * =====================================================
     */
    public function test_other_doctor_cannot_update_appointment()
    {
        $doctor1 = User::factory()->create([
            'role' => 'doctor'
        ]);

        $doctor2 = User::factory()->create([
            'role' => 'doctor'
        ]);

        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $appointment = Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor1->id,
            'doctor_name' => $doctor1->name,
            'doctor_specialty' => 'Cardiology',
            'appointment_date' => now(),
            'status' => 'scheduled',
            'reason' => 'Checkup'
        ]);

        $response = $this->actingAs($doctor2)
            ->patch(route('doctor.appointments.updateStatus', $appointment), [
                'status' => 'confirmed'
            ]);

        $response->assertStatus(403);
    }

    /**
     * =====================================================
     * Doctor dapat membuka halaman riwayat appointment
     * =====================================================
     */
    public function test_doctor_can_view_history_page()
    {
        $doctor = User::factory()->create([
            'role' => 'doctor'
        ]);

        $response = $this->actingAs($doctor)
            ->get(route('doctor.appointments.history'));

        $response->assertStatus(200);

        $response->assertViewIs(
            'staff.doctor.appointment-history'
        );

        $response->assertViewHas('appointments');
    }
}