<?php

namespace App\Models;

class Film {
    private $id;
    private $title;
    private $title_fr;
    private $type;
    private $year;
    private $score;


    // Getters

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getTitleFr() {
        return $this->title_fr;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getYear() {
        return $this->year;
    }

    /**
     * @return mixed
     */
    public function getScore() {
        return $this->score;
    }

    // Setters

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * @param mixed $title_fr
     */
    public function setTitleFr($title_fr) {
        $this->title_fr = $title_fr;
    }

    /**
     * @param mixed $type
     */
    public function setType($type) {
        $this->type = $type;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year) {
        $this->year = $year;
    }

    /**
     * @param mixed $score
     */
    public function setScore($score) {
        $this->score = $score;
    }

}