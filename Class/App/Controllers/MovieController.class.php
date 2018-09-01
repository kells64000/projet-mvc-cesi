<?php

namespace App\Controllers;

class MovieController extends BaseController {

    public function showList() {

        if(!empty($_GET['orderby']) && !empty($_GET['dir'])) {
            $stmt = $this->db->run('SELECT * FROM film ORDER BY ' . $_GET['orderby'] . ' ' . $_GET['dir']);

        } else {
            $stmt = $this->db->run('SELECT * FROM film');
        }

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

    public function showOne() {

        $stmt = $this->db->run('SELECT * FROM film WHERE id=' . $_GET['id']);
        echo $this->layout->render('film', [
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

        $stmt = $this->db->run('INSERT INTO film (`title`, `title_fr`, `type`, `year`, `score`) VALUES (`' . $_POST['title'] . ',' . $_POST['titleFr'] . ',' . $_POST['type'] . ',' . $_POST['year'] . ',' . $_POST['score'] . '`');
        $stmt->execute();

        $this->showList();
    }

    public function updateMovie() {
        $stmt = $this->db->run('UPDATE film SET `title` =' . $_POST['title'] .', WHERE id=' . $_POST['id']);
        $stmt->execute();

        $this->showList();

    }

    public function deleteMovie() {

        $stmt = $this->db->run('DELETE FROM film WHERE id=' . $_POST['id']);
        $stmt->execute();

        $this->showList();
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