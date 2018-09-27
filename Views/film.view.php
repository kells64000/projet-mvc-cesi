<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-1">
            <div class="position-fixed mt-5">

                <a href="/" class="btn btn-md bg-dark">
                    <i class="fas fa-home text-white"></i>
                </a>

                <?php if(!$isMoviesList) : ?>
                    <a href="/movies" class="btn btn-md bg-dark">
                        <i class="fas fa-film text-white"></i>
                    </a>
                <?php else : ?>
                    <a href="/movies/page" class="btn btn-md bg-dark">
                        <i class="fas fa-align-justify text-white"></i>
                    </a>

                    <button class="btn btn-md bg-dark" data-toggle="modal" data-target="#search">
                        <i class="fas fa-search text-white"></i>
                    </button>
                <?php endif; ?>

            </div>
        </div>

        <div class="col-12 col-md-10">
            <table class="table table-striped table-dark table-bordered text-center">
                <thead>
                <tr>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <a href="/movies?orderby=film.id&dir=desc" class="text-white">
                                    <?=$id?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.id&dir=asc" class="text-white">
                                    <?=$id?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$id?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.title&dir=desc" class="text-white">
                                    <?=$title?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.title&dir=asc" class="text-white">
                                    <?=$title?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$title?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.title_fr&dir=desc" class="text-white">
                                    <?=$titleFr?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.title_fr&dir=asc" class="text-white">
                                    <?=$titleFr?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$titleFr?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.name&dir=desc" class="text-white">
                                    <?=$director?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.name&dir=asc" class="text-white">
                                    <?=$director?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$director?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.type&dir=desc" class="text-white">
                                    <?=$type?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.type&dir=asc" class="text-white">
                                    <?=$type?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$type?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.year&dir=desc" class="text-white">
                                    <?=$year?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.year&dir=asc" class="text-white">
                                    <?=$year?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$year?>
                        <?php endif; ?>
                    </th>
                    <th scope="col">
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                                <a href="/movies?orderby=film.score&dir=desc" class="text-white">
                                    <?=$score?>
                                </a>
                            <?php else : ?>
                                <a href="/movies?orderby=film.score&dir=asc" class="text-white">
                                    <?=$score?>
                                </a>
                            <?php endif;
                        else : ?>
                            <?=$score?>
                        <?php endif; ?>
                    </th>
                    <?php if($isMoviesList) : ?>
                    <th>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#createMovie">
                            <i class="far fa-plus-square fa-3x"></i>
                        </button>
                    </th>
                    <?php endif; ?>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr ondblclick="document.location='/movie/<?=$movie->getId()?>'">
                        <th scope="row"><?=$movie->getId() ?></th>

                        <td>
                            <?=$movie->getTitle() ?>
                        </td>

                        <td>
                            <?=$movie->getTitleFr()?>
                        </td>

                        <td>
                            <?=$movie->getName()?>
                        </td>

                        <td>
                            <?=$movie->getType()?>
                        </td>

                        <td>
                            <?=$movie->getYear()?>
                        </td>

                        <td>
                            <?=$movie->getScore()?>
                        </td>
                        <?php if($isMoviesList) : ?>
                        <td>
                            <div class="d-flex justify-content-center">
                                <button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#updateMovie-<?=$movie->getId()?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMovie-<?=$movie->getId()?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <?php if ($isPaginate) : ?>
                <div class="d-flex justify-content-center">
                    <nav aria-label="pagination">
                        <ul class="pagination">
                            <?php if($currentPage == 1) :?>
                            <li class="page-item disabled">
                                <a class="page-link bg-secondary text-white" href="#" aria-label="Previous">
                            <?php else : ?>
                            <li class="page-item">
                                <a class="page-link bg-dark text-white" href="/movies/page?page=<?=$currentPage-1?>" aria-label="Previous">
                            <?php endif; ?>
                                    <span aria-hidden="true">&laquo;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                            </li>
                            <?=$nav?>
                            <?php if($currentPage == $nbPage) : ?>
                            <li class="page-item disabled">
                                <a class="page-link bg-secondary text-white" href="#" aria-label="Next">
                            <?php else : ?>
                            <li class="page-item">
                                <a class="page-link bg-dark text-white" href="/movies/page?page=<?=$currentPage+1?>" aria-label="Next">
                            <?php endif; ?>
                                    <span aria-hidden="true">&raquo;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="d-flex justify-content-center">
                    <p><?=$step?></p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Modal CREATE -->
<div class="modal fade" id="createMovie" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movie/add" method="POST">
                <div class="modal-header bg-success">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Ajout d'un nouveau film</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="title" class="col-form-label">Titre original :</label>
                        <input name="title" type="text" class="form-control" id="title" placeholder="The Godfather" required>
                    </div>
                    <div class="form-group">
                        <label for="titleFr" class="col-form-label">Titre français :</label>
                        <input name="titleFr" type="text" class="form-control" id="titleFr" placeholder="Le Parrain" required>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type :</label>
                        <select class="custom-select" name="type" id="type">

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-form-label">Année :</label>
                        <input name="year" type="text" class="form-control" id="year" placeholder="1972" required>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-form-label">Note :</label>
                        <input name="score" type="text" class="form-control" id="score" placeholder="8.5" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-success">Créer</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal UPDATE -->
<?php foreach ($movies as $movie) { ?>
<div class="modal fade" id="updateMovie-<?=$movie->getId()?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movie/<?=$movie->getId()?>/edit" method="POST">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Modifications de : <p><?=$movie->getTitleFr()?></p></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div>
                        <label for="id" class="col-form-label"></label>
                        <input name="id" type="hidden" class="form-control" id="id" value="<?=$movie->getId()?>">
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-form-label">Titre original :</label>
                        <input name="title" type="text" class="form-control" id="title" value="<?=$movie->getTitle()?>" required>
                    </div>
                    <div class="form-group">
                        <label for="titleFr" class="col-form-label">Titre français :</label>
                        <input name="titleFr" type="text" class="form-control" id="titleFr" value="<?=$movie->getTitleFr()?>" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Réalisateur :</label>
                        <select class="custom-select" name="name" id="name">
                            <option value="<?=$movie->getName()?>"><?=$movie->getName()?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type :</label>
                        <select class="custom-select" name="type" id="type">
                            <option value="<?=$movie->getType()?>"><?=$movie->getType()?></option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-form-label">Année :</label>
                        <input name="year" type="text" class="form-control" id="year" value="<?=$movie->getYear()?>" required>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-form-label">Note :</label>
                        <input name="score" type="text" class="form-control" id="score" value="<?=$movie->getScore()?>" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-primary">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal DELETE -->
<?php foreach ($movies as $movie) { ?>
<div class="modal fade" id="deleteMovie-<?=$movie->getId()?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movie/<?=$movie->getId()?>/delete" method="GET">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Êtes-vous certain de vouloir supprimer <p><?=$movie->getTitleFr()?> ?</p></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Une fois supprimé il ne serra plus enregistré en base de donnée.</p>
                    <p>Il faudra alors le réenregistrer !</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                    <button type="submit" class="btn btn-danger">Supprimer</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal SEARCH -->
<div id="search" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movies/search" method="get">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white">Rechercher ce que vous voulez !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Recherche...">
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-md bg-dark">
                                <i class="fas fa-search text-white"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
