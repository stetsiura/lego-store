<?php

namespace Admin\Model\Product;

use \Engine\Model;

class ProductRepository extends Model
{
	const ADD_NEW_ENTITY = -1;

    const IMAGE_INPUT_NAME = 'product_image_file';

    const ITEMS_PER_PAGE = 15;
	
	/**
	* @param int $id
	* @return array
	*/
	public function product($id)
	{
		$product = $this->db->query(
			$this->qb
				->select()
				->from('product')
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();
		
		return $product;
	}

	public function productsInCategory($categoryId, $pageParams)
	{
        $sort = ($pageParams['sort'] == 'name') ? 'name' : 'creation_date';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

		$products = $this->db->query(
			$this->qb
				->select()
				->from('product')
				->where('category_id', $categoryId, '=')
				->where('is_deleted', false, '=')
                ->orderBy($sort, $order)
                ->limitOffset($offset, self::ITEMS_PER_PAGE)
				->sql(),
			$this->qb->values
		)->all();
		
		return $products;
	}

	public function productsInCategoryCount($categoryId)
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('product')
                ->where('category_id', $categoryId, '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }
	
	public function emptyProduct($categoryId)
	{
		return [
			'id' => -1,
			'name' => '',
			'alias' => '',
            'description' => '',
			'category_id' => $categoryId,
			'sku' => '',
			'item_code' => '',
			'barcode' => '',
			'ingredients' => '',
			'specification' => '',
			'product_usage' => '',
            'warning' => '',
            'price' => '0',
			'actual_price' => '0',
            'has_discount' => false,
			'in_stock' => true,
			'is_popular' => false,
			'big_image_url' => ''
		];
	}
	
	public function addProduct($params)
	{
		$params = $this->prepareCheckboxes($params, ['has_discount', 'in_stock', 'is_popular']);

        if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

            $fileNames = $this->file->processProductFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->insert('product')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias']),
                        'sku' => trim($params['sku']),
                        'description' => $params['description'],
                        'item_code' => trim($params['item_code']),
                        'barcode' => trim($params['barcode']),
                        'ingredients' => $params['ingredients'],
                        'specification' => $params['specification'],
                        'product_usage' => \Sanitize::removeStyles($params['product_usage']),
                        'warning' => \Sanitize::removeStyles($params['warning']),
                        'price' => trim($params['price']),
                        'actual_price' => trim($params['actual_price']),
                        'has_discount' => $params['has_discount'],
                        'is_deleted' => false,
                        'in_stock' => $params['in_stock'],
                        'is_popular' => $params['is_popular'],
                        'small_image_url' => $fileNames['thumbnail_basename'],
                        'big_image_url' => $fileNames['original_basename'],
                        'creation_date' => date('Y-m-d H:i:s'),
                        'category_id' => $params['category_id']
                    ])
                    ->sql(),
                $this->qb->values
            );

        } else {

            $this->db->query(
                $this->qb
                    ->insert('product')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias']),
                        'sku' => trim($params['sku']),
                        'description' => $params['description'],
                        'item_code' => trim($params['item_code']),
                        'barcode' => trim($params['barcode']),
                        'ingredients' => $params['ingredients'],
                        'specification' => $params['specification'],
                        'product_usage' => \Sanitize::removeStyles($params['product_usage']),
                        'warning' => \Sanitize::removeStyles($params['warning']),
                        'price' => trim($params['price']),
                        'actual_price' => trim($params['actual_price']),
                        'has_discount' => $params['has_discount'],
                        'is_deleted' => false,
                        'in_stock' => $params['in_stock'],
                        'is_popular' => $params['is_popular'],
                        'creation_date' => date('Y-m-d H:i:s'),
                        'category_id' => $params['category_id']
                    ])
                    ->sql(),
                $this->qb->values
            );
        }
	}
	
	public function editProduct($params)
	{
        $params = $this->prepareCheckboxes($params, ['has_discount', 'in_stock', 'is_popular']);

        $product = $this->product($params['product_id']);

        if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

            $this->file->removeProductOriginalImage($product['big_image_url']);
            $this->file->removeProductThumbnailImage($product['small_image_url']);

            $fileNames = $this->file->processProductFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->update('product')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias']),
                        'sku' => trim($params['sku']),
                        'description' => $params['description'],
                        'item_code' => trim($params['item_code']),
                        'barcode' => trim($params['barcode']),
                        'ingredients' => $params['ingredients'],
                        'specification' => $params['specification'],
                        'product_usage' => \Sanitize::removeStyles($params['product_usage']),
                        'warning' => \Sanitize::removeStyles($params['warning']),
                        'price' => trim($params['price']),
                        'actual_price' => trim($params['actual_price']),
                        'has_discount' => $params['has_discount'],
                        'is_deleted' => false,
                        'in_stock' => $params['in_stock'],
                        'is_popular' => $params['is_popular'],
                        'small_image_url' => $fileNames['thumbnail_basename'],
                        'big_image_url' => $fileNames['original_basename'],
                        'creation_date' => date('Y-m-d H:i:s'),
                        'category_id' => $params['category_id']
                    ])
                    ->where('id', $product['id'])
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );

        } else {

            $this->db->query(
                $this->qb
                    ->update('product')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias']),
                        'sku' => trim($params['sku']),
                        'description' => $params['description'],
                        'item_code' => trim($params['item_code']),
                        'barcode' => trim($params['barcode']),
                        'ingredients' => $params['ingredients'],
                        'specification' => $params['specification'],
                        'product_usage' => \Sanitize::removeStyles($params['product_usage']),
                        'warning' => \Sanitize::removeStyles($params['warning']),
                        'price' => trim($params['price']),
                        'actual_price' => trim($params['actual_price']),
                        'has_discount' => $params['has_discount'],
                        'is_deleted' => false,
                        'in_stock' => $params['in_stock'],
                        'is_popular' => $params['is_popular'],
                        'creation_date' => date('Y-m-d H:i:s'),
                        'category_id' => $params['category_id']
                    ])
                    ->where('id', $product['id'])
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        }
	}
	
	public function moveProduct($productId, $categoryId)
	{
		$this->db->query(
			$this->qb
				->update('product')
				->set(['category_id' => $categoryId])
				->where('id', $productId, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);
	}
	
	public function deleteProduct($id)
	{
		$this->moveProduct($id, 1);
		
		$this->db->query(
			$this->qb
				->update('product')
				->set(['is_deleted' => true])
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);
	}

	public function moveToUnsorted($categoryId)
    {
        $this->db->query(
            $this->qb
                ->update('product')
                ->set(['category_id' => 1])
                ->where('category_id', $categoryId, '=')
                ->sql(),
            $this->qb->values
        );
    }

    public function search($pageParams)
    {
        $sort = ($pageParams['sort'] == 'name') ? 'name' : 'creation_date';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

        $users = $this->db->query(
            $this->qb
                ->select()
                ->from('product')
                ->where('name', '%' . trim($pageParams['term']) . '%', 'LIKE')
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
                ->orWhere('item_code', trim($term), '=')
                ->orWhere('sku', trim($term), '=')
                ->orWhere('barcode', trim($term), '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }
	
	private function prepareCheckboxes($params, $names = [])
	{
		foreach($names as $name) {
			if (isset($params[$name])) {
				
				$params[$name] = true;				
			} else {
				
				$params[$name] = false;				
			}
		}
		
		return $params;
	}
}