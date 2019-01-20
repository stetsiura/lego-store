<?php

namespace App\Controller;

class ProductController extends AppController
{
	public function product($number)
	{
		$this->load->model('Product');
        $this->load->model('Category');
        $this->load->model('Wishlist');
		
		$product = $this->model->product->productByNumber($number);

		$this->data['product'] = $product;
		$this->data['suggestions'] = $this->model->product->productsInCategory($product['category_id'], $product['id']);
        $this->data['category'] = $this->model->category->category($product['category_id']);

        $this->data['wishlistItem'] = null;

        $auth = $this->data['auth'];

        if ($auth['authorized']) {
            $this->data['wishlistItem'] = $this->model->wishlist->wishlistItem($auth['user']['id'], $this->data['product']['id']);
        }
		
		$this->view->setTitle($product['name']);
		
		$this->view->render('product/product', $this->data);
	}

	public function addWishlist()
    {
        $this->load->model('Wishlist');

        $params = $this->request->post;

        $auth = $this->data['auth'];

        if ($auth['authorized']) {
            $id = $this->model->wishlist->add($auth['user']['id'], $params['product_id']);

            echo json_encode($id);
        }
    }

    public function removeWishlist()
    {
        $this->load->model('Wishlist');

        $params = $this->request->post;

        $auth = $this->data['auth'];

        if ($auth['authorized']) {
            $id = $this->model->wishlist->remove($params['wishlist_id']);

            echo json_encode($id);
        }
    }

    public function wishlistRedirect()
    {
        \Session::set('login-error', 'Пожалуйста, авторизируйтесь на сайте, чтобы воспользоваться списком желаний');

        \Redirect::to('/account/signin-or-register/');
    }
}