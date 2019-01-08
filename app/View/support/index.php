
<?php $this->theme->header(); ?>

<div class="container">
    <div class="centered-block margin-bottom-200">
        <div class="heading">
            <h1>Поддержка</h1>
        </div>
        <form id="support-form" action="/support/support-form/" method="post">
            <?php if(Session::has('support-message')): ?>
                <?php $message = Session::flash('support-message'); ?>
                <div class="alert success"><?= $message ?></div>
            <?php endif; ?>
            <div class="form-group">
                <p class="form-text">
                    Если у Вас возникли вопросы касательно продукции бренда MINISO
                    или работы данного сайта, заполните, пожалуйста, форму ниже.<br><br>
                    Мы обязательно постараемся помочь!
                </p>
            </div>
            <?php if($auth['authorized']):?>
                <div class="form-group">
                    <?php Html::label('name', 'Как к Вам можно обращаться?', 'required'); ?>
                    <?php Html::inputText('name', 'name', 'form-control', $auth['user']['name'], 'false', 'false', '', 'Ваше имя...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('email', 'Ваш E-mail:', 'required'); ?>
                    <?php Html::inputText('email', 'email', 'form-control', $auth['user']['email'], 'false', 'false', '', 'Ваш E-mail...'); ?>
                    <p class="form-error-message"></p>
                </div>
            <?php else: ?>
                <div class="form-group">
                    <?php Html::label('name', 'Как к Вам можно обращаться?', 'required'); ?>
                    <?php Html::inputText('name', 'name', 'form-control', '', 'false', 'false', '', 'Ваше имя...'); ?>
                    <p class="form-error-message"></p>
                </div>
                <div class="form-group">
                    <?php Html::label('email', 'Ваш E-mail:', 'required'); ?>
                    <?php Html::inputText('email', 'email', 'form-control', '', 'false', 'false', '', 'Ваш E-mail...'); ?>
                    <p class="form-error-message"></p>
                </div>
            <?php endif; ?>

            <div class="form-group">
                <?php Html::label('message', 'Сообщние:', 'required'); ?>
                <?php Html::textarea('message', 'message', 'form-control', '', '', 'Ваше сообщение'); ?>
                <p class="form-error-message"></p>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-brand btn-md">Отправить</button>
            </div>
        </form>
    </div>
</div>

<?php Asset::js('/app/assets/js/custom/support/support'); ?>

<?php $this->theme->footer(); ?>