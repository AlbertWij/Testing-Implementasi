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
    <div class="container">
        <?php echo $__env->make('patient.book.partials.header', ['step' => 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <h3 class="h5 fw-bold mb-4">Patient Information</h3>
                    <p class="text-muted">Please verify your information below.</p>
                    <div class="row g-4 mt-3">
                        <div class="col-md-6"><strong>Full Name</strong><p><?php echo e($patient->name); ?></p></div>
                        <div class="col-md-6"><strong>Email</strong><p><?php echo e($patient->email); ?></p></div>
                        <div class="col-md-6"><strong>Phone</strong><p><?php echo e($patient->phone_number); ?></p></div>
                        <div class="col-md-6"><strong>Date of Birth</strong><p><?php echo e(\Carbon\Carbon::parse($patient->date_of_birth)->format('Y-m-d')); ?></p></div>
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-4">
                    <a href="<?php echo e(route('patient.book.create.step.two')); ?>" class="btn btn-primary">Next →</a>
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $attributes = $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $component = $__componentOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/patient/book/step-one.blade.php ENDPATH**/ ?>