<?php $title = "Login"; ?>
<?php require 'partials/header.php'; ?>

<h2>Login</h2>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <input type="email" name="email" class="form-control" placeholder="Email" required>
    </div>

    <div class="mb-3">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
    </div>

    <button type="submit" class="btn btn-primary">Login</button>
</form>

<?php require 'partials/footer.php'; 
$password = 'Password123!';
$hash = password_hash($password, PASSWORD_BCRYPT);
echo $hash;?>