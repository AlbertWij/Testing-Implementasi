<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $doctor = User::factory()->create(['role' => 'doctor']);

        return [
            'patient_id'        => User::factory()->create(['role' => 'patient'])->id,
            'doctor_id'         => $doctor->id,
            'doctor_name'       => $doctor->name,
            'doctor_specialty'  => $doctor->specialty,
            'appointment_date'  => now()->addDays(rand(1, 30))->setTime(rand(9, 16), 0),
            'status'            => 'scheduled',
            'reason'            => $this->faker->sentence(),
        ];
    }
}
