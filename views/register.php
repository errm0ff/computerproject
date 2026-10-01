<!-- views/register.php -->
<?php if (!empty($error)): ?>
    <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
<?php endif; ?>
<?php if (!empty($success)): ?>
    <div class="alert alert-success"><?= htmlspecialchars($success) ?></div>
<?php endif; ?>

<form method="post" action="/computerproject/auth/register">
    <div class="mb-3">
        <label for="u_fname" class="form-label">First Name</label>
        <input type="text" class="form-control" name="u_fname" id="u_fname" required>
    </div>
    <div class="mb-3">
        <label for="u_lname" class="form-label">Last Name</label>
        <input type="text" class="form-control" name="u_lname" id="u_lname" required>
    </div>
    <div class="mb-3">
        <label for="u_email" class="form-label">Email</label>
        <input type="email" class="form-control" name="u_email" id="u_email" required>
    </div>
    <div class="mb-3">
        <label for="u_password" class="form-label">Password</label>
        <input type="password" class="form-control" name="u_password" id="u_password" required>
    </div>
    <div class="mb-3">
        <label for="u_confirm_password" class="form-label">Confirm Password</label>
        <input type="password" class="form-control" name="u_confirm_password" id="u_confirm_password" required>
    </div>
    <div class="mb-3">
        <label for="u_phone" class="form-label">Phone</label>
        <input type="text" class="form-control" name="u_phone" id="u_phone">
    </div>
    <div class="mb-3">
        <label for="u_dob" class="form-label">Date of Birth</label>
        <input type="date" class="form-control" name="u_dob" id="u_dob">
    </div>
    <div class="mb-3">
        <label for="u_education_lv" class="form-label">Education Level</label>
        <select class="form-select" name="u_education_lv" id="u_education_lv">
            <option value="1">High School</option>
            <option value="2">Associate</option>
            <option value="3">Bachelor</option>
            <option value="4">Master</option>
            <option value="5">PhD</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Register</button>
</form>