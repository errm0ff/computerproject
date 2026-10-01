<!-- /admin/views/users.php -->
<h1>Users Management</h1>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Privilege</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?= $user['u_id'] ?></td>
                <td><?= htmlspecialchars($user['u_fname'] . ' ' . $user['u_lname']) ?></td>
                <td><?= htmlspecialchars($user['u_email']) ?></td>
                <td><?= $user['u_privilege'] == 2 ? 'Admin' : 'User' ?></td>
                <td><?= $user['u_account_status'] == 1 ? 'Active' : 'Inactive' ?></td>
                <td>
                    <?php if ($user['u_id'] != $_SESSION['user_id']): ?>
                        <a href="/computerproject/admin/deleteUser/<?= $user['u_id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<a href="/computerproject/admin" class="btn btn-secondary">Back to Dashboard</a>