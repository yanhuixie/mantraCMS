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
            // 'entity_name_sans',
            [
        		'attribute'=>'text_han',
        		'format'=>'ntext',
            ],
            [
        		'attribute'=>'voice',
        		'format'=>'raw',
        		'value'=>$model->voice_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_base_url, $model->voice_path) : '',
        	],
            [
        		'attribute'=>'text_tb',
        		'format'=>'ntext',
            ],
            [
        		'attribute'=>'voice_tb',
        		'format'=>'raw',
        		'value'=>$model->voice_tb_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_tb_base_url, $model->voice_tb_path) : '',
        	],
            [
        		'attribute'=>'text_sans',
        		'format'=>'ntext',
            ],
            [
        		'attribute'=>'voice_sans',
        		'format'=>'raw',
        		'value'=>$model->voice_sans_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_sans_base_url, $model->voice_sans_path) : '',
            ],
            [
        		'attribute'=>'text_mongol',
        		'format'=>'ntext',
            ],
            [
        		'attribute'=>'voice_mongol',
        		'format'=>'raw',
        		'value'=>$model->voice_mongol_path ? sprintf('<audio src="%s%s" controls="controls">浏览器不支持播放</audio>', $model->voice_mongol_base_url, $model->voice_mongol_path) : '',
            ],
            [
        		'attribute'=>'text_manchu',
        		'format'=>'ntext',
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
        		'format'=>'ntext',
        	],
            'cbeta_index',
            'created_at',
            [
                'attribute' => 'created_by',
                'value' => $model->createdBy->userProfile->fullname
            ],
        ],
        'template' => '<tr><th style="width:120px;">{label}</th><td>{value}</td></tr>',
    ]) ?>

</div>
