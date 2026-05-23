<?php if (isset($component)) { $__componentOriginal03b6c44728e100ba2673d02906458342 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal03b6c44728e100ba2673d02906458342 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.auth-layout','data' => ['title' => 'Patient Registration']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('auth-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Patient Registration']); ?>
    <div class="text-center mb-4">
         <div class="icon-circle-sm bg-primary bg-opacity-10 text-primary mx-auto mb-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16"><path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/></svg>
        </div>
        <h3 class="fw-bold">Patient Registration</h3>
        <p class="text-muted">Create your patient account</p>
    </div>

    <form method="POST" action="<?php echo e(route('register')); ?>">
        <?php echo csrf_field(); ?>
        <div class="row g-3">
            <!-- Full Name -->
            <div class="col-12">
                <label for="name" class="form-label">Full Name</label>
                <input id="name" class="form-control" type="text" name="name" value="<?php echo e(old('name')); ?>" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="col-12">
                <label for="email" class="form-label">Email Address</label>
                <input id="email" class="form-control" type="email" name="email" value="<?php echo e(old('email')); ?>" required />
            </div>
            
            <!-- Password -->
            <div class="col-md-6">
                <label for="password" class="form-label">Password</label>
                <input id="password" class="form-control" type="password" name="password" required />
            </div>

            <!-- Confirm Password -->
            <div class="col-md-6">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required />
            </div>

            <!-- Phone Number -->
            <div class="col-md-6">
                <label for="phone_number" class="form-label">Phone Number</label>
                <input id="phone_number" class="form-control" type="tel" name="phone_number" value="<?php echo e(old('phone_number')); ?>" required />
            </div>

            <!-- Date of Birth -->
            <div class="col-md-6">
                <label for="date_of_birth" class="form-label">Date of Birth</label>
                <input id="date_of_birth" class="form-control" type="date" name="date_of_birth" value="<?php echo e(old('date_of_birth')); ?>" required />
            </div>

            <!-- Gender -->
            <div class="col-md-6">
                <label for="gender" class="form-label">Gender</label>
                <select id="gender" name="gender" class="form-select" required>
                    <option value="" disabled selected>Select gender</option>
                    <option value="male" <?php if(old('gender') == 'male'): echo 'selected'; endif; ?>>Male</option>
                    <option value="female" <?php if(old('gender') == 'female'): echo 'selected'; endif; ?>>Female</option>
                    <option value="other" <?php if(old('gender') == 'other'): echo 'selected'; endif; ?>>Other</option>
                </select>
            </div>

            <!-- Address -->
            <div class="col-12">
                <label for="address" class="form-label">Address</label>
                <textarea id="address" name="address" class="form-control" rows="2" required><?php echo e(old('address')); ?></textarea>
            </div>

            <?php if($errors->any()): ?>
                <div class="col-12 mt-3">
                    <div class="alert alert-danger py-2">
                        <ul class="mb-0 small">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>

            <div class="col-12 mt-3">
                <button type="submit" class="btn btn-primary w-100 py-2">Create Account</button>
            </div>
        </div>
    </form>
    <div class="text-center mt-4">
        <p class="text-muted">Already have an account? <a href="<?php echo e(route('login')); ?>">Sign In</a></p>
        <a href="/" class="text-muted small">← Back to Home</a>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal03b6c44728e100ba2673d02906458342)): ?>
<?php $attributes = $__attributesOriginal03b6c44728e100ba2673d02906458342; ?>
<?php unset($__attributesOriginal03b6c44728e100ba2673d02906458342); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal03b6c44728e100ba2673d02906458342)): ?>
<?php $component = $__componentOriginal03b6c44728e100ba2673d02906458342; ?>
<?php unset($__componentOriginal03b6c44728e100ba2673d02906458342); ?>
<?php endif; ?>
<style>
.icon-circle-sm {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}
</style><?php /**PATH E:\Albert\Appointment-Booking-System-master\resources\views/auth/register.blade.php ENDPATH**/ ?>