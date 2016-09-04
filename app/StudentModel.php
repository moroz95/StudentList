<?php

/**
 * Class StudentModel
 *
 * Student attributes and setting method
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class StudentModel
{

    public $id;
    public $firstName;
    public $lastName;
    public $sex;
    public $groupNumber;
    public $birthDate;
    public $email;
    public $mark;
    public $location;
    public $password;

    /**
     * Setting student attributes
     *
     * @param array $attributes data from post
     *
     * @return null
     */
    public function setAttributes($attributes)
    {
        foreach ($attributes as $name => $attribute)
        {
            if (property_exists('StudentModel', $name))
            {
                $this->$name = h($attribute);
            }
        }

    }

    public function generatePassword($strength = 40)
    {
        return preg_replace('/=*$/', '', base64_encode(openssl_random_pseudo_bytes($strength)));
    }

}
