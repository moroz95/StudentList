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
		$student = new StudentModel();
		$attributes = ['firstName'=>'Никита', 'lastName'=>'Локтионов', 'sex' => 'male', 'groupNumber' => '0001', 'birthDate' =>'1996-01-01', 'email' =>'sfjnsfdgnd.com',
			'mark' =>1, 'location' =>'nonresident' ];
		$student->setAttributes($attributes);
		$validate = new Validation($this->model);
		$errors = $validate->validate($student);
		var_dump($errors);
		$this->model->insert($student);
	}
}