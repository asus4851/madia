<?php

namespace backend\models;

use Yii;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
/**
 * This is the model class for table "companies".
 *
 * @property integer $id
 * @property string $name
 * @property string $email
 * @property string $address
 * @property string $created_date
 * @property string $status
 *
 * @property Branches[] $branches
 */
class Companies extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'companies';
    }
public static function fileInput()
{
    echo "<div class='col-md-8' style='height:300px;'>";
    echo FileInput::widget([
        'name' => 'image',
        'language' => 'ru',
        'options' => ['multiple' => true],
        'pluginOptions' => ['previewFileType' => 'any', 'uploadUrl' => Url::to(['/companies/']),]
    ]);
    echo "</div>";
}
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'address', 'created_date', 'status'], 'required'],
            [['created_date'], 'safe'],
            [['status'], 'string'],
            [['name', 'email'], 'string', 'max' => 100],
            [['address'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Company Name',
            'email' => 'Email',
            'address' => 'Address',
            'created_date' => 'Created Date',
            'status' => 'Status',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBranches()
    {
        return $this->hasMany(Branches::className(), ['company_id' => 'id']);
    }
}
