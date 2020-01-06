<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use trntv\filekit\behaviors\UploadBehavior;

/**
 * This is the base model class for table "mantra".
 *
 * @property integer $id
 * @property string $cd
 * @property string $entity_name_han 咒名汉文
 * @property string $entity_name_tb 咒名藏文
 * @property string $entity_name_sans 咒名梵文
 * @property string $text_han 咒语汉文
 * @property string $text_tb 咒语藏文
 * @property string $text_sans 咒语梵文
 * @property string $text_mongol 咒语蒙文
 * @property string $text_manchu 咒语满文
 * @property int $sutra_id
 * @property string $context
 * @property string $cbeta_index
 * @property string $voice_base_url 
 * @property string $voice_path 
 * @property string $voice_tb_base_url 
 * @property string $voice_tb_path 
 * @property string $voice_sans_base_url 
 * @property string $voice_sans_path 
 * @property string $voice_mongol_base_url 
 * @property string $voice_mongol_path 
 * @property string $voice_manchu_base_url 
 * @property string $voice_manchu_path 
 * @property string $created_at
 * @property integer $created_by
 * 
 *
 * @property \common\models\User $createdBy
 * @property \common\models\MantraFunc[] $mantraFuncs
 * @property \common\models\Sutra $sutra
 */
class Mantra extends \yii\db\ActiveRecord
{
    // use \mootensai\relation\RelationTrait;

    public $funcs = [];

    /**
     * @var array
     */
    public $voice;

    /**
     * @var array
     */
    public $voice_tb;

    /**
     * @var array
     */
    public $voice_sans;

    /**
     * @var array
     */
    public $voice_mongol;

    /**
     * @var array
     */
    public $voice_manchu;

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'createdBy',
            'mantraFuncs',
            'sutra'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['entity_name_han', 'entity_name_tb', 'entity_name_sans', 'text_sans', 'text_han', 'text_tb', 'context', 'cbeta_index'], 'filter', 'filter'=>'\yii\helpers\HtmlPurifier::process'],

            [['entity_name_han', 'text_han', 'context', 'sutra_id', 'funcs'], 'required'],
            [['text_han', 'text_tb', 'text_sans', 'text_mongol', 'text_manchu', 'context'], 'string'],
            [['created_at', 'funcs', 'voice', 'voice_tb', 'voice_sans', 'voice_mongol', 'voice_manchu'], 'safe'],
            [['created_by'], 'integer'],
            [['cd'], 'string', 'max' => 45],
            [['entity_name_han', 'entity_name_tb', 'entity_name_sans', 'cbeta_index'], 'string', 'max' => 100],
            [['voice_base_url', 'voice_path', 'voice_tb_base_url', 'voice_tb_path', 'voice_sans_base_url', 'voice_sans_path', 
                'voice_mongol_base_url', 'voice_mongol_path', 'voice_manchu_base_url', 'voice_manchu_path'], 'string', 'max' => 255],
            [['cd', 'entity_name_han'], 'unique'],

            [['sutra_id'], 'exist', 'skipOnError' => true, 'targetClass' => Sutra::className(), 'targetAttribute' => ['sutra_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mantra';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'cd' => '咒编号',
            'entity_name_han' => '咒名',
            'entity_name_tb' => '咒名藏文',
            'entity_name_sans' => '咒名梵文',
            'text_han' => '咒语汉文',
            'text_tb' => '咒语藏文',
            'text_sans' => '咒语梵文',
            'text_mongol' => '咒语蒙文',
            'text_manchu' => '咒语满文',
            'context' => '前后文',
            'sutra_id' => '出处',
            'cbeta_index' => 'CBETA',
            'voice_base_url' => 'Voice Base Url',
            'voice_path' => 'Voice Path',
            'voice_tb_base_url' => 'Voice Tb Base Url',
            'voice_tb_path' => 'Voice Tb Path',
            'voice_sans_base_url' => 'Voice Sans Base Url',
            'voice_sans_path' => 'Voice Sans Path',
            'voice_mongol_base_url' => 'Voice Mongol Base Url',
            'voice_mongol_path' => 'Voice Mongol Path',
            'voice_manchu_base_url' => 'Voice Manchu Base Url',
            'voice_manchu_path' => 'Voice Manchu Path',
            'created_at' => Yii::t('common', 'Created At'),
            'created_by' => Yii::t('common', 'Created By'),
            'createdBy' => '创建者',
            'mantraFuncs' => '功能',
            'funcs' => '功能',
            'func_id' => '功能',
            'voice' => '录音(汉文)',
            'voice_tb' => '录音(藏文)',
            'voice_sans' => '录音(梵文)',
            'voice_mongol' => '录音(蒙文)',
            'voice_manchu' => '录音(满文)',
        ];
    }

    public function getFuncs(){
        if(empty($this->funcs)){
            $this->loadFuncs();
        }

        return $this->funcs;
    }

    public function getFuncsText(){
        if(empty($this->funcs)){
            $this->loadFuncs();
        }

        return implode(', ', $this->funcs);
    }

    public function loadFuncs(){
        foreach($this->mantraFuncs as $mf){
            $this->funcs[] = $mf->func->name;
        }
    }

    public function saveFuncs(){
        if(empty($this->funcs)){
            return ;
        }

        foreach($this->mantraFuncs as $mf){
            $mf->delete();
        }

        foreach($this->funcs as $func){
            $func = \yii\helpers\HtmlPurifier::process($func);
            $fmodel = Func::findOne(['name' => $func]);
            if(empty($fmodel)){
                $fmodel = Func::newModel($func);
            }

            MantraFunc::newModel($this, $fmodel); //$this->id be careful
        }
    }

    /**
     * {@inheritDoc}
     * @see \yii\db\BaseActiveRecord::afterSave()
     */
    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $this->saveFuncs();
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSutra()
    {
        return $this->hasOne(\common\models\Sutra::className(), ['id' => 'sutra_id']);
    }
        
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMantraFuncs()
    {
        return $this->hasMany(\common\models\MantraFunc::className(), ['mantra_id' => 'id']);
    }
  
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => false,
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => false,
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'voice',
                'pathAttribute' => 'voice_path',
                'baseUrlAttribute' => 'voice_base_url',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'voice_tb',
                'pathAttribute' => 'voice_tb_path',
                'baseUrlAttribute' => 'voice_tb_base_url',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'voice_sans',
                'pathAttribute' => 'voice_sans_path',
                'baseUrlAttribute' => 'voice_sans_base_url',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'voice_mongol',
                'pathAttribute' => 'voice_mongol_path',
                'baseUrlAttribute' => 'voice_mongol_base_url',
            ],
            [
                'class' => UploadBehavior::class,
                'attribute' => 'voice_manchu',
                'pathAttribute' => 'voice_manchu_path',
                'baseUrlAttribute' => 'voice_manchu_base_url',
            ],
        ];
    }
}
