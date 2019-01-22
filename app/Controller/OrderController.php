<?php

namespace App\Controller;

use \Engine\Core\Mail\Message\OrderConfirmationMessage;

class OrderController extends AppController
{
	public function checkout()
    {
        $this->load->model('Order');
        
        $cart = $this->cart->cart();

        if (count($cart['items']) == 0) {
            \Redirect::to('/cart/');
        }

        if ($this->data['auth']['authorized']) {
            $address = $this->model->order->addressByUserId($this->data['auth']['user']['id']);
        } else {
            $address = null;
        }

        $this->data['email'] = ($this->data['auth']['authorized']) ? $this->data['auth']['user']['email'] : '';
        $this->data['name'] = ($this->data['auth']['authorized']) ? $this->data['auth']['user']['name'] : '';
        $this->data['phone'] = (!is_null($address)) ? $address['phone'] : '';
        $this->data['city'] = (!is_null($address)) ? $address['city'] : '';
        $this->data['post'] = (!is_null($address)) ? $address['post_office'] : '';

		$this->view->setTitle('Оформление заказа');
        $this->view->render('order/checkout', $this->data);
	}

	public function placeOrder()
    {
        $this->load->model('Order');

        $params = $this->request->post;

        $validator = new \Validator($this->di);

        $valid = $validator->validateOrder($params);

        if (!$valid) {
            \Redirect::to('/order/checkout/');
        }

        $userId = ($this->data['auth']['authorized']) ? $this->data['auth']['user']['id'] : null;

        $orderId = $this->model->order->createOrder($params, $userId);

        $cart = $this->cart->cart();

        $message = new OrderConfirmationMessage(
            [
                'client_name' => $params['client_name'],
                'order_number' => $orderId,
                'city' => $params['city'],
                'post_office' => $params['post_office'],
                'total_cost' => $cart['total_price']
            ],
            $params['email']);

        $result = $this->mail->sendMessage($message);

        $this->cart->clear();

        $this->view->setTitle('Заказ оформлен успешно!');
        $this->view->render('order/success', $this->data);
    }
}