<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mantra */
?>
<div class="mantra-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'cd',
            'entity_name_han',
            'entity_name_tb',
            'entity_name_sans',
            [
        		'attribute'=>'text_han',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_han.'</textarea>',
        	],
            [
        		'attribute'=>'text_tb',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_tb.'</textarea>',
            ],
            [
        		'attribute'=>'text_sans',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_sans.'</textarea>',
        	],
            [
                'attribute' => 'funcs',
                'value' => $model->funcsText
            ],
            [
                'attribute' => 'sutra_id',
                'value' => $model->sutra->entity_name_tc
            ],
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
