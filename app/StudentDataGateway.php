<?php

/**
 * Class StudentDataGateway
 *
 * здесь будут методы для работы с БД
 *
 * выборка, вставка, обновление и удаление
 *
 * для работы передается объект PDO
 */
class StudentDataGateway
{
    private $pdo = false;

    public function __construct()
    {
        require_once '../app/Database.php';
        try {
            $this->pdo = new PDO("mysql:host=$db_host; dbname=$db_name; charset=utf8", $db_username, $db_password);
        } catch (PDOException $e) {
            echo "Connection error.";
        }
    }

    public function getStudentsList($order)
    {
        $students = array();

        $parameters = array('firstName', 'lastName', 'groupNumber', 'mark');
        $key = array_search($order, $parameters);
        $order = $key ? $parameters[$key] : 'firstName';

        $sql = "SELECT * FROM `students` ORDER BY " . $order;
        $sth = $this->pdo->query($sql);
        $students = $sth->fetchAll(PDO::FETCH_CLASS, "StudentModel");

        return $students;
    }

    public function insert(StudentModel $student)
    {
        $parameters = array('firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location');

        $sql = "INSERT INTO students(
            firstName,
            lastName,
            sex,
            groupNumber,
            birthDate,
            email,
            mark,
            location) VALUES (
            :firstName, 
            :lastName, 
            :sex, 
            :groupNumber,
            :birthDate,
            :email,
            :mark,
            :location)";

        $sth = $this->pdo->prepare($sql);

        foreach ($parameters as $parameter)
        {
            $sth->bindParam(":$parameter", $student->$parameter);
        }

        return $sth->execute();
    }

    public function update(StudentModel $student, $id)
    {
        $parameters = array('firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location');
    }

    public function delete($id)
    {

    }

    public function isUniqueEmail($email)
    {
        $sth = $this->pdo->prepare("select count(`email`) from `students` where `email` = ?");
        $sth->execute(array($email));
        $result = $sth->fetch()[0];
        return !(boolean)$result;
    }

}