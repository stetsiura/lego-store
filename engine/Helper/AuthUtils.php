<?php

namespace Engine\Helper;

class AuthUtils
{
    public static function isInRole($auth, $roles = [])
    {
        if (!$auth['authorized']) {
            return false;
        }

        if (empty($roles)) {
            return true;
        }

        return in_array($auth['user']['role'], $roles);
    }
}