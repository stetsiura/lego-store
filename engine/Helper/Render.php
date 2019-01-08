<?php

namespace Engine\Helper;

class Render
{
	const ROOT_CAT_COLUMN_COUNT = 3;
	
	const ITEMS_PER_PAGE = 15;

	const ORDERS_PER_PAGE = 15;
	


	/**
	 * @param string $basename
	 */

	
	/**
	 * @param string $basename
	 */
	public static function adminImageThumbnail($basename)
	{
		if (!empty($basename)) {
			echo CLIENT_UPLOADS_THUMBS_PATH . $basename;
		} else {
			echo "/admin/assets/img/no-image-thumb.png";
		}
	}
	
	/**
	 * @param string $basename
	 */
	public static function clientImageOriginal($basename)
	{
		if (!empty($basename)) {
			echo CLIENT_UPLOADS_PATH . $basename;
		} else {
			echo "/app/assets/img/no-image.png";
		}
	}
	
	/**
	 * @param string $basename
	 */
	public static function clientImageThumbnail($basename)
	{
		if (!empty($basename)) {
			echo CLIENT_UPLOADS_THUMBS_PATH . $basename;
		} else {
			echo "/app/assets/img/no-image-thumb.png";
		}
	}
	
	public static function sliderImage($basename)
	{
		echo CLIENT_SLIDER_PATH . $basename;
	}
	

	
	/**
	 * @param bool $hasDiscount
	 */
	public static function actualPriceBoxClass($hasDiscount = false)
	{
		$className = $hasDiscount ? "" : "collapsed";
		
		echo $className;
	}
	
	public static function checked($pattern, $value)
	{
		if ($pattern == $value) {
			echo "checked";
		}
	}
	
	/**
	 * @param bool $isBestseller
	 */

	
	/**
	 * @param bool $inStock
	 */

	
	/**
	 * @param array $categoriesTree
	 */

	
	public static function rootCategories($categories)
	{
		$count = count($categories);
		$largeColumnsCount = (int)floor($count / ceil($count / self::ROOT_CAT_COLUMN_COUNT));
		$smallColumnsCount = self::ROOT_CAT_COLUMN_COUNT - $largeColumnsCount;
		$itemsInLargeColumnCount = (int) floor($count / $largeColumnsCount);
		$itemsinSmallColumnCount = $count - $itemsInLargeColumnCount * $largeColumnsCount;
		
		for ($i = 0; $i < $largeColumnsCount; $i++){
			echo "<ul>\n";
			for ($j = $i * $itemsInLargeColumnCount; $j < ($i+1) * $itemsInLargeColumnCount; $j++) {
				self::renderRootCategory($categories[$j]['name'], $categories[$j]['id']);
			}
			echo "</ul>\n";
		}
		
		for ($i = 0; $i < $smallColumnsCount; $i++) {
			echo "<ul>\n";
			for ($j = $largeColumnsCount * $itemsInLargeColumnCount; $j < $count; $j++) {
				self::renderRootCategory($categories[$j]['name'], $categories[$j]['id']);
			}
			echo "</ul>\n";
		}
	}
	
	public static function categoryUrl($id, $page, $sort, $order = 'asc')
	{
		return "/category/{$id}?page={$page}&sort={$sort}&order={$order}";
	}
	
	public static function searchUrl($term, $page, $sort, $order = 'asc')
	{
		return "/search/result/?term={$term}&page={$page}&sort={$sort}&order={$order}";
	}
	
	public static function navigationUrl($id, $term, $page, $sort, $order, $type = 'category')
	{
		switch($type) {
            case 'category':
                return self::categoryUrl($id, $page, $sort, $order);
            case 'search':
                return self::searchUrl($term, $page, $sort, $order);
            default:
                return self::categoryUrl($id, $page, $sort, $order);
        }
	}
	
	public static function cartUrl()
	{
		return "/cart/";
	}
	
	public static function bookUrl($id) {
		return "/book/{$id}";
	}
	
	public static function bookCasing($count)
	{
		$result = $count . " ";
		
		switch($count % 10) {
			case 0:
			case 5:
			case 6:
			case 7:
			case 8:
			case 8:
				$result .= "книг";
				break;
			case 1: 
				$result .= "книга";
				break;
			case 2: 
			case 3:
			case 4:
				$result .= "книги";
				break;
			default:
				$result .= "книги";
		}
		
		echo $result;
	}

	public static function adminNavigationUrl($section, $page, $sort, $order, $type = 'orders')
    {
        if ($type == 'orders') {
            return self::orderUrl($section, $page, $sort, $order);
        } else {
            return self::orderUrl($section, $page, $sort, $order);
        }
    }

    public static function orderUrl($section, $page, $sort, $order = 'ASC')
    {
        return "/admin/orders/{$section}?page={$page}&sort={$sort}&order={$order}";
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
					self::navigationUrl($pageParams['category_id'], $pageParams['term'], $prevPage, $pageParams['sort'], $pageParams['order'] , $type) . 
					"\"><i class=\"fa fa-chevron-left\"></i></a></li>\n";
			}
			
			for ($i = $currentPage - $pagesBefore; $i < $currentPage; $i++) {
				echo "<li><a href=\"" .
				self::navigationUrl($pageParams['category_id'], $pageParams['term'], $i, $pageParams['sort'], $pageParams['order'] , $type) . 
				"\">" .
				$i . 
				"</a></li>\n";
			}
			
			echo "<li><a class=\"active\">" . $currentPage . "</a></li>";
			
			for ($j = $currentPage + 1; $j <= $currentPage + $pagesAfter + 1; $j++) {
				echo "<li><a href=\"" .
				self::navigationUrl($pageParams['category_id'], $pageParams['term'], $j, $pageParams['sort'], $pageParams['order'] , $type) . 
				"\">" .
				$j . 
				"</a></li>\n";
			}
			
			if ($displayRightArrow) {
				echo "<li><a href=\"" . 
					self::navigationUrl($pageParams['category_id'], $pageParams['term'], $nextPage, $pageParams['sort'], $pageParams['order'] , $type) . 
					"\"><i class=\"fa fa-chevron-right\"></i></a></li>\n";
			}
			
			echo "</ul>\n</div>\n";
		}
	}

    public static function adminPagination($pageParams, $itemsCount, $type = 'orders')
    {
        if ($itemsCount > self::ORDERS_PER_PAGE) {
            $currentPage = $pageParams['page'];
            $totalPagesCount = (int) ceil($itemsCount / self::ORDERS_PER_PAGE);
            $displayLeftArrow = $currentPage > 1;
            $displayRightArrow = ($currentPage != $totalPagesCount);
            $pagesBefore = ($currentPage > 2) ? 2 : $currentPage - 1;
            $pagesAfter = ($totalPagesCount - $currentPage > 2) ? 2 : $totalPagesCount - $currentPage - 1;
            $nextPage = $displayRightArrow ? $currentPage + 1 : $totalPagesCount;
            $prevPage = $displayLeftArrow ? $currentPage - 1 : 1;

            echo "<nav aria-label=\"Page navigation\"><ul class=\"pagination\">\n";

            if ($displayLeftArrow) {
                echo "<li><a href=\"" .
                    self::adminNavigationUrl($pageParams['section'], $prevPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" aria-label=\"Previous\"><span aria-hidden=\"true\">&laquo;</span></a></li>\n";
            }

            for ($i = $currentPage - $pagesBefore; $i < $currentPage; $i++) {
                echo "<li><a href=\"" .
                    self::adminNavigationUrl($pageParams['section'], $i, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\">" .
                    $i .
                    "</a></li>\n";
            }

            echo "<li class=\"active\"><a href='\"#\"'>" . $currentPage . "</a></li>\n";

            for ($j = $currentPage + 1; $j <= $currentPage + $pagesAfter + 1; $j++) {
                echo "<li><a href=\"" .
                    self::adminNavigationUrl($pageParams['section'], $j, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\">" .
                    $j .
                    "</a></li>\n";
            }

            if ($displayRightArrow) {
                echo "<li><a href=\"" .
                    self::adminNavigationUrl($pageParams['section'], $nextPage, $pageParams['sort'], $pageParams['order'] , $type) .
                    "\" aria-label=\"Next\"><span aria-hidden=\"true\">&raquo;</span></a></li>\n";
            }

            echo "</ul>\n</nav>\n";
        }
    }
	




    public static function compressOrderItems($order)
    {
        $result = '';

        foreach($order['items'] as $item) {
            $result .= "<li><b>{$item['title']}</b> ({$item['name']})</li>";
        }

        return $result;
    }

    public static function deliveryName($delivery)
    {
        switch($delivery) {
            case 'self':
                return 'Самовывоз';
            case 'courier':
                return 'Доставка курьером';
            default:
                return '';
        }
    }
	
	private static function renderRootCategory($name, $id)
	{
		echo "<li><a class=\"category-link\" href=\"" . self::categoryUrl($id, 1, 'name') . "\">{$name}</a></li>\n";
	}
	
	/**
	 * @param array $node
	 */

}