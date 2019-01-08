<?php $this->theme->header(); ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="page-header">
                <h4><?= $formData['header']; ?></h4>
            </div>

            <?php if(Session::has('edit-user-message')): ?>
                <?php $message = Session::flash('edit-user-message'); ?>
                <div class="alert alert-danger" role="alert"><?= $message ?></div>
            <?php endif; ?>

            <form id="user-form" action="/admin/users/<?= $formData['action'] ?>/" method="post">
                <?php AdminHtml::inputHidden('action', 'action', $formData['action']); ?>
                <?php AdminHtml::inputHidden('currentEmail', 'current-email', $user['email']); ?>
                <?php AdminHtml::inputHidden('id', 'id', $user['id']); ?>
                <div class="form-group">
                    <?php AdminHtml::label('name', 'Имя:'); ?>
                    <?php AdminHtml::inputText('name', 'name', 'form-control', $user['name'], 'false', 'false', 'autofocus', 'Имя пользователя...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php AdminHtml::label('email', 'E-mail:'); ?>
                    <?php AdminHtml::inputText('email', 'email', 'form-control', $user['email'], 'false', 'false', 'autofocus', 'E-mail...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php AdminHtml::label('role', 'Роль:'); ?>
                    <?php AdminHtml::select('role', 'role', 'key', 'value', 'form-control', [['key' => 'user', 'value' => 'Клиент'], ['key' => 'admin', 'value' => 'Администратор']], $user['role']); ?>
                </div>

                <?php if ($formData['action'] == 'add-post'): ?>
                <div class="form-group">
                    <?php AdminHtml::label('password', 'Пароль для пользователя:'); ?>
                    <?php AdminHtml::inputPassword('password', 'password', 'form-control', 'Пароль пользователя...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php AdminHtml::label('password-repeat', 'Введите пароль еще раз'); ?>
                    <?php AdminHtml::inputPassword('password_repeat', 'password-repeat', 'form-control', 'Еще раз пароль...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <?php endif; ?>

                <div class="form-group">
                    <input type="submit" value="Сохранить" class="btn btn-primary" />
                    <button type="button" class="btn btn-default" onclick="window.history.back();">Отмена</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php Asset::js('/admin/assets/js/validation'); ?>
<?php Asset::js('/admin/assets/js/users/edit'); ?>

<?php $this->theme->footer(); ?>
