<table class="mt-5 table table-striped table-dark table-bordered text-center">
    <thead>
    <tr>
        <th scope="col">
            <a href="?orderby=title&dir=desc">
                <?= $nb ?>
            </a>
        </th>
        <th scope="col"><?= $title ?></th>
        <th scope="col"><?= $titleFr ?></th>
        <th scope="col"><?= $type ?></th>
        <th scope="col"><?= $year ?></th>
        <th scope="col"><?= $score ?></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($movies as $movie): ?>
        <tr>
            <th scope="row"><?= $movie->getId(); ?></th>

            <td>
                <a href="/movies/<?= $movie->getId(); ?>">
                    <?= $movie->getTitle(); ?>
                </a>
            </td>

            <td>
                <a href="/movies/<?= $movie->getId(); ?>">
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

        </tr>
    <?php endforeach; ?>
    </tbody>
</table>