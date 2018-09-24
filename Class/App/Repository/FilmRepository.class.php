<?php

namespace App\Repository;

use App\Store\Database;

class FilmRepository
{
    private $database;
    /**
     * FilmRepository constructor.
     * @param Database $database
     */
    public function __construct(Database $database)
    {
        $this->database = $database;
    }

    public function showOne($id) {

        $sql = 'SELECT * FROM film WHERE id=' . $id;
        $stmt = $this->database->run($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    public function showAll($orderBy, $dir) {

        //$sql = "SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id ";
        $sql = "SELECT * FROM film ";
        if(!empty($orderBy) && !empty($dir)) {
            $sql .= 'ORDER BY :orderby :dir ';
        }
        $stmt = $this->database->run($sql, array(
            'orderby' => $orderBy,
            'dir' => $dir,
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    public function showPaginate($orderBy, $dir, $limit) {

        //$sql = "SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id ";
        $sql = "SELECT * FROM film ";
        if(!empty($orderBy) && !empty($dir)) {
            $sql .= 'ORDER BY :orderby :dir ';
        }
        $sql .= 'LIMIT ' . $limit;
        $stmt = $this->database->run($sql, array(
            'orderby' => $orderBy,
            'dir' => $dir,
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    public function create($title, $title_fr, $type, $year, $score) {
        $this->database->beginTransaction();
        try {
            $sql = 'INSERT INTO `film` (`id`, `title`, `title_fr`, `type`, `year`, `score`) VALUES (NULL, :title, :titleFr, :type, :year, :score)';
            $this->database->run($sql, array(
                'title' => $title,
                'titleFr' => $title_fr,
                'type' => $type,
                'year' => $year,
                'score' => $score,
            ));
            $this->database->commit();
            return true;
        } catch (\PDOException $e) {
            $this->database->rollBack();
            return new \PDOException($e);
        }
    }

    public function update($id, $title, $title_fr, $type, $year, $score) {
        $this->database->beginTransaction();
        try {
            $sql = 'UPDATE `film` SET `title` = :title, `title_fr` = :titleFr, `type` = :type, `year` = :year, `score` = :score WHERE `id` = :id';
            $this->database->run($sql, array(
                'id' => $id,
                'title' => $title,
                'titleFr' => $title_fr,
                'type' => $type,
                'year' => $year,
                'score' => $score,
            ));
            $this->database->commit();
            return true;
        } catch (\PDOException $e) {
            $this->database->rollBack();
            return new \PDOException($e);
        }
    }

    public function delete($id) {
        $this->database->beginTransaction();
        try {
            $sql = 'DELETE FROM `film` WHERE id=' . $id;
            $this->database->run($sql);
            $this->database->commit();
            return true;
        } catch (\PDOException $e) {
            $this->database->rollBack();
            return new \PDOException($e);
        }
    }

    public function search() {


    }

}