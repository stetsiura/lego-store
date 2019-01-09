<?php Asset::css('/admin/assets/js/summernote/summernote'); ?>

<?php $this->theme->header(); ?>

<div class="cont">
	<div>
		<?php $this->theme->block('partials/breadcrumbs', ['breadcrumbs' => $breadcrumbs]); ?>
	</div>

	<form id="edit-form" action="<?= $url ?>" method="post" enctype="multipart/form-data">
		<?php AdminHtml::inputHidden('category_id', 'category-id', $product['category_id']); ?>
		<?php AdminHtml::inputHidden('product_id', 'product-id', $product['id']); ?>
		<div class="rw">
			<div class="cl cl-3">
				<div class="product-preview">
					<img id="product-image" src="<?php AdminHtml::productOriginalImage($product['big_image_url']); ?>" />
				</div>
				<div class="file-input">
					<button type="button" id="cover-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
					<input type="file" accept="image/*" name="product_image_file" id="product-image-file" />
				</div>
			</div>
			<div class="cl cl-7">
				<div class="border-bottom margin-bottom-10">
					<div class="form-group">
						<?php AdminHtml::label('name', 'Название:'); ?>
						<?php AdminHtml::inputText('name', 'name' , 'form-control', $product['name'], 'true', 'false', 'autofocus', 'Название продукта...'); ?>
                        <p class="form-error-message"></p>
					</div>
				</div>
				<div class="border-bottom margin-bottom-10">
					<div class="form-group">
						<?php AdminHtml::label('original-name', 'Оригинальное название:'); ?>
						<?php AdminHtml::inputText('original_name', 'original-name' , 'form-control', $product['original_name'], 'true', 'false', 'autofocus', 'Оригинальное название продукта...'); ?>
                        <p class="form-error-message"></p>
					</div>
				</div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('item-code', 'Номер:'); ?>
                        <?php AdminHtml::inputText('item_code', 'item-code' , 'form-control', $product['item_code'], 'false', 'false', '', 'Номер...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
                    <textarea id="description" name="description" style="display: none;"><?= $product['description'] ?></textarea>
                    <?php AdminHtml::label('description', 'Описание:'); ?>
                    <div class="summernote" id="description-editor"></div>
                </div>
				<div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('year-released', 'Год выпуска:'); ?>
                        <?php AdminHtml::inputText('year_released', 'year-released' , 'form-control', $product['year_released'], 'false', 'false', '', 'Год выпуска...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('parts-count', 'Количество деталей:'); ?>
                        <?php AdminHtml::inputText('parts_count', 'parts-count' , 'form-control', $product['parts_count'], 'false', 'false', '', 'Количество деталей...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('minifigures-count', 'Количество человечков:'); ?>
                        <?php AdminHtml::inputText('minifigures_count', 'minifigures-count' , 'form-control', $product['minifigures_count'], 'false', 'false', '', 'Количество человечков...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('item-condition', 'Состояние:'); ?>
                        <?php AdminHtml::select('item_condition', 'item-condition', 'key', 'value', 'form-control', [['key' => 'used', 'value' => 'Б/У'], ['key' => 'new', 'value' => 'Новый']], $product['item_condition']); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div id="used-product-details-group" class="<?php AdminHtml::usedProductDetailsBoxClass($product['item_condition']); ?>">
					<div class="margin-bottom-10">
						<div>
							<?php AdminHtml::inputCheckbox('has_all_parts', 'has-all-parts', $product['has_all_parts']); ?>
							<?php AdminHtml::label('has-all-parts', 'Есть все детали'); ?>
						</div>
					</div>
					<div class="margin-bottom-10">
						<div>
							<?php AdminHtml::inputCheckbox('has_instructions', 'has-instructions', $product['has_instructions']); ?>
							<?php AdminHtml::label('has-instructions', 'Есть инструкция'); ?>
						</div>
					</div>
					<div class="border-bottom margin-bottom-10">
						<div>
							<?php AdminHtml::inputCheckbox('has_box', 'has-box', $product['has_box']); ?>
							<?php AdminHtml::label('has-box', 'Есть коробка'); ?>
						</div>
					</div>
				</div>
				<div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('item-state', 'Наличие:'); ?>
                        <?php AdminHtml::select('item_state', 'item-state', 'key', 'value', 'form-control', [['key' => 'order', 'value' => 'Под заказ'], ['key' => 'instock', 'value' => 'В наличии'], ['key' => 'hidden', 'value' => 'Не отображать на сайте']], $product['item_state']); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
					<div>
						<?php AdminHtml::inputCheckbox('is_popular', 'is-popular', $product['is_popular']); ?>
						<?php AdminHtml::label('is-popular', 'Это популярный товар'); ?>
					</div>
				</div>
				<div class="border-bottom margin-bottom-10">
					<div class="form-group">
						<?php AdminHtml::label('price', 'Цена:'); ?>
						<div class="input-group">
							<?php AdminHtml::inputText('price', 'price' , 'form-control', $product['price'], 'false', 'false', '', 'Цена...'); ?>
						    <span class="input-group-addon">грн</span>
						</div>
					</div>
					<div>
						<?php AdminHtml::inputCheckbox('has_discount', 'has-discount', $product['has_discount']); ?>
						<?php AdminHtml::label('has-discount', 'Действует скидка'); ?>
					</div>
					
					<div id="discountPriceGroup" class="form-group <?php AdminHtml::actualPriceBoxClass($product['has_discount']); ?>">
						<?php AdminHtml::label('actual-price', 'Цена со скидкой:'); ?>
						<div class="input-group">
							<?php AdminHtml::inputText('actual_price', 'actual-price' , 'form-control', $product['actual_price'], 'false', 'false', '', 'Цена со скидкой...'); ?>
						    <span class="input-group-addon">грн</span>
						</div>
					</div>
				</div>
                
				<div class="form-group">
					<input type="submit" class="btn btn-primary" value="Сохранить" />
				</div>
			</div>
		</div>
	</form>
</div>

<?php Asset::js('/admin/assets/js/summernote/summernote'); ?>
<?php Asset::js('/admin/assets/js/summernote/lang/summernote-ru-RU'); ?>
<?php Asset::js('/admin/assets/js/validation'); ?>
<?php Asset::js('/admin/assets/js/product/product'); ?>

<?php $this->theme->footer(); ?>