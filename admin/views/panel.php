<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Admin Panel</h1>
<p>Welcome, <?= htmlspecialchars($_SESSION['user_name']) ?>!</p>

<div class="list-group">
    <div class="list-group">
    <a href="/computerproject/admin/users" class="list-group-item list-group-item-action">Manage Users</a>
    <a href="/computerproject/admin/jobs" class="list-group-item list-group-item-action">Manage Jobs</a>
    <a href="/computerproject/home" class="list-group-item list-group-item-action">Go to Website</a>
    <a href="/computerproject/auth/logout" class="list-group-item list-group-item-action text-danger">Logout</a>
</div>
</div>

<?php require __DIR__ . '/partials/footer.php'; ?>