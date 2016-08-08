<?php

/**
 * Основной контроллер
 */


class Controller
{
	private $model;

	public function __construct()
	{
		$this->model = new StudentDataGateway();
	}

	public function index($order)
	{
		$students = $this->model->getStudentsList($order);
		$content = '../templates/students.php';
		include '../templates/main.php';
	}
}