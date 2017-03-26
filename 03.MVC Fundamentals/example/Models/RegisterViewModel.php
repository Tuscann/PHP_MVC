<?php


namespace Models;


class RegisterViewModel
{
   private $title;

    /**
     * RegisterViewModel constructor.
     * @param $title
     */
    public function __construct($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }


}