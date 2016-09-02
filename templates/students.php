<form method="get" class="navbar-form navbar-left" action="/search/">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Поиск" name="q">
    </div>
    <button type="submit" class="btn btn-default">Вперед</button>
</form>
<table class="table table-striped">
    <?php $url = $page == 'search' ? array('q' => $params['q']) : array() ?>
    <thead>
    <tr>
        <th><a href="/<?php $url['order'] = 'firstName';
            echo $pager->buildLink($page, $url); ?>">Имя</a></th>
        <th><a href="/<?php $url['order'] = 'lastName';
            echo $pager->buildLink($page, $url); ?>">Фамилия</a></th>
        <th><a href="/<?php $url['order'] = 'groupNumber';
            echo $pager->buildLink($page, $url); ?>">Группа</a></th>
        <th><a href="/<?php $url['order'] = 'mark';
            echo $pager->buildLink($page, $url); ?>">Баллы</a></th>
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

<?php if ($pager->getTotalPages(@$params['q']) > 1): ?>

    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="/<?php $params['page'] = abs($page_number - 1);
                echo $pager->buildLink($page, $params) ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php for ($number = 1; $number <= $pager->getTotalPages(); $number++) {
                $params['page'] = $number;
                echo "<li><a href='/" . $pager->buildLink($page, $params) . "'>$number</a></li>";
            }
            ?>
            <li>
                <a href="/<?php $params['page'] = abs($page_number + 1);
                echo $pager->buildLink($page, $params) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>

<?php endif; ?>

