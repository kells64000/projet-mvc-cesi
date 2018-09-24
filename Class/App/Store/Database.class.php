<?php

namespace App\Store;

use PDO;
use PDOStatement;

class Database extends PDO {
    public function __construct($host, $db, $user, $pwd, $options=[]) {

        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;

        parent::__construct($dsn, $user, $pwd, $options);
        $this->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);    // les noms de champs seront TOUJOURS en minuscules
        $this->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);    // les erreurs SQL lanceront des exceptions PDO
        $this->exec("SET NAMES 'utf8'");    // force échange de données en UTF-8
    }

    public function run($sql, $arg = null) : PDOStatement {

        $stmt = $this->prepare($sql);
        $stmt->execute($arg);
        return $stmt;
    }
}
