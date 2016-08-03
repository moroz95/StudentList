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
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
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
}