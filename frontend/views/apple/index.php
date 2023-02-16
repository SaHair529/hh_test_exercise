<?php

use app\models\Apple;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var $apples */

$this->title = 'Apples';

function prepareFallDownForm($id) {
    return Html::beginForm(['apple/falldown']).
        Html::input('hidden', 'id', $id).
        Html::submitButton('Сорвать', ['class' => 'btn btn-outline-primary']).
        Html::endForm();

}

function prepareEatForm($id) {
    return Html::beginForm(['apple/eat']).
    '<input type="text" style="width: 35px" class="mr-1" name="percent" />'.
    Html::input('hidden', 'id', $id).
    Html::submitButton('Откусить', ['class' => 'btn btn-outline-success']).
    Html::endForm();
}

?>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">Цвет</th>
        <th scope="col">Размер</th>
        <th scope="col">Расположение</th>
        <th scope="col">Состояние</th>
        <th scope="col">Действие</th>
        <th scope="col">Действие</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($apples as $apple): ?>
        <tr>
            <th scope="row"><?= $apple->id ?></th>
            <td><?= $apple->color ?></td>
            <td><?= $apple->size ?></td>
            <td><?= $apple->is_on_tree ? 'На дереве' : 'На земле' ?></td>
            <td><?= $apple->is_bad ? 'Испорчено' : 'Свежее' ?></td>
            <td><?= prepareFallDownForm($apple->id)?>
            <td><?= prepareEatForm($apple->id)?>
            <?php

            ?>
            </td>
            <td></td>
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

