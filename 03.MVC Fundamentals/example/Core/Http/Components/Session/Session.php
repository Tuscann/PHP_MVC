<?php


namespace Core\Http\Components\Session;


class Session implements SessionInterface
{
    private $sessions;

    /**
     * @var callable
     */
    private $destroyableDelegate;


    public function __construct(&$sessions, callable $destroyableDelegate)
    {
        $this->sessions = &$sessions;
        $this->destroyableDelegate = $destroyableDelegate;
    }

    public function get($key)
    {
        return $this->sessions[$key];
    }

    public function set($key, $value)
    {
        $this->sessions[$key] = $value;
    }

    public function getMessage($key)
    {
        if (!isset($this->sessions['messages'][$key])) {
            return [];
        }

        $messages = $this->sessions['messages'][$key];
        unset($this->sessions['messages'][$key]);

        return $messages;
    }

    public function getMessages()
    {
        return $this->sessions['messages'];
    }


    public function delete($key)
    {
        unset($this->sessions[$key]);
    }

    public function destroy()
    {
        $destroy = $this->destroyableDelegate;
        $destroy();
    }

    public function addMessage($key, $message)
    {
        $this->sessions['messages'][$key][] = $message;
    }
}