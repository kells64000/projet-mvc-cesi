<?php

namespace App\Models;

class Film {
    private $id;
    private $director;
    private $title;
    private $title_fr;
    private $type;
    private $year;
    private $score;

    // Getters
    /**
     * @return int
     */
    public function getId() :int
    {
        return $this->id;
    }

    /**
     * @return Director
     */
    public function getDirector() :Director
    {
        return $this->director;
    }

    /**
     * @return string
     */
    public function getTitle() :string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getTitleFr() :string
    {
        return $this->title_fr;
    }

    /**
     * @return string
     */
    public function getType() :string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getYear() :int
    {
        return $this->year;
    }

    /**
     * @return float
     */
    public function getScore() :float
    {
        return $this->score;
    }

    // Setters
    /**
     * @param mixed $id
     */
    public function setId($id) :void
    {
        $this->id = $id;
    }

    /**
     * @param Director $director
     * @return Director
     */
    public function setDirector(Director $director)
    {
        return $this->director = $director;
    }

    /**
     * @param $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @param $title_fr
     */
    public function setTitleFr($title_fr) {
        $this->title_fr = $title_fr;
    }

    /**
     * @param $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @param $year
     */
    public function setYear($year) {
        $this->year = $year;
    }

    /**
     * @param $score
     */
    public function setScore($score) {
        $this->score = $score;
    }
}