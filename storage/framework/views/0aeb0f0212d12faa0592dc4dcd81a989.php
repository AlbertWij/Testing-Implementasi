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
        <?php echo $__env->make('patient.book.partials.header', ['step' => 4], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <form method="POST" action="<?php echo e(route('patient.book.store')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <h3 class="h5 fw-bold mb-2">Confirmation</h3>
                        <p class="text-muted">Please review your appointment details.</p>
                        <div class="row g-4 mt-3">
                            <div class="col-md-6"><strong>Patient</strong><p><?php echo e($booking['patient']->name); ?></p></div>
                            <div class="col-md-6"><strong>Doctor</strong><p><?php echo e($booking['doctor']->name); ?></p></div>
                            <div class="col-md-6"><strong>Specialty</strong><p><?php echo e($booking['doctor']->specialty); ?></p></div>
                            <div class="col-md-6"><strong>Date</strong><p><?php echo e(\Carbon\Carbon::parse($booking['appointment_time'])->format('Y-m-d')); ?></p></div>
                            <div class="col-md-6"><strong>Time</strong><p><?php echo e(\Carbon\Carbon::parse($booking['appointment_time'])->format('H:i A')); ?></p></div>
                            <div class="col-12">
                                <label for="reason" class="form-label">Additional Notes / Reason for Visit (Optional)</label>
                                <textarea name="reason" id="reason" class="form-control" rows="3" placeholder="Please describe your symptoms..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('patient.book.create.step.three')); ?>" class="btn btn-secondary">← Back</a>
                        <button type="submit" class="btn btn-success">Confirm Appointment</button>
                    </div>
                </form>
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
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Testing-Implementasi\resources\views/patient/book/step-four.blade.php ENDPATH**/ ?>