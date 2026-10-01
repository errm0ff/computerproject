<?php
class JobsController {
    protected $pdo;

    public function __construct() {
        require_once __DIR__ . '/DBController.php';
        $this->pdo = (new DBController())->getConnection();
    }

    // Show all jobs
    public function index() {
        $stmt = $this->pdo->prepare("
            SELECT jp.*, 
                   jl.l_name AS location_name, 
                   jc.cat_name AS category_name
            FROM jobs_posts jp
            JOIN jobs_locations jl ON jp.j_location = jl.l_id
            JOIN jobs_categories jc ON jp.j_category = jc.cat_id
            WHERE jp.j_available = 1
            ORDER BY jp.j_post_date DESC
        ");
        $stmt->execute();
        $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->render('jobs', ['jobs' => $jobs]);
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}