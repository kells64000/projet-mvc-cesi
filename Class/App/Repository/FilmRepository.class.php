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

    /**
     * @param $id
     * @return array
     */
    public function showOne($id) {

        $sql = 'SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id WHERE film.id=' . $id;
        $stmt = $this->database->run($sql);
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    /**
     * @param $orderBy
     * @param $dir
     * @return array
     */
    public function showAll($orderBy, $dir) {

        $sql = "SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id ";

        if(!empty($orderBy) && !empty($dir)) {
            $sql .= "ORDER BY :orderBy :dir";
        } else {
            $sql .= 'ORDER BY film.id';
        }

        $stmt = $this->database->run($sql, array(
            'orderBy' => $orderBy,
            'dir' => $dir,
        ));
        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    /**
     * @param $limit
     * @return float
     */
    public function countNbPage($limit) {
        $sql = "SELECT count(*) FROM film ";
        $stmt = $this->database->run($sql);
        $nb_movies = $stmt->fetch();
        $nb_movies = $nb_movies['0'];

        return ceil($nb_movies / $limit);
    }

    /**
     * @param $limit
     * @param $currentPage
     * @return array
     */
    public function showPaginate($limit, $currentPage) {

        $start = ($currentPage - 1) * $limit;
        $sql = "SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id ORDER BY film.id ";
        $sql .= 'LIMIT ' . $start . ', ' . $limit . ';';
        $stmt = $this->database->run($sql);

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

    /**
     * @param $title
     * @param $title_fr
     * @param $type
     * @param $id_director
     * @param $year
     * @param $score
     * @return bool|\PDOException
     */
    public function create($title, $title_fr, $type, $id_director, $year, $score) {
        $this->database->beginTransaction();
        try {
            $sql = 'INSERT INTO `film` (`id`, `id_director`, `title`, `title_fr`, `type`, `year`, `score`) VALUES (NULL, :id_director, :title, :titleFr, :type, :year, :score)';
            $this->database->run($sql, array(
                'id_director' => $id_director,
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

    /**
     * @param $id
     * @param $title
     * @param $title_fr
     * @param $id_director
     * @param $type
     * @param $year
     * @param $score
     * @return bool|\PDOException
     */
    public function update($id, $title, $title_fr, $id_director, $type, $year, $score) {
        $this->database->beginTransaction();
        try {
            $sql = 'UPDATE `film` SET `id_director` = :id_director, `title` = :title, `title_fr` = :titleFr, `type` = :type, `year` = :year, `score` = :score WHERE `id` = :id';
            $this->database->run($sql, array(
                'id' => $id,
                'id_director' => $id_director,
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

    /**
     * @param $id
     * @return bool|\PDOException
     */
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

    /**
     * @param $search
     * @return array
     */
    public function search($search) {

        $sql = "SELECT film.id, director.name, film.title, film.title_fr, film.type, film.year, film.score FROM film INNER JOIN director ON film.id_director = director.id WHERE ";
        $sql .= "film.id = :search ";
        $sql .= "OR director.name LIKE '%:search%' ";
        $sql .= "OR film.title LIKE '%:search%' ";
        $sql .= "OR film.title_fr LIKE '%:search%' ";
        $sql .= "OR film.type LIKE '%:search%' ";
        $sql .= "OR film.year LIKE '%:search%' ";
        $sql .= "OR film.score LIKE '%:search%' ";
        $stmt = $this->database->run($sql, array(
            'search' => $search,
        ));

        return $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film');
    }

}