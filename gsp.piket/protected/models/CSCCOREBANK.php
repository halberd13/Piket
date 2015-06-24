<?php

/**
 * This is the model class for table "CSCCORE_BANK".
 *
 * The followings are the available columns in table 'CSCCORE_BANK':
 * @property string $CSC_B_ID
 * @property string $CSC_B_NAME
 * @property string $CSC_B_ADDRESS
 * @property string $CSC_B_PHONE
 * @property string $CSC_B_PIC_NAME
 * @property string $CSC_B_PIC_PHONE
 * @property string $CSC_B_REGISTERED
 */
class CSCCOREBANK extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_BANK';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_B_ID', 'required'),
			array('CSC_B_ID', 'length', 'max'=>7),
			array('CSC_B_NAME, CSC_B_PIC_NAME, CSC_B_PIC_PHONE', 'length', 'max'=>100),
			array('CSC_B_ADDRESS', 'length', 'max'=>255),
			array('CSC_B_PHONE', 'length', 'max'=>50),
			array('CSC_B_REGISTERED', 'length', 'max'=>19),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_B_ID, CSC_B_NAME, CSC_B_ADDRESS, CSC_B_PHONE, CSC_B_PIC_NAME, CSC_B_PIC_PHONE, CSC_B_REGISTERED', 'safe', 'on'=>'search'),
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
			'CSC_B_ID' => 'Kode Sandi Bank (by Central Bank or other authoritatives)',
			'CSC_B_NAME' => 'Csc B Name',
			'CSC_B_ADDRESS' => 'Csc B Address',
			'CSC_B_PHONE' => 'Csc B Phone',
			'CSC_B_PIC_NAME' => 'Csc B Pic Name',
			'CSC_B_PIC_PHONE' => 'Csc B Pic Phone',
			'CSC_B_REGISTERED' => 'Csc B Registered',
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
		$criteria->compare('CSC_B_NAME',$this->CSC_B_NAME,true);
		$criteria->compare('CSC_B_ADDRESS',$this->CSC_B_ADDRESS,true);
		$criteria->compare('CSC_B_PHONE',$this->CSC_B_PHONE,true);
		$criteria->compare('CSC_B_PIC_NAME',$this->CSC_B_PIC_NAME,true);
		$criteria->compare('CSC_B_PIC_PHONE',$this->CSC_B_PIC_PHONE,true);
		$criteria->compare('CSC_B_REGISTERED',$this->CSC_B_REGISTERED,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCCOREBANK the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
