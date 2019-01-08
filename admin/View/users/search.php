<?php $this->theme->header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="page-header">
                <h4>Поиск пользователей</h4>
            </div>
            <form action="/admin/users/search-post/" method="post">
                <div class="form-group">
                    <?php AdminHtml::label('term', 'Поиск по имени, фамилии или E-mail:') ?>
                    <div class="input-group">
                        <?php AdminHtml::inputText('term', 'term', 'form-control', $term, 'false', 'false', 'autofocus', 'Имя, фамилия или E-mail...'); ?>
                        <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit">Поиск</button>
                    </span>
                    </div>
                </div>
            </form>

            <?php if (!empty($users)): ?>
                <div>
                    <div class="margin-top-10">
                        <select id="sort-order" class="form-control">
                            <option value="<?= AdminUrl::usersSearchUrl($pageParams['term'], 1, 'name', 'asc') ?>" <?= AdminHtml::sortOrderSelected('name', 'asc', $pageParams); ?>>Сортировать по Имени (по возрастанию)</option>
                            <option value="<?= AdminUrl::usersSearchUrl($pageParams['term'], 1, 'name', 'desc') ?>" <?= AdminHtml::sortOrderSelected('name', 'desc', $pageParams); ?>>Сортировать по Имени (по убыванию)</option>
                            <option value="<?= AdminUrl::usersSearchUrl($pageParams['term'], 1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате регистрации (по убыванию)</option>
                            <option value="<?= AdminUrl::usersSearchUrl($pageParams['term'], 1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате регистрации (по возрастанию)</option>
                        </select>
                    </div>
                </div>
            <?php endif; ?>

            <div class="margin-top-10">
                <?php if ($usersCount > 0): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>№</th>
                        <th>Имя</th>
                        <th>E-mail</th>
                        <th>Роль</th>
                        <th>Дата регистрации</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($users as $user): ?>
                        <tr>
                            <td><?= $user['id'] ?></td>
                            <td>
                                <?= AdminHtml::render($user['name']); ?>
                            </td>
                            <td>
                                <?= AdminHtml::render($user['email']); ?>
                            </td>
                            <td>
                                <?= AdminHtml::roleName($user['role']); ?>
                            </td>
                            <td><?= AdminHtml::renderDate($user['register_date']) ?></td>
                            <td class="align-right">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Опции <span class="caret"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="/admin/users/edit-user/<?= $user['id'] ?>">Редактировать</a></li>
                                        <li><a href="#" class="delete-user" data-id="<?= $user['id'] ?>" data-role="<?= $user['role'] ?>" data-toggle="modal" data-target="#delete-user-modal">Удалить</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php else: ?>
                    <?php if (!$initial): ?>
                        <div class="alert alert-info" role="alert">Поиск не дал результатов</div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
            <div>
                <?php AdminHtml::pagination($pageParams, $usersCount, 'users-search');?>
            </div>
        </div>
    </div>
</div>

<!-- Delete user Modal -->
<div class="modal fade" id="delete-user-modal" tabindex="-1" role="dialog" aria-labelledby="delete-user-modal-label">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form action="/admin/users/delete/" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="delete-user-modal-label">Удалить этого пользователя?</h4>
                </div>
                <div class="modal-body">
                    <p>
                        <strong>Внимание!</strong> Это действие нельзя отменить.
                    </p>

                    <?php AdminHtml::inputHidden('role', 'delete-role', 'user'); ?>
                    <?php AdminHtml::inputHidden('id', 'delete-id', '-1'); ?>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Отмена</button>
                    <button type="submit" class="btn btn-danger">Удалить</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/admin/assets/js/users/users'); ?>

<?php $this->theme->footer(); ?>
