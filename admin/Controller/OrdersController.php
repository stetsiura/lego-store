<?php

namespace Admin\Controller;

class OrdersController extends AdminController
{
    protected $authorizedActions = [
        'index' => ['admin'],
		'item' => ['admin'],
		'update' => ['admin']
    ];

    public function index($section)
    {
        $this->load->model('Order');

        $this->data['pageParams'] = \AdminUrl::pageParams($this->request->get, $section);
        $this->data['ordersCount'] = $this->model->order->ordersCount($section);
        $this->data['orders'] = $this->model->order->orders($this->data['pageParams']);

        $this->view->setTitle(\AdminHtml::ordersSectionName($this->data['pageParams']['section']));
        $this->view->render('orders/index', $this->data);
    }

    public function item($id)
    {
        $this->load->model('Order');

        $this->data['order'] = $this->model->order->order($id);

        $this->view->setTitle('Просмотр заказа');
        $this->view->render('orders/item', $this->data);
    }

    public function update()
    {
        $this->load->model('Order');

        $params = $this->request->post;

        $this->model->order->updateOrder($params['order_id'], $params['order_status']);

        \Session::set('order-update-message', 'Изменения сохранены');

        \Redirect::to('/admin/orders/item/' . $params['order_id']);
    }
}