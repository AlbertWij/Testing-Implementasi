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
    <div class="text-center" style="margin-top: 15vh;">
        <svg class="mx-auto mb-4 text-success" style="width: 80px; height: 80px;" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <h2 class="h3 fw-bold">Appointment Booked!</h2>
        <p class="text-muted">Your appointment has been successfully scheduled.</p>

         <div class="mt-4">
            <a href="<?php echo e(route('patient.appointments.export.patient', ['appointment' => $appointmentId])); ?>" class="btn btn-success">
                Download Confirmation (PDF)
            </a>
            <a href="<?php echo e(route('patient.appointments.index')); ?>" class="btn btn-secondary">
                Go to My Appointments
            </a>
        </div>
    </div>

    <script>
        // Automatically redirect after 7 seconds
        setTimeout(function() {
            window.location.href = "<?php echo e(route('patient.appointments.index')); ?>";
        }, 7000);
    </script>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $attributes = $__attributesOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__attributesOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235)): ?>
<?php $component = $__componentOriginal1a6cca1fb3b05e19b47840b98800a235; ?>
<?php unset($__componentOriginal1a6cca1fb3b05e19b47840b98800a235); ?>
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Testing-Implementasi\resources\views/patient/book/confirmation.blade.php ENDPATH**/ ?>