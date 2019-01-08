<?php $this->theme->header(); ?>

    <div class="container">
        <?php if(Session::has('users-message')): ?>
            <?php $message = Session::flash('users-message'); ?>
            <div class="alert alert-success" role="alert"><?= $message ?></div>
        <?php endif; ?>

        <ul class="nav nav-tabs">
            <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'admin') ?>"><a href="<?= AdminUrl::usersUrl('admin', 1, 'name', 'asc') ?>"><?= AdminHtml::usersSectionName('admin') ?></a></li>
            <li role="presentation" class="<?= AdminHtml::activeClass($pageParams['section'], 'user') ?>"><a href="<?= AdminUrl::usersUrl('user', 1, 'date', 'desc') ?>"><?= AdminHtml::usersSectionName('user') ?></a></li>
        </ul>
        <div>
            <div class="margin-top-10">
                <select id="sort-order" class="form-control">
                    <option value="<?= AdminUrl::usersUrl($pageParams['section'], 1, 'name', 'asc') ?>" <?= AdminHtml::sortOrderSelected('name', 'asc', $pageParams); ?>>Сортировать по Имени (по возрастанию)</option>
                    <option value="<?= AdminUrl::usersUrl($pageParams['section'], 1, 'name', 'desc') ?>" <?= AdminHtml::sortOrderSelected('name', 'desc', $pageParams); ?>>Сортировать по Имени (по убыванию)</option>
                    <option value="<?= AdminUrl::usersUrl($pageParams['section'], 1, 'date', 'desc') ?>" <?= AdminHtml::sortOrderSelected('date', 'desc', $pageParams); ?>>Сортировать по Дате регистрации (по убыванию)</option>
                    <option value="<?= AdminUrl::usersUrl($pageParams['section'], 1, 'date', 'asc') ?>" <?= AdminHtml::sortOrderSelected('date', 'asc', $pageParams); ?>>Сортировать по Дате регистрации (по возрастанию)</option>
                </select>
            </div>
        </div>

        <div class="margin-top-10">
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
        </div>
        <div>
            <?php AdminHtml::pagination($pageParams, $usersCount, 'users');?>
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