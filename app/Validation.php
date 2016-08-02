<?php

/* ��������:
    ���, �������, ���, ����� ������ (�� 2 �� 5 ���� ��� ����), e-mail (������ ���� ��������), 
   ��������� ����� ������ �� ��� (��������� �� ������������), ��� ��������, ������� ��� �����������. 
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
            $this->errors["firstName"] = "�� ��������� ���� ����� �����.";
        } elseif(mb_strlen($name) > 200) {
            $this->errors["firstName"] = "��� �� ������ ��������� 200 ��������! �� ����� " .
                                          mb_strlen($name) . ".";
        } elseif(!preg_match("/[�-��-�'\-]/u", $name)) {
            $this->errors["lastName"] = "�������� ������ �������.";
        }
    }
    public function validateLastName($name)
    {
        if(!$name) {
            $this->errors["lastName"] = "�� ��������� ���� ����� �������.";
        } elseif(mb_strlen($name) > 200) {
            $this->errors["lastName"] = "������� �� ������ ��������� 200 ��������. �� ����� " .
                                        mb_strlen($name) . ".";
        } elseif(!preg_match("/[�-��-�'\-]/u", $name)) {
            $this->errors["lastName"] = "�������� ������ �������.";
        }
    }
    public function validateNumberOfGroup($group)
    {
        if(mb_strlen($group) > 5) {
            $this->errors["numberOfGroup"] = "����� ������ �� ������ ��������� 5 ��������! �� ����� " .
                                          mb_strlen($group) . ".";
        } elseif(mb_strlen($group) < 2 ) {
            $this->errors["numberOfGroup"] = "����� ������ ������ ���� ����� 2 ��������! �� ����� " .
                                          mb_strlen($group) . ".";
        } elseif(!preg_match("/[�-��-�0-9]/u", $group)) {
            $this->errors["numberOfGroup"] = "������������ ������ ������ ������.
                                           ����������� ������������ ������ ����� ��� �����.";
        }
    }
    public function validateEmail($email)
    {
        if(!$email) {
            $this->errors["email"] = "�� ��������� ���� ����� email.";
        } elseif(!preg_match("/.+@.+\..+/i", $email)) {
            $this->errors["email"] = "�������� ������ email ������.";
  /*      } elseif(!$this->mapper->isUniqueEmail($email)) {
            $this->errors["email"] = "�� ��� ����������������.";
        }
 */
    }
    public function validateMark($mark)
    {
        if(!$mark) {
            $this->errors["mark"] = "�� ��������� ���� ����� ����� ���.";
        }
        if($mark < 0 or $mark > 300) {
            $this->errors["mark"] = "���� ��� ������ ���� � ��������� �� 100 �� 300.
                                     �� ����� " . "{$mark}";
        }
    }
    public function validateDateOfBirth($year)
    {
        if(!$year) {
            $this->errors["DateOfBirth"] = "�� ��������� ���� ����� ���� ��������.";
        } elseif(intval($year) < 1930 or intval($year) > date("Y") - 10) {
            $this->errors["DateOfBirth"] = "�� �� ������ ��������� � ��� ����������� �� ���������� ���������.";
        }
    }
    /*public function validateSexOpt($opt)
    {
        if(!$opt) {
            $this->errors["sex"] = "�� ������ ���.";
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