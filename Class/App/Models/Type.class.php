<?php

namespace App\Models;

class Type
{
    private $id;
    private $name;

    // GETTERS
    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName() :string
    {
        return $this->name;
    }

    // SETTERS
    /**
     * @param $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }
}