<?php

/**
 * This is the model class for table "CSCCORE_BANK_DOWNLINE".
 *
 * The followings are the available columns in table 'CSCCORE_BANK_DOWNLINE':
 * @property string $CSC_B_ID
 * @property string $CSC_D_ID
 * @property string $CSC_BI_ID
 */
class CSCCOREBANKDOWNLINE extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_BANK_DOWNLINE';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_B_ID, CSC_D_ID, CSC_BI_ID', 'required'),
			array('CSC_B_ID, CSC_D_ID', 'length', 'max'=>7),
			array('CSC_BI_ID', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_B_ID, CSC_D_ID, CSC_BI_ID', 'safe', 'on'=>'search'),
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
			'CSC_B_ID' => 'Csc B',
			'CSC_D_ID' => 'Csc D',
			'CSC_BI_ID' => 'Csc Bi',
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

		$criteria->compare('CSC_B_ID',$this->CSC_B_ID,true);
		$criteria->compare('CSC_D_ID',$this->CSC_D_ID,true);
		$criteria->compare('CSC_BI_ID',$this->CSC_BI_ID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCCOREBANKDOWNLINE the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
