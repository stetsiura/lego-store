<?php $this->theme->header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php if(Session::has('news-message')): ?>
                <?php $message = Session::flash('news-message'); ?>
                <div class="alert alert-success" role="alert"><?= $message ?></div>
            <?php endif; ?>

            <div class="margin-top-10">
                <select id="sort-order" class="form-control">
                    <option value="<?= AdminUrl::newsUrl(1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате добавления (по убыванию)</option>
                    <option value="<?= AdminUrl::newsUrl(1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате добавления (по возрастанию)</option>
                    <option value="<?= AdminUrl::newsUrl(1, 'name', 'asc') ?>" <?= AdminHtml::sortOrderSelected('name', 'asc', $pageParams); ?>>Сортировать по Названию (по возрастанию)</option>
                    <option value="<?= AdminUrl::newsUrl(1, 'name', 'desc') ?>" <?= AdminHtml::sortOrderSelected('name', 'desc', $pageParams); ?>>Сортировать по Названию (по убыванию)</option>
                </select>
            </div>

            <?php if(count($news) > 0): ?>
                <div class="products-list margin-top-10">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>Картинка</th>
                            <th>Заголовок</th>
                            <th>Дата</th>
                            <th>Опубликовано</th>
                            <th>Действия</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($news as $item): ?>
                            <tr>
                                <td>
                                    <img src="<?php AdminHtml::newsThumbnailImage($item['small_image_url']); ?>" >
                                </td>
                                <td>
                                    <strong><?= $item['title'] ?></strong>
                                </td>
                                <td>
                                    <?= DateTime::createFromFormat('Y-m-d h:i:s', $item['creation_date'])->format('d.m.Y') ?>
                                </td>
                                <td>
                                    <?php AdminHtml::isPublished($item['is_published']) ?>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Опции <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a href="/admin/news/edit/<?= $item['id'] ?>">Редактировать</a></li>
                                            <li role="separator" class="divider"></li>
                                            <li><a href="#" class="removing-news-btn" data-toggle="modal" data-target="#removing-news-modal" data-news-id="<?= $item['id'] ?>">Удалить</a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php else: ?>
                <div class="alert alert-info align-center margin-top-10" role="alert">
                    На сайте <strong>пока что нет новостей</strong>.
                </div>
            <?php endif; ?>

            <div>
                <?php AdminHtml::pagination($pageParams, $newsCount, 'news');?>
            </div>
        </div>
    </div>
</div>

<!-- Modal for removing news -->
<div class="modal fade" id="removing-news-modal" tabindex="-1" role="dialog" aria-labelledby="removing-news-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="/admin/news/delete/">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="removing-news-modal-label">Удаление новости</h4>
                </div>
                <?php AdminHtml::inputHidden('removing_news_id', 'removing-news-id', '-1'); ?>
                <div class="modal-body">
                    Удалить эту новость?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/admin/assets/js/news/index'); ?>

<?php $this->theme->footer(); ?>
