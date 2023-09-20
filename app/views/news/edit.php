<?php
/** @var array $sidebar - Меню */
/** @var array $news - Новость */
?>
<div class="page">
    <div class="container">
        <div class="cabinet_wrapped">
            <div class="cabinet_sidebar">
                <?php if (!empty($sidebar)) : ?>
                    <div class="menu_box">
                        <ul>
                            <?php foreach ($sidebar as $link) : ?>
                                <li>
                                    <a href="<?= $link['link'] ?>"><?= $link['title'] ?></a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="cabinet_content">
                <dib class="page-content-inner">
                    <h2>Редактирование новости</h2>
                    <form method="post" name="news_add_form">
                        <div class="news_add_form">
                            <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                                <?= !empty($error_message) ? $error_message : null ?>
                            </div>
                            <?php if (!empty($news)): ?>
                                <div class="input_box">
                                    <label for="field_title">Наименование</label>
                                    <input type="text"
                                           name="news[title]"
                                           id="field_title"
                                           class="form-control"
                                           maxlength="120"
                                           value="<?= !empty($_POST['news']['title']) ? $_POST['news']['title'] : !empty($news['title']) ? $news['title'] : '' ?>"
                                           placeholder="Введите наименование"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_short_description">Краткое описание</label>
                                    <input type="text"
                                           name="news[short_description]"
                                           id="field_short_description"
                                           class="form-control"
                                           maxlength="120"
                                           value="<?= !empty($_POST['news']['short_description'])
                                               ? $_POST['news']['short_description']
                                               : !empty($news['short_description']) ? $news['short_description'] : ''
                                           ?>"
                                           placeholder="Введите краткое описание"
                                    >
                                </div>

                                <div class="input_box">
                                    <label for="field_description">Описание</label>
                                    <textarea
                                            name="news[description]"
                                            id="field_description"
                                            cols="50"
                                            rows="8"
                                            placeholder="Введиет описание"
                                    ><?= !empty($_POST['news']['description'])
                                            ? $_POST['news']['description']
                                            : !empty($news['description']) ? $news['description'] : ''
                                        ?></textarea>
                                </div>

                                <div class="button_box">
                                    <button type="submit"
                                            name="btn_news_edit_form"
                                            id="btnNewsEditForm"
                                            class="btn btn-primary"
                                            value="1"
                                    >Редактировать
                                    </button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </form>
                </dib>
            </div>
        </div>
    </div>
</div>