<?php

namespace Admin\Model\Wishlist;

use \Engine\Model;

class WishlistRepository extends Model
{
    public function deleteWishListOfUser($userId)
    {
        $this->db->query(
            $this->qb
                ->delete('wishlist')
                ->where('user_id', $userId, '=')
                ->sql(),
            $this->qb->values
        );
    }
}