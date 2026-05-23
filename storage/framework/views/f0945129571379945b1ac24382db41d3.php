<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthCare Plus</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', 'resources/scss/app.scss']); ?>
    <style>
        body { background-color: #f8fafc; }
        .sidebar { width: 280px; }
        .sidebar-link { display: block; padding: 0.75rem 1.25rem; border-radius: 0.5rem; text-decoration: none; color: #4b5563; font-weight: 500; margin-bottom: 0.5rem; }
        .sidebar-link.active, .sidebar-link:hover { background-color: #eef2ff; color: #4338ca; }
        .card { background-color: white; padding: 1.5rem; border-radius: 0.75rem; border: 1px solid #e2e8f0; margin-bottom: 1.5rem; }
    </style>
</head>
<body>
<!-- Off-canvas Sidebar -->
<aside class="sidebar bg-white border-end offcanvas offcanvas-start" tabindex="-1" id="mainSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title h4 fw-bold" style="color: #0066CC;">💙 HealthCare Plus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <a href="<?php echo e(route('patient.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('patient.dashboard') ? 'active' : ''); ?>">Dashboard</a>
            <a href="<?php echo e(route('patient.appointments.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('patient.appointments.*') ? 'active' : ''); ?>">Manage Appointments</a>
            <a href="<?php echo e(route('patient.book.create.step.one')); ?>" class="sidebar-link <?php echo e(request()->routeIs('patient.book.*') ? 'active' : ''); ?>">+ Book Appointment</a>
            <a href="<?php echo e(route('patient.appointments.history')); ?>" class="sidebar-link <?php echo e(request()->routeIs('patient.appointments.history') ? 'active' : ''); ?>">Appointment History</a>
            <a href="<?php echo e(route('patient.profile.edit')); ?>" class="sidebar-link <?php echo e(request()->routeIs('patient.profile.edit') ? 'active' : ''); ?>">Profile</a>
            <hr>
            <a href="<?php echo e(route('homepage')); ?>" class="sidebar-link">← Back to Home</a>
        </nav>
    </div>
</aside>

<!-- Main Content -->
<main class="flex-grow-1 p-3 p-md-4">
    <!-- CORRECTED HEADER -->
     <header class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
        <!-- Menu Button -->
        <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainSidebar" aria-controls="mainSidebar">
            ☰ Menu
        </button>
        <!-- Welcome Message (pushed to the right) -->
        <div class="ms-auto">
            <span>Welcome, <?php echo e(Auth::user()->name); ?></span>
            <form method="POST" action="<?php echo e(route('logout')); ?>" class="d-inline ms-3">
                <?php echo csrf_field(); ?>
                <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); this.closest('form').submit();" class="text-danger fw-bold text-decoration-none">Logout</a>
            </form>
        </div>
    </header>

    <!-- Page Specific Content -->
    <?php echo e($slot); ?>

</main>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html><?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/components/layouts/dashboard.blade.php ENDPATH**/ ?>