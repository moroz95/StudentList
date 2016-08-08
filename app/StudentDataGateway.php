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

    public function update()
    {

    }

    public function insert()
    {

    }

    public function isUniqueEmail()
    {
        
    }

    public function getStudentsList($order)
    {
        $students = array();

        $orders = array('id', 'firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location');
        $key = array_search($order, $orders);
        $order = $key ? $orders[$key]: 'id';

        $sql = "SELECT * FROM `students` ORDER BY ".$order;
        $sth = $this->pdo->query($sql);
        $students = $sth->fetchAll(PDO::FETCH_CLASS, "StudentModel");

        return $students;
    }
}