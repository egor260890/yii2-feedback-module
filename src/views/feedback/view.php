<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model core\entities\site\Feedback */
$this->title=$model->id;
$this->params['breadcrumbs'][] = ['label' => 'Обратная связь', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="feedback-view">

    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно хотите удалить эту запись?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'tel',
            'email',
            'message',
            [
                'attribute'=>'created_date',
                'value'=>function($model){
                    return Yii::$app->formatter->asDatetime($model->created_date,'dd.MM.yyyy HH:mm:ss');
                },
            ]
        ],
    ]) ?>

</div>
