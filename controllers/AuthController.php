<?php
class AuthController {

    protected $pdo;

    public function __construct() {
        require_once __DIR__ . '/DBController.php';
        $this->pdo = (new DBController())->getConnection();
    }

    public function login() {
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            $stmt = $this->pdo->prepare("SELECT * FROM users_table WHERE u_email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['u_password_hash'])) {
                $_SESSION['user_id'] = $user['u_id'];
                $_SESSION['user_name'] = $user['u_fname'];

                header("Location: /computerproject/home");
                exit;
            } else {
                $error = "Invalid email or password.";
            }
        }

        $this->render('login', ['error' => $error]);
    }

    public function logout() {
        session_unset();   // clear session variables
        session_destroy(); // destroy the session
        header("Location: /computerproject/home");
        exit;
    }
    public function register() {
    $error = null;
    $success = null;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $fname = trim($_POST['u_fname']);
        $lname = trim($_POST['u_lname']);
        $email = trim($_POST['u_email']);
        $password = trim($_POST['u_password']);
        $confirm_password = trim($_POST['u_confirm_password']);
        $phone = trim($_POST['u_phone']);
        $dob = trim($_POST['u_dob']);
        $education_lv = intval($_POST['u_education_lv'] ?? 0);

        // Basic validation
        if (empty($fname) || empty($lname) || empty($email) || empty($password)) {
            $error = "Please fill in all required fields.";
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "Invalid email address.";
        } elseif ($password !== $confirm_password) {
            $error = "Passwords do not match.";
        } else {
            // Check if email already exists
            $stmt = $this->pdo->prepare("SELECT * FROM users_table WHERE u_email = :email");
            $stmt->execute(['email' => $email]);
            if ($stmt->fetch(PDO::FETCH_ASSOC)) {
                $error = "Email is already registered.";
            } else {
                // Insert new user
                $hash = password_hash($password, PASSWORD_BCRYPT);
                $stmt = $this->pdo->prepare("
                    INSERT INTO users_table
                    (u_type, u_privilege, u_fname, u_lname, u_email, u_password_hash, u_phone, u_regdate, u_account_status, u_rating, u_education_lv)
                    VALUES
                    (1, 1, :fname, :lname, :email, :password_hash, :phone, NOW(), 1, 0, :education_lv)
                ");
                $stmt->execute([
                    'fname' => $fname,
                    'lname' => $lname,
                    'email' => $email,
                    'password_hash' => $hash,
                    'phone' => $phone,
                    'education_lv' => $education_lv
                ]);

                $success = "Registration successful! You can now log in.";
            }
        }
    }

    $this->render('register', ['error' => $error, 'success' => $success]);
}

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}