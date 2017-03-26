<?php
/**
 * Created by IntelliJ IDEA.
 * User: RoYaL
 * Date: 11/24/2016
 * Time: 9:51 PM
 */

namespace SoftUni\Models\DB;


class Category
{
    private $id;
    private $name;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }



}