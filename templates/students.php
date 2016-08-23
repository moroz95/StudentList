
<form method="get" class="navbar-form navbar-left" action="/search/">
    <div class="form-group">
        <input type="text" class="form-control" placeholder="Поиск" name="q">
    </div>
    <button type="submit" class="btn btn-default">Вперед</button>
</form>
<table class="table table-striped">
    <?php if(empty($search_url)) $search_url = ''; ?>
    <thead>
    <tr>
        <th><a href="<?= '?order=firstName'.$search_url;?>">Имя</a></th>
        <th><a href="<?= '?order=lastName'.$search_url;?>">Фамилия</a></th>
        <th><a href="<?= '?order=groupNumber'.$search_url;?>">Группа</a></th>
        <th><a href="<?= '?order=mark'.$search_url;?>">Баллы</a></th>
    </tr>
    </thead>
    <tbody>
<?php foreach( $students as $student ): ?>
    <tr>
        <td><?=$student->firstName ?></td>
        <td><?=$student->lastName ?></td>
        <td><?=$student->groupNumber ?></td>
        <td><?=$student->mark ?></td>
    </tr>
<?php endforeach; ?>
    </tbody>
</table>
