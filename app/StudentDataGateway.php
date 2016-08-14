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
            $this->pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        } catch (PDOException $e) {
            echo "Connection error.";
        }

        $this->pdo->query("SET character_set_results = 'utf8', character_set_client = 'cp1251', character_set_connection = 'cp1251', character_set_database = 'cp1251', character_set_server = 'cp1251'");
        $this->pdo->query('set collation_connection="utf8_general_ci"');

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
            :birhDate,
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

    public function update(StudentModel $student)
    {
        $parameters = array('firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location');
    }

    public function delete(StudentModel $student)
    {

    }

    public function isUniqueEmail($email)
    {

    }

}