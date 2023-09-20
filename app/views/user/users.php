<?php
/** @var array $sidebar - Меню */
/** @var array $users - Список пользователей */

use app\lib\UserOperations;

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
                    <h2>Пользователи</h2>
                    <div class="news-block">
                        <div class="links_box text-end">
                            <a href="/user/add">Добавить</a>
                        </div>
                        <?php if (!empty($users)) : ?>
                            <div class="news-list">
                                <?php foreach ($users as $user) :?>
                                    <div class="news-item">
                                        <h3>
                                            Имя: <?=$user['username']?>
                                                (<a href="/user/edit/?user_id=<?=$user['id']?>">Редактировать</a>
                                                <a href="/user/delete/?user_id=<?=$user['id']?>">Удалить</a>)
                                        </h3>
                                        <div class="user-login">Имя: <?=$user['login']?></div>
                                        <div class="user-is_admin">Являеться администратором: <?=($user['is_admin'] === '1') ? 'Да' : 'Нет'?></div>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </dib>
            </div>
        </div>
    </div>
</div>