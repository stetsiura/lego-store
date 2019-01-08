<?php $this->theme->header(); ?>

<div class="cont">
    <h2>Настройки</h2>

    <?php if (Session::has('settings-message')): ?>
    <div class="alert alert-success">
        <?= Session::flash('settings-message') ?>
    </div>
    <?php endif; ?>

    <form action="/admin/settings/update/" method="post">

        <?php foreach($settings as $setting): ?>
        <div class="form-group">
            <?php AdminHtml::label($setting['setting_key'], $setting['name']); ?>
            <?php AdminHtml::inputText($setting['setting_key'], $setting['setting_key'], 'form-control', $setting['value'], 'false', 'false', ''); ?>
        </div>
        <?php endforeach; ?>

        <div class="form-group">
            <input type="submit" value="Сохранить" class="btn btn-primary" />
        </div>
    </form>
</div>


<?php $this->theme->footer(); ?>