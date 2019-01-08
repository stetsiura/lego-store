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

        $params['alias'] = $alias;

        if (isset($getParams['inStock'])) {
            $params['inStock'] = $getParams['inStock'] == 'true';
        } else {
            $params['inStock'] = true;
        }

        $params['filters'] = isset($getParams['filters']) && !empty($getParams['filters']) ? explode('--', $getParams['filters']) : [];

        $params['page'] = isset($getParams['page']) ? $getParams['page'] : 1;

        $params['sort'] = isset($getParams['sort']) ? $getParams['sort'] : 'name';

        $params['order'] = isset($getParams['order']) ? $getParams['order'] : 'asc';

        $params['term'] = isset($getParams['term']) ? $getParams['term'] : '';

        return $params;
    }

    public static function categoryUrl($alias, $filters, $inStock, $page, $sort, $order = 'asc')
    {
        $filtersString = implode('--', $filters);
        $inStockString = ($inStock) ? "true" : "false";
        return "/category/{$alias}?filters={$filtersString}&inStock={$inStockString}&page={$page}&sort={$sort}&order={$order}";
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