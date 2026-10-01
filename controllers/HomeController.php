<?php
class HomeController {
    protected $pdo;

    public function __construct() {
        require_once __DIR__ . '/DBController.php';
        $this->pdo = (new DBController())->getConnection();
    }

    public function index() {
        // You can fetch some data if needed, e.g., featured jobs
        $stmt = $this->pdo->prepare("
            SELECT jp.j_id, jp.j_title, jp.j_price, jl.l_name AS location_name
            FROM jobs_posts jp
            JOIN jobs_locations jl ON jp.j_location = jl.l_id
            WHERE jp.j_available = 1
            ORDER BY jp.j_post_date DESC
            LIMIT 5
        ");
        $stmt->execute();
        $featuredJobs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->render('home', ['featuredJobs' => $featuredJobs]);
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}