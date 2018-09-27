<?php

namespace App\Controllers;

use App\Repository\FilmRepository;
use App\Repository\TypeRepository;
use App\Repository\DirectorRepository;
use App\Router;

class MovieController extends BaseController {

    public function showOne() {

        if(isset($_GET['id'])) {
            $filmRepository = new FilmRepository($this->db);
            $film = $filmRepository->showOne($_GET['id']);

            echo $this->layout->render('film', [
                'isMoviesList' => false,
                'isPaginate' => false,
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
        $typeRepository = new TypeRepository($this->db);
        $directorRepository = new DirectorRepository($this->db);


        if(isset($_GET['orderby']) && isset($_GET['dir'])) {
            $films = $filmRepository->showAll($_GET['orderby'], $_GET['dir']);
        } else {
            $films = $filmRepository->showAll(null, null);
        }

        echo $this->layout->render('film', [
            'isMoviesList' => true,
            'isPaginate' => false,
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'director' => 'Réalisateur',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $films,
            'directors' => $directorRepository->showAll(),
            'types' => $typeRepository->showAll(),
        ]);
    }

    public function showPaginate() {

        $filmRepository = new FilmRepository($this->db);

        $navBar = "";
        $limit = 15;
        $nbPages = $filmRepository->countNbPage($limit);
        $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
        $previousPage = $currentPage - 1;
        $nextPage = $currentPage + 1;

        if($nbPages > 0)
        {
            if($nbPages > 1)
            {
                if($currentPage > 1)
                {
                    $navBar .= "<li class=\"page-item\"><a class=\"page-link bg-dark text-white\" href=\"/movies/page?page=". $previousPage ."\" title=\"page ". $previousPage ."\">". $previousPage ."</a></li>";
                } else {
                    $currentPage = 1;
                }

                $navBar .= "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\" title='Page Active'>". $currentPage ."</a></li>";

                if($currentPage < $nbPages)
                {
                    $navBar .= "<li class=\"page-item\"><a class=\"page-link bg-dark text-white\" href=\"/movies/page?page=". $nextPage ."\" title=\"page ". $nextPage ."\">". $nextPage ."</a></li>";
                }

                $pageStep = "Page ". $currentPage ." sur un total de ". $nbPages ." pages.";
            }
        }

        $films = $filmRepository->showPaginate($limit, $currentPage);

        echo $this->layout->render('film', [
            'isMoviesList' => false,
            'isPaginate' => true,
            'id' => 'ID',
            'title'  => 'Titres films originaux',
            'titleFr'  => 'Titres films français',
            'director' => 'Réalisateur',
            'type'  => 'Type films',
            'year' => 'Année',
            'score' => 'Note',
            'movies' => $films,
            'nbPage' => $nbPages,
            'currentPage' => $currentPage,
            'nav' => $navBar,
            'step' => $pageStep,
        ]);
    }

    public function createMovie() {

        if (isset($_POST['title']) && isset($_POST['titleFr']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['year']) && isset($_POST['score'])) {
            try {
                $movie = new FilmRepository($this->db);
                $director = new DirectorRepository($this->db);

                $idDirector = $director->searchId($_POST['name']);

                $movie->create($_POST['title'], $_POST['titleFr'], $_POST['type'], $idDirector, $_POST['year'], $_POST['score']);
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
        if (isset($_POST['id']) && isset($_POST['title']) && isset($_POST['titleFr']) && isset($_POST['name']) && isset($_POST['type']) && isset($_POST['year']) && isset($_POST['score'])) {
            try {
                $movie = new FilmRepository($this->db);
                $director = new DirectorRepository($this->db);

                $idDirector = $director->searchId($_POST['name']);

                $movie->update($_POST['id'], $_POST['title'], $_POST['titleFr'], $idDirector, $_POST['type'], $_POST['year'], $_POST['score']);
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

    public function searchMovies() {

        if(isset($_GET['search'])) {
            $filmRepository = new FilmRepository($this->db);
            $films = $filmRepository->search($_GET['search']);

            echo $this->layout->render('film', [
                'isMoviesList' => false,
                'isPaginate' => false,
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

    }
}