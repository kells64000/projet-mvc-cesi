<?php

namespace App\Repository;

use App\Store\Database;

class TypeRepository
{
    private $database;

    /**
     * TypeRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    /**
     * @return array
     */
    public function showAll() {

        $sql = "SELECT * FROM type";

        $stmt = $this->database->run($sql);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Type');
    }
}