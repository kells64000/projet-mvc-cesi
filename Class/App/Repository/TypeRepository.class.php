<?php

namespace App\Repository;

use App\Store\Database;

class TypeRepository
{
    private $database;
    private $types = [];

    /**
     * TypeRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
        $stmt = $this->database->run('SELECT distinct type FROM film');
        while($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            $types = explode("/", $row['type']);
            foreach ($types as $type) {
                if (!in_array($type, $this->types)) {
                    $this->types[] = $type;
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getTypes(): array
    {
        return $this->types;
    }
}