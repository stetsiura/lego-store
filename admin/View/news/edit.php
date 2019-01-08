<?php Asset::css('/admin/assets/js/summernote/summernote'); ?>
<?php Asset::css('/admin/assets/css/bootstrap-datetimepicker.min'); ?>

<?php $this->theme->header(); ?>

    <div class="cont">

        <form id="edit-form" action="<?= $url ?>" method="post" enctype="multipart/form-data">
            <?php AdminHtml::inputHidden('id', 'id', $news['id']); ?>
            <div class="rw">
                <div class="cl cl-3">
                    <div class="product-preview">
                        <img id="news-cover" src="<?php AdminHtml::newsOriginalImage($news['big_image_url']); ?>" />
                    </div>
                    <div class="file-input">
                        <button type="button" id="cover-btn" class="btn btn-primary btn-block">Выберите картинку...</button>
                        <input type="file" accept="image/*" name="news_cover_file" id="news-cover-file" />
                    </div>
                </div>
                <div class="cl cl-7">
                    <div class="border-bottom margin-bottom-10">
                        <div class="form-group">
                            <?php AdminHtml::label('title', 'Заголовок:'); ?>
                            <?php AdminHtml::inputText('title', 'title' , 'form-control', $news['title'], 'true', 'false', 'autofocus', 'Заголовок новости...'); ?>
                            <p class="form-error-message"></p>
                        </div>
                    </div>
                    <div class="border-bottom margin-bottom-10">
                        <div class="form-group">
                            <?php AdminHtml::label('alias', 'Псевдоним:'); ?>
                            <?php AdminHtml::inputText('alias', 'alias' , 'form-control', $news['alias'], 'false', 'false', '', 'Псевдоним...'); ?>
                            <p class="form-error-message"></p>
                        </div>
                    </div>

                    <div class="border-bottom margin-bottom-10">
                        <div class="form-group">
                            <?php AdminHtml::label('creation-date', 'Дата публикации:'); ?>
                            <div class='input-group date' id='publish-date-picker'>
                                <input type='text' class="form-control" name="creation_date" id="creation-date" value="<?= $news['creation_date'] ?>" />
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                        </div>
                    </div>

                    <div class="border-bottom margin-bottom-10">
                        <div>
                            <?php AdminHtml::inputCheckbox('is_published', 'is-published', $news['is_published']); ?>
                            <?php AdminHtml::label('is-published', 'Опубликовать на сайте'); ?>
                        </div>
                    </div>

                    <div class="border-bottom margin-bottom-10">
                        <div class="form-group">
                            <?php AdminHtml::label('meta-description', 'Meta description:'); ?>
                            <?php AdminHtml::textarea('meta_description', 'meta-description', 'form-control half-height', $news['meta_description'], '', 'Meta description...'); ?>
                        </div>
                    </div>
                    <div class="border-bottom margin-bottom-10">
                        <div class="form-group">
                            <?php AdminHtml::label('meta-keywords', 'Meta keywords:'); ?>
                            <?php AdminHtml::textarea('meta_keywords', 'meta-keywords', 'form-control half-height', $news['meta_keywords'], '', 'Meta keywords...'); ?>
                        </div>
                    </div>


                    <div class="border-bottom margin-bottom-10">
                        <textarea id="content" name="content" style="display: none;"><?= $news['content'] ?></textarea>
                        <?php AdminHtml::label('content', 'Контент:'); ?>
                        <div class="summernote" id="content-editor"></div>
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
<?php Asset::js('/admin/assets/js/moment/moment.min'); ?>
<?php Asset::js('/admin/assets/js/moment/ru'); ?>
<?php Asset::js('/admin/assets/js/bootstrap-datetimepicker.min'); ?>
<?php Asset::js('/admin/assets/js/transliteration'); ?>
<?php Asset::js('/admin/assets/js/validation'); ?>
<?php Asset::js('/admin/assets/js/news/news'); ?>

<?php $this->theme->footer(); ?>