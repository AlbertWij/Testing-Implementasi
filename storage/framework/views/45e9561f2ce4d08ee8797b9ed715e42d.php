<?php if (isset($component)) { $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.admin','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.admin'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="mb-4">
        <h1 class="h2 fw-bold">Admin Dashboard</h1>
        <p class="text-muted">High-level overview of the HealthCare Plus system.</p>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card">
                <h5>Total Patients</h5>
                <p class="fs-2 fw-bold text-primary mb-0"><?php echo e($totalPatients); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <h5>Total Doctors</h5>
                <p class="fs-2 fw-bold text-info mb-0"><?php echo e($totalDoctors); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <h5>Appointments Today</h5>
                <p class="fs-2 fw-bold text-success mb-0"><?php echo e($appointmentsToday); ?></p>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <h5>Pending Appointments</h5>
                <p class="fs-2 fw-bold text-warning mb-0"><?php echo e($pendingAppointments); ?></p>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-6">
            <h3 class="h4 fw-bold mb-3">Recent Registrations</h3>
            <div class="card">
                <ul class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <p class="fw-bold mb-0"><?php echo e($user->name); ?></p>
                                <p class="small text-muted mb-0"><?php echo e($user->email); ?></p>
                            </div>
                            <span class="badge rounded-pill 
                                <?php if($user->role == 'patient'): ?> bg-primary-subtle text-primary-emphasis
                                <?php else: ?> bg-info-subtle text-info-emphasis <?php endif; ?>
                            "><?php echo e(ucfirst($user->role)); ?></span>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-muted">No recent registrations.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>

        <div class="col-md-6">
            <h3 class="h4 fw-bold mb-3">Upcoming Appointments</h3>
            <div class="card">
                 <ul class="list-group list-group-flush">
                    <?php $__empty_1 = true; $__currentLoopData = $upcomingAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <li class="list-group-item">
                            <p class="fw-bold mb-0"><?php echo e($appointment->patient->name ?? 'N/A'); ?> with <?php echo e($appointment->doctor->name ?? 'N/A'); ?></p>
                            <p class="small text-muted mb-0"><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('M d, Y \a\t h:i A')); ?></p>
                        </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <li class="list-group-item text-muted">No upcoming appointments.</li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $attributes = $__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__attributesOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3)): ?>
<?php $component = $__componentOriginalc8c9fd5d7827a77a31381de67195f0c3; ?>
<?php unset($__componentOriginalc8c9fd5d7827a77a31381de67195f0c3); ?>
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/staff/admin/dashboard.blade.php ENDPATH**/ ?>