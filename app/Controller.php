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
        $studentsPerPage = 5;
        $pager = new Pager($this->model, $studentsPerPage);

        $order = empty($_GET['order']) ? 'firstName' : strval($_GET['order']);
        $page = empty($_GET['page']) ? '1' : strval($_GET['page']);

        $page = $page > $pager->getTotalPages() ? $pager->getTotalPages() : $page;

        $students = $this->model->getStudentsList($order, $page, $studentsPerPage);
        $params = array('order' => $order);
        $this->view->render(
            'students', array('students' => $students, 'pager' => $pager, 'params' => $params, 'page' => 'index', 'page_number' => $page)
        );
    }

    /**
     * Search page, almost as index, but using while user enter some search query
     *
     * @return null
     */
    public function search()
    {
        $studentsPerPage = 5;
        $pager = new Pager($this->model, $studentsPerPage);

        $order = empty($_GET['order']) ? 'firstName' : strval($_GET['order']);
        $page = empty($_GET['page']) ? '1' : strval($_GET['page']);
        $search = empty($_GET['q']) ? '' : strval($_GET['q']);

        $students = ($search == '') ?
            $this->model->getStudentsList($order, $page, $studentsPerPage) :
            $this->model->searchStudents($search, $order, $page, $studentsPerPage);

        $params = array('q' => $search, 'order' => $order);

        $this->view->render(
            'students', array('students' => $students, 'pager' => $pager, 'params' => $params, 'page' => 'search', 'page_number' => $page)
        );
    }

    /**
     * Register page for new students
     *
     * @return null;
     */
    public function register()
    {
        $variables = array('page' => 'register');

        if ($_POST) {
            $student = new StudentModel();
            $student->setAttributes($_POST);

            $student->password = preg_replace('/=*$/', '', base64_encode(openssl_random_pseudo_bytes(40)));
            setcookie("password", $student->password, mktime(0, 0, 0, 1, 1, 2018));

            $validate = new Validation($this->model);
            $validate->validate($student, 'register');
            if ($validate->getErrors() != false) {
                $this->form = $validate->setErrorsInForm($this->form);
                $result = "<div class='alert alert-warning' role='alert'>Неудача! Исправьте ошибки</div>";
            } else {
                $result = $this->model->insert($student) ?
                    "<div class='alert alert-success' role='alert'>Добавление студента прошло удачно!</div>" :
                    "<div class='alert alert-warning' role='alert'>Неудача! Исправьте ошибки</div>";
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
     * @param integer $id id for edit
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
            $variables = array('page' => 'edit');

            $this->form = $validate->setValuesInForm($this->form, $student);

            if ($_POST) {
                $student = new StudentModel();
                $student->setAttributes($_POST);
                $student->id = $id;

                $validate->validate($student, 'edit');
                if ($validate->getErrors() != false) {
                    $this->form = $validate->setErrorsInForm($this->form);
                    $result = "<div class='alert alert-warning' role='alert'>Неудача! Исправьте ошибки</div>";
                } else {
                    $result = $this->model->update($student) ?
                        "<div class='alert alert-success' role='alert'>Изменение данных прошло удачно!</div>" :
                        "<div class='alert alert-warning' role='alert'>Неудача! Исправьте ошибки</div>";
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
}