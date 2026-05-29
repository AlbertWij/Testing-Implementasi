<h2 class="h3 fw-bold mb-4">Book New Appointment</h2>

<div class="d-flex justify-content-between mb-5">
    <?php
        $steps = ['Patient Info', 'Select Doctor', 'Date & Time', 'Confirmation'];
    ?>

    <?php $__currentLoopData = $steps; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stepName): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $currentStep = $index + 1;
            $isCompleted = $step > $currentStep;
            $isActive = $step == $currentStep;
        ?>
        <div class="text-center">
            <div class="d-flex align-items-center">
                <div class="d-flex align-items-center justify-content-center rounded-circle" 
                     style='width: 32px; height: 32px; 
                            background-color: <?php echo e($isCompleted ? '#16a34a' : ($isActive ? '#2563eb' : '#e2e8f0')); ?>;
                            color: white;'>
                    <?php if($isCompleted): ?>
                        <span>&#10003;</span> <?php else: ?>
                        <?php echo e($currentStep); ?>

                    <?php endif; ?>
                </div>
                <span class="ms-2 fw-bold <?php echo e($isActive || $isCompleted ? 'text-dark' : 'text-muted'); ?>"><?php echo e($stepName); ?></span>
            </div>
        </div>
        <?php if(!$loop->last): ?>
        <div class="flex-fill" style="height: 2px; background-color: <?php echo e($isCompleted ? '#16a34a' : '#e2e8f0'); ?>; margin: auto 1rem;"></div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Testing-Implementasi\resources\views/patient/book/partials/header.blade.php ENDPATH**/ ?>