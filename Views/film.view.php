<div class="container-fluid">
    <div class="row">
        <div class="col-12 col-md-2">
            <div class="position-fixed mt-5">

                <a href="/" class="btn btn-lg bg-dark">
                    <i class="fas fa-home text-white"></i>
                </a>

                <button class="btn btn-lg bg-dark" data-toggle="collapse" data-target="#search">
                    <i class="fas fa-search text-white"></i>
                </button>

                <?php if(!$isMovies) :?>
                    <a href="/movies" class="btn btn-lg bg-dark">
                        <i class="fas fa-film text-white"></i>
                    </a>
                <?php endif; ?>

                <div id="search" class="collapse">
                    <form action="/movies/search" method="get">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="Recherche...">
                            <div class="input-group-append">
                                <button type="submit" class="btn bg-dark">
                                    <i class="fas fa-search text-white"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>

        <div class="col-12 col-md-8">
            <table class="table table-striped table-dark table-bordered text-center">
                <thead>
                <tr>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') : ?>
                            <a href="/movies?orderby=id&dir=desc" class="text-white">
                                <?=$id?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=id&dir=asc" class="text-white">
                                <?=$id?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                            <a href="/movies?orderby=title&dir=desc" class="text-white">
                                <?=$title?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=title&dir=asc" class="text-white">
                                <?=$title?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                            <a href="/movies?orderby=title_fr&dir=desc" class="text-white">
                                <?=$titleFr?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=title_fr&dir=asc" class="text-white">
                                <?=$titleFr?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                            <a href="/movies?orderby=type&dir=desc" class="text-white">
                                <?=$type?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=type&dir=asc" class="text-white">
                                <?=$type?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                            <a href="/movies?orderby=year&dir=desc" class="text-white">
                                <?=$year?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=year&dir=asc" class="text-white">
                                <?=$year?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th scope="col">
                        <?php if(!isset($_GET['dir']) || $_GET['dir'] !== 'desc') :?>
                            <a href="/movies?orderby=score&dir=desc" class="text-white">
                                <?=$score?>
                            </a>
                        <?php else : ?>
                            <a href="/movies?orderby=score&dir=asc" class="text-white">
                                <?=$score?>
                            </a>
                        <?php endif ?>
                    </th>
                    <th>
                        <button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#createMovie">
                            <i class="far fa-plus-square fa-3x"></i>
                        </button>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                        <th scope="row"><?= $movie->getId(); ?></th>

                        <td>
                            <a href="/movie/<?= $movie->getId(); ?>" class="text-light">
                                <?= $movie->getTitle(); ?>
                            </a>
                        </td>

                        <td>
                            <a href="/movie/<?= $movie->getId(); ?>" class="text-light">
                                <?= $movie->getTitleFr(); ?>
                            </a>
                        </td>

                        <td>
                            <?= $movie->getType(); ?>
                        </td>

                        <td>
                            <?= $movie->getYear(); ?>
                        </td>

                        <td>
                            <?= $movie->getScore(); ?>
                        </td>
                        <td>
                            <div class="d-flex">
                                <button type="button" class="btn btn-sm btn-primary mr-2" data-toggle="modal" data-target="#updateMovie-<?php echo $movie->getId();?>">
                                    <i class="fas fa-edit"></i>
                                </button>

                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteMovie-<?php echo $movie->getId();?>">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
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
                        <input name="type" type="text" class="form-control" id="type" placeholder="Drame/Policier" required>
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
<div class="modal fade" id="updateMovie-<?php echo $movie->getId();?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movie/edit/<?=$movie->getId()?>" method="POST">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Modifications de <?=$movie->getTitleFr();?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div>
                        <label for="id" class="col-form-label"></label>
                        <input name="id" type="hidden" class="form-control" id="id" value="<?=$movie->getId();?>">
                    </div>

                    <div class="form-group">
                        <label for="title" class="col-form-label">Titre original :</label>
                        <input name="title" type="text" class="form-control" id="title" value="<?=$movie->getTitle();?>" required>
                    </div>
                    <div class="form-group">
                        <label for="titleFr" class="col-form-label">Titre français :</label>
                        <input name="titleFr" type="text" class="form-control" id="titleFr" value="<?=$movie->getTitleFr();?>" required>
                    </div>
                    <div class="form-group">
                        <label for="type" class="col-form-label">Type :</label>
                        <input name="type" type="text" class="form-control" id="type" value="<?=$movie->getType();?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="year" class="col-form-label">Année :</label>
                        <input name="year" type="text" class="form-control" id="year" value="<?=$movie->getYear();?>" required>
                    </div>
                    <div class="form-group">
                        <label for="score" class="col-form-label">Note :</label>
                        <input name="score" type="text" class="form-control" id="score" value="<?=$movie->getScore();?>" required>
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
<div class="modal fade" id="deleteMovie-<?php echo $movie->getId();?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form action="/movie/delete/<?=$movie->getId()?>" method="GET">
                <div class="modal-header bg-danger">
                    <h5 class="modal-title text-white" id="exampleModalLongTitle">Êtes-vous certain de vouloir supprimer <p><?=$movie->getTitleFr();?> ?</p></h5>
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

<style>
    .table thead th{
        vertical-align: middle;
    }
    thead th:hover {
        background-color: #636e72;
    }
    .table tbody tr:hover {
        background-color: #8395a7 !important;
    }
</style>