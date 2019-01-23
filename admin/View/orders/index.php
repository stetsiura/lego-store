<?php $this->theme->header(); ?>

<div class="cont">
    <ul class="nav nav-tabs">
        <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'new') ?>"><a href="<?= AdminUrl::orderUrl('new', 1, 'date', 'desc') ?>"><?= AdminHtml::ordersSectionName('new') ?></a></li>
        <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'ready') ?>"><a href="<?= AdminUrl::orderUrl('ready', 1, 'date', 'desc') ?>"><?= AdminHtml::ordersSectionName('ready') ?></a></li>
        <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'delivered') ?>"><a href="<?= AdminUrl::orderUrl('delivered', 1, 'date', 'desc') ?>"><?= AdminHtml::ordersSectionName('delivered') ?></a></li>
        <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'cancelled') ?>"><a href="<?= AdminUrl::orderUrl('cancelled', 1, 'date', 'desc') ?>"><?= AdminHtml::ordersSectionName('cancelled') ?></a></li>
    </ul>
    <div>
        <?php Render::adminPagination($pageParams, $ordersCount, 'orders'); ?>
        <div class="margin-top-10">
            <select id="sort-order" class="form-control">
                <option value="<?= AdminUrl::orderUrl($pageParams['section'], 1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате (по убыванию)</option>
                <option value="<?= AdminUrl::orderUrl($pageParams['section'], 1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате (по возрастанию)</option>
                <option value="<?= AdminUrl::orderUrl($pageParams['section'], 1, 'price', 'desc') ?>" <?= AdminHtml::sortOrderSelected('price', 'desc', $pageParams); ?>>Сортировать по Цене (по убыванию)</option>
                <option value="<?= AdminUrl::orderUrl($pageParams['section'], 1, 'price', 'asc') ?>" <?= AdminHtml::sortOrderSelected('price', 'asc', $pageParams); ?>>Сортировать по Цене (по возрастанию)</option>
            </select>
        </div>
    </div>

    <div class="margin-top-10">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>№</th>
                    <th>Дата</th>
                    <th>Заказ</th>
                    <th>Общая сумма</th>
                    <th>Управление</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($orders as $order): ?>
                <tr>
                    <td><?= $order['id'] ?></td>
                    <td><?= AdminHtml::renderDate($order['order_date']) ?></td>
                    <td>
                        <ol>
                            <?= AdminHtml::compressOrderItems($order) ?>
                        </ol>
                    </td>
                    <td>
                        <?= number_format($order['total_cost'], 2) ?> грн
                    </td>
                    <td>
                        <a class="btn btn-small btn-primary btn-block" title="Перейти к заказу" href="/admin/orders/item/<?= $order['id'] ?>">
                            <span class="glyphicon glyphicon-arrow-right"></span>
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php Asset::js('/admin/assets/js/orders/orders'); ?>

<?php $this->theme->footer(); ?>