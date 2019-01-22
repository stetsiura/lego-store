<?php

namespace Engine\Helper;

class Url
{
    public static function passwordResetUrl($hash)
    {
        return 'http://bricksunity.loc:8080/account/password-reset-form/' . $hash;
    }

    public static function pageParams($getParams, $alias = '')
    {
        $params = [];

        $params['sort'] = isset($getParams['sort']) ? $getParams['sort'] : 'price';

        $params['order'] = isset($getParams['order']) ? $getParams['order'] : 'asc';

        $params['term'] = isset($getParams['term']) ? $getParams['term'] : '';

        return $params;
    }

    public static function categoryUrl($alias, $sort, $order = 'asc')
    {
        return "/category/{$alias}?sort={$sort}&order={$order}";
    }

    public static function searchUrl($term, $page, $sort, $order = 'asc')
    {
        return "/search?term={$term}&sort={$sort}&order={$order}";
    }

    public static function navigationUrl($term, $alias, $sort, $order, $type = 'category')
    {
        switch($type) {
            case 'category':
                return self::categoryUrl($alias, $sort, $order);
            case 'search':
                return self::searchUrl($term, $sort, $order);
            default:
                return self::categoryUrl($alias, $sort, $order);
        }
    }
}