<?php
/**
 * Class StudentModel
 *
 * здесь будет вся информация о студенте
 *
 * экземпляров класса может быть несколько
 *
 * свойства класса есть характеристики студента
 *
 * "имя, фамилия, пол, номер группы (от 2 до 5 цифр или букв), e-mail (должен быть уникален),
 *  суммарное число баллов на ЕГЭ (проверять на адекватность), год рождения, местный или иногородний.
 *  Данные надо сохранять в БД, все поля обязательны, все поля надо проверять (например нельзя ввести фамилию длиной 200 символов),
 *  при ошибке ввода отображать форму с сообщением об ошибке и выделенным красным цветом ошибочным полем,
 *  при успешном заполнении — спасибо, данные сохранены, вы можете их отредактировать или просмотреть список абитуриентов."
 */
class StudentModel {

    public $id;
    public $firstName;
    public $lastName;
    public $sex;
    public $groupNumber;
    public $birthDate;
    public $email;
    public $mark;
    public $location;

    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $attribute)
        {
            if (property_exists('StudentModel', $name))
            {
                $this->$name = $attribute;
            }
        }

    }

}
