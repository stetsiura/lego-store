<?php

namespace App\Model\Product;

use \Engine\Model;

class ProductRepository extends Model
{
	const POPULAR_PRODUCTS_LIMIT = 30;
	
	const NEW_PRODUCTS_LIMIT = 30;
	
	const SUGGESTIONS_PRODUCTS_LIMIT = 30;
	
	const ITEMS_PER_PAGE = 15;
	
	public function popular()
	{
		$popular = $this->db->query(
			$this->qb
				->select()
				->from('product')
				->where('is_popular', true, '=')
				->where('is_deleted', false, '=')
                ->orderBy('creation_date', 'DESC')
				->limit(self::POPULAR_PRODUCTS_LIMIT)
				->sql(),
			$this->qb->values
		)->all();
		
		return $popular;
	}

	public function newProducts()
	{
        $newProducts = $this->db->query(
            $this->qb
                ->select()
                ->from('product')
				->where('is_deleted', false, '=')
                ->orderBy('creation_date', 'desc')
                ->limit(self::POPULAR_PRODUCTS_LIMIT)
                ->sql(),
            $this->qb->values
        )->all();

        return $newProducts;
	}

	public function productsInStack($alias, $pageParams)
	{
		$this->load->model('Category');
		
		$categoryStack = $this->model->category->stack($alias, $pageParams['filters']);
		
		$offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;
		
		$sort = ($pageParams['sort'] == 'name') ? 'name' : 'price';
		$order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

		$inStock = $pageParams['inStock'];

		if ($inStock) {
            $products = $this->db->query(
                $this->qb
                    ->select()
                    ->from('product')
                    ->where('in_stock', true, '=')
                    ->where('is_deleted', false, '=')
                    ->whereIn('category_id', implode(',', $categoryStack))
                    ->orderBy($sort, $order)
                    ->limitOffset($offset, self::ITEMS_PER_PAGE)
                    ->sql(),
                $this->qb->values
            )->all();
        } else {
            $products = $this->db->query(
                $this->qb
                    ->select()
                    ->from('product')
                    ->where('is_deleted', false, '=')
                    ->whereIn('category_id', implode(',', $categoryStack))
                    ->orderBy($sort, $order)
                    ->limitOffset($offset, self::ITEMS_PER_PAGE)
                    ->sql(),
                $this->qb->values
            )->all();
        }
		
		return $products;
	}

    public function productsInStackCount($alias, $pageParams)
    {
        $this->load->model('Category');

        $categoryStack = $this->model->category->stack($alias, $pageParams['filters']);

        $inStock = $pageParams['inStock'];

        if ($inStock) {
            $count = $this->db->query(
                $this->qb
                    ->select("count(id) as 'count'")
                    ->from('product')
                    ->where('in_stock', true, '=')
                    ->where('is_deleted', false, '=')
                    ->whereIn('category_id', implode(',', $categoryStack))
                    ->sql(),
                $this->qb->values
            )->firstOrDefault();
        } else {
            $count = $this->db->query(
                $this->qb
                    ->select("count(id) as 'count'")
                    ->from('product')
                    ->where('is_deleted', false, '=')
                    ->whereIn('category_id', implode(',', $categoryStack))
                    ->sql(),
                $this->qb->values
            )->firstOrDefault();
        }

        return $count['count'];
    }

    public function productByAlias($alias)
    {
        $product = $this->db->query(
            $this->qb
                ->select()
                ->from('product')
                ->where('alias', trim($alias), '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $product;
    }

    public function productsInCategory($categoryId, $productId = -1)
    {
        $products = $this->db->query(
            $this->qb
                ->select()
                ->from('product')
                ->where('category_id', $categoryId, '=')
				->where('is_deleted', false, '=')
                ->where('id', $productId, '!=')
                ->orderBy('name', 'asc')
                ->limit(self::SUGGESTIONS_PRODUCTS_LIMIT)
                ->sql(),
            $this->qb->values
        )->all();

        return $products;
    }

    public function search($pageParams)
    {
        $sort = ($pageParams['sort'] == 'name') ? 'name' : 'price';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

        $users = $this->db->query(
            $this->qb
                ->select()
                ->from('product')
                ->where('name', '%' . trim($pageParams['term']) . '%', 'LIKE')
                ->where('category_id', 1, '!=')
				->where('is_deleted', false, '=')
                ->orWhere('item_code', trim($pageParams['term']), '=')
                ->orWhere('sku', trim($pageParams['term']), '=')
                ->orWhere('barcode', trim($pageParams['term']), '=')
                ->orderBy($sort, $order)
                ->limitOffset($offset, self::ITEMS_PER_PAGE)
                ->sql(),
            $this->qb->values
        )->all();

        return $users;
    }

    public function searchCount($term)
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('user')
                ->from('product')
                ->where('name', '%' . trim($term) . '%', 'LIKE')
                ->where('category_id', 1, '!=')
				->where('is_deleted', false, '=')
                ->orWhere('item_code', trim($term), '=')
                ->orWhere('sku', trim($term), '=')
                ->orWhere('barcode', trim($term), '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }
}