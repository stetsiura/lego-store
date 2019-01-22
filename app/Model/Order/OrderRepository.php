<?php

namespace App\Model\Order;

use \Engine\Model;

class OrderRepository extends Model
{
    /**
     * @var array
     */
    protected $cart;

    public function __construct(\Engine\DI\DI $di)
    {
        parent::__construct($di);
        $this->cart = $this->di->get('cart')->cart();
    }

    public function createOrder($params, $userId = null)
    {
        $totalCost = $this->cart['total_price'];

        $addressId = $this->createOrUpdateAddress($params, $userId);

        $orderId = $this->db->query(
            $this->qb
                ->insert('client_order')
                ->set([
                    'order_date' => date('Y-m-d H:i:s'),
                    'items_cost' => $this->cart['total_price'],
                    'total_cost' =>  $this->cart['total_price'],
                    'shipping_cost' => 0,
                    'order_status' => 'new',
                    'notes' => $params['notes'],
                    'user_id' => $userId,
                    'address_id' => $addressId
                ])
                ->sql(),
            $this->qb->values
        )->lastInsertId();

        foreach($this->cart['items'] as $item) {
            $this->createOrderItem($item, $orderId);
        }

        return $orderId;
    }

    private function createOrderItem($item, $orderId)
    {
        $actualPrice = ($item['product']['has_discount']) ? $item['product']['actual_price'] : $item['product']['price'];

        $this->db->query(
            $this->qb
                ->insert('order_item')
                ->set([
                    'product_id' => $item['product']['id'],
                    'price' => $item['product']['price'],
                    'actual_price' => $actualPrice,
                    'has_discount' => $item['product']['has_discount'],
                    'item_count' => $item['count'],
                    'total_item_cost' => $item['item_price'],
                    'client_order_id' => $orderId
                ])
                ->sql(),
            $this->qb->values
        );
    }

    private function createOrUpdateAddress($params, $userId)
    {

        if (!is_null($userId)) {
            $address = $this->addressByUserId($userId);

            if (!is_null($address)) {
                $this->updateAddress($params, $address['id']);
                return $address['id'];
            }
        }

        $addressId = $this->createAddress($params, $userId);

        return $addressId;
    }

    public function addressByUserId($userId)
    {
        $address = $this->db->query(
            $this->qb
                ->select()
                ->from('address')
                ->where('user_id', $userId, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $address;
    }

    private function updateAddress($params, $id)
    {
        $set = $this->setArray($params, ['client_name', 'email', 'phone', 'city', 'post_office']);

        $this->db->query(
            $this->qb
                ->update('address')
                ->set($set)
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }

    private function createAddress($params, $userId)
    {
        $set = $this->setArray($params, ['client_name', 'email', 'phone', 'city', 'post_office']);
        $set['user_id'] = $userId;

        $addressId = $this->db->query(
            $this->qb
                ->insert('address')
                ->set($set)
                ->sql(),
            $this->qb->values
        )->lastInsertId();

        return $addressId;
    }

    private function setArray($params, $keys = [])
    {
        $set = [];

        foreach($keys as $key) {
            if (isset($params[$key]) && $params[$key] != '') {
                $set[$key] = $params[$key];
            }
        }

        return $set;
    }
}