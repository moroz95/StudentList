<?php

/* Проверка:
    имя, фамилия, пол, номер группы (от 2 до 5 цифр или букв), e-mail (должен быть уникален), 
   суммарное число баллов на ЕГЭ (проверять на адекватность), год рождения, местный или иногородний. 
 */

class Validation
{
    private $errors;
    private $dataGateway;


    public function __construct(StudentDataGateway $dataGateway)
    {
        $this->dataGateway = $dataGateway;
    }

    public function validate(StudentModel $student)
    {
        $this->validateFirstName($student->firstName);
        $this->validateLastName($student->lastName);
        $this->validateGroupNumber($student->groupNumber);
        $this->validateEmail($student->email);
        $this->validateMark($student->mark);
        $this->validateBirthDate($student->birthDate);
        $this->validateSexOpt($student->sex);
        $this->validateLocation($student->location);
    }

    public function getErrors()
    {
        return $this->errors;
    }

    public function hasError($name)
    {
        return key_exists($name, $this->errors);
    }

    private function applyTags($str)
    {
        return "<div class='alert alert-danger' role='alert'>$str</div>";
    }

    public function validateFirstName($name)
    {
        if (!$name) {
            $this->errors["firstName"] = $this->applyTags("Не заполнено поле ввода имени");
        } elseif (mb_strlen($name) > 200) {
            $this->errors["firstName"] = $this->applyTags("Имя не должно превышать 200 символов! Вы ввели " . (int)mb_strlen($name));
        }
        if (!preg_match("/[а-яА-Я'\-]/u", $name)) {
            $this->errors["firstName"] .= $this->applyTags("Неверный формат имени");
        }
    }

    public function validateLastName($name)
    {
        if (!$name) {
            $this->errors["lastName"] = $this->applyTags("Не заполнено поле ввода фамилии");
        } elseif (mb_strlen($name) > 200) {
            $this->errors["lastName"] = $this->applyTags("Фамилия не должна превышать 200 символов. Вы ввели " . (int)mb_strlen($name));
        }
        if (!preg_match("/[а-яА-Я'\-]/u", $name)) {
            $this->errors["lastName"] .= $this->applyTags("Неверный формат фамилии");
        }
    }

    public function validateGroupNumber($group)
    {
        if (mb_strlen($group) > 5) {
            $this->errors["groupNumber"] = $this->applyTags("Номер группы не должен превышать 5 символов, а вы ввели " . (int)mb_strlen($group));
        } elseif (mb_strlen($group) < 2) {
            $this->errors["groupNumber"] = $this->applyTags("Номер группы должен быть более 2 символов, а вы ввели " . (int)mb_strlen($group));
        }
        if (!preg_match("/[а-яА-Я0-9]/u", $group)) {
            $this->errors["groupNumber"] .= $this->applyTags("Недопустимый формат номера группы, разрешается использовать только буквы или цифры");
        }
    }

    public function validateEmail($email)
    {
        if (!$email) {
            $this->errors["email"] = $this->applyTags("Не заполнено поле воода email");
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors["email"] = $this->applyTags("Неверный формат email адреса");
        } elseif (!$this->dataGateway->isUniqueEmail($email)) {
            $this->errors["email"] = $this->applyTags("Вы уже зарегистрированы");
        }
    }

    public function validateMark($mark)
    {
        if (!$mark) {
            $this->errors["mark"] = $this->applyTags("Не заполнено поле ввода балла ЕГЭ");
        } else if ($mark < 100 or $mark > 300) {
            $this->errors["mark"] = $this->applyTags("Балл ЕГЭ должен быть в диапазоне от 100 до 300, а вы ввели {$mark}");
        }
    }

    public function validateBirthDate($year)
    {
        if (!$year) {
            $this->errors["birthDate"] = $this->applyTags("Не заполнено поле ввода года рождения");
        } elseif (intval($year) < 1930 or intval($year) > date("Y") - 10) {
            $this->errors["birthDate"] = $this->applyTags("Вы не можете поступить в наш университет по возрастной категории");
        }
    }

    public function validateSexOpt($opt)
    {
        if (!$opt) {
            $this->errors["sex"] = $this->applyTags("Не выбран пол");
        }
    }

    public function validateLocation($location)
    {
        if (!$location) {
            $this->errors["location"] = $this->applyTags("Укажите, местный вы или нет");
        }
    }

}

