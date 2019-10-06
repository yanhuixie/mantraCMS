<?php
use yii\helpers\Url;
use kartik\grid\GridView;
use yii\web\JsExpression;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cd',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'entity_name_han',
    ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'entity_name_tb',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'funcs',
        'value' => function($model){
            return $model->funcsText;
        }
    ],
    [
		'class'=>'\kartik\grid\DataColumn',
		'attribute'=>'sutra_id',
		'filterType' => GridView::FILTER_SELECT2,
	    'filterInputOptions' => ['placeholder' => '经名'],
		'filterWidgetOptions' => [
			'model' => $searchModel,
			'attribute' => 'school_id',
			'initValueText' => $searchModel->sutra ? $searchModel->sutra->entity_name_tc : '',
			'pluginOptions'=>[
				'allowClear' => true,
				'ajax' => [
					'url' => Url::to(['/sutra/autocomplete']),
					'dataType' => 'json',
					'data' => new JsExpression('function(params) { return {q:params.term}; }')
				],
				'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
				'templateResult' => new JsExpression('function(city) { return city.text; }'),
				'templateSelection' => new JsExpression('function (city) { return city.text; }'),
			]
		],
		'value'=>function ($model){
			return $model->sutra->entity_name_tc;
		}
	],

    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'cbeta_index',
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'template'=> '{view}',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key, ]);
        },
        'viewOptions'=>['target'=>'_blank'],
    ],

];   