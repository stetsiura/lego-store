<?php

namespace App\Model\Category;

use \Engine\Model;

class CategoryRepository extends Model
{
	const UNSORTED_CATEGORY_ID = 1;
	
	public function allCategories()
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('id', self::UNSORTED_CATEGORY_ID, '!=')
				->orderBy('id', 'ASC')
				->sql(),
			$this->qb->values
		)->all();
		
		return $categories;
	}
	
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

    public function categoryByAlias($alias)
    {
        $category = $this->db->query(
            $this->qb
                ->select()
                ->from('category')
                ->where('alias', trim($alias), '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $category;
    }
	
	public function childCategories($id)
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->where('parent_id', $id, '=')
				->orderBy('name', 'ASC')
				->sql(),
			$this->qb->values
		)->all();
		
		return $categories;
	}

    public function childCategoriesByFilter($id, $filters = [])
    {
        $categories = $this->db->query(
            $this->qb
                ->select()
                ->from('category')
                ->where('parent_id', $id, '=')
                ->whereIn('alias', "'" . implode("','", $filters) . "'")
                ->orderBy('name', 'ASC')
                ->sql(),
            $this->qb->values
        )->all();

        return $categories;
    }
	
	public function stack($alias, $filters)
	{
		$categories = [];

		$category = $this->categoryByAlias($alias);

		$categories[] = $category['id'];

		if (empty($filters)) {
            $childCategories = $this->childCategories($category['id']);
        } else {
            $childCategories = $this->childCategoriesByFilter($category['id'], $filters);
        }
		
		if (!empty($childCategories)) {
			foreach($childCategories as $category) {
				$categories[] = $category['id'];
			}
		}
		
		return $categories;
	}

	public function breadcrumbs($childCategoryId) {

	    $breadcrumbs = [];

	    $currentCategory = $this->category($childCategoryId);

	    $breadcrumbs[] = $currentCategory;

	    if (!is_null($currentCategory['parent_id'])) {
            $parentCategory = $this->category($currentCategory['parent_id']);

            array_unshift($breadcrumbs, $parentCategory);
        }

	    return $breadcrumbs;
    }
	
	public function categoriesInRange($ids)
	{
		$categories = $this->db->query(
			$this->qb
				->select()
				->from('category')
				->whereIn('id', implode(',', $ids))
				->sql(),
			$this->qb->values
		)->all();
		
		return $categories;
	}
	
	public function navigator($categoryId)
	{
		$category = $this->category($categoryId);
		
		$parentCategory = null;
		
		if (!is_null($category['parent_id'])) {
			$parentCategory = $this->category($category['parent_id']);
		}
		
		$childCategories = $this->childCategories($categoryId);
		
		return [
			'current' => $category,
			'parent' => $parentCategory,
			'child' => $childCategories
		];
	}
	
	public function searchNavigator($books)
	{
		$category = [
			'name' => 'Показаны книги из категорий:'
		];
		
		$parentCategory = null;
		
		$childCategories = $this->categoriesInRange($this->categoryIdsFromBooks($books));
		
		return [
			'current' => $category,
			'parent' => $parentCategory,
			'child' => $childCategories
		];
	}
	
	private function categoryIdsFromBooks($books)
	{
		$categoryIds = [];
		
		foreach($books as $book) {
			if (!in_array($book['category_id'], $categoryIds)) {
				$categoryIds[] = $book['category_id'];
			}
		}
		
		return $categoryIds;
	}
}