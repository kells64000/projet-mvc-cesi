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
            'nb' => 'Id Films',
            'title'  => 'Titres Films originaux',
            'titleFr'  => 'Titres Films français',
            'type'  => 'Type Films',
            'year' => 'Année de sortie',
            'score' => 'Note',
            'movies' => $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film'),
        ]);
    }

    public function showOne() {

        $stmt = $this->db->run('SELECT * FROM film WHERE id=' . $_GET['id']);
        echo $this->layout->render('film', [
            'nb' => 'Id Film',
            'title' => 'Titre Film original',
            'titleFr' => 'Titre Film français',
            'type'  => 'Type Film',
            'year' => 'Année de sortie',
            'score' => 'Note',
            'movies' => $stmt->fetchAll(\PDO::FETCH_CLASS, 'App\\Models\\Film'),
        ]);
    }
}