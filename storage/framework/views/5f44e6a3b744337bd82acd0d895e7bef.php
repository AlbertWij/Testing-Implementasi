<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - HealthCare Plus</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', 'resources/scss/app.scss']); ?>

    <style>
        html, body {
            height: 100%;
            background-color: #f8fafc;
        }
        .sidebar {
            width: 280px;
        }
        .sidebar-link {
            display: block;
            padding: 0.75rem 1.25rem;
            border-radius: 0.5rem;
            text-decoration: none;
            color: #4b5563;
            font-weight: 500;
            margin-bottom: 0.5rem;
        }
        .sidebar-link.active,
        .sidebar-link:hover {
            background-color: #eef2ff;
            color: #4338ca;
        }
        .card {
            background-color: white;
            padding: 1.5rem;
            border-radius: 0.75rem;
            border: 1px solid #e2e8f0;
            margin-bottom: 1.5rem;
        }
    </style>
</head>
<body class="d-flex flex-column min-vh-100">

<!-- Off-canvas Sidebar -->
<aside class="sidebar bg-white border-end offcanvas offcanvas-start" tabindex="-1" id="mainSidebar">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title h4 fw-bold text-primary">💙 HealthCare Plus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <nav>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.dashboard') ? 'active' : ''); ?>">Dashboard</a>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">User Management</a>
            <a href="<?php echo e(route('admin.appointments.index')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.appointments.index') ? 'active' : ''); ?>">All Appointments</a>
            <a href="<?php echo e(route('admin.appointments.history')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.appointments.history') ? 'active' : ''); ?>">Appointment History</a>
            <a href="<?php echo e(route('admin.profile.edit')); ?>" class="sidebar-link <?php echo e(request()->routeIs('admin.profile.edit') ? 'active' : ''); ?>">My Profile</a>
            <hr>
            <a href="<?php echo e(route('homepage')); ?>" class="sidebar-link">← Back to Home</a>
        </nav>
    </div>
</aside>

<!-- Page Layout Wrapper -->
<div class="d-flex flex-column flex-md-row w-100">

    <!-- Main Content -->
    <main class="flex-grow-1 p-3 p-md-4">
        <!-- Header -->
        <header class="d-flex flex-wrap justify-content-between align-items-center mb-4 gap-2">
            <!-- Menu Button (always visible) -->
            <button class="btn btn-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#mainSidebar" aria-controls="mainSidebar">
                ☰ Menu
            </button>
            <div class="text-end">
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
</div>

<?php echo $__env->yieldPushContent('scripts'); ?>
</body>
</html>
<?php /**PATH C:\Users\User\OneDrive\Documents\Albert\Appointment-Booking-System-master\resources\views/components/layouts/admin.blade.php ENDPATH**/ ?>