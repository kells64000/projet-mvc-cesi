<?php

namespace App\Models;


class Director {
    private $id;
    private $name;

    // Getters
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

    // Setters

    /**
     * @param $id
     */
    public function setId($id) :void
    {
        $this->id = $id;
    }

    /**
     * @param $name
     */
    public function setName($name) :void
    {
        $this->name = $name;
    }
}