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
        <?php echo $__env->make('patient.book.partials.header', ['step' => 2], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <form id="doctor-selection-form" method="POST" action="<?php echo e(route('patient.book.store.step.two')); ?>">
                    <?php echo csrf_field(); ?>
                    <div class="card">
                        <h3 class="h5 fw-bold mb-2">Select Doctor</h3>
                        <p class="text-muted">Choose your preferred healthcare provider.</p>
                        <div class="row g-3 mt-3">
                            <?php $__currentLoopData = $doctors; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $doctor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-md-6">
                                <label class="d-block card-radio">
                                    <input type="radio" name="doctor_id" value="<?php echo e($doctor->id); ?>" class="d-none doctor-radio" required>
                                    <div class="card card-body">
                                        <h5 class="fw-bold"><?php echo e($doctor->name); ?></h5>
                                        <p class="mb-1 fw-bold" style="color:#0066CC;"><?php echo e($doctor->specialty); ?></p>
                                        <p class="text-muted small"><?php echo e($doctor->department); ?></p>
                                        <p class="text-muted small">⭐ <?php echo e($doctor->rating); ?> (<?php echo e($doctor->experience_years); ?> years exp.)</p>
                                    </div>
                                </label>
                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?php echo e(route('patient.book.create.step.one')); ?>" class="btn btn-secondary">← Back</a>
                        <button type="submit" id="next-btn" class="btn btn-primary" disabled>Next →</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>.card-radio input:checked + .card { border-color: #0066CC; box-shadow: 0 0 0 2px #0066CC; }</style>
    <?php $__env->startPush('scripts'); ?>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('doctor-selection-form');
            const nextButton = document.getElementById('next-btn');
            form.addEventListener('change', function(event) {
                if (event.target.name === 'doctor_id') {
                    nextButton.disabled = false;
                }
            });
        });
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
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/patient/book/step-two.blade.php ENDPATH**/ ?>