<table class="table table-striped">
    <thead>
    <tr>
        <th><a href="/index/firstName">Имя</a></th>
        <th><a href="/index/lastName">Фамилия</a></th>
        <th><a href="/index/groupNumber">Группа</a></th>
        <th><a href="/index/mark">Баллы</a></th>
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
