<?php

/**
 * This is the model class for table "PARTNER_PRODUCT_ACCESS_TIME".
 *
 * The followings are the available columns in table 'PARTNER_PRODUCT_ACCESS_TIME':
 * @property string $ID
 * @property string $NAME
 * @property string $PARTNER
 * @property string $GSP_PRODUCT
 * @property integer $ACCESS_DAY
 * @property string $START_TIME
 * @property string $STOP_TIME
 * @property string $CREATOR
 * @property string $LAST_MODIFIED_DATE
 * @property string $DESCRIPTION
 */
class V_PARTNERPRODUCTACCESSTIME extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'PARTNER_PRODUCT_ACCESS_TIME';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('LAST_MODIFIED_DATE', 'required'),
			array('ACCESS_DAY', 'numerical', 'integerOnly'=>true),
			array('ID', 'length', 'max'=>40),
			array('NAME', 'length', 'max'=>60),
			array('PARTNER', 'length', 'max'=>11),
			array('GSP_PRODUCT', 'length', 'max'=>10),
			array('CREATOR', 'length', 'max'=>25),
			array('START_TIME, STOP_TIME, DESCRIPTION', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('ID, NAME, PARTNER, GSP_PRODUCT, ACCESS_DAY, START_TIME, STOP_TIME, CREATOR, LAST_MODIFIED_DATE, DESCRIPTION', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'ID' => 'ID',
			'NAME' => 'Name',
			'PARTNER' => 'Partner',
			'GSP_PRODUCT' => 'Gsp Product',
			'ACCESS_DAY' => 'Access Day',
			'START_TIME' => 'Start Time',
			'STOP_TIME' => 'Stop Time',
			'CREATOR' => 'Creator',
			'LAST_MODIFIED_DATE' => 'Last Modified Date',
			'DESCRIPTION' => 'Description',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('ID',$this->ID,true);
		$criteria->compare('NAME',$this->NAME,true);
		$criteria->compare('PARTNER',$this->PARTNER,true);
		$criteria->compare('GSP_PRODUCT',$this->GSP_PRODUCT,true);
		$criteria->compare('ACCESS_DAY',$this->ACCESS_DAY);
		$criteria->compare('START_TIME',$this->START_TIME,true);
		$criteria->compare('STOP_TIME',$this->STOP_TIME,true);
		$criteria->compare('CREATOR',$this->CREATOR,true);
		$criteria->compare('LAST_MODIFIED_DATE',$this->LAST_MODIFIED_DATE,true);
		$criteria->compare('DESCRIPTION',$this->DESCRIPTION,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return V_PARTNERPRODUCTACCESSTIME the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
