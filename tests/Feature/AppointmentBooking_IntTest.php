<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AppointmentBooking_IntTest extends TestCase
{
    use RefreshDatabase;

    public function test_patient_can_access_step_one()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $response = $this->actingAs($patient)
            ->get(route('patient.book.create.step.one'));

        $response->assertStatus(200);
        $response->assertViewIs('patient.book.step-one');
    }

    public function test_patient_can_store_selected_doctor()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $doctor = User::factory()->create([
            'role' => 'doctor',
            'specialty' => 'Neurology'
        ]);

        $response = $this->actingAs($patient)
            ->post(route('patient.book.store.step.two'), [
                'doctor_id' => $doctor->id
            ]);

        $response->assertRedirect(
            route('patient.book.create.step.three')
        );

        $this->assertEquals(
            $doctor->id,
            session('booking.doctor')->id
        );
    }

    public function test_patient_can_store_appointment_time()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $response = $this->actingAs($patient)
            ->withSession([
                'booking' => []
            ])
            ->post(route('patient.book.store.step.three'), [
                'appointment_time' => '2026-06-20 10:00:00'
            ]);

        $response->assertRedirect(
            route('patient.book.create.step.four')
        );

        $this->assertEquals(
            '2026-06-20 10:00:00',
            session('booking.appointment_time')
        );
    }

    public function test_patient_can_create_appointment()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $doctor = User::factory()->create([
            'role' => 'doctor',
            'specialty' => 'Cardiology'
        ]);

        $response = $this->actingAs($patient)
            ->withSession([
                'booking' => [
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'appointment_time' => '2026-06-20 10:00:00'
                ]
            ])
            ->post(route('patient.book.store'), [
                'reason' => 'Checkup'
            ]);

        $response->assertRedirect(
            route('patient.book.confirmation')
        );

        $this->assertDatabaseHas('appointments', [
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'status' => 'scheduled',
            'reason' => 'Checkup'
        ]);
    }

    public function test_patient_cannot_double_book_same_slot()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $doctor = User::factory()->create([
            'role' => 'doctor',
            'specialty' => 'Neurology'
        ]);

        Appointment::create([
            'patient_id' => $patient->id,
            'doctor_id' => $doctor->id,
            'doctor_name' => $doctor->name,
            'doctor_specialty' => $doctor->specialty,
            'appointment_date' => '2026-06-20 10:00:00',
            'status' => 'scheduled',
            'reason' => 'Old appointment'
        ]);

        $response = $this->actingAs($patient)
            ->withSession([
                'booking' => [
                    'patient' => $patient,
                    'doctor' => $doctor,
                    'appointment_time' => '2026-06-20 10:00:00'
                ]
            ])
            ->post(route('patient.book.store'));

        $response->assertSessionHasErrors(
            'appointment_time'
        );
    }

    public function test_patient_can_open_confirmation_page()
    {
        $patient = User::factory()->create([
            'role' => 'patient'
        ]);

        $response = $this->actingAs($patient)
            ->withSession([
                'last_booked_appointment_id' => 1
            ])
            ->get(route('patient.book.confirmation'));

        $response->assertStatus(200);
        $response->assertViewIs('patient.book.confirmation');
    }
}