<?php

namespace App\Controllers;

use App\Models\Film;
use App\Router;

class MovieController extends BaseController {

    public function showList() {

        if(!empty($_GET['orderby']) && !empty($_GET['dir'])) {
            $stmt = $this->db->run('SELECT * FROM film ORDER BY ' . $_GET['orderby'] . ' ' . $_GET['dir']);

        } else {
            $stmt = $this->db->run('SELECT * FROM film');
        }

        echo $this->layout->render('film', [
            'isMovies' => true,
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film'),
        ]);
    }

    public function showOne() {

        $stmt = $this->db->run('SELECT * FROM film WHERE id=' . $_GET['id']);
        echo $this->layout->render('film', [
            'isMovies' => false,
            'id' => 'ID',
            'title' => 'Titre Film original',
            'titleFr' => 'Titre Film français',
            'type'  => 'Type Film',
            'year' => 'Année de sortie',
            'score' => 'Note',
            'movies' => $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film'),
        ]);
    }

    public function createMovie() {
        $title = $_POST['title'];
        $titleFr = $_POST['titleFr'];
        $type = $_POST['type'];
        $year = $_POST['year'];
        $score = $_POST['score'];

        try {
            $movie = new Film();
            $movie->create($this->db, $title, $titleFr, $type, $year, $score);
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        } catch(pdoException $e) {
            echo 'PDO Error: ' . $e->getMessage();
            die();
        }
    }

    public function updateMovie() {
        $id = $_POST['id'];
        $title = $_POST['title'];
        $titleFr = $_POST['titleFr'];
        $type = $_POST['type'];
        $year = $_POST['year'];
        $score = $_POST['score'];

        try {
            $movie = new Film();
            $movie->update($this->db, $id, $title, $titleFr, $type, $year, $score);
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        } catch(pdoException $e) {
            echo 'PDO Error: ' . $e->getMessage();
            die();
        }
    }

    public function deleteMovie() {
        $id =  $_GET['id'];

        try {
            $movie = new Film();
            $movie->delete($this->db, $id);
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        } catch(pdoException $e) {
            echo 'PDO Error: ' . $e->getMessage();
            die();
        }
    }

    public function searchMovie() {

        $stmt = $this->db->run('SELECT * FROM film WHERE ' . $_POST['column'] . '=' . $_POST['search']);
        echo $this->layout->render('film', [
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film'),
        ]);
    }
}