<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Modal;
use yii\web\JsExpression;
use kartik\select2\Select2; // or kartik\select2\Select2
use kartik\grid\GridView;
use johnitvn\ajaxcrud\CrudAsset; 
use johnitvn\ajaxcrud\BulkButtonWidget;
use common\models\Sutra;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\MantraSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '咒';
$this->params['breadcrumbs'][] = $this->title;

CrudAsset::register($this);

$dataProvider->pagination->pageSize = 10;
?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h4 class="panel-title">
            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                检索条件 <small>(点击收起/展开)</small>
            </a>
        </h4>
    </div>
    <div id="collapseOne" class="panel-collapse collapse in">
        <div class="panel-body">

<div class="mantra-search">
    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?php echo $form->field($searchModel, 'sutra_id')->widget(Select2::classname(), [
            'initValueText' => Sutra::getName($searchModel->sutra_id), 
            'options' => ['placeholder' => '输入并查找出处...'],
            'pluginOptions' => [
                'allowClear' => true,
                'minimumInputLength' => 1,
                'ajax' => [
                    'url' => Url::to(['/sutra/autocomplete']),
                    'dataType' => 'json',
                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                ],
                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
            ],
        ]);
    ?>

    <?php echo $form->field($searchModel, 'cd')->textInput(); ?>

    <?php echo $form->field($searchModel, 'entity_name_han')->textInput(); ?>

    <?php echo $form->field($searchModel, 'text_han')->textInput(); ?>

    <?php echo $form->field($searchModel, 'context')->textInput(); ?>

    <?php echo $form->field($searchModel, 'cbeta_index')->textInput(); ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?php echo Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

        </div>
    </div>
</div>
    


<div class="mantra-index">
    <div id="ajaxCrudDatatable">
        <?=GridView::widget([
            'id'=>'crud-datatable',
            'dataProvider' => $dataProvider,
            'filterModel' => null,
            'pjax'=>true,
            'columns' => require(__DIR__.'/_columns.php'),
            'toolbar'=> [
                ['content'=>
                    '{export}'
                ],
            ], 
            'striped' => true,
            'condensed' => true,
            'responsive' => true,          
            'panel' => [
                'type' => 'primary', 
                'heading' => '<i class="glyphicon glyphicon-list"></i> 检索结果 列表',
                'before'=>'<em>* Resize table columns just like a spreadsheet by dragging the column edges.</em>',
                'after'=>'<div class="clearfix"></div>',
            ],
            'containerOptions'=>[
                'style' => 'overflow-x:visible;'
            ]
        ])?>
    </div>
</div>

<?php \common\widgets\JsBlock::begin() ?>
<script>
    $(document).ready(function () {
        // $.fn.modal.Constructor.prototype.enforceFocus = function () {};
    });
</script>
<?php \common\widgets\JsBlock::end() ?>