<?php

namespace Admin\Model\Order;

use \Engine\Model;

class OrderRepository extends Model
{
    const ORDERS_PER_PAGE = 15;

    public function ordersCount($status = 'new')
    {
        $count = $this->db->query(
            $this->qb
                ->select("count(id) AS 'count'")
                ->from('client_order')
                ->where('order_status', $status, '=')
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        return $count['count'];
    }

    public function orderItems($orderId)
    {
        $items = $this->db->query(
            $this->qb
                ->select("
                    product.name,
                    product.item_code,
                    product.small_image_url,
                    product.price,
                    product.actual_price,
                    product.has_discount,
                    order_item.item_count,
                    order_item.total_item_cost
                ")
                ->from('order_item')
                ->innerJoin('product', 'order_item.product_id', 'product.id')
                ->where('order_item.client_order_id', $orderId, '=')
                ->orderBy('product.name', 'ASC')
                ->sql(),
            $this->qb->values
        )->all();

        return $items;
    }

    public function orders($pageParams)
    {
        $status = (isset($pageParams['section'])) ? $pageParams['section'] : 'new';
        $sort = ($pageParams['sort'] == 'date') ? 'order_date' : 'total_cost';
        $order = ($pageParams['order'] == 'asc') ? 'ASC' : 'DESC';

        $offset = ($pageParams['page'] - 1) * self::ORDERS_PER_PAGE;

        $orders = $this->db->query(
            $this->qb
                ->select()
                ->from('client_order')
                ->where('order_status', $status, '=')
                ->orderBy($sort, $order)
                ->limitOffset($offset, self::ORDERS_PER_PAGE)
                ->sql(),
            $this->qb->values
        )->all();

        foreach($orders as $key => $order) {
            $orders[$key]['items'] = $this->orderItems($order['id']);
        }

        return $orders;
    }

    public function order($id)
    {
        $order = $this->db->query(
            $this->qb
                ->select("
                    client_order.id AS 'id',
                    client_order.order_date AS 'order_date',
                    client_order.items_cost AS 'items_cost',
                    client_order.total_cost AS 'total_cost',
                    client_order.order_status AS 'order_status',
                    client_order.notes AS 'notes',
                    address.post_office AS 'post_office',
                    address.city AS 'city',
                    address.email AS 'email',
                    address.phone AS 'phone',
                    address.client_name AS 'name'
                ")
                ->from('client_order')
                ->innerJoin('address', 'client_order.address_id', 'address.id')
                ->where('client_order.id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        )->firstOrDefault();

        $order['items'] = $this->orderItems($id);

        return $order;
    }

    public function updateOrder($id, $status)
    {
        $this->db->query(
            $this->qb
                ->update('client_order')
                ->set(['order_status' => $status])
                ->where('id', $id, '=')
                ->limit(1)
                ->sql(),
            $this->qb->values
        );
    }
}