<?php

/**
 * Class Controller
 *
 * Main app controller
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class Controller
{
    /**
     * Model for getting/setting data
     *
     * @var StudentDataGateway
     */
    private $model;

    /**
     * View to render pages
     *
     * @var View
     */
    private $view;

    /**
     * Edit/register form data
     *
     * @var array
     */
    private $form = array(
        'lastName'    => array('title' => 'Фамилия:',       'legend' => 'Введите фамилию',      'type' => 'text',   'value' => ''),
        'firstName'   => array('title' => 'Имя:',           'legend' => 'Введите имя',          'type' => 'text',   'value' => ''),
        'mark'        => array('title' => 'Баллы за ЕГЭ:',  'legend' => 'Введите баллы',        'type' => 'number', 'value' => ''),
        'birthDate'   => array('title' => 'Дата рождения:', 'legend' => '01-01-2011',           'type' => 'date',   'value' => ''),
        'groupNumber' => array('title' => 'Номер группы:',  'legend' => 'Введите номер группы', 'type' => 'text',   'value' => ''),
        'email'       => array('title' => "Email:",         'legend' => 'Email',                'type' => 'email',  'value' => '')
    );

    /**
     * Controller constructor.
     *
     * Sets up {@link $model} and {@link $view}
     */
    public function __construct()
    {
        $this->model = new StudentDataGateway();
        $this->view = new View();
    }

    /**
     * Index page, using by default and /index/
     *
     * @return null
     */
    public function index()
    {
        $studentsPerPage = 10;
        $pager = new Pager($this->model, $studentsPerPage);

        $order = empty($_GET['order']) ? 'firstName' : strval($_GET['order']);
        $search = empty($_GET['q']) ? '' : strval($_GET['q']);
        $page = (empty($_GET['page']) || !preg_match('/^\+?\d+$/', $_GET['page'])) ? '1' : strval($_GET['page']);
        $notify = empty($_GET['notify']) ? '' : strval($_GET['notify']);

        $page = $page > $pager->getTotalPages(@$search) ? $pager->getTotalPages(@$search) : $page;

        $students = ($search == '') ?
            $this->model->getStudentsList($order, $page, $studentsPerPage) :
            $this->model->searchStudents($search, $order, $page, $studentsPerPage);

        $url_params = array('order' => $order);
        if($search != ''){
            $url_params['q'] = $search;
        }

        $this->view->render(
            'students', array('students' => $students, 'pager' => $pager, 'url_params' => $url_params, 'url_template' => 'index',
                'page_number' => $page, 'notify' => $notify)
        );
    }

    /**
     * Register page for new students
     *
     * @return null;
     */
    public function register()
    {
        $variables = array('url_template' => 'register');

        if ($_POST) {
            $student = new StudentModel();
            $student->setAttributes($_POST);

            $student->password = $student->generatePassword(40);
            setcookie("password", $student->password, mktime(0, 0, 0, 1, 1, 2018));

            $validate = new Validation($this->model);
            $validate->validate($student, 'register');

            if ($validate->getErrors() != false) {
                $this->form = $validate->setErrorsInForm($this->form);
                $result = "Неудача! Исправьте ошибки";
            } else {
                if ($this->model->insert($student)) {
                    header("Location: /index/?notify=success");
                } else {
                    $result = "Неудача! Исправьте ошибки";
                }
            }

            $variables['result'] = $result;
            $variables['validate'] = $validate;
        }
        $variables['form'] = $this->form;
        $this->view->render('edit', $variables);
    }

    /**
     * Edit page for student by id
     *
     * @return null
     */
    public function edit()
    {
        $validate = new Validation($this->model);

        $password = isset($_COOKIE['password']) ? $_COOKIE['password'] : false;
        $id = $password ? $this->model->getIdByPassword($password) : false;

        if ($id !== false) {
            $student = $this->model->getStudentById($id);
            $variables = array('url_template' => 'edit');
            $variables['student'] = $student;
            $this->form = $validate->setValuesInForm($this->form, $student);

            if ($_POST) {
                $student = new StudentModel();
                $student->setAttributes($_POST);
                $student->id = $id;

                $validate->validate($student, 'edit');
                if ($validate->getErrors() != false) {
                    $this->form = $validate->setErrorsInForm($this->form);
                    $result = "Неудача! Исправьте ошибки";
                } else {
                    $this->model->update($student) ? header("Location: /index/?notify=success") :
                        $result = "Неудача! Исправьте ошибки";

                }
                $variables['result'] = $result;
                $variables['validate'] = $validate;
            }
            $variables['form'] = $this->form;
            $this->view->render('edit', $variables);
        } else {
            header('Location: /index');
        }
    }

    /**
     * 404 page
     *
     * @return null
     */
    public function notFound()
    {
        $this->view->render('notFound', array('url_template' => 'notFound'));
    }
}