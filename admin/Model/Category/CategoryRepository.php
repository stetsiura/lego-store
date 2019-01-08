<?php

namespace Admin\Model\Category;

use \Engine\Model;

class CategoryRepository extends Model
{

    const IMAGE_INPUT_NAME = 'category_image_file';

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
	 * @param int $id
	 * @return array
	 */
	public function childCategories($id)
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('parent_id', $id, '=')
				->sql(),
			$this->qb->values
		)->all();
		
		return $categories;
	}

    public function stack($id)
    {
        $categories = [];

        $categories[] = $this->category($id)['id'];

        $childCategories = $this->childCategories($id);

        if (!empty($childCategories)) {
            foreach($childCategories as $category) {
                $categories = array_merge($categories, $this->stack($category['id']));
            }
        }

        return $categories;
    }
	
	/**
	 * @param int $id
	 * @return array
	 */
	public function parentCategory($id)
	{
		$currentCategory = $this->category($id);
		
		$parentCategory = $this->category($currentCategory['parent_id']);
		
		return $parentCategory;
	}
	
	/**
	 * @param array $params
	 */
	public function create($params)
	{
		$this->db->query(
		    $this->qb
                ->insert('category')
                ->set([
                    'name' => $params['create_name'],
                    'alias' => $params['create_alias'],
                    'parent_id' => $params['create_id'],
                    'creation_date' => date('Y-m-d H:i:s')
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

		if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {
		    $this->file->removeCategoryImage($category['image_url']);

		    $fileNames = $this->file->processCategoryFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->update('category')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias']),
                        'image_url' => $fileNames['basename']
                    ])
                    ->where('id', $params['id'], '=')
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        } else {

            $this->db->query(
                $this->qb
                    ->update('category')
                    ->set([
                        'name' => trim($params['name']),
                        'alias' => trim($params['alias'])
                    ])
                    ->where('id', $params['id'], '=')
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        }
	}

	public function remove($id)
    {
        $this->load->model('Product');

        $this->model->product->moveToUnsorted($id);

        $this->db->query(
            $this->qb
                ->delete('category')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }
	
	/**
	 * @param array $params
	 */
	public function moveCategory($params)
	{
		$categoryId = $params['categoryId'];
		$targetId = $params['targetCategoryId'];

        $this->db->query(
            $this->qb
                ->update('category')
                ->set(['parent_id' => $targetId])
                ->where('id', $categoryId, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
	}

    /**
     * @param int $categoryId
     * @param int $targetId
     * @return array
     */
    public function canMoveCategory($categoryId, $targetId)
    {
        if ($categoryId == $targetId) {
            return false;
        }

        if ($targetId == 1 || $targetId == -1) {
            return false;
        }

        $targetCategory = $this->category($targetId);

        if (!is_null($targetCategory['parent_id'])) {
            return false;
        }

        return true;
    }
	
	/**
	 * @return array
	 */
	public function rootCategories()
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('id', 1, '!=')
				->whereIsNull('parent_id')
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
		
		$rootCategories = $this->rootCategories();
		
		foreach($rootCategories as $category) {
			$categoryWrapper = $this->categoryWrapper($category, $selectedId);
			
			$categoryWrapper['children'] = $this->childTreeNodes($category['id'], $selectedId);
			
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
		
			while(!is_null($category['parent_id'])) {
				$category = $this->parentCategory($category['id']);
				
				$breadCrumbs[] = $this->breadCrumbItem($category);
			}
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
	 * @param int $categoryId
	 * @param int $selectedId
	 * @return array
	 */
	private function childTreeNodes($categoryId, $selectedId)
	{
		$childCategories = $this->childCategories($categoryId);

		$childTreeNodes = [];
		
		if (!empty($childCategories)) {
			foreach($childCategories as $category) {
				$childNodeWrapper = $this->categoryWrapper($category, $selectedId);
				
				if (!is_null($this->childCategories($category['id'])))
				{
					$childNodeWrapper['children'] = $this->childTreeNodes($category['id'], $selectedId);
				}

				$childTreeNodes[] = $childNodeWrapper;
			}
		}
		
		usort($childTreeNodes, [$this, "arrayComparisonByName"]);
		
		return $childTreeNodes;
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
			'parent_id' => $category['parent_id'],
			'name' 		=> $category['name'],
			'selected'  => $category['id'] == $selectedId ? true : false,
			'children'  => []
		];
	}
	

	
	/**
	 * @param array $categories
	 * @param int $targetId
	 * @return array
	 */
	private function checkAncestors($categories, $targetId)
	{
		$result = true;
		
		if (!empty($categories)) {
			foreach($categories as $category) {
				if ($category['id'] == $targetId) {
					return false;
				}
				
				$childCategories = $this->childCategories($category['id']);
				
				$result = $result && $this->checkAncestors($childCategories, $targetId);
			}
		}
		
		return $result;
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