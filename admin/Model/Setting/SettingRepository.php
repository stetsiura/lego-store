<?php

namespace Admin\Model\Setting;

use \Engine\Model;

class SettingRepository extends Model 
{
	public function getSettings()
	{
		$settings = $this->db->query(
			$this->qb
				->select()
				->from('setting')
				->orderBy('id', 'ASC')
				->sql(),
            $this->qb->values
		)->all();
		
		return $settings;
	}
	
	public function update($params)
	{
		if (!empty($params)) {
			foreach($params as $key => $value) {
				 $this->db->query(
					$this->qb
						->update('setting')
						->set(['value' => $value])
						->where('setting_key', $key, '=')
						->sql(),
					$this->qb->values
				 );
			}
		}
	}
}