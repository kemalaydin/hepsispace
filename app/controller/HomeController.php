<?php
require_once(CORE . "controller.php");

class HomeController extends Controller
{
    public function index()
    {
        $_SESSION['start_game'] = 0;
        $this->View("home");
    }
}
