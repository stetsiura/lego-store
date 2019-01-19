<?php

namespace Engine\Helper;

class Url
{
    public static function passwordResetUrl($hash)
    {
        return 'http://1184105.mnsdev.web.hosting-test.net/account/password-reset-form/' . $hash;
    }

    public static function pageParams($getParams, $alias = '')
    {
        $params = [];

        $params['sort'] = isset($getParams['sort']) ? $getParams['sort'] : 'name';

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
        return "/search?term={$term}&page={$page}&sort={$sort}&order={$order}";
    }

    public static function navigationUrl($term, $alias, $filters, $inStock, $page, $sort, $order, $type = 'category')
    {
        switch($type) {
            case 'category':
                return self::categoryUrl($alias, $filters, $inStock, $page, $sort, $order);
            case 'search':
                return self::searchUrl($term, $page, $sort, $order);
            default:
                return self::categoryUrl($alias, $filters, $inStock, $page, $sort, $order);
        }
    }
}