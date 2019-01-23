<?php

namespace Engine\Helper;

class AdminUrl
{
    public static function pageParams($getParams, $section = null)
    {
        $params = [];

        $params['section'] = $section;

        $params['category_id'] = $section;

        $params['term'] = isset($getParams['term']) ? $getParams['term'] : '';

        $params['page'] = isset($getParams['page']) ? $getParams['page'] : 1;

        $params['sort'] = isset($getParams['sort']) ? $getParams['sort'] : 'date';

        $params['order'] = isset($getParams['order']) ? $getParams['order'] : 'asc';

        return $params;

    }

    public static function usersUrl($section, $page, $sort, $order = 'asc')
    {
        return "/admin/users/{$section}?page={$page}&sort={$sort}&order={$order}";
    }

    public static function usersSearchUrl($term, $page, $sort, $order = 'asc')
    {
        return "/admin/users/search/search-result?term={$term}&page={$page}&sort={$sort}&order={$order}";
    }

    public static function categoryUrl($category_id, $page, $sort, $order = 'asc') {
        return "/admin/categories/{$category_id}?page={$page}&sort={$sort}&order={$order}";
    }

    public static function productsSearchUrl($term, $page, $sort, $order = 'asc')
    {
        return "/admin/product/search/search-result?term={$term}&page={$page}&sort={$sort}&order={$order}";
    }

    public static function newsUrl($page, $sort, $order = 'asc') {
        return "/admin/news/?page={$page}&sort={$sort}&order={$order}";
    }

    public static function navigationUrl($category_id, $section, $term, $page, $sort, $order, $type = 'users')
    {
        switch($type) {
            case 'users':
                return self::usersUrl($section, $page, $sort, $order);
            case 'users-search':
                return self::usersSearchUrl($term, $page, $sort, $order);
            case 'categories':
                return self::categoryUrl($category_id, $page, $sort, $order);
            case 'products-search':
                return self::productsSearchUrl($term, $page, $sort, $order);
            case 'news':
                return self::newsUrl($page, $sort, $order);
            default:
                return '/admin/dashboard/';
        }

    }

    public static function orderUrl($section, $page, $sort, $order = 'ASC')
    {
        return "/admin/orders/{$section}?page={$page}&sort={$sort}&order={$order}";
    }
}