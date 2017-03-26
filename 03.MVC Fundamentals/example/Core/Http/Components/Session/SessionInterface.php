<?php


namespace Core\Http\Components\Session;


interface SessionInterface
{
    public function get($key);

    public function set($key, $value);

    public function getMessage($key);

    public function getMessages();

    public function addMessage($key, $message);

    public function delete($key);

    public function destroy();
}