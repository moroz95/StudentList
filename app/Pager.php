<?php

/**
 * Class Pager
 *
 * Create links and get total pages
 *
 * @author Phrlog <phrlog@gmail.com>
 */
class Pager
{
    public  $totalPages = null;
    public  $recordsPerPage;
    private $model;

    /**
     * Pager constructor.
     *
     * @param StudentDataGateway $model model injection
     * @param integer $recordsPerPage student per page
     */
    public function __construct(StudentDataGateway $model, $recordsPerPage = 5)
    {
        $this->model = $model;
        $this->recordsPerPage = $recordsPerPage;
    }

    /**
     * @param string $search search query
     *
     * @return integer       total pages
     */
    public function getTotalPages($search = '')
    {
        $number_of_students = $this->model->countStudents($search);
        $this->totalPages = ceil($number_of_students / $this->recordsPerPage);
        return $this->totalPages;
    }

    /**
     * @param string $template page to build
     * @param array $params parameters
     *
     * @return string          link
     */
    public function buildLink($template, $params)
    {
        $link = htmlspecialchars("/$template/?" . http_build_query($params));
        return $link;
    }

    public function lastPage($template, $params, $current_page)
    {
        if ($this->totalPages === null) {
            $this->totalPages = $this->getTotalPages();
        }

        if ($current_page <= 1) {
            return null;
        } else {
            $params['page'] = $current_page - 1;
            return $this->buildLink($template, $params);
        }
    }

    public function nextPage($template, $params, $current_page)
    {
        if ($this->totalPages === null) {
            $this->totalPages = $this->getTotalPages();
        }

        if ($current_page >= $this->totalPages) {
            return null;
        } else {
            $params['page'] = $current_page + 1;
            return $this->buildLink($template, $params);
        }
    }
}