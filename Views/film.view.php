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

                <div id="search" class="collapse">
                    <form action="#" method="get">
                        <div class="input-group mt-3">
                            <input type="text" class="form-control" placeholder="Recherche...">
                            <div class="input-group-append">
                                <span class="input-group-text bg-dark" id="basic-addon2">
                                    <i class="fas fa-search text-white"></i>
                                </span>
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
                        <a href="?orderby=id&dir=desc" class="text-white">
                            <?=$id?>
                        </a>
                    </th>
                    <th scope="col"><?=$title?></th>
                    <th scope="col"><?=$titleFr?></th>
                    <th scope="col"><?=$type?></th>
                    <th scope="col"><?=$year?></th>
                    <th scope="col"><?=$score?></th>
                    <th scope="col">
                        <a href="#popup" class="btn btn-sm btn-success"><i class="far fa-plus-square"></i></a>
                    </th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($movies as $movie): ?>
                    <tr>
                        <th scope="row"><?= $movie->getId(); ?></th>

                        <td>
                            <a href="/movies/<?= $movie->getId(); ?>" class="text-light">
                                <?= $movie->getTitle(); ?>
                            </a>
                        </td>

                        <td>
                            <a href="/movies/<?= $movie->getId(); ?>" class="text-light">
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
                            <form action="/movies" method="post">
                                <input type="hidden" name="id" value="<?php echo $movie->getId(); ?>" />
                                <input type="submit" value="" class="btn btn-sm btn-danger" />
                            </form>
                            <!--<button onclick="supprimerFilm()" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>-->
                        </td>

                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-2">

        </div>
    </div>
</div>

<script type="text/javascript">
// $(document).ready(function() {
// });
// function supprimerFilm(){
//     if(confirm('Confirmez-vous la suppression ?')){
//         $.ajax({
//
//             url : '/movies',
//             type : 'DELETE',
//             success : function(response, statut){
//
//             },
//
//             error : function(resultat, statut, erreur){
//             },
//
//             complete : function(resultat, statut){
//
//             }
//         });
//     }
// }
</script>