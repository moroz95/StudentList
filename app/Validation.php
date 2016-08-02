<?php

/* Проверка:
    имя, фамилия, пол, номер группы (от 2 до 5 цифр или букв), e-mail (должен быть уникален), 
   суммарное число баллов на ЕГЭ (проверять на адекватность), год рождения, местный или иногородний. 
 */
class Validation
{
    private $errors;
	public function validate(Student $student)
    {
        $this->validateFirstName($student->getFirstName());
        $this->validateLastName($student->getLastName());
        $this->validateNumberOfGroup($student->getNumberOfGroup());
        $this->validateEmail($student->getEmail());
        $this->validateMark($student->getMark());
        $this->validateDateOfBirth($student->getDateOfBirth());
        $this->validateSexOpt(($student->getSex()));
        $this->validateLocation($student->getLocation(true));
    }
    public function validateFirstName($name)
    {
        if(!$name) {
            $this->errors["firstName"] = "Не заполнено поле ввода имени.";
        } elseif(mb_strlen($name) > 200) {
            $this->errors["firstName"] = "Имя не должно превышать 200 символов! Вы ввели " .
                                          mb_strlen($name) . ".";
        } elseif(!preg_match("/[а-яА-Я'\-]/u", $name)) {
            $this->errors["lastName"] = "Неверный формат фамилии.";
        }
    }
    public function validateLastName($name)
    {
        if(!$name) {
            $this->errors["lastName"] = "Не заполнено поле ввода фамилии.";
        } elseif(mb_strlen($name) > 200) {
            $this->errors["lastName"] = "Фамилия не должна превышать 200 символов. Вы ввели " .
                                        mb_strlen($name) . ".";
        } elseif(!preg_match("/[а-яА-Я'\-]/u", $name)) {
            $this->errors["lastName"] = "Неверный формат фамилии.";
        }
    }
    public function validateNumberOfGroup($group)
    {
        if(mb_strlen($group) > 5) {
            $this->errors["numberOfGroup"] = "Номер группы не должен превышать 5 символов! Вы ввели " .
                                          mb_strlen($group) . ".";
        } elseif(mb_strlen($group) < 2 ) {
            $this->errors["numberOfGroup"] = "Номер группы должен быть более 2 символов! Вы ввели " .
                                          mb_strlen($group) . ".";
        } elseif(!preg_match("/[а-яА-Я0-9]/u", $group)) {
            $this->errors["numberOfGroup"] = "Недопустимый формат номера группы.
                                           Разрешается использовать только буквы или цифры.";
        }
    }
    public function validateEmail($email)
    {
        if(!$email) {
            $this->errors["email"] = "Не заполнено поле воода email.";
        } elseif(!preg_match("/.+@.+\..+/i", $email)) {
            $this->errors["email"] = "Неверный формат email адреса.";
  /*      } elseif(!$this->mapper->isUniqueEmail($email)) {
            $this->errors["email"] = "Вы уже зарегестрированы.";
        }
 */
    }
    public function validateMark($mark)
    {
        if(!$mark) {
            $this->errors["mark"] = "Не заполнено поле воода балла ЕГЭ.";
        }
        if($mark < 0 or $mark > 300) {
            $this->errors["mark"] = "Балл ЕГЭ должен быть в диапазоне от 100 до 300.
                                     Вы ввели " . "{$mark}";
        }
    }
    public function validateDateOfBirth($year)
    {
        if(!$year) {
            $this->errors["DateOfBirth"] = "Не заполнено поле ввода года рождения.";
        } elseif(intval($year) < 1930 or intval($year) > date("Y") - 10) {
            $this->errors["DateOfBirth"] = "Вы не можете поступить в наш университет по возрастной категории.";
        }
    }
    /*public function validateSexOpt($opt)
    {
        if(!$opt) {
            $this->errors["sex"] = "Не выбран пол.";
        }
    }
    public function validateLocation($opt)
    {
    */    
    }
    public function getErrors()
    {
        return $this->errors;
    }
}

}