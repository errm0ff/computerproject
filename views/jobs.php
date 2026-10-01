<?php $title = "Jobs - Job Portal"; ?>
<?php require 'partials/header.php'; ?>

<h1 class="mb-4">Available Jobs</h1>

<?php if(!empty($jobs)): ?>
    <div class="row">
        <?php foreach($jobs as $job): ?>
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($job['j_title']) ?></h5>
                        <p class="card-text"><?= htmlspecialchars($job['j_descr']) ?></p>
                        <ul class="list-unstyled">
                            <li><strong>Category:</strong> <?= htmlspecialchars($job['category_name']) ?></li>
                            <li><strong>Location:</strong> <?= htmlspecialchars($job['location_name']) ?></li>
                            <li><strong>Price:</strong> $<?= number_format($job['j_price'], 2) ?></li>
                            <li><strong>Skills Required:</strong> <?= $job['j_skills_required'] ? 'Yes' : 'No' ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>No jobs available at the moment.</p>
<?php endif; ?>

<?php require 'partials/footer.php'; ?>