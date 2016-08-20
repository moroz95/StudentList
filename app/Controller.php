<?php

/**
 * Основной контроллер
 */


class Controller
{
	private $model;

	private $view;

	private $form = array(
		'lastName' 		=> array('Фамилия:', 'Введите фамилию','text'),
		'firstName' 	=> array('Имя:', 'Введите имя', 'text'),
		'mark' 			=> array('Баллы за ЕГЭ:', 'Введите баллы', 'number'),
		'birthDate' 	=> array('Дата рождения:', '01-01-2011', 'date'),
		'groupNumber' 	=> array('Номер группы:', 'Введите номер группы', 'text'),
		'email' 		=> array("Email:", 'Email', 'email')
	);

	public function __construct()
	{
		$this->model = new StudentDataGateway();
		$this->view = new View();
	}

	public function index($order)
	{
		$students = $this->model->getStudentsList($order);
		$this->view->render('students',array('students' => $students));
	}

	public function register()
	{
		if($_POST)
		{
			$student = new StudentModel();
			$student->setAttributes($_POST);
			$validate = new Validation($this->model);
			$validate->validate($student);
			foreach ($validate->getErrors() as $key => $value)
			{
				if(key_exists($key, $this->form))
				$this->form[$key][3] = $value;
			}
			if ($this->model->insert($student)) echo "удачно";
			else echo "неудачно";
			$this->view->render('edit',array('page' => 'register', 'form' => $this->form, 'validate' => $validate));
		}
		else
		{
			$this->view->render('edit',array('page' => 'register','form' => $this->form));
		}
	}

	public function edit($id)
	{
		$student = $this->model->getStudentById($id);
		$this->view->render('edit',array('page'=>"edit/$id"));
	}
}