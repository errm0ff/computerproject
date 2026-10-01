<?php $title = "Contact Us"; ?>
<?php require 'partials/header.php'; ?>

<h2>Contact Us</h2>

<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= $success ?></div>
<?php endif; ?>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= $error ?></div>
<?php endif; ?>

<form method="POST">
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Message</label>
        <textarea name="message" class="form-control" rows="5" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Send Message</button>
</form>

<?php require 'partials/footer.php'; ?>