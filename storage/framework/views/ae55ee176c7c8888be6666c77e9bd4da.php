<?php if (isset($component)) { $__componentOriginal1a6cca1fb3b05e19b47840b98800a235 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.dashboard','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.dashboard'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <!-- Dashboard Title -->
    <h2 class="h3 fw-bold mb-4">Dashboard</h2>

    <!-- Stats Cards -->
    <div class="row g-4 mb-4">
        <div class="col-md-3"><div class="card"><h5>Total Appointments</h5><p class="fs-2 fw-bold"><?php echo e($stats['total']); ?></p></div></div>
        <div class="col-md-3"><div class="card"><h5>Upcoming</h5><p class="fs-2 fw-bold text-warning"><?php echo e($stats['upcoming']); ?></p></div></div>
        <div class="col-md-3"><div class="card"><h5>Completed</h5><p class="fs-2 fw-bold text-success"><?php echo e($stats['completed']); ?></p></div></div>
        <div class="col-md-3"><div class="card"><h5>Cancelled</h5><p class="fs-2 fw-bold text-danger"><?php echo e($stats['cancelled']); ?></p></div></div>
    </div>

    <!-- Upcoming Appointments -->
    <h3 class="h4 fw-bold mb-3">Upcoming Appointments</h3>
    <div class="card p-0">
        <ul class="list-group list-group-flush">
             <?php $__empty_1 = true; $__currentLoopData = $upcomingAppointments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $appointment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    <div>
                        <h5 class="fw-bold mb-1"><?php echo e($appointment->doctor_name); ?></h5>
                        <p class="text-muted mb-1"><?php echo e($appointment->doctor_specialty); ?></p>
                        <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill text-capitalize"><?php echo e($appointment->status); ?></span>
                        <span class="ms-2 text-muted"><?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('Y-m-d \a\t h:i A')); ?></span>
                    </div>
                    <!-- This button triggers the modal -->
                    <button type="button" class="btn btn-outline-primary" 
                            data-bs-toggle="modal" 
                            data-bs-target="#appointmentDetailModal"
                            data-status="<?php echo e(ucfirst($appointment->status)); ?>"
                            data-date="<?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('l, F j, Y')); ?>"
                            data-time="<?php echo e(\Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A')); ?>"
                            data-doctor="<?php echo e($appointment->doctor_name); ?>"
                            data-specialty="<?php echo e($appointment->doctor_specialty); ?>"
                            data-reason="<?php echo e($appointment->reason ?? 'Not given'); ?>">
                        View Details
                    </button>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <li class="list-group-item p-3 text-center">
                     <p class="text-muted mb-0">You have no upcoming appointments.</p>
                </li>
            <?php endif; ?>
        </ul>
    </div>

    <!-- REDESIGNED Appointment Details Modal -->
    <div class="modal fade" id="appointmentDetailModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content custom-modal-content">
                <div class="custom-modal-header">
                    <div class="icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16"><path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0z"/><path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z"/><path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z"/></svg>
                    </div>
                    <h4 class="modal-title">Appointment Details</h4>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4" id="appointmentDetailsBody">
                    <!-- Content will be injected by JavaScript -->
                </div>
            </div>
        </div>
    </div>

    <style>.custom-modal-content{border-radius:1rem;border:none;box-shadow:0 10px 25px rgba(0,0,0,.1);overflow:hidden}.custom-modal-header{background:linear-gradient(135deg,#0066CC,#00B4A6);color:white;padding:1.5rem;text-align:center;position:relative}.custom-modal-header .icon-box{width:60px;height:60px;border-radius:50%;background-color:rgba(255,255,255,.2);display:flex;align-items:center;justify-content:center;margin:0 auto 1rem}.custom-modal-header .btn-close{position:absolute;top:1rem;right:1rem}.modal.fade .modal-dialog{transform:scale(.9);transition:transform .2s ease-out}.modal.show .modal-dialog{transform:scale(1)}</style>

    <?php $__env->startPush('scripts'); ?>
    <script>
        const appointmentDetailModal = document.getElementById('appointmentDetailModal');
        if (appointmentDetailModal) {
            appointmentDetailModal.addEventListener('show.bs.modal', function (event) {
                const button = event.relatedTarget;
                const modalBody = document.getElementById('appointmentDetailsBody');

                // Extract all data from the button
                const status = button.getAttribute('data-status');
                const date = button.getAttribute('data-date');
                const time = button.getAttribute('data-time');
                const doctor = button.getAttribute('data-doctor');
                const specialty = button.getAttribute('data-specialty');
                const reason = button.getAttribute('data-reason');

                // Build the new, beautiful modal content
                modalBody.innerHTML = `
                    <div class="p-2">
                        <div class="row text-center mb-3">
                            <div class="col"><span class="badge fs-6 text-capitalize bg-warning-subtle text-warning-emphasis">${status}</span></div>
                        </div>
                        <h6 class="mt-4">Doctor Information</h6>
                        <div class="row">
                            <div class="col-md-6"><p><small class="text-muted">Name</small><br>${doctor}</p></div>
                            <div class="col-md-6"><p><small class="text-muted">Specialty</small><br>${specialty}</p></div>
                        </div>
                        <hr>
                        <h6 class="mt-4">Appointment Details</h6>
                        <div class="row">
                            <div class="col-md-6"><p><small class="text-muted">Date</small><br>${date}</p></div>
                            <div class="col-md-6"><p><small class="text-muted">Time</small><br>${time}</p></div>
                            <div class="col-12"><p><small class="text-muted">Reason for Visit</small><br>${reason}</p></div>
                        </div>
                    </div>
                `;
            });
        }
    </script>
    <?php $__env->stopPush(); ?>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $attributes = $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $component = $__componentOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/patient/dashboard.blade.php ENDPATH**/ ?>