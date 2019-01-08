<?php

namespace Engine\Core\Mail\Message;

abstract class AbstractMessage
{
    protected $data = [];

    protected $templateFile = '';

    protected $subject = '';

    protected $email = '';

    public function getBody()
    {
        $template = file_get_contents($this->templateFile);

        foreach($this->data as $pattern => $value) {
            $template = $this->replacePattern($template, $pattern, $value);
        }

        return $template;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getEmail()
    {
        return $this->email;
    }

    private function replacePattern($template, $pattern, $value)
    {
        return str_replace('%' . strtoupper($pattern) . '%', $value, $template);
    }
}