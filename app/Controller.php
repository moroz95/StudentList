<?php

/**
 * Основной контроллер
 */
class Controller
{
    private $model;

    private $view;

    private $form = array(
        'lastName' => array('Фамилия:', 'Введите фамилию', 'text'),
        'firstName' => array('Имя:', 'Введите имя', 'text'),
        'mark' => array('Баллы за ЕГЭ:', 'Введите баллы', 'number'),
        'birthDate' => array('Дата рождения:', '01-01-2011', 'date'),
        'groupNumber' => array('Номер группы:', 'Введите номер группы', 'text'),
        'email' => array("Email:", 'Email', 'email')
    );

    public function __construct()
    {
        $this->model = new StudentDataGateway();
        $this->view = new View();
    }

    public function index()
    {
        $order = empty($_GET['order']) ? 'firstName' : $_GET['order'];
        $students = $this->model->getStudentsList($order);
        $this->view->render('students', array('students' => $students, 'page' => 'students'));
    }

    public function search()
    {
        $order = empty($_GET['order']) ? 'firstName' : $_GET['order'];

        if (!empty($_GET['q'])) {
            $students = $this->model->searchStudents($_GET['q'], $order);
            $search_url = '&q=' . $_GET['q'];
        } else {
            $students = $this->model->getStudentsList($order);
            $search_url = '';
        }

        $this->view->render('students', array('students' => $students, 'search_url' => $search_url, 'page' => 'students'));
    }

    public function register()
    {
        $variables = array('page' => 'register');

        if ($_POST) {
            $student = new StudentModel();
            $student->setAttributes($_POST);
            $validate = new Validation($this->model);
            $validate->validate($student);

            foreach ($validate->getErrors() as $key => $value) {
                if (key_exists($key, $this->form))
                    $this->form[$key][3] = $value;
            }

            $result = $this->model->insert($student) ?
                "<div class='alert alert-success' role='alert'>Добавление студента прошло удачно!</div>" :
                "<div class='alert alert-warning' role='alert'>Неудача! Исправьте ошибки</div>";

            $variables['result'] = $result;
            $variables['validate'] = $validate;
        }
        $variables['form'] = $this->form;
        $this->view->render('edit', $variables);
    }


    public function edit($id)
    {
        $student = $this->model->getStudentById($id);
        $this->view->render('edit', array('page' => "edit/$id"));
    }
}