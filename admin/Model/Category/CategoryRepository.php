<?php

namespace Admin\Model\Category;

use \Engine\Model;

class CategoryRepository extends Model
{

	const IMAGE_INPUT_NAME = 'category_image_file';
	const THUMB_INPUT_NAME = 'category_thumb_file';

	/**
	 * @param int $id
	 * @return array
	 */
	public function category($id)
	{
		$category = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();
		
		return $category;
	}
	
	/**
	 * @param array $params
	 */
	public function create($params)
	{
		$imageFileNames = $this->file->processCategoryImageFile(self::IMAGE_INPUT_NAME);

		$thumbFileNames = $this->file->processCategoryThumbFile(self::THUMB_INPUT_NAME);

		$this->db->query(
		    $this->qb
                ->insert('category')
                ->set([
					'name' => $params['name'],
					'original_name' => $params['original_name'],
					'description' => $params['description'],
					'cover_color' => $params['cover_color'],
					'youtube_link' => trim($params['youtube_link']),
                    'alias' => $params['alias'],
					'creation_date' => date('Y-m-d H:i:s'),
					'big_image_url' => $imageFileNames['big_basename'],
					'small_image_url' => $imageFileNames['small_basename'],
					'thumb_image_url' => $thumbFileNames['original_basename'],
                ])
                ->sql(),
            $this->qb->values
        );
	}
	
	/**
	 * @param array $params
	 */
	public function edit($params)
	{
		$category = $this->category($params['id']);
		
		$imageFileNames = $this->file->processCategoryImageFile(self::IMAGE_INPUT_NAME);

		$thumbFileNames = $this->file->processCategoryThumbFile(self::THUMB_INPUT_NAME);

		if (empty($imageFileNames['big_basename'])) {
			$imageFileNames['big_basename'] = $category['big_image_url'];
		} else {
			$this->file->removeCategoryBigImage($category['big_image_url']);
		}

		if (empty($imageFileNames['small_basename'])) {
			$imageFileNames['small_basename'] = $category['small_image_url'];
		} else {
			$this->file->removeCategorySmallImage($category['small_image_url']);
		}

		if (empty($thumbFileNames['original_basename'])) {
			$thumbFileNames['original_basename'] = $category['thumb_image_url'];
		} else {
			$this->file->removeCategoryThumbImage($category['thumb_image_url']);
		}

		$this->db->query(
			$this->qb
				->update('category')
				->set([
					'name' => $params['name'],
					'original_name' => $params['original_name'],
					'description' => $params['description'],
					'cover_color' => $params['cover_color'],
					'youtube_link' => trim($params['youtube_link']),
                    'alias' => $params['alias'],
					'creation_date' => date('Y-m-d H:i:s'),
					'big_image_url' => $imageFileNames['big_basename'],
					'small_image_url' => $imageFileNames['small_basename'],
					'thumb_image_url' => $thumbFileNames['original_basename'],
                ])
				->where('id', $params['id'], '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);
	}

	public function remove($id)
    {
		$this->load->model('Product');

		$this->model->product->moveToUnsorted($id);
		
		$category = $this->category($id);

		if (!is_null($category)) {

			if (!empty($category['big_image_url'])) {
				$this->file->removeCategoryBigImage($category['big_image_url']);
			}

			if (!empty($category['small_image_url'])) {
				$this->file->removeCategorySmallImage($category['small_image_url']);
			}

			if (!empty($category['thumb_image_url'])) {
				$this->file->removeCategoryThumbImage($category['thumb_image_url']);
			}

			$this->db->query(
				$this->qb
					->delete('category')
					->where('id', $id, '=')
					->limit(1)
					->sql(),
				$this->qb->values
			);

		}
    }
	
	/**
	 * @return array
	 */
	public function allCategories()
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('id', 1, '!=')
				->sql(),
			$this->qb->values
		)->all();
		
		return $categories;
	}
	
	/**
	 * @param int $selectedId
	 * @return array
	 */
	public function categoryTree($selectedId = -1)
	{		
		$superRootCategoryWrapper = $this->categoryWrapper(
			[
				'name' => 'Все товары',
				'id' => -1,
				'parent_id' => null
			], 
			$selectedId
		);
		
		$allCategories = $this->allCategories();
		
		foreach($allCategories as $category) {

			$categoryWrapper = $this->categoryWrapper($category, $selectedId);
			
			$superRootCategoryWrapper['children'][] = $categoryWrapper;
		}
		
		usort($superRootCategoryWrapper['children'], [$this, "arrayComparisonByName"]);
		
		$unsortedCategoryWrapper = $this->categoryWrapper($this->category(1), $selectedId);
		
		array_unshift($superRootCategoryWrapper['children'], $unsortedCategoryWrapper);
		
		return $superRootCategoryWrapper;
	}
	
	/**
	 * @param int $categoryId
	 * @return array
	 */
	public function breadCrumbs($categoryId)
	{
		$breadCrumbs = [];
		
		$category = $this->category($categoryId);
		
		if (!is_null($category)) {
			$breadCrumbs[] = $this->breadCrumbItem($category);
		}		
		
		$breadCrumbs[] = $this->breadCrumbItem([
			'name' => 'Все товары',
			'id' => -1
		]);
		
		return array_reverse($breadCrumbs);
	}
	
	/**
	 * @param array $category
	 * @return array
	 */
	private function breadCrumbItem($category) {
		return [
			'name' => $category['name'],
			'url' => $category['id'] != -1 ? 
				'/admin/categories/' . $category['id'] :
				'/admin/categories/'
		];
	}
	
	/**
	 * @param array $category
	 * @param int $selectedId
	 * @return array
	 */
	private function categoryWrapper($category, $selectedId)
	{
		return [
			'id' 		=> $category['id'],
			'name' 		=> $category['name'],
			'selected'  => $category['id'] == $selectedId ? true : false,
			'children'  => []
		];
	}
	
	/**
	 * @param array $a
	 * @param array $b
	 */
	private function arrayComparisonByName($a, $b)
	{
		return strcmp($a['name'], $b['name']);
	}
}