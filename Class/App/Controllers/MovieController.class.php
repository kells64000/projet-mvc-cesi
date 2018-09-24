<?php

namespace App\Controllers;

use App\Repository\FilmRepository;
use App\Repository\TypeRepository;
use App\Router;

class MovieController extends BaseController {

    public function showOne() {

        if(isset($_GET['id'])) {
            $filmRepository = new FilmRepository($this->db);
            $film = $filmRepository->showOne($_GET['id']);

            echo $this->layout->render('film', [
                'isMovies' => false,
                'id' => 'ID',
                'title' => 'Titre Film original',
                'titleFr' => 'Titre Film français',
                'director' => 'Réalisateur',
                'type'  => 'Type Film',
                'year' => 'Année de sortie',
                'score' => 'Note',
                'movies' => $film,
            ]);
        } else {
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        }
    }

    public function showAll() {

        $filmRepository = new FilmRepository($this->db);

        if(isset($_GET['orderby']) && isset($_GET['dir'])) {
            $films = $filmRepository->showAll($_GET['orderby'], $_GET['dir']);
        } else {
            $films = $filmRepository->showAll(null, null);
        }

        echo $this->layout->render('film', [
            'isMovies' => true,
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'director' => 'Réalisateur',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $films,
        ]);
    }

    public function showPaginate() {

        $filmRepository = new FilmRepository($this->db);
        $typeRepository = new TypeRepository($this->db);

        if(isset($_GET['orderby']) && isset($_GET['dir'])) {
            $films = $filmRepository->showPaginate($_GET['orderby'], $_GET['dir'], 10);
        } else {
            $films = $filmRepository->showPaginate(null, null, 10);
        }

        echo $this->layout->render('film', [
            'isMovies' => true,
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'director' => 'Réalisateur',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $films,
            'types' => $typeRepository->getTypes(),
        ]);
    }

    public function createMovie() {

        if (isset($_POST['title']) && isset($_POST['titleFr']) && isset($_POST['type']) && isset($_POST['year']) && isset($_POST['score'])) {
            try {
                $movie = new FilmRepository($this->db);
                $movie->create($_POST['title'], $_POST['titleFr'], $_POST['type'], $_POST['year'], $_POST['score']);
                $route = Router::getByName('movies_list');
                Header("location: " . $route->getUri(true));
            } catch (\PDOException $e) {
                echo 'PDO Error: ' . $e->getMessage();
                throw new \PDOException($e->getMessage());
            }
        } else {
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        }
    }

    public function updateMovie() {
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['titleFr']) && isset($_POST['type']) && isset($_POST['year']) && isset($_POST['score'])) {
            try {
                $movie = new FilmRepository($this->db);
                $movie->update($_POST['id'], $_POST['title'], $_POST['titleFr'], $_POST['type'], $_POST['year'], $_POST['score']);
                $route = Router::getByName('movies_list');
                Header("location: " . $route->getUri(true));
            } catch(\PDOException $e) {
                echo 'PDO Error: ' . $e->getMessage();
                throw new \PDOException($e->getMessage());
            }
        } else {
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        }
    }

    public function deleteMovie() {

        if(isset($_GET['id'])) {
            try {
                $movie = new FilmRepository($this->db);
                $movie->delete($_GET['id']);
                $route = Router::getByName('movies_list');
                Header("location: " . $route->getUri(true));
            } catch(\PDOException $e) {
                echo 'PDO Error: ' . $e->getMessage();
                throw new \PDOException($e->getMessage());
            }
        } else {
            $route = Router::getByName('movies_list');
            Header("location: " . $route->getUri(true));
        }
    }

    public function searchMovie() {

    }
}