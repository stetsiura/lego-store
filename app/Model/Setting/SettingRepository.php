<?php

namespace App\Model\Setting;

use \Engine\Model;

class SettingRepository extends Model
{
	public function setting($key)
	{
		$setting = $this->db->query(
			$this->qb
				->select()
				->from('setting')
				->where('setting_key', $key, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();
		
		return $setting['value'];
	}
}