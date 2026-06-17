<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Appointment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminAppointmentController_IntTestt extends TestCase
{
    use RefreshDatabase;

    protected function authenticateAdmin()
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $this->actingAs($admin);
    }

    protected function createDoctor()
    {
        return User::factory()->create([
            'role' => 'doctor',
            'specialty' => 'Cardiology'
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | POSITIVE TESTS
    |--------------------------------------------------------------------------
    */

    public function test_admin_can_view_appointment_list()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.appointments.index'));

        $response->assertStatus(200);
    }

    public function test_admin_can_view_appointment_detail()
    {
        $this->authenticateAdmin();

        $appointment = Appointment::factory()->create();

        $response = $this->get(route('admin.appointments.show', $appointment));

        $response->assertStatus(200);
    }

    public function test_admin_can_update_appointment()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '2026-07-01',
                'appointment_time' => '10:00',
                'doctor_id' => $doctor->id,
                'status' => 'confirmed'
            ]
        );

        $response->assertRedirect(route('admin.appointments.index'));

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'doctor_id' => $doctor->id,
            'status' => 'confirmed'
        ]);
    }

    public function test_admin_can_cancel_appointment()
    {
        $this->authenticateAdmin();

        $appointment = Appointment::factory()->create([
            'status' => 'scheduled'
        ]);

        $response = $this->delete(
            route('admin.appointments.destroy', $appointment)
        );

        $response->assertRedirect();

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'cancelled'
        ]);
    }

    public function test_admin_can_view_history()
    {
        $this->authenticateAdmin();

        $response = $this->get(route('admin.appointments.history'));

        $response->assertStatus(200);
    }

    public function test_admin_can_get_available_slots()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        $response = $this->get(
            route('admin.api.available_slots', [
                'date' => '2026-07-01',
                'doctor_id' => $doctor->id
            ])
        );

        $response->assertStatus(200);
    }

    /*
    |--------------------------------------------------------------------------
    | NEGATIVE TESTS
    |--------------------------------------------------------------------------
    */

    public function test_update_fails_when_doctor_not_found()
    {
        $this->authenticateAdmin();

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '2026-07-01',
                'appointment_time' => '10:00',
                'doctor_id' => 99999,
                'status' => 'confirmed'
            ]
        );

        $response->assertSessionHasErrors('doctor_id');
    }

    public function test_update_fails_when_date_invalid()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '01/07/2026',
                'appointment_time' => '10:00',
                'doctor_id' => $doctor->id,
                'status' => 'confirmed'
            ]
        );

        $response->assertSessionHasErrors('appointment_date');
    }

    public function test_update_fails_when_time_invalid()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '2026-07-01',
                'appointment_time' => '25:00',
                'doctor_id' => $doctor->id,
                'status' => 'confirmed'
            ]
        );

        $response->assertSessionHasErrors('appointment_time');
    }

    public function test_update_fails_when_status_invalid()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '2026-07-01',
                'appointment_time' => '10:00',
                'doctor_id' => $doctor->id,
                'status' => 'active'
            ]
        );

        $response->assertSessionHasErrors('status');
    }

    public function test_available_slots_fails_without_doctor_id()
    {
        $this->authenticateAdmin();

        $response = $this->get(
            route('admin.api.available_slots', [
                'date' => '2026-07-01'
            ])
        );

        $response->assertSessionHasErrors('doctor_id');
    }

    public function test_admin_cannot_update_to_already_booked_slot()
    {
        $this->authenticateAdmin();

        $doctor = $this->createDoctor();

        Appointment::factory()->create([
            'doctor_id' => $doctor->id,
            'doctor_name' => $doctor->name,
            'doctor_specialty' => $doctor->specialty,
            'appointment_date' => '2026-07-01 10:00:00',
            'status' => 'scheduled'
        ]);

        $appointment = Appointment::factory()->create();

        $response = $this->patch(
            route('admin.appointments.update', $appointment),
            [
                'appointment_date' => '2026-07-01',
                'appointment_time' => '10:00',
                'doctor_id' => $doctor->id,
                'status' => 'confirmed'
            ]
        );

        $response->assertSessionHasErrors('error');
    }
}