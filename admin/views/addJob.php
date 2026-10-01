<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Add New Job</h1>

<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>

<form method="post">
    <div class="mb-3">
        <label for="job_title" class="form-label">Job Title</label>
        <input type="text" name="job_title" id="job_title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="job_description" class="form-label">Description</label>
        <textarea name="job_description" id="job_description" class="form-control" required></textarea>
    </div>
    <div class="mb-3">
        <label for="job_location" class="form-label">Location</label>
        <input type="text" name="job_location" id="job_location" class="form-control">
    </div>
    <button type="submit" class="btn btn-success">Add Job</button>
    <a href="/computerproject/admin/jobs" class="btn btn-secondary">Cancel</a>
</form>

<?php require __DIR__ . '/partials/footer.php'; ?>