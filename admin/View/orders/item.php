<?php 
use Engine\Helper\AdminHtml;
$this->theme->header(); ?>

<div class="cont">
    <div class="page-header">
        <h3>Детали заказа № <?= $order['id'] ?></h3>
    </div>

    <div>
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <td>Имя заказчика:</td>
                    <td><?= htmlspecialchars($order['name']) ?></td>
                </tr>
                <tr>
                    <td>Дата и время заказа:</td>
                    <td><?= AdminHtml::renderDate($order['order_date']) ?></td>
                </tr>
                <tr>
                    <td><b>ОБЩАЯ СУММА К ОПЛАТЕ:</b></td>
                    <td><b><?= number_format($order['total_cost'], 2) ?> грн</b></td>
                </tr>
            </tbody>
        </table>
    </div>

    <div>
        <?php if (Session::has('order-update-message')): ?>
            <div class="alert alert-success" role="alert"><?= Session::flash('order-update-message') ?></div>
        <?php endif; ?>
        <form action="/admin/orders/update/" method="post">
            <div class="form-group">
                <?php AdminHtml::select('order_status', 'status', 'key', 'value', 'form-control', AdminHtml::orderStatusOptions(), $order['order_status']); ?>
                <?php AdminHtml::inputHidden('order_id', 'order-id', $order['id']); ?>
            </div>
            <div class="form-group">
                <input type="submit" value="Сохранить" class="btn btn-primary">
            </div>
        </form>
    </div>

    <div>
        <table class="table table-bordered table-striped">
            <tbody>
            <tr>
                <td>Город:</td>
                <td><?= htmlspecialchars($order['city']) ?></td>
            </tr>
            <tr>
                <td>E-mail:</td>
                <td><?= htmlspecialchars($order['email']) ?></td>
            </tr>
            <tr>
                <td>Телефон:</td>
                <td><b><?= htmlspecialchars($order['phone']) ?></b></td>
            </tr>
            <tr>
                <td>Отделение Новой Почты:</td>
                <td><b><?= htmlspecialchars($order['post_office']) ?></b></td>
            </tr>

            </tbody>
        </table>
    </div>

    <div class="page-header">
        <h4>Содержание заказа</h4>
    </div>

    <div>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Изображение</th>
                    <th>Название</th>
                    <th>Кол-во</th>
                    <th>Цена</th>
                    <th>Всего</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($order['items'] as $item): ?>
                <tr>
                    <td>
                        <img src="<?php AdminHtml::productThumbnailImage($item['small_image_url']); ?>">
                    </td>
                    <td>
                        <b><?= $item['item_code'] ?></b><br><br>
                        <?= $item['name'] ?>
                    </td>
                    <td>
                        <?= $item['item_count'] ?>
                    </td>
                    <td>
                        <?= number_format($item['price'], 2) ?> грн
                    </td>
                    <td>
                        <b><?= number_format($item['total_item_cost'], 2) ?> грн</b>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <div class="page-header">
        <h4>Комментарий клиента</h4>
    </div>

    <?php if(!empty($order['notes'])): ?>
        <div class="alert alert-info" role="alert">
        <?= htmlspecialchars($order['notes']) ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Пользователь не оставил комментариев.
        </div>
    <?php endif; ?>
</div>

<?php $this->theme->footer(); ?>
