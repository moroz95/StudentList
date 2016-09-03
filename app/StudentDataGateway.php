<?php

/**
 * Class StudentDataGateway
 *
 * Main model for getting/setting data
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class StudentDataGateway
{
    /*
     *  @var pdo
     */
    private $pdo = false;


    /**
     * Constructor sets up {@link $pdo}
     */
    public function __construct()
    {
        include_once '../app/Database.php';
        try {
            $this->pdo = new PDO(
                "mysql:host=$db_host; dbname=$db_name; charset=utf8",
                $db_username, $db_password
            );
        } catch (PDOException $e) {
            echo "Connection error.";
        }
    }

    /**
     * Get array of StudentModel, depends from order and required page
     *
     * @param string  $order           requested order
     * @param integer $page            requested page
     * @param integer $studentsPerPage students per page for pagination
     *
     * @return array
     */
    public function getStudentsList($order, $page, $studentsPerPage)
    {
        $students = array();

        $parameters = array('firstName', 'lastName', 'groupNumber', 'mark');
        $key = array_search($order, $parameters);
        $order = $key ? $parameters[$key] : 'firstName';

        $sql = "SELECT * FROM `students` ORDER BY " . $order . " LIMIT :skip, :max";
        $sth = $this->pdo->prepare($sql);
        $sth->bindValue(':skip', (int)(($page - 1) * $studentsPerPage), PDO::PARAM_INT);
        $sth->bindValue(':max', (int)$studentsPerPage, PDO::PARAM_INT);
        $sth->execute();
        $students = $sth->fetchAll(PDO::FETCH_CLASS, "StudentModel");

        return $students;
    }

    /**
     * Get array of StudentModel, depends from search query and order
     *
     * @param string  $search          search query
     * @param string  $order           requested order
     * @param integer $page            required page
     * @param integer $studentsPerPage students per page for pagination
     *
     * @return array
     */
    public function searchStudents($search, $order, $page, $studentsPerPage)
    {
        $students = array();

        $parameters = array('firstName', 'lastName', 'groupNumber', 'mark');
        $key = array_search($order, $parameters);
        $order = $key ? $parameters[$key] : 'firstName';

        $sql = "SELECT * FROM students WHERE (firstName LIKE :search OR lastName LIKE :search OR mark LIKE :search OR groupNumber LIKE :search) ORDER BY " . $order . " LIMIT :skip, :max";
        $sth = $this->pdo->prepare($sql);

        $sth->bindValue(':skip', (int)(($page - 1) * $studentsPerPage), PDO::PARAM_INT);
        $sth->bindValue(':max', (int)$studentsPerPage, PDO::PARAM_INT);
        $sth->bindValue(':search', $search, PDO::PARAM_STR);

        $sth->execute();
        $students = $sth->fetchAll(PDO::FETCH_CLASS, "StudentModel");
        $students = $this->markQuery($students, $search);
        return $students;
    }

    /**
     * Get StudentModel by id
     *
     * @param integer $id student id
     *
     * @return StudentModel
     */
    public function getStudentById($id)
    {
        $student = false;
        $sql = "SELECT * FROM students WHERE id LIKE ?";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array($id));
        $student = $sth->fetchAll(PDO::FETCH_CLASS, "StudentModel")[0];

        return $student;
    }

    /**
     * Count number of students
     *
     * @param string $search search query
     *
     * @return integer
     */
    public function countStudents($search = '')
    {
        if ($search != '') {
            $sql = "SELECT count(*) FROM students WHERE (firstName LIKE ? OR lastName LIKE ? OR mark LIKE ? OR groupNumber LIKE ?)";
            $execute = array($search, $search, $search, $search);
        } else {
            $sql = "SELECT count(*) FROM `students`";
            $execute = array();
        }

        $sth = $this->pdo->prepare($sql);
        $sth->execute($execute);
        $students = $sth->fetch()[0];
        return $students;
    }

    /**
     * Checking for unique email
     *
     * @param string $email email to check
     *
     * @return bool         is unique or not
     */
    public function isUniqueEmail($email)
    {
        $sth = $this->pdo->prepare("SELECT count(`email`) FROM `students` WHERE `email` = ?");
        $sth->execute(array($email));
        $result = $sth->fetch()[0];
        return !(boolean)$result;
    }

    /**
     * @param $password
     *
     * @return bool
     */
    public function getIdByPassword($password)
    {
        $sth = $this->pdo->prepare("SELECT id FROM `students` WHERE `password` = ?");
        $sth->execute(array($password));
        $result = $sth->fetch()[0];
        return $result;
    }

    /**
     * Mark search query in array of StudentModel
     *
     * @param array  $students array of StudentModel
     * @param string $search   search query
     *
     * @return mixed
     */
    private function markQuery($students, $search)
    {
        $sort = array('lastName', 'firstName', 'groupNumber', 'mark');

        foreach ($students as &$student) {
            foreach ($sort as $s) {
                if (strcasecmp($student->$s, $search) == 0) {
                    $student->$s = "<b>" . h($student->$s) . "</b>";
                }
            }

        }
        return $students;
    }


    /**
     * Insert new student
     *
     * @param StudentModel $student student model to insert
     *
     * @return bool                 result of execute
     */
    public function insert(StudentModel $student)
    {
        $parameters = array(
            'firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location', 'password'
        );

        $sql = "INSERT INTO students(
            firstName,
            lastName,
            sex,
            groupNumber,
            birthDate,
            email,
            mark,
            location,
            password) VALUES (
            :firstName, 
            :lastName, 
            :sex, 
            :groupNumber,
            :birthDate,
            :email,
            :mark,
            :location,
            :password)";

        $sth = $this->pdo->prepare($sql);

        foreach ($parameters as $parameter) {
            $sth->bindParam(":$parameter", $student->$parameter);
        }

        return $sth->execute();
    }

    /**
     * Update student by id
     *
     * @param StudentModel $student updated model
     *
     * @return bool                 result of update
     */
    public function update(StudentModel $student)
    {
        $parameters = array(
            'firstName', 'lastName', 'sex', 'groupNumber', 'birthDate', 'email', 'mark', 'location', 'id'
        );

        $sql = "UPDATE students SET 
            firstName = :firstName,
            lastName = :lastName, 
            sex = :sex,
            groupNumber = :groupNumber,
            birthDate = :birthDate,
            email = :email,
            mark = :mark,
            location = :location
            WHERE id = :id";

        $sth = $this->pdo->prepare($sql);

        foreach ($parameters as $parameter) {
            $sth->bindParam(":$parameter", $student->$parameter);
        }

        return $sth->execute();
    }

    /**
     * Delete student by id
     *
     * @param integer $id student id
     *
     * @return PDOStatement result of deleting
     */
    public function delete($id)
    {
        $sql = "DELETE FROM students WHERE id LIKE ?";
        $sth = $this->pdo->prepare($sql);
        $sth->execute(array($id));

        return $sth;

    }


}