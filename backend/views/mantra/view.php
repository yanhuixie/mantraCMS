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
        		'attribute'=>'voice',
        		'format'=>'raw',
        		'value'=>$model->voice_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_base_url, $model->voice_path) : '',
        	],
            [
        		'attribute'=>'text_tb',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_tb.'</textarea>',
            ],
            [
        		'attribute'=>'voice_tb',
        		'format'=>'raw',
        		'value'=>$model->voice_tb_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_tb_base_url, $model->voice_tb_path) : '',
        	],
            [
        		'attribute'=>'text_sans',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_sans.'</textarea>',
            ],
            [
        		'attribute'=>'voice_sans',
        		'format'=>'raw',
        		'value'=>$model->voice_sans_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_sans_base_url, $model->voice_sans_path) : '',
            ],
            [
        		'attribute'=>'text_mongol',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_mongol.'</textarea>',
            ],
            [
        		'attribute'=>'voice_mongol',
        		'format'=>'raw',
        		'value'=>$model->voice_mongol_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_mongol_base_url, $model->voice_mongol_path) : '',
            ],
            [
        		'attribute'=>'text_manchu',
        		'format'=>'raw',
        		'value'=>'<textarea cols=100 rows=5 readonly=true>'.$model->text_manchu.'</textarea>',
            ],
            [
        		'attribute'=>'voice_manchu',
        		'format'=>'raw',
        		'value'=>$model->voice_manchu_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_manchu_base_url, $model->voice_manchu_path) : '',
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
