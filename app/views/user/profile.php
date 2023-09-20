<?php
/** @var array $sidebar - Меню */
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
                    <h2>Мой профиль</h2>
                    <div class="profile-block">
                        <div class="alert alert-danger <?= !empty($error_message) ? null : 'hidden' ?>">
                            <?= !empty($error_message) ? $error_message : null ?>
                        </div>
                        <div class="profile-item">
                            <div class="profile-item_title">Смена пароля</div>
                            <div class="profile-item_box">
                                <form method="post" name="change_password">
                                    <div class="input_box">
                                        <label for="field_current_password">Текущий пароль</label>
                                        <input type="password"
                                               name="current_password"
                                               id="field_current_password"
                                               class="form-control"
                                               placeholder="Введите текущий пароль"
                                        >
                                    </div>

                                    <div class="input_box">
                                        <label for="field_new_password">Новый пароль</label>
                                        <input type="password"
                                               name="new_password"
                                               id="field_new_password"
                                               class="form-control"
                                               placeholder="Введите новый пароль"
                                        >
                                    </div>

                                    <div class="input_box">
                                        <label for="field_confirm_new_password">Повторите новый пароль</label>
                                        <input type="password"
                                               name="confirm_new_password"
                                               id="field_confirm_new_password"
                                               class="form-control"
                                               placeholder="Повторите новый пароль"
                                        >
                                    </div>

                                    <div class="button_box">
                                        <button type="submit"
                                                name="btn_change_password_form"
                                                id="btnChangePasswordForm"
                                                class="btn btn-primary"
                                                value="1"
                                        >Сменить пароль
                                        </button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>