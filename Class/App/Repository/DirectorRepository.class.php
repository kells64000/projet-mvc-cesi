<?php

namespace App\Repository;

use App\Models\Director;
use App\Store\Database;

class DirectorRepository
{
    private $database;

    /**
     * DirectorRepository constructor.
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

        $sql = "SELECT * FROM director";

        $stmt = $this->database->run($sql);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Director');
    }

    /**
     * @param $name
     * @return int
     */
    public function searchId($name) {

        $sql = "SELECT id FROM director WHERE name ='" . $name . "'";

        $stmt = $this->database->run($sql);

        $director = $stmt->fetchAll();
        $id = intval($director[0]['id']);

        return $id;
    }

}