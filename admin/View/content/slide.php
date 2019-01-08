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
				<a href="/admin/content/slide/<?= $alias ?>/<?= $slideItem['position'] ?>" class="list-group-item <?= AdminHtml::activeClass($slideItem['position'], $slide['position']) ?>">
					<h4 class="list-group-item-heading">Слайд <?= $slideItem['position'] ?></h4>
					<p class="list-group-item-text">
						<img src="<?= AdminHtml::sliderImage($slideItem['image_url']); ?>">
					</p>
				</a>
				<?php endforeach; ?>
			  
				<a href="/admin/content/slider/<?= $alias ?>/new-slide/" class="list-group-item">
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
					<h3 class="panel-title">Слайд <?= $slide['position'] ?></h3>
				</div>
				<div class="panel-body">
					<div class="slide-image">
						<img src="<?= AdminHtml::sliderImage($slide['image_url']); ?>">
					</div>
					<form id="slider-image" action="/admin/content/slider/update-slide/" method="post" enctype="multipart/form-data">
                        <?php AdminHtml::inputHidden('alias', 'alias-update', $alias); ?>
                        <?php AdminHtml::inputHidden('id', 'id', $slide['id']); ?>
						<?php AdminHtml::inputHidden('position', 'position', $slide['position']); ?>
						<div class="form-group">
							<div class="file-input">
								<button type="button" id="cover-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
								<input type="file" accept="image/*" name="image" id="image" />
							</div>
                            <p class="help-block">Изображение должно быть <b>1000px</b> по ширине и <b>420px</b> по высоте.</p>
						</div>
						<div class="form-group">
							<?php AdminHtml::label('url', 'Куда должен вести слайд:'); ?>
							<?php AdminHtml::inputText('url', 'url', 'form-control', $slide['url'], 'false', 'false', '', 'Относительная ссылка...'); ?>
						</div>
						<div class="form-group">
							<input type="submit" class="btn btn-success" value="Сохранить">
						</div>
					</form>
				</div>
				<div class="panel-footer">
					<div class="rw">
						<div class="cl cl-4">
							<form action="/admin/content/slider/slide-move-up/" method="post">
								<?php AdminHtml::inputHidden('id', 'move-up-id', $slide['id']); ?>
                                <?php AdminHtml::inputHidden('alias', 'alias-up', $alias); ?>
								<button type="submit" class="btn btn-primary">
									Переместить выше <span class="glyphicon glyphicon-arrow-up"></span>
								</button>
							</form>
						</div>
						<div class="cl cl-4">
							<form action="/admin/content/slider/slide-move-down/" method="post">
								<?php AdminHtml::inputHidden('id', 'move-down-id', $slide['id']); ?>
                                <?php AdminHtml::inputHidden('alias', 'alias-down', $alias); ?>
								<button type="submit" class="btn btn-primary">
									Переместить ниже <span class="glyphicon glyphicon-arrow-down"></span>
								</button>
							</form>
						</div>
						<div class="cl cl-2">
							<form action="/admin/content/slider/remove-slide/" method="post">
								<?php AdminHtml::inputHidden('id', 'remove-id', $slide['id']); ?>
                                <?php AdminHtml::inputHidden('alias', 'alias-remove', $alias); ?>
								<button type="submit" class="btn btn-danger">
									Удалить <span class="glyphicon glyphicon-remove"></span>
								</button>
							</form>
						</div>
					</div>
				</div>
			</div>					
		</div>
	</div>
</div>

<?php Asset::js('/admin/assets/js/content/slider'); ?>

<?php $this->theme->footer(); ?>