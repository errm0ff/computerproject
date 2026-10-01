<?php
class AboutController {

    public function index() {
        $this->render('about');
    }

    private function render($view, $data = []) {
        extract($data);
        require __DIR__ . '/../views/' . $view . '.php';
    }
}
