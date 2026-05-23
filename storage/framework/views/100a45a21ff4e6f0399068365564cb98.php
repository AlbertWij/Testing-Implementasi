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
    <div x-data="{ isEditing: false }">
        <header class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="h3 fw-bold">My Profile</h2>
            <button x-show="!isEditing" @click="isEditing = true" class="btn btn-primary">Edit Profile</button>
        </header>

        <div class="card">
            <div class="card-body p-4">
                <h3 x-show="isEditing" class="h5 fw-bold mb-4">Edit Profile</h3>
                <h3 x-show="!isEditing" class="h5 fw-bold mb-4">Personal Information</h3>

                <?php if(session('status') === 'profile-updated'): ?>
                    <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)" class="alert alert-success">Profile updated successfully.</div>
                <?php endif; ?>
                
                <!-- Read-Only View -->
                <div x-show="!isEditing" class="row g-4">
                    <div class="col-md-6"><strong>Full Name</strong><p><?php echo e($user->name); ?></p></div>
                    <div class="col-md-6"><strong>Email Address</strong><p><?php echo e($user->email); ?></p></div>
                    <div class="col-md-6"><strong>Phone Number</strong><p><?php echo e($user->phone_number ?? 'N/A'); ?></p></div>
                    <div class="col-md-6"><strong>Date of Birth</strong><p><?php echo e($user->date_of_birth ? \Carbon\Carbon::parse($user->date_of_birth)->format('Y-m-d') : 'N/A'); ?></p></div>
                    <div class="col-md-6"><strong>Gender</strong><p class="text-capitalize"><?php echo e($user->gender ?? 'N/A'); ?></p></div>
                    <div class="col-12"><strong>Address</strong><p><?php echo e($user->address ?? 'N/A'); ?></p></div>
                </div>

                <!-- Edit Form -->
                <form x-show="isEditing" x-cloak method="post" action="<?php echo e(route('admin.profile.update')); ?>">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <div class="row g-3">
                        <div class="col-md-6"><label class="form-label">Full Name</label><input type="text" name="name" class="form-control" value="<?php echo e(old('name', $user->name)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Email Address</label><input type="email" name="email" class="form-control" value="<?php echo e(old('email', $user->email)); ?>" required></div>
                        <div class="col-md-6"><label class="form-label">Phone Number</label><input type="text" name="phone_number" class="form-control" value="<?php echo e(old('phone_number', $user->phone_number)); ?>"></div>
                        <div class="col-md-6"><label class="form-label">Date of Birth</label><input type="date" name="date_of_birth" class="form-control" value="<?php echo e(old('date_of_birth', $user->date_of_birth)); ?>"></div>
                        <div class="col-md-6"><label class="form-label">Gender</label><select name="gender" class="form-select"><option value="">Select</option><option value="male" <?php if(old('gender', $user->gender) == 'male'): echo 'selected'; endif; ?>>Male</option><option value="female" <?php if(old('gender', $user->gender) == 'female'): echo 'selected'; endif; ?>>Female</option><option value="other" <?php if(old('gender', $user->gender) == 'other'): echo 'selected'; endif; ?>>Other</option></select></div>
                        <div class="col-12"><label class="form-label">Address</label><input type="text" name="address" class="form-control" value="<?php echo e(old('address', $user->address)); ?>"></div>
                        
                        <div class="col-12"><hr><h6 class="mb-3">Change Password (Optional)</h6></div>
                        <div class="col-md-6"><label class="form-label">New Password</label><input type="password" name="password" class="form-control"></div>
                        <div class="col-md-6"><label class="form-label">Confirm New Password</label><input type="password" name="password_confirmation" class="form-control"></div>
                    </div>
                    <div class="mt-4">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" @click="isEditing = false" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
            <style>[x-cloak] { display: none !important; }</style>
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
<?php endif; ?><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/admin/profile/edit.blade.php ENDPATH**/ ?>