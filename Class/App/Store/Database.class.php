<?php

namespace App\Store;

use PDO;
use PDOStatement;

class Database extends PDO {
    public function __construct($host, $db, $user, $pwd, $options=[]) {

        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;

        $default = [
            PDO::ATTR_CASE                  => PDO::CASE_LOWER,
            PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES      => false,
        ];
        $options = array_merge($options, $default);
        parent::__construct($dsn, $user, $pwd, $options);
        $this->exec("SET NAMES `utf8`");
    }

    public function run($sql, $arg = null) : PDOStatement {

        $stmt = $this->prepare($sql);
        $stmt->execute($arg);
        return $stmt;
    }
}
