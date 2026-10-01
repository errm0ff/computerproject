<?php
class AdminController {

    protected $pdo;

    public function __construct() {
        require_once __DIR__ . '/../../controllers/DBController.php';
        $this->pdo = (new DBController())->getConnection();

        // Only allow admins
        if (empty($_SESSION['user_id'])) {
            header("Location: /computerproject/login");
            exit;
        }

        // Check privilege (u_privilege = 2 is admin)
        $stmt = $this->pdo->prepare("SELECT u_privilege FROM users_table WHERE u_id = :id");
        $stmt->execute(['id' => $_SESSION['user_id']]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if (!$user || $user['u_privilege'] != 3) {
            echo "Access denied. Admins only.";
            exit;
        }
    }

    // Admin panel (main page)
    public function panel() {
        $this->render('panel');
    }

    // Manage users
    public function users() {
        $stmt = $this->pdo->query("SELECT * FROM users_table ORDER BY u_id DESC");
        $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $this->render('users', ['users' => $users]);
    }

    // Delete a user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users_table WHERE u_id = :id");
        $stmt->execute(['id' => $id]);
        header("Location: /computerproject/admin/panel");
        exit;
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
    // List all jobs
public function jobs() {
    $stmt = $this->pdo->query("
        SELECT j.*, u.u_fname, u.u_lname 
        FROM jobs_table j
        LEFT JOIN users_table u ON j.u_id = u.u_id
        ORDER BY j.j_id DESC
    ");
    $jobs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $this->render('jobs', ['jobs' => $jobs]);
}

// Add a job
public function addJob() {
    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u_id = intval($_POST['u_id']);
        $title = trim($_POST['j_title']);
        $descr = trim($_POST['j_descr']);
        $location = intval($_POST['j_location']);
        $lat = trim($_POST['j_location_latitude']);
        $lng = trim($_POST['j_location_longitude']);
        $price = intval($_POST['j_price']);
        $available = isset($_POST['j_available']) ? 1 : 0;
        $skills = isset($_POST['j_skills_required']) ? 1 : 0;
        $category = intval($_POST['j_category']);

        if (empty($title) || empty($descr)) {
            $error = "Title and description are required.";
        } else {
            $stmt = $this->pdo->prepare("
                INSERT INTO jobs_table 
                (u_id, j_post_date, j_title, j_descr, j_location, j_location_latitude, j_location_longitude, j_price, j_available, j_skills_required, j_category)
                VALUES 
                (:u_id, NOW(), :title, :descr, :location, :lat, :lng, :price, :available, :skills, :category)
            ");
            $stmt->execute([
                'u_id' => $u_id,
                'title' => $title,
                'descr' => $descr,
                'location' => $location,
                'lat' => $lat,
                'lng' => $lng,
                'price' => $price,
                'available' => $available,
                'skills' => $skills,
                'category' => $category
            ]);

            header("Location: /computerproject/admin/jobs");
            exit;
        }
    }

    // Get list of users and categories for form select options
    $users = $this->pdo->query("SELECT u_id, u_fname, u_lname FROM users_table")->fetchAll(PDO::FETCH_ASSOC);
    $categories = $this->pdo->query("SELECT c_id, c_name FROM categories_table")->fetchAll(PDO::FETCH_ASSOC); // adjust table name
    $locations = $this->pdo->query("SELECT l_id, l_name FROM locations_table")->fetchAll(PDO::FETCH_ASSOC); // adjust table name

    $this->render('addJob', ['error' => $error, 'users' => $users, 'categories' => $categories, 'locations' => $locations]);
}

// Edit a job
public function editJob($id) {
    $stmt = $this->pdo->prepare("SELECT * FROM jobs_table WHERE j_id = :id");
    $stmt->execute(['id' => $id]);
    $job = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$job) { echo "Job not found"; exit; }

    $error = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $u_id = intval($_POST['u_id']);
        $title = trim($_POST['j_title']);
        $descr = trim($_POST['j_descr']);
        $location = intval($_POST['j_location']);
        $lat = trim($_POST['j_location_latitude']);
        $lng = trim($_POST['j_location_longitude']);
        $price = intval($_POST['j_price']);
        $available = isset($_POST['j_available']) ? 1 : 0;
        $skills = isset($_POST['j_skills_required']) ? 1 : 0;
        $category = intval($_POST['j_category']);

        if (empty($title) || empty($descr)) {
            $error = "Title and description are required.";
        } else {
            $stmt = $this->pdo->prepare("
                UPDATE jobs_table SET
                u_id = :u_id,
                j_title = :title,
                j_descr = :descr,
                j_location = :location,
                j_location_latitude = :lat,
                j_location_longitude = :lng,
                j_price = :price,
                j_available = :available,
                j_skills_required = :skills,
                j_category = :category
                WHERE j_id = :id
            ");
            $stmt->execute([
                'u_id' => $u_id,
                'title' => $title,
                'descr' => $descr,
                'location' => $location,
                'lat' => $lat,
                'lng' => $lng,
                'price' => $price,
                'available' => $available,
                'skills' => $skills,
                'category' => $category,
                'id' => $id
            ]);

            header("Location: /computerproject/admin/jobs");
            exit;
        }
    }

    $users = $this->pdo->query("SELECT u_id, u_fname, u_lname FROM users_table")->fetchAll(PDO::FETCH_ASSOC);
    $categories = $this->pdo->query("SELECT c_id, c_name FROM categories_table")->fetchAll(PDO::FETCH_ASSOC);
    $locations = $this->pdo->query("SELECT l_id, l_name FROM locations_table")->fetchAll(PDO::FETCH_ASSOC);

    $this->render('editJob', ['job' => $job, 'error' => $error, 'users' => $users, 'categories' => $categories, 'locations' => $locations]);
}

// Delete a job
public function deleteJob($id) {
    $stmt = $this->pdo->prepare("DELETE FROM jobs_table WHERE j_id = :id");
    $stmt->execute(['id' => $id]);
    header("Location: /computerproject/admin/jobs");
    exit;
}
}