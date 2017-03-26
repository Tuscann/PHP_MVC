<?php
namespace SoftUni\Models\View;

class ApplicationViewModel
{
    private $name;

    /**
     * ApplicationViewModel constructor.
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }



}