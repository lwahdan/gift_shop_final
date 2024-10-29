<?php


class login {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function register($data) {
        // Code to save user to database
    }

    public function login($email, $password) {
        // Code to authenticate user
    }
}
