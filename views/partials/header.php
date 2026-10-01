<!-- views/partials/header.php -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Job Portal" ?></title>
    <link rel="stylesheet" href="/computerproject/assets/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand" href="/computerproject/home">Job Portal</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="/computerproject/home">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/jobs">Jobs</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="/computerproject/contact">Contact</a></li>

                <?php if (!empty($_SESSION['user_id']) && !empty($_SESSION['user_name'])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Hello, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/computerproject/auth/logout">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item"><a class="nav-link" href="/computerproject/auth/login">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="/computerproject/register">Register</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<div class="container mt-4">