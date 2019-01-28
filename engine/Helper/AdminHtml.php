<?php

namespace Engine\Helper;

class AdminHtml
{
    const ITEMS_PER_PAGE = 15;

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

    public static function usersSectionName($role = 'user')
    {
        switch($role) {
            case 'admin':
                return 'Администраторы';
            case 'user':
                return 'Клиенты';
            default:
                return 'Клиенты';
        }
    }

    public static function ordersSectionName($section = 'new')
    {
        switch($section) {
            case 'new':
                return 'Новые';
            case 'ready':
                return 'Отправленные';
            case 'delivered':
                return 'Доставленные';
            case 'cancelled':
                return 'Отмененные';
            default:
                return 'Новые';
        }
    }

    public static function roleName($role = 'user')
    {
        switch($role) {
            case 'admin':
                return 'Администратор';
            case 'user':
                return 'Клиент';
            default:
                return 'Клиент';
        }
    }

    public static function activeClass($value, $pattern)
    {
        if ($value == $pattern) {
            return 'active';
        }

        return '';
    }

    public static function renderDate($dateString)
    {
        $dateTime = \DateTime::createFromFormat('Y-m-d H:i:s', $dateString);

        return $dateTime->format('d.m.Y H:i');
    }

    public static function render($value)
    {
        return htmlentities($value);
    }

    public static function pagination($pageParams, $itemsCount, $type = 'users')
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

            echo "<nav aria-label=\"Page navigation\"><ul class=\"pagination\">\n";

            if ($displayLeftArrow) {
                echo "<li><a href=\"" .
                    \AdminUrl::navigationUrl($pageParams['category_id'], $pageParams['section'], $pageParams['term'], $prevPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>\n";
            }

            for ($i = $currentPage - $pagesBefore; $i < $currentPage; $i++) {
                echo "<li><a href=\"" .
                    \AdminUrl::navigationUrl($pageParams['category_id'], $pageParams['section'], $pageParams['term'], $i, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\">" .
                    $i .
                    "</a></li>\n";
            }

            echo "<li class=\"active\"><a href='\"#\"'>" . $currentPage . "</a></li>\n";

            for ($j = $currentPage + 1; $j <= $currentPage + $pagesAfter + 1; $j++) {
                echo "<li><a href=\"" .
                    \AdminUrl::navigationUrl($pageParams['category_id'], $pageParams['section'], $pageParams['term'], $j, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\">" .
                    $j .
                    "</a></li>\n";
            }

            if ($displayRightArrow) {
                echo "<li><a href=\"" .
                    \AdminUrl::navigationUrl($pageParams['category_id'], $pageParams['section'], $pageParams['term'], $nextPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>\n";
            }

            echo "</ul>\n</nav>\n";
        }
    }

    public static function sortOrderSelected($sort, $order, $pageParams)
    {
        if ($sort == $pageParams['sort'] && $order == $pageParams['order']) {
            return "selected";
        }

        return "";
    }

    public static function tree($categoriesTree)
    {
        echo "<ul>";

        self::renderNode($categoriesTree);

        echo "</ul>\n";
    }

    private static function renderNode($node)
    {
        $selectedProperty = $node['selected'] ? "true" : "false";

        echo "<li data-jstree='{\"opened\":true,\"selected\":" . $selectedProperty . " }' data-cat-id='" . $node['id'] . "'>\n";

        echo $node['name'];

        $childNodes = $node['children'];

        if (!empty($childNodes)) {
            echo "<ul>";

            foreach($childNodes as $childNode) {
                self::renderNode($childNode);
            }

            echo "</ul>\n";
        }

        echo "</li>\n";
    }

    public static function categoryBigImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            return "/admin/assets/img/no-image-thumb.png";
        } else {
            return UPLOADS_PATH . "categories/big/" . $imageUrl;
        }
    }

    public static function categorySmallImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            return "/admin/assets/img/no-image-thumb.png";
        } else {
            return UPLOADS_PATH . "categories/small/" . $imageUrl;
        }
    }

    public static function categoryLogoImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            return "/admin/assets/img/no-image-thumb.png";
        } else {
            return UPLOADS_PATH . "categories/logo/" . $imageUrl;
        }
    }

    public static function categoryThumbImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            return "/admin/assets/img/no-image-thumb.png";
        } else {
            return UPLOADS_PATH . "categories/thumb/" . $imageUrl;
        }
    }

    public static function sliderImage($imageUrl = '')
    {
        if (empty($imageUrl)) {
            return "/admin/assets/img/no-image-thumb.png";
        } else {
            return UPLOADS_PATH . "slider/" . $imageUrl;
        }
    }

    public static function productOriginalImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'products/original/' . $basename;
        } else {
            echo "/admin/assets/img/no-image.png";
        }
    }

    public static function productThumbnailImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'products/thumb/' . $basename;
        } else {
            echo "/admin/assets/img/no-image-thumb.png";
        }
    }

    public static function newsOriginalImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'news/cover/original/' . $basename;
        } else {
            echo "/admin/assets/img/no-image.png";
        }
    }

    public static function newsThumbnailImage($basename)
    {
        if (!empty($basename)) {
            echo CLIENT_UPLOADS_PATH . 'news/cover/thumb/' . $basename;
        } else {
            echo "/admin/assets/img/no-image-thumb.png";
        }
    }

    public static function actualPriceBoxClass($hasDiscount = false)
    {
        $className = $hasDiscount ? "" : "collapsed";

        echo $className;
    }

    public static function usedProductDetailsBoxClass($condition = 'used')
    {
        $className = $condition == 'used' ? "" : "collapsed";

        echo $className;
    }

    public static function inStock($inStock)
    {
        $stockWord = '';

        switch($inStock) {
            case 'order':
                $stockWord = 'Под заказ';
                break;
            case 'instock':
                $stockWord = 'В наличии';
                break;
            case 'hidden':
                $stockWord = 'Не отображается';
                break;
            default:
                $stockWord = 'Под заказ';
                break;
        }

        echo "<span class=\"stockage\">{$stockWord}</span>";
    }

    public static function isPopular($isPopular)
    {
        if ($isPopular) {
            echo "<span class=\"bestseller\">Это популярный продукт</span>";
        }
    }

    public static function isPublished($isPublished)
    {
        if ($isPublished) {
            echo "Опубликовано";
        } else {
            echo "НЕ опубликовано";
        }
    }

    public static function compressOrderItems($order)
    {
        $result = '';

        foreach($order['items'] as $item) {
            $result .= "<li><b>{$item['item_code']}</b> ({$item['name']})</li>";
        }

        return $result;
    }

    public static function orderStatusOptions()
    {
        return [
            ['key' => 'new', 'value' => 'Новый заказ'],
            ['key' => 'ready', 'value' => 'Отправленный заказ'],
            ['key' => 'delivered', 'value' => 'Доставленный заказ'],
            ['key' => 'cancelled', 'value' => 'Отмененный заказ']
        ];
    }
}
