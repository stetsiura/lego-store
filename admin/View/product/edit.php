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
                        <?php AdminHtml::label('alias', 'Псевдоним:'); ?>
                        <?php AdminHtml::inputText('alias', 'alias' , 'form-control', $product['alias'], 'false', 'false', '', 'Псевдоним...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('description', 'Описание:'); ?>
                        <?php AdminHtml::textarea('description', 'description', 'form-control half-height', $product['description'], '', 'Описание товара...'); ?>
                    </div>
                </div>
				<div class="border-bottom margin-bottom-10">
					<div>
						<?php AdminHtml::inputCheckbox('in_stock', 'in-stock', $product['in_stock']); ?>
						<?php AdminHtml::label('in-stock', 'Есть в наличии'); ?>
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

                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('sku', 'SKU:'); ?>
                        <?php AdminHtml::inputText('sku', 'sku' , 'form-control', $product['sku'], 'false', 'false', '', 'SKU...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('item_code', 'Код товара:'); ?>
                        <?php AdminHtml::inputText('item_code', 'item_code' , 'form-control', $product['item_code'], 'false', 'false', '', 'Код товара...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('barcode', 'Штрихкод:'); ?>
                        <?php AdminHtml::inputText('barcode', 'barcode' , 'form-control', $product['barcode'], 'false', 'false', '', 'Штрихкод...'); ?>
                        <p class="form-error-message"></p>
                    </div>
                </div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('ingredients', 'Составляющие:'); ?>
                        <?php AdminHtml::textarea('ingredients', 'ingredients', 'form-control half-height', $product['ingredients'], '', 'Составляющие...'); ?>
                    </div>
                </div>
                <div class="border-bottom margin-bottom-10">
                    <div class="form-group">
                        <?php AdminHtml::label('specification', 'Спецификация:'); ?>
                        <?php AdminHtml::textarea('specification', 'specification', 'form-control half-height', $product['specification'], '', 'Спецификация...'); ?>
                    </div>
                </div>

                <div class="border-bottom margin-bottom-10">
                    <textarea id="usage" name="product_usage" style="display: none;"><?= $product['product_usage'] ?></textarea>
                    <?php AdminHtml::label('usage', 'Использование:'); ?>
                    <div class="summernote" id="usage-editor"></div>
                </div>

                <div class="border-bottom margin-bottom-10">
                    <textarea id="warning" name="warning" style="display: none;"><?= $product['warning'] ?></textarea>
                    <?php AdminHtml::label('warning', 'Предупреждение:'); ?>
                    <div class="summernote" id="warning-editor"></div>
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
<?php Asset::js('/admin/assets/js/transliteration'); ?>
<?php Asset::js('/admin/assets/js/validation'); ?>
<?php Asset::js('/admin/assets/js/product/product'); ?>

<?php $this->theme->footer(); ?>