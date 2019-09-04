<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mantra */
?>
<div class="mantra-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'cd',
            'entity_name_han',
            // 'entity_name_tb',
            // 'text_han:ntext',
            [
        		'attribute'=>'text_han',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=6 readonly=true>'.$model->text_han.'</textarea>',
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
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=3 readonly=true>'.$model->context.'</textarea>',
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
