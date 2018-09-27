<?php

namespace App\Store;

use PDO;
use PDOStatement;

class Database extends PDO {
    /**
     * Database constructor.
     * @param $host
     * @param $db
     * @param $user
     * @param $pwd
     * @param array $options
     */
    public function __construct($host, $db, $user, $pwd, $options=[]) {

        $dsn = 'mysql:host=' . $host . ';dbname=' . $db;

        parent::__construct($dsn, $user, $pwd, $options);
        $this->setAttribute(PDO::ATTR_CASE, PDO::CASE_LOWER);    // les noms de champs seront TOUJOURS en minuscules
        $this->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);    // les erreurs SQL lanceront des exceptions PDO
        $this->exec("SET NAMES 'utf8'");    // force échange de données en UTF-8
    }

    /**
     * @param $sql
     * @param null $arg
     * @return PDOStatement
     */
    public function run($sql, $arg = null) : PDOStatement {

        $stmt = $this->prepare($sql);

//        $stmt->bindValue(':orderBy',$arg['orderBy'], PDO::PARAM_STR);
//        $stmt->bindValue(':dir',$arg['dir'], PDO::PARAM_STR);

        $stmt->execute($arg);

        return $stmt;
    }
}
