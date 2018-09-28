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
                <?php endif; ?>

                <?php if($isMoviesSearch) : ?>
                    <button class="btn btn-md bg-dark" data-toggle="modal" data-target="#search">
                        <i class="fas fa-search text-white"></i>
                    </button>
                <?php endif;; ?>

            </div>
        </div>

        <div class="col-12 col-md-10">
            <table class="table table-striped table-dark table-bordered text-center">
                <thead>
                    <tr>
                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.id&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.id&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$id?>
                            </th>

                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.title&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.title&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$title?>
                            </th>

                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.title_fr&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.title_fr&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$titleFr?>
                            </th>


                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.name&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.name&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$director?>
                            </th>

                        <?php
                        if($isMoviesList) :
                            if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.type&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.type&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$type?>
                            </th>

                        <?php
                        if($isMoviesList) :
                             if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.year&dir=desc'" scope="col">
                             <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.year&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$year?>
                            </th>

                        <?php
                        if($isMoviesList) :
                             if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                                <th onclick="document.location='/movies?orderby=film.score&dir=desc'" scope="col">
                            <?php else : ?>
                                <th onclick="document.location='/movies?orderby=film.score&dir=asc'" scope="col">
                            <?php endif;
                        else : ?>
                            <th scope="col">
                        <?php endif; ?>
                                <?=$score?>
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
                                    <a class="page-link bg-secondary text-white" href="#" aria-label="Start">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Start</span>
                                    </a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link bg-secondary text-white" href="#" aria-label="Previous">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link bg-dark text-white" href="/movies/page?page=1" aria-label="Start">
                                        <span aria-hidden="true">&laquo;</span>
                                        <span class="sr-only">Start</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link bg-dark text-white" href="/movies/page?page=<?=$currentPage-1?>" aria-label="Previous">
                                        <span aria-hidden="true">&lt;</span>
                                        <span class="sr-only">Previous</span>
                                    </a>
                                </li>
                            <?php endif; ?>

                            <?=$nav?>

                            <?php if($currentPage == $nbPage) : ?>
                                <li class="page-item disabled">
                                    <a class="page-link bg-secondary text-white" href="#" aria-label="Next">
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item disabled">
                                    <a class="page-link bg-secondary text-white" href="#" aria-label="End">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">End</span>
                                    </a>
                                </li>
                            <?php else : ?>
                                <li class="page-item">
                                    <a class="page-link bg-dark text-white" href="/movies/page?page=<?=$currentPage+1?>" aria-label="Next">
                                        <span aria-hidden="true">&gt;</span>
                                        <span class="sr-only">Next</span>
                                    </a>
                                </li>
                                <li class="page-item">
                                    <a class="page-link bg-dark text-white" href="/movies/page?page=<?=$nbPage?>" aria-label="End">
                                        <span aria-hidden="true">&raquo;</span>
                                        <span class="sr-only">End</span>
                                    </a>
                                </li>
                            <?php endif; ?>
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
                        <input name="title" type="text" class="form-control" id="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label for="titleFr" class="col-form-label">Titre français :</label>
                        <input name="titleFr" type="text" class="form-control" id="titleFr" placeholder="Title Fr" required>
                    </div>
                    <div class="form-group">
                        <label for="name" class="col-form-label">Réalisateur :</label>
                        <select class="custom-select" name="name" id="name">
                            <?php foreach ($directors as $director) : ?>
                                <option value="<?=$director->getName()?>"><?=$director->getName()?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type :</label>
                        <select class="custom-select" name="type" id="type">
                            <?php foreach ($types as $type) : ?>
                                <option value="<?=$type->getName()?>"><?=$type->getName()?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-form-label">Année :</label>
                        <input name="year" type="number" class="form-control" id="year" placeholder="AAAA" required>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-form-label">Note :</label>
                        <input name="score" type="number" step="0.1" min="0" max="10" class="form-control" id="score" placeholder="0 / 10" required>
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
                            <?php foreach ($directors as $director) : ?>
                                <option value="<?=$director->getName()?>"><?=$director->getName()?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type :</label>
                        <select class="custom-select" name="type" id="type">
                            <option value="<?=$movie->getType()?>"><?=$movie->getType()?></option>
                            <?php foreach ($types as $type) : ?>
                                <option value="<?=$type->getName()?>"><?=$type->getName()?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-form-label">Année :</label>
                        <input name="year" type="number" class="form-control" id="year" value="<?=$movie->getYear()?>" required>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-form-label">Note :</label>
                        <input name="score"  type="number" step="0.1" min="0" max="10" class="form-control" id="score" value="<?=$movie->getScore()?>" required>
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
                    <h5 class="modal-title text-white">Rechercher dans la liste des films !</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="input-group">
                        <input type="text" class="form-control" name="search" placeholder="Recherche...">
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
