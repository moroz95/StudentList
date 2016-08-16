<form action="/<?= $page ?>" method="post" class="form-horizontal">
    <div class="form-group">
        <label class="control-label col-xs-3" for="lastName">Фамилия:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Введите фамилию">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" for="firstName">Имя:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Введите имя">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3"">Баллы за ЕГЭ:</label>
        <div class="col-xs-9">
            <input type="number" class="form-control" id="mark" name="mark"">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Дата рождения:</label>
        <div class="col-xs-9">
            <input id="age" type="date" min="1920-01-01" max="2000-01-01" name="birthDate">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3"">Номер группы:</label>
        <div class="col-xs-9">
            <input type="text" class="form-control" id="groupNumber" placeholder="Номер группы" name="groupNumber">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3" for="inputEmail">Email:</label>
        <div class="col-xs-9">
            <input type="email" class="form-control" id="inputEmail" placeholder="Email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Пол:</label>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="sex" value="male"> Мужской
            </label>
        </div>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="sex" value="female"> Женский
            </label>
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-xs-3">Место жительства:</label>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="location" value="local"> Местный
            </label>
        </div>
        <div class="col-xs-2">
            <label class="radio-inline">
                <input type="radio" name="location" value="nonresident"> Иногородний
            </label>
        </div>
    </div>
    <br />
    <div class="form-group">
        <div class="col-xs-offset-3 col-xs-9">
            <input type="submit" class="btn btn-primary" value="Регистрация">
            <input type="reset" class="btn btn-default" value="Очистить форму">
        </div>
    </div>
</form>