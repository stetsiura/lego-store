<?php

namespace Engine\Helper;

class Validator
{
    const NOT_EMPTY_REGEX = '/([^\s])/';

    /**
     * @var \Engine\DI\DI
     */
    protected $di;

    /**
     * @var \Engine\Model
     */
    protected $model;

    /**
     * @var \Engine\Load
     */
    protected $load;

    private $valid = true;

    public function __construct(\Engine\DI\DI $di)
    {
        $this->di = $di;
        $this->load = $this->di->get('load');
        $this->model = $this->di->get('model');
    }

    public function init()
    {
        $this->valid = true;

        return $this;
    }

    public function email($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->valid = false;
        }

        return $this;
    }

    public function notEmpty($value)
    {
        if (!preg_match(self::NOT_EMPTY_REGEX, $value)) {
            $this->valid = false;
        }

        return $this;
    }

    public function result()
    {
        return $this->valid;
    }

    public function match($value, $target)
    {
        if ($value !== $target) {
            $this->valid = false;
        }

        return $this;
    }

    public function emailUnique($email)
    {
        $this->load->model('User');

        $unique = $this->model->user->checkEmail($email);

        if (!$unique) {
            $this->valid = false;
        }

        return $this;
    }

    public function validateRegistration($params)
    {
        return $this
            ->init()
            ->notEmpty($params['name'])
            ->email($params['email'])
            ->notEmpty($params['password'])
            ->match($params['password'], $params['password_repeat'])
            ->emailUnique($params['email'])
            ->result();
    }

    public function validateUserEdit($params)
    {
        return $this
            ->notEmpty($params['name'])
            ->email($params['email'])
            ->result();
    }

    public function validateOrder($params)
    {
        return $this
            ->init()
            ->notEmpty($params['client_name'])
            ->email($params['email'])
            ->notEmpty($params['phone'])
            ->notEmpty($params['city'])
            ->notEmpty($params['post_office'])
            ->result();
    }
}