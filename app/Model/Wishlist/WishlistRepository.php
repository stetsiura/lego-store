<?php

namespace App\Model\Wishlist;

use \Engine\Model;

class WishlistRepository extends Model
{
    public function wishlistItem($userId, $productId)
    {
        $item = $this->db->query(
            $this->qb
                ->select()
                ->from('wishlist')
                ->where('user_id', $userId, '=')
                ->where('product_id', $productId, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $item;
    }

    public function wishlistItemById($id)
    {
        $item = $this->db->query(
            $this->qb
                ->select()
                ->from('wishlist')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $item;
    }

    public function add($userId, $productId)
    {
        $id = $this->db->query(
            $this->qb
                ->insert('wishlist')
                ->set([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'creation_date' => date('Y-m-d h:i:s')
                ])
                ->sql(),
            $this->qb->values
        )->lastInsertId();

        return $id;
    }

    public function remove($id)
    {
        $item = $this->wishlistItemById($id);

        $productId = $item['product_id'];

        $this->db->query(
            $this->qb
                ->delete('wishlist')
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );

        return $productId;
    }

    public function all($userId)
    {
        $products = $this->db->query(
            $this->qb
                ->select("
					product.id AS 'id',
					product.name AS 'name',
					product.price AS 'price',
					product.actual_price AS 'actual_price',
					product.has_discount AS 'has_discount',
					product.small_image_url AS 'small_image_url',
                    product.item_code AS 'item_code',
                    product.parts_count AS 'parts_count',
                    product.minifigures_count AS 'minifigures_count',
                    product.item_state AS 'item_state'
				")
                ->from('product')
                ->innerJoin('wishlist', 'product.id', 'wishlist.product_id')
                ->where('wishlist.user_id', $userId, '=')
                ->where('product.is_deleted', false, '=')
                ->where('product.item_state', 'hidden', '!=')
                ->orderBy('wishlist.creation_date', 'desc')
                ->sql(),
            $this->qb->values
        )->all();

        return $products;
    }
}