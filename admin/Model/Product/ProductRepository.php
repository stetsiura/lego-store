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
            'original_name' => '',
            'description' => '',
            'item_code' => '',
            'year_released' => '',
            'parts_count' => '',
            'minifigures_count' => '',
            'item_condition' => 'used',
            'has_all_parts' => true,
            'has_instructions' => true,
            'has_box' => false,
            'item_state' => 'order',
            'has_discount' => false,
            'price' => '0',
            'actual_price' => '0',
            'is_popular' => false,
            'description' => '',
            'category_id' => $categoryId,
			'big_image_url' => ''
		];
	}
	
	public function addProduct($params)
	{
        $params = $this->prepareCheckboxes($params, ['is_popular','has_discount', 'has_all_parts', 'has_instructions', 'has_box']);
        
        $fileNames = $this->file->processProductFile(self::IMAGE_INPUT_NAME);

        $this->db->query(
            $this->qb
                ->insert('product')
                ->set([
                    'name' => trim($params['name']),
                    'original_name' => trim($params['original_name']),
                    'item_code' => trim($params['item_code']),
                    'description' => \Sanitize::removeStyles($params['description']),
                    'year_released' => trim($params['year_released']),
                    'parts_count' => trim($params['parts_count']),
                    'minifigures_count' => trim($params['minifigures_count']),
                    'item_condition' => $params['item_condition'],
                    'has_all_parts' => $params['has_all_parts'],
                    'has_instructions' => $params['has_instructions'],
                    'has_box' => $params['has_box'],
                    'item_state' => $params['item_state'],
                    'has_discount' => $params['has_discount'],
                    'has_discount' => $params['has_discount'],
                    'price' => trim($params['price']),
                    'actual_price' => trim($params['actual_price']),
                    'has_discount' => $params['has_discount'],
                    'is_deleted' => false,
                    'is_popular' => $params['is_popular'],
                    'creation_date' => date('Y-m-d H:i:s'),
                    'small_image_url' => $fileNames['thumbnail_basename'],
                    'big_image_url' => $fileNames['original_basename'],
                    'category_id' => $params['category_id']
                ])
                ->sql(),
            $this->qb->values
        );
	}
	
	public function editProduct($params)
	{
        $params = $this->prepareCheckboxes($params, ['is_popular','has_discount', 'has_all_parts', 'has_instructions', 'has_box']);

        $product = $this->product($params['product_id']);

        $fileNames = $this->file->processProductFile(self::IMAGE_INPUT_NAME);

        if (empty($fileNames['original_basename'])) {
            $fileNames['original_basename'] = $product['big_image_url'];
            $fileNames['thumbnail_basename'] = $product['small_image_url'];
        } else {
            $this->file->removeProductOriginalImage($product['big_image_url']);
            $this->file->removeProductThumbnailImage($product['small_image_url']);
        }

        $this->db->query(
            $this->qb
                ->update('product')
                ->set([
                    'name' => trim($params['name']),
                    'original_name' => trim($params['original_name']),
                    'item_code' => trim($params['item_code']),
                    'description' => \Sanitize::removeStyles($params['description']),
                    'year_released' => trim($params['year_released']),
                    'parts_count' => trim($params['parts_count']),
                    'minifigures_count' => trim($params['minifigures_count']),
                    'item_condition' => $params['item_condition'],
                    'has_all_parts' => $params['has_all_parts'],
                    'has_instructions' => $params['has_instructions'],
                    'has_box' => $params['has_box'],
                    'item_state' => $params['item_state'],
                    'has_discount' => $params['has_discount'],
                    'has_discount' => $params['has_discount'],
                    'price' => trim($params['price']),
                    'actual_price' => trim($params['actual_price']),
                    'has_discount' => $params['has_discount'],
                    'is_popular' => $params['is_popular'],
                    'creation_date' => date('Y-m-d H:i:s'),
                    'small_image_url' => $fileNames['thumbnail_basename'],
                    'big_image_url' => $fileNames['original_basename'],
                    'category_id' => $params['category_id']
                ])
                ->where('id', $product['id'])
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
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
                ->orWhere('original_name', '%' . trim($pageParams['term']) . '%', 'LIKE')
                ->orWhere('item_code', trim($pageParams['term']), '=')
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
                ->from('product')
                ->where('name', '%' . trim($term) . '%', 'LIKE')
                ->orWhere('original_name', '%' . trim($term) . '%', 'LIKE')
                ->orWhere('item_code', trim($term), '=')
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