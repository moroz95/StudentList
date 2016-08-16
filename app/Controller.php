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

	public function register()
	{
		/**
		 * проверка валидации и вставки
		 * в конечном счете класс должен принимать POST запросы, данные из POST отпрвлять в метод setAttributes,
		 * потом уже вставлять данные в бд с помощью метода insert
		 */
		if($_POST)
		{
			$student = new StudentModel();
			$student->setAttributes($_POST);
			$validate = new Validation($this->model);
			$errors = $validate->validate($student);
			if ($this->model->insert($student)) echo "удачно";
			else echo "неудачно";
		}
		$page = "register";
		$content = '../templates/edit.php';
		include "../templates/main.php";
	}

	public function edit($id)
	{
		$page = "edit/$id";
		$student = $this->model->getStudentById($id);
		$content = '../templates/edit.php';
		include "../templates/main.php";
	}
}