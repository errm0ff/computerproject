<!-- /admin/views/partials/header.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Admin Panel" ?></title>
    <link rel="stylesheet" href="/computerproject/assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/computerproject/admin">Admin Panel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#adminNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminNavbar">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/computerproject/admin">Dashboard</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/admin/users">Users</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/home">Go to Website</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/auth/logout">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">