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
    public  $totalPages;
    public  $recordsPerPage;
    private $model;

    /**
     * Pager constructor.
     *
     * @param StudentDataGateway $model          model injection
     * @param integer            $recordsPerPage student per page
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
        $pages = ceil($number_of_students/$this->recordsPerPage);
        return $pages;
    }

    /**
     * @param string $template page to build
     * @param array  $params   parameters
     *
     * @return string          link
     */
    public function buildLink($template, $params)
    {
        $link = "$template/?" . http_build_query($params);
        return $link;
    }
}