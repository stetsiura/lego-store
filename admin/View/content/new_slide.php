<?php $this->theme->header(); ?>

<div class="cont">
    <?php if(Session::has('slider-message')): ?>
        <?php $message = Session::flash('slider-message'); ?>
        <div class="alert alert-success" role="alert"><?= $message ?></div>
    <?php endif; ?>
	<div class="rw">
		<div class="cl cl-3">
            <div class="list-group">

				<?php foreach($slides as $slideItem): ?>
				<a href="/admin/content/slide/<?= $alias ?>/<?= $slideItem['position'] ?>" class="list-group-item">
					<h4 class="list-group-item-heading">Слайд <?= $slideItem['position'] ?></h4>
					<p class="list-group-item-text">
						<img src="<?= AdminHtml::sliderImage($slideItem['image_url']); ?>">
					</p>
				</a>
				<?php endforeach; ?>

				<a href="/admin/content/slider/<?= $alias ?>/new-slide/" class="list-group-item active">
					<h4 class="list-group-item-heading">Создать новый слайд</h4>
					<p class="list-group-item-text">
						Щелкните здесь, чтобы добавить новый слайд
					</p>
				</a>
			</div>
        </div>
		<div class="cl cl-7">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<h3 class="panel-title">Создание нового слайда</h3>
				</div>
				<div class="panel-body">
					<form action="/admin/content/slider/add-slide/" method="post" enctype="multipart/form-data">
                        <?php AdminHtml::inputHidden('alias', 'alias', $alias) ?>
						<div class="form-group">
                            <div class="form-group">
                                <div class="slider-image">
                                    <img id="slider-image" src="<?= AdminHtml::sliderImage('') ?>">
                                </div>
                            </div>
							<div class="file-input">
								<button type="button" id="cover-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
								<input type="file" accept="image/*" name="image" id="image" />
							</div>
							<p class="help-block">Изображение должно быть <b>1000px</b> по ширине и <b>420px</b> по высоте.</p>
						</div>
            <div class="form-group">
							<?php AdminHtml::label('header-text', 'Заголовок слайда:'); ?>
							<?php AdminHtml::inputText('header_text', 'header-text', 'form-control', '', 'false', 'false', '', 'Заголовок слайда...'); ?>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('button-text', 'Текст в кнопке слайда:'); ?>
							<?php AdminHtml::inputText('button_text', 'button-text', 'form-control', '', 'false', 'false', '', 'Текст в кнопке слайда...'); ?>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('button-url', 'Ссылка в кнопке слайда:'); ?>
							<?php AdminHtml::inputText('button_url', 'button-url', 'form-control', '', 'false', 'false', '', 'Относительная ссылка...'); ?>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('button-color', 'Цвет кнопки слайда (HEX):'); ?>
							<?php AdminHtml::inputText('button_color', 'button-color', 'form-control', '', 'false', 'false', '', 'Цвет кнопки слайда (HEX)...'); ?>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('slide-description', 'Описание слайда:'); ?>
							<?php AdminHtml::textarea('slide_description', 'slide-description', 'form-control half-height', '', '', 'Описание слайда...'); ?>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('cover-color', 'Цвет обложки слайда (HEX):'); ?>
							<?php AdminHtml::inputText('cover_color', 'cover-color', 'form-control', '', 'false', 'false', '', 'Цвет обложки слайда (HEX)...'); ?>
						</div>

						<div class="form-group">
							<input type="submit" class="btn btn-success" value="Сохранить">
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<?php Asset::js('/admin/assets/js/content/slider'); ?>

<?php $this->theme->footer(); ?>
