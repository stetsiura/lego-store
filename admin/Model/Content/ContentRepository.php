<?php

namespace Admin\Model\Content;

use \Engine\Model;

class ContentRepository extends Model
{
	const IMAGE_INPUT_NAME = 'image';

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

	public function slide($id)
	{
		$slide = $this->db->query(
			$this->qb
				->select()
				->from('slide')
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();

		return $slide;
	}

	public function slideByPosition($alias, $position)
	{
		$slide = $this->db->query(
			$this->qb
				->select()
				->from('slide')
				->where('position', $position, '=')
                ->where('alias', trim($alias), '=')
				->limit(1)
				->sql(),
			$this->qb->values
		)->firstOrDefault();

		return $slide;
	}

	public function addSlide($params)
	{
		$position = $this->maxPosition($params['alias']) + 1;

        if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

            $fileNames = $this->file->processSliderFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->insert('slide')
                    ->set([
												'header_text' => trim($params['header_text']),
                        'button_url' => trim($params['button_url']),
												'button_text' => trim($params['button_text']),
												'button_color' => trim($params['button_color']),
												'slide_description' => trim($params['slide_description']),
												'cover_color' => trim($params['cover_color']),
												'alias' => $params['alias'],
                        'position' => $position,
                        'image_url' => $fileNames['basename']
                    ])
                    ->sql(),
                $this->qb->values
            );

        } else {
            $this->db->query(
                $this->qb
                    ->insert('slide')
                    ->set([
												'header_text' => trim($params['header_text']),
                        'button_url' => trim($params['button_url']),
												'button_text' => trim($params['button_text']),
												'button_color' => trim($params['button_color']),
												'slide_description' => trim($params['slide_description']),
												'cover_color' => trim($params['cover_color']),
												'alias' => $params['alias'],
                        'position' => $position
                    ])
                    ->sql(),
                $this->qb->values
            );
        }

		return $position;
	}

	public function updateSlide($params)
	{
		$slide = $this->slide($params['id']);

		if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

		    $this->file->removeSliderImage($slide['image_url']);

            $fileNames = $this->file->processSliderFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->update('slide')
                    ->set([
												'header_text' => trim($params['header_text']),
                        'button_url' => trim($params['button_url']),
												'button_text' => trim($params['button_text']),
												'button_color' => trim($params['button_color']),
												'slide_description' => trim($params['slide_description']),
												'cover_color' => trim($params['cover_color']),
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
                    ->update('slide')
                    ->set([
												'header_text' => trim($params['header_text']),
                        'button_url' => trim($params['button_url']),
												'button_text' => trim($params['button_text']),
												'button_color' => trim($params['button_color']),
												'slide_description' => trim($params['slide_description']),
												'cover_color' => trim($params['cover_color']),
                    ])
                    ->where('id', $params['id'], '=')
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        }

	}

	public function removeSlide($alias, $id)
	{
		$slide = $this->slide($id);

		$this->moveNextSlidesUpper($alias, $slide['position']);

		$this->file->removeSliderImage($slide['image_url']);

		$this->db->query(
			$this->qb
				->delete('slide')
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);
	}

	public function moveNextSlidesUpper($alias, $position)
	{
		$ids = $this->nextSlidesIds($alias, $position);

		foreach($ids as $id) {
			$this->moveSlideUpper($id['id']);
		}
	}

	public function nextSlidesIds($alias, $position)
	{
		$ids = $this->db->query(
			$this->qb
				->select('id')
				->from('slide')
                ->where('alias', trim($alias), '=')
				->where('position', $position, '>')
				->sql(),
			$this->qb->values
		)->all();

		return $ids;
	}

	public function moveSlideUpper($id)
	{
		$slide = $this->slide($id);

		$position = $slide['position'] - 1;

		$this->updateSlidePosition($id, $position);
	}

	public function moveSlideLower($id)
	{
		$slide = $this->slide($id);

		$position = $slide['position'] + 1;

		$this->updateSlidePosition($id, $position);
	}

	public function moveUpSlide($alias, $id)
	{
		$slide = $this->slide($id);

		if ($slide['position'] == 1) {
			return $slide['position'];
		}

		$position = $slide['position'] - 1;

		$upperSlide = $this->slideByPosition($alias, $position);

		$this->moveSlideUpper($id);
		$this->moveSlideLower($upperSlide['id']);

		return $position;
	}

	public function moveDownSlide($alias, $id)
	{
		$slide = $this->slide($id);
		$maxPosition = $this->maxPosition($alias);

		if ($slide['position'] == $maxPosition) {
			return $slide['position'];
		}

		$position = $slide['position'] + 1;

		$lowerSlide = $this->slideByPosition($alias, $position);

		$this->moveSlideLower($id);
		$this->moveSlideUpper($lowerSlide['id']);

		return $position;
	}

	public function maxPosition($alias)
	{
		$position = $this->db->query(
			$this->qb
				->select('MAX(position) AS max')
				->from('slide')
                ->where('alias', trim($alias), '=')
				->sql(),
			$this->qb->values
		)->firstOrDefault()['max'];

		$position = (is_null($position)) ? 0 : $position;

		return $position;
	}

	private function updateSlidePosition($id, $position)
	{
		$this->db->query(
			$this->qb
				->update('slide')
				->set([
					'position' => $position
				])
				->where('id', $id, '=')
				->limit(1)
				->sql(),
			$this->qb->values
		);
	}
}
