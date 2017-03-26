<?php


namespace Core\Http\Components\Request;


class Request implements RequestInterface
{
    private $serverInfo;

    public function __construct($serverInfo)
    {
        $this->serverInfo = $serverInfo;
    }

    public function getReferrer()
    {
        return $this->serverInfo['HTTP_REFERER'];
    }
}