<?php @$notify == 'success' AND print "<div class='alert alert-success' role='alert'>Добавление студента прошло удачно!</div>"; ?>

<form method="get" class="navbar-form navbar-left" action="/search/">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Поиск" name="q" value="<?= @$_GET['q'] ?>">
    </div>
    <button type="submit" class="btn btn-default">Вперед</button>
</form>
<table class="table table-striped">
    <?php $sort_params = $url_template == 'search' ? array('q' => $url_params['q']) : array() ?>
    <thead>
    <tr>
        <th><a href="/<?php $sort_params['order'] = 'firstName';
            echo $pager->buildLink($url_template, $sort_params); ?>">Имя</a></th>
        <th><a href="/<?php $sort_params['order'] = 'lastName';
            echo $pager->buildLink($url_template, $sort_params); ?>">Фамилия</a></th>
        <th><a href="/<?php $sort_params['order'] = 'groupNumber';
            echo $pager->buildLink($url_template, $sort_params); ?>">Группа</a></th>
        <th><a href="/<?php $sort_params['order'] = 'mark';
            echo $pager->buildLink($url_template, $sort_params); ?>">Баллы</a></th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?= $student->firstName ?></td>
            <td><?= $student->lastName ?></td>
            <td><?= $student->groupNumber ?></td>
            <td><?= $student->mark ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php if ($pager->getTotalPages(@$url_params['q']) > 1): ?>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="/<?php $url_params['page'] = abs($page_number - 1);
                echo $pager->buildLink($url_template, $url_params) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($number = 1; $number <= $pager->getTotalPages(); $number++): ?>
                <?php $url_params['page'] = $number; ?>
                <li <?php $page_number == $number AND print 'class="active"'; ?>><a href="/<?= $pager->buildLink($url_template, $url_params); ?> "><?= $number ?></a></li>
            <?php endfor; ?>
            <li>
                <a href="/<?php $url_params['page'] = abs($page_number + 1);
                echo $pager->buildLink($url_template, $url_params) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>

