<?php if (isset($component)) { $__componentOriginala03e37d80bd914102d1fc3edb1482cfe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala03e37d80bd914102d1fc3edb1482cfe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.doctor','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.doctor'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div x-data="{ isEditing: false }">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold">My Profile</h2>
            <button x-show="!isEditing" @click="isEditing = true" class="btn btn-primary">Edit Profile Information</button>
        </header>

        <!-- Profile Information Card -->
        <div class="card mb-4">
            <div class="card-body p-4">
                <h3 x-show="isEditing" class="h5 fw-bold mb-4">Edit Profile Information</h3>
                <h3 x-show="!isEditing" class="h5 fw-bold mb-4">Personal & Professional Information</h3>

                <?php if(session('status') === 'profile-updated'): ?>
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success">Profile updated successfully.</div>
                <?php endif; ?>
                
                <!-- Read-Only View -->
                <div x-show="!isEditing" class="row g-4">
                    <div class="col-md-6"><strong>Full Name</strong><p><?php echo e($user->name); ?></p></div>
                    <div class="col-md-6"><strong>Email Address</strong><p><?php echo e($user->email); ?></p></div>
                    <div class="col-md-6"><strong>Phone Number</strong><p><?php echo e($user->phone_number ?? 'N/A'); ?></p></div>
                    <div class="col-md-6"><strong>Date of Birth</strong><p><?php echo e($user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A'); ?></p></div>
                    <!-- ADDED GENDER TO VIEW -->
                    <div class="col-md-6"><strong>Gender</strong><p class="text-capitalize"><?php echo e($user->gender ?? 'N/A'); ?></p></div>
                    <div class="col-12"><strong>Address</strong><p><?php echo e($user->address ?? 'N/A'); ?></p></div>
                    <hr>
                    <div class="col-md-6"><strong>Specialty</strong><p><?php echo e($user->specialty ?? 'N/A'); ?></p></div>
                    <div class="col-md-6"><strong>License Number</strong><p><?php echo e($user->license_number ?? 'N/A'); ?></p></div>
                    <div class="col-md-6"><strong>Years of Experience</strong><p><?php echo e($user->experience_years ?? 'N/A'); ?></p></div>
                </div>

                <!-- Edit Form -->
                <form x-show="isEditing" x-cloak method="post" action="<?php echo e(route('doctor.profile.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Phone Number</label><input type="text" name="phone_number" class="form-control" value="<?php echo e(old('phone_number', $user->phone_number)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" value="<?php echo e(old('date_of_birth', $user->date_of_birth)); ?>" required></div>
                        <!-- ADDED GENDER TO FORM -->
                        <div class="col-md-6">
                            <label class="form-label">Gender</label>
                            <select name="gender" class="form-select" required>
                                <option value="">Select</option>
                                <option value="male" <?php if(old('gender', $user->gender) == 'male'): echo 'selected'; endif; ?>>Male</option>
                                <option value="female" <?php if(old('gender', $user->gender) == 'female'): echo 'selected'; endif; ?>>Female</option>
                                <option value="other" <?php if(old('gender', $user->gender) == 'other'): echo 'selected'; endif; ?>>Other</option>
                            </select>
                        </div>
                        <div class="col-12"><label class="form-label">Address</label><input type="text" name="address" class="form-control" value="<?php echo e(old('address', $user->address)); ?>" required></div>
                        <hr>
                        <div class="col-md-6"><label class="form-label">Specialty</label><input type="text" name="specialty" class="form-control" value="<?php echo e(old('specialty', $user->specialty)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">License Number</label><input type="text" name="license_number" class="form-control" value="<?php echo e(old('license_number', $user->license_number)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Years of Experience</label><input type="number" name="experience_years" class="form-control" value="<?php echo e(old('experience_years', $user->experience_years)); ?>" required></div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" @click="isEditing = false" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
        
        <!-- Security Settings (No changes here) -->
        <div x-show="isEditing" x-cloak x-transition>
            <h3 class="h4 fw-bold mb-3 mt-5">Security Settings</h3>
            <div class="card">
                <div class="card-body p-4">
                    <h3 class="h5 fw-bold mb-4">Update Password</h3>
                    <p class="text-muted small">Ensure your account is using a long, random password to stay secure.</p>
                    <form method="post" action="<?php echo e(route('doctor.password.update')); ?>" class="mt-4">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('put'); ?>
                        <div class="mb-3">
                            <label for="current_password" class="form-label">Current Password</label>
                            <input id="current_password" name="current_password" type="password" class="form-control <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="current-password">
                            <?php $__errorArgs = ['current_password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">New Password</label>
                            <input id="password" name="password" type="password" class="form-control <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" autocomplete="new-password">
                            <?php $__errorArgs = ['password', 'updatePassword'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="invalid-feedback"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="mb-3">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="form-control" autocomplete="new-password">
                        </div>
                        <div class="d-flex align-items-center gap-4">
                            <button type="submit" class="btn btn-primary">Save Password</button>
                            <?php if(session('status') === 'password-updated'): ?>
                                <p x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="text-success small m-0">Saved.</p>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <style>[x-cloak] { display: none !important; }</style>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala03e37d80bd914102d1fc3edb1482cfe)): ?>
<?php $attributes = $__attributesOriginala03e37d80bd914102d1fc3edb1482cfe; ?>
<?php unset($__attributesOriginala03e37d80bd914102d1fc3edb1482cfe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala03e37d80bd914102d1fc3edb1482cfe)): ?>
<?php $component = $__componentOriginala03e37d80bd914102d1fc3edb1482cfe; ?>
<?php unset($__componentOriginala03e37d80bd914102d1fc3edb1482cfe); ?>
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/staff/doctor/profile.blade.php ENDPATH**/ ?>