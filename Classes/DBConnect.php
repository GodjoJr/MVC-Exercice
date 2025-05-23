<?php

class DBConnect extends PDO
{
    private string $host;
    private string $port;
    private string $user;
    private string $password;
    private string $database;
    private string $dsn;
    private PDO $pdo;

    public function __construct()
    {
        $config = require 'config/config.php';

        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->database = $config['database'];

        $this->dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->database;
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, ]);
        } catch (PDOException | Exception $e) {
            echo $e->getMessage();
        }
    }

    public function getPDO(): PDO
    {
        return $this->pdo;
    }

}

