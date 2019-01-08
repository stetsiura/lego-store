<?php

namespace App\Model\News;

use \Engine\Model;

class NewsRepository extends Model
{
    const RECENT_NEWS_COUNT = 4;
	
	const ALL_NEWS_COUNT = 7;

    public function recent()
    {
        $news = $this->db->query(
            $this->qb
                ->select()
                ->from('news')
                ->where('is_published', true, '=')
                ->orderBy('creation_date', 'DESC')
                ->limit(self::RECENT_NEWS_COUNT)
                ->sql(),
            $this->qb->values
        )->all();

        return $news;
    }

    public function all()
    {
        $news = $this->db->query(
            $this->qb
                ->select()
                ->from('news')
                ->where('is_published', true, '=')
                ->orderBy('creation_date', 'DESC')
				->limit(self::ALL_NEWS_COUNT)
                ->sql(),
            $this->qb->values
        )->all();

        return $news;
    }

    public function article($alias)
    {
        $article = $this->db->query(
            $this->qb
                ->select()
                ->from('news')
                ->where('alias', trim($alias), '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $article;
    }
}