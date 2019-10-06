<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mantra */

$this->title = $model->entity_name_han;
$this->params['breadcrumbs'][] = ['label' => '咒', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mantra-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'cd',
            'entity_name_han',
            // 'entity_name_tb',
            // 'text_han:ntext',
            [
        		'attribute'=>'text_han',
        		'format'=>'ntext',
        	],
            // 'text_tb:ntext',
            [
                'attribute' => 'funcs',
                'value' => $model->funcsText
            ],
            [
                'attribute' => 'sutra_id',
                'value' => $model->sutra->entity_name_tc
            ],
            // 'context:ntext',
            [
        		'attribute'=>'context',
        		'format'=>'ntext',
        	],
            'cbeta_index',
            'created_at',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->userProfile->fullname
            ],
        ],
    ]) ?>

</div>
