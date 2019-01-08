<?php

namespace App\Model\Content;

use \Engine\Model;

class ContentRepository extends Model
{
	public function slides($alias)
	{
		$slides = $this->db->query(
			$this->qb
				->select()
				->from('slide')
                ->where('alias', trim($alias), '=')
				->orderBy('position', 'ASC')
				->sql(),
			$this->qb->values
		)->all();
		
		return $slides;
	}
}