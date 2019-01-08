<?php

namespace Admin\Model\News;

use \Engine\Model;

class NewsRepository extends Model
{
    const IMAGE_INPUT_NAME = 'news_cover_file';

    const ITEMS_PER_PAGE = 15;

    public function emptyNews()
    {
        return [
            'id' => -1,
            'title' => '',
            'alias' => '',
            'big_image_url' => '',
            'content' => '',
            'meta_description' => '',
            'meta_keywords' => '',
            'is_published' => true,
            'creation_date' => date('d-m-Y')
        ];
    }

    public function news($pageParams)
    {
        $sort = ($pageParams['sort'] == 'name') ? 'title' : 'creation_date';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ITEMS_PER_PAGE;

        $news = $this->db->query(
            $this->qb
                ->select()
                ->from('news')
                ->orderBy($sort, $order)
                ->limitOffset($offset, self::ITEMS_PER_PAGE)
                ->sql(),
            $this->qb->values
        )->all();

        return $news;
    }

    public function singleNews($id)
    {
        $news = $this->db->query(
            $this->qb
                ->select()
                ->from('news')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        $news['creation_date'] =  \DateTime::createFromFormat('Y-m-d h:i:s', $news['creation_date'])->format('d-m-Y');

        return $news;
    }

    public function newsCount()
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('news')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }

    public function add($params)
    {
        $params = $this->prepareCheckboxes($params, ['is_published']);

        $creationDate = (empty($params['creation_date'])) ?
            new \DateTime() :
            \DateTime::createFromFormat('d-m-Y', $params['creation_date']);

        $dateKeyword = $creationDate->format('Y-m');

        if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

            $fileNames = $this->file->processNewsCoverFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->insert('news')
                    ->set([
                        'title' => trim($params['title']),
                        'alias' => trim($params['alias']),
                        'big_image_url' => $fileNames['original_basename'],
                        'small_image_url' => $fileNames['thumbnail_basename'],
                        'content' => \Sanitize::removeStyles($params['content']),
                        'content_preview' => \Sanitize::contentPreview($params['content']),
                        'meta_description' => $params['meta_description'],
                        'meta_keywords' => $params['meta_keywords'],
                        'date_keyword' => $dateKeyword,
                        'creation_date' => $creationDate->format('Y-m-d h:i:s'),
                        'is_published' => $params['is_published']
                    ])
                    ->sql(),
                $this->qb->values
            );
        } else {

            $this->db->query(
                $this->qb
                    ->insert('news')
                    ->set([
                        'title' => trim($params['title']),
                        'alias' => trim($params['alias']),
                        'content' => \Sanitize::removeStyles($params['content']),
                        'content_preview' => \Sanitize::contentPreview($params['content']),
                        'meta_description' => $params['meta_description'],
                        'meta_keywords' => $params['meta_keywords'],
                        'date_keyword' => $dateKeyword,
                        'creation_date' => $creationDate->format('Y-m-d h:i:s'),
                        'is_published' => $params['is_published']
                    ])
                    ->sql(),
                $this->qb->values
            );

        }
    }

    public function edit($params)
    {
        $params = $this->prepareCheckboxes($params, ['is_published']);

        $creationDate = (empty($params['creation_date'])) ?
            new \DateTime() :
            \DateTime::createFromFormat('d-m-Y', $params['creation_date']);

        $dateKeyword = $creationDate->format('Y-m');

        $news = $this->singleNews($params['id']);

        if ($this->file->fileUploaded(self::IMAGE_INPUT_NAME)) {

            $this->file->removeNewsOriginalImage($news['big_image_url']);
            $this->file->removeNewsThumbnailImage($news['small_image_url']);

            $fileNames = $this->file->processNewsCoverFile(self::IMAGE_INPUT_NAME);

            $this->db->query(
                $this->qb
                    ->update('news')
                    ->set([
                        'title' => trim($params['title']),
                        'alias' => trim($params['alias']),
                        'big_image_url' => $fileNames['original_basename'],
                        'small_image_url' => $fileNames['thumbnail_basename'],
                        'content' => \Sanitize::removeStyles($params['content']),
                        'content_preview' => \Sanitize::contentPreview($params['content']),
                        'meta_description' => $params['meta_description'],
                        'meta_keywords' => $params['meta_keywords'],
                        'date_keyword' => $dateKeyword,
                        'creation_date' => $creationDate->format('Y-m-d h:i:s'),
                        'is_published' => $params['is_published']
                    ])
                    ->where('id', $params['id'], '=')
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        } else {

            $this->db->query(
                $this->qb
                    ->update('news')
                    ->set([
                        'title' => trim($params['title']),
                        'alias' => trim($params['alias']),
                        'content' => \Sanitize::removeStyles($params['content']),
                        'content_preview' => \Sanitize::contentPreview($params['content']),
                        'meta_description' => $params['meta_description'],
                        'meta_keywords' => $params['meta_keywords'],
                        'date_keyword' => $dateKeyword,
                        'creation_date' => $creationDate->format('Y-m-d h:i:s'),
                        'is_published' => $params['is_published']
                    ])
                    ->where('id', $params['id'], '=')
                    ->limit(1)
                    ->sql(),
                $this->qb->values
            );
        }
    }

    public function delete($id)
    {
        $news = $this->singleNews($id);

        $this->file->removeNewsOriginalImage($news['big_image_url']);
        $this->file->removeNewsThumbnailImage($news['small_image_url']);

        $this->db->query(
            $this->qb
                ->delete('news')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
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