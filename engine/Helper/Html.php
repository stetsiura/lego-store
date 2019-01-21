<?php

namespace Engine\Helper;

use function GuzzleHttp\default_ca_bundle;

class Html
{
    const ITEMS_PER_PAGE = 15;

    const MONTHS = ['Январь', 'Февраль', 'Март', 'Апрель', 'Май', 'Июнь', 'Июль', 'Август', 'Сентябрь', 'Октябрь', 'Ноябрь', 'Декабрь'];

    /**
     * @param string $name
     * @param string $id
     * @param string $keyColumn
     * @param string $valueColumn
     * @param string $class
     * @param array $data
     */
    public static function select($name, $id, $keyColumn, $valueColumn, $class, $data, $selectedValue = -1)
    {
        echo "<select name=\"{$name}\" id=\"{$id}\" class=\"{$class}\">";

        foreach($data as $option) {
            $selectedAttr = ($selectedValue == $option[$keyColumn]) ? 'selected' : '';
            echo "<option value=\"{$option[$keyColumn]}\" {$selectedAttr}>{$option[$valueColumn]}</option>\n";
        }

        echo "</select>\n";
    }

    /**
     * @param string $name
     * @param string $id
     * @param string $class
     * @param string $value
     * @param string $spellcheck
     * @param string $autocomlete
     * @param string $attrs
     * @param string $placeholder
     */
    public static function inputText($name, $id, $class, $value, $spellcheck, $autocomlete, $attrs, $placeholder = '')
    {
        echo "<input type=\"text\" name=\"{$name}\" id=\"{$id}\" class=\"{$class}\" value=\"{$value}\" spellcheck=\"{$spellcheck}\" autocomplete=\"{$autocomlete}\" {$attrs} placeholder=\"{$placeholder}\">\n";
    }

    /**
     * @param string $name
     * @param string $id
     * @param string $value
     */
    public static function inputHidden($name, $id, $value)
    {
        echo "<input type=\"hidden\" name=\"{$name}\" id=\"{$id}\" value=\"{$value}\">";
    }

    /**
     * @param string $name
     * @param string $id
     * @param string $class
     */
    public static function inputPassword($name, $id, $class, $placeholder = '')
    {
        echo "<input type=\"password\" name=\"{$name}\" id=\"{$id}\" class=\"{$class}\" placeholder=\"{$placeholder}\">";
    }

    /**
     * @param string $name
     * @param string $id
     * @param bool $checked
     */
    public static function inputCheckbox($name, $id, $checked = false)
    {
        $checkedAttr = $checked ? 'checked' : '';
        echo "<input type=\"checkbox\" name=\"{$name}\" id=\"{$id}\" {$checkedAttr}>\n";
    }

    /**
     * @param string $name
     * @param string $id
     * @param string $class
     * @param string $value
     * @param string $placeholder
     */
    public static function textarea($name, $id, $class, $value, $attrs, $placeholder = '')
    {
        echo "<textarea name=\"{$name}\" id=\"{$id}\" class=\"{$class}\" {$attrs} placeholder=\"{$placeholder}\">{$value}</textarea>\n";
    }

    /**
     * @param string $for
     * @param string $text
     */
    public static function label($for, $text, $class = '')
    {
        echo "<label for=\"{$for}\" class=\"{$class}\">{$text}</label>\n";
    }

    public static function categoryBigImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'categories/big/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image.png";
        }
    }

    public static function categorySmallImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'categories/small/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image.png";
        }
    }

    public static function productOriginalImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'products/original/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image.png";
        }
    }

    public static function productThumbnailImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'products/thumb/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image-thumb.png";
        }
    }

    public static function productPrice($product)
    {
        if ($product['has_discount']) {
            return number_format($product['actual_price'], 2);
        } else {
            return number_format($product['price'], 2);
        }
    }

    public static function newsOriginalImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'news/cover/original/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image-thumb.png";
        }
    }

    public static function newsThumbnailImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'news/cover/thumb/' . $basename;
        } else {
            echo "/app/assets/img/common/no-image-thumb.png";
        }
    }

    public static function sliderImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            echo "/app/assets/img/common/no-image-thumb.png";
        } else {
            echo CLIENT_UPLOADS_PATH . "slider/" . $imageUrl;
        }
    }

    public static function date($dateString)
    {
        echo \DateTime::createFromFormat('Y-m-d h:i:s', $dateString)->format('d.m.Y');
    }

    public static function partsCasing($count) {
        $mod100 = $count % 100;

        $mod10 = $count % 10;

        if ($mod100 >= 11 && $mod100 <= 20) {
            return "деталей";
        } else {
            switch($mod10) {
                case 1:
                    return "деталь";
                case 2:
                case 3:
                case 4:
                    return "детали";
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 0:
                    return "деталей";
                default:
                    return "деталь";
            }
        }

        return "деталь";
    }

    public static function daysCasing($count) {
        $mod100 = $count % 100;

        $mod10 = $count % 10;

        if ($mod100 >= 11 && $mod100 <= 20) {
            return "дней";
        } else {
            switch($mod10) {
                case 1:
                    return "день";
                case 2:
                case 3:
                case 4:
                    return "дня";
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 0:
                    return "дней";
                default:
                    return "дней";
            }
        }

        return "деталь";
    }

    public static function minifiguresCasing($count) {
        $mod100 = $count % 100;

        $mod10 = $count % 10;

        if ($mod100 >= 11 && $mod100 <= 20) {
            return "фигурок";
        } else {
            switch($mod10) {
                case 1:
                    return "фигурка";
                case 2:
                case 3:
                case 4:
                    return "фигурки";
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 0:
                    return "фигурок";
                default:
                    return "фигурка";
            }
        }

        return "фигурка";
    }

    public static function productCasing($count) {
        $mod100 = $count % 100;

        $mod10 = $count % 10;

        if ($mod100 >= 11 && $mod100 <= 20) {
            return "наборов";
        } else {
            switch($mod10) {
                case 1:
                    return "набор";
                case 2:
                case 3:
                case 4:
                    return "набора";
                case 5:
                case 6:
                case 7:
                case 8:
                case 9:
                case 0:
                    return "наборов";
                default:
                    return "набор";
            }
        }

        return "набор";
    }

    public static function buyButtonText($itemState) {
        switch ($itemState) {
            case 'order':
                return 'Заказать';
            case 'instock':
                return 'Купить';
            default:
                return 'Заказать';
        }
    }

    public static function productStateText($itemState) {
        switch($itemState) {
            case 'order':
                return 'Под заказ';
            case 'instock':
                return 'Есть в наличии';
            default:
                return 'Под заказ';
        }
    }

    public static function sortOrderSelected($sort, $order, $pageParams)
    {
        if ($sort == $pageParams['sort'] && $order == $pageParams['order']) {
            return "selected";
        }

        return "";
    }

    public static function pagination($pageParams, $itemsCount, $type = 'category')
    {
        if ($itemsCount > self::ITEMS_PER_PAGE) {
            $currentPage = $pageParams['page'];
            $totalPagesCount = (int) ceil($itemsCount / self::ITEMS_PER_PAGE);
            $displayLeftArrow = $currentPage > 1;
            $displayRightArrow = ($currentPage != $totalPagesCount);
            $pagesBefore = ($currentPage > 2) ? 2 : $currentPage - 1;
            $pagesAfter = ($totalPagesCount - $currentPage > 2) ? 2 : $totalPagesCount - $currentPage - 1;
            $nextPage = $displayRightArrow ? $currentPage + 1 : $totalPagesCount;
            $prevPage = $displayLeftArrow ? $currentPage - 1 : 1;

            echo "<div class=\"pagination\">\n<ul>\n";

            if ($displayLeftArrow) {
                echo "<li><a href=\"" .
                    \Url::navigationUrl($pageParams['term'], $pageParams['alias'], $pageParams['filters'], $pageParams['inStock'], $prevPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" data-page=\"{$prevPage}\"><i class=\"fa fa-chevron-left\"></i></a></li>\n";
            }

            for ($i = $currentPage - $pagesBefore; $i < $currentPage; $i++) {
                echo "<li><a href=\"" .
                    \Url::navigationUrl($pageParams['term'], $pageParams['alias'], $pageParams['filters'], $pageParams['inStock'], $i, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" data-page=\"{$i}\">" .
                    $i .
                    "</a></li>\n";
            }

            echo "<li><a class=\"active\">" . $currentPage . "</a></li>";

            for ($j = $currentPage + 1; $j <= $currentPage + $pagesAfter + 1; $j++) {
                echo "<li><a href=\"" .
                    \Url::navigationUrl($pageParams['term'], $pageParams['alias'], $pageParams['filters'], $pageParams['inStock'], $j, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" data-page=\"{$j}\">" .
                    $j .
                    "</a></li>\n";
            }

            if ($displayRightArrow) {
                echo "<li><a href=\"" .
                    \Url::navigationUrl($pageParams['term'], $pageParams['alias'], $pageParams['filters'], $pageParams['inStock'], $nextPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" data-page=\"{$nextPage}\"><i class=\"fa fa-chevron-right\"></i></a></li>\n";
            }

            echo "</ul>\n</div>\n";
        }
    }

    public static function newsBlockDate($dateKey) {
        $parts = explode('-', $dateKey);

        $parts[1] = (int)$parts[1];

        return self::MONTHS[$parts[1] - 1] . "<br>" . $parts[0];
    }
}