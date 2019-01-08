<?php

namespace App\Model\Subscriber;

use \Engine\Model;

class SubscriberRepository extends Model
{
    public function getByEmail($email)
    {
        $subscriber = $this->db->query(
            $this->qb
                ->select()
                ->from('subscriber')
                ->where('email', trim($email), '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $subscriber;
    }

    public function add($email)
    {
        $subscriber = $this->getByEmail($email);

        if (is_null($subscriber)) {
            $hash = md5(date('Y-m-d h:i:s') . md5(rand(100000, 999999)));

            $this->db->query(
                $this->qb
                    ->insert('subscriber')
                    ->set([
                        'email' => $email,
                        'hash' => $hash,
                        'is_subscribed' => true,
                        'creation_date' => date('Y-m-d h:i:s')
                    ])
                    ->sql(),
                $this->qb->values
            );
        }
    }
}