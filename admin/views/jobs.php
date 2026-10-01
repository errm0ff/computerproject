<?php require __DIR__ . '/partials/header.php'; ?>

<h1>Manage Jobs</h1>
<a href="/computerproject/admin/addJob" class="btn btn-success mb-3">Add New Job</a>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>User</th>
            <th>Location</th>
            <th>Price</th>
            <th>Available</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($jobs as $job): ?>
            <tr>
                <td><?= $job['j_id'] ?></td>
                <td><?= htmlspecialchars($job['j_title']) ?></td>
                <td><?= htmlspecialchars($job['u_fname'] . ' ' . $job['u_lname']) ?></td>
                <td><?= htmlspecialchars($job['j_location']) ?></td>
                <td><?= $job['j_price'] ?></td>
                <td><?= $job['j_available'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="/computerproject/admin/editJob/<?= $job['j_id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                    <a href="/computerproject/admin/deleteJob/<?= $job['j_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<a href="/computerproject/admin/panel" class="btn btn-secondary">Back to Panel</a>

<?php require __DIR__ . '/partials/footer.php'; ?>