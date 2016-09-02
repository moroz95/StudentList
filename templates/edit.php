<br>
<?php if(!empty($result)) echo $result ?>
<form action="/<?= $params['page'] ?>" method="post" class="form-horizontal ">
    <?php foreach ($form as $key => $value): ?>
    <div class="form-group <?php if($validate) $validate->hasError($key) and print "has-error";?>">
        <label class="control-label col-xs-3" for="<?= $key ?>"><?= $value['title']?></label>
        <div class="col-xs-9">
            <input type="<?= $value['type']?>" class="form-control" id="<?= $key ?>" value="<?=$value['value']?>" name="<?= $key ?>" placeholder="<?= $value['legend']?>">
            <?php if(!empty($value['error'])) print $value['error'];?>
        </div>
    </div>
    <?php endforeach;?>
    <div class="form-group <?php if($validate) $validate->hasError("sex") and print "has-error";?>">
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
    <div class="form-group <?php if($validate) $validate->hasError("location") and print "has-error";?>">
        <label class="control-label col-xs-3" >Место жительства:</label>
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
