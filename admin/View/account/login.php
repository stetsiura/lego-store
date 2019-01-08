<?php $this->theme->header(); ?>

<div class="container">
	<div class="row">
		<div class="col-sm-6 col-sm-offset-3">
			<div class="page-header">
				<h2>Вход в систему</h2>
			</div>
			<form action="/admin/account/auth/" method="post">
				<div class="form-group">
					<?php AdminHtml::label('email', 'E-mail:'); ?>
					<?php AdminHtml::inputText('email', 'email', 'form-control', '', 'false', 'false', '', 'Ваш e-mail...'); ?>
				</div>
				<div class="form-group">
					<?php AdminHtml::label('password', 'Пароль:'); ?>
					<?php AdminHtml::inputPassword('password', 'password', 'form-control', 'Ваш пароль...'); ?>
				</div>
				<div class="form-group">
					<input type="submit" value="Войти" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

<?php $this->theme->footer(); ?>

