<?php
class ContactController {

    public function index() {
        $success = null;
        $error = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $message = trim($_POST['message']);

            if (empty($name) || empty($email) || empty($message)) {
                $error = "All fields are required.";
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $error = "Invalid email format.";
            } else {
                // Later you can insert into DB or send email
                $success = "Your message has been sent successfully!";
            }
        }

        $this->render('contact', [
            'success' => $success,
            'error' => $error
        ]);
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}
