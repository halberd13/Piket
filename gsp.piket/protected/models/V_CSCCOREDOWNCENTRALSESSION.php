<?php

/**
 * This is the model class for table "CSCCORE_DOWN_CENTRAL_SESSION".
 *
 * The followings are the available columns in table 'CSCCORE_DOWN_CENTRAL_SESSION':
 * @property string $CSC_DCS_CID
 * @property string $CSC_DCS_TID
 * @property string $CSC_DCS_SESSION
 * @property string $CSC_DCS_LASTSESSION
 * @property string $CSC_DCS_IP
 */
class V_CSCCOREDOWNCENTRALSESSION extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_DOWN_CENTRAL_SESSION';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_DCS_CID', 'required'),
			array('CSC_DCS_CID', 'length', 'max'=>7),
			array('CSC_DCS_TID', 'length', 'max'=>16),
			array('CSC_DCS_SESSION', 'length', 'max'=>50),
			array('CSC_DCS_LASTSESSION', 'length', 'max'=>19),
			array('CSC_DCS_IP', 'length', 'max'=>15),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_DCS_CID, CSC_DCS_TID, CSC_DCS_SESSION, CSC_DCS_LASTSESSION, CSC_DCS_IP', 'safe', 'on'=>'search'),
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
			'CSC_DCS_CID' => 'Csc Dcs Cid',
			'CSC_DCS_TID' => 'Terminal ID / Central Downline ID and only used if CSCCORE_DOWN_CENTRAL.CSC_DC_TYPE=0',
			'CSC_DCS_SESSION' => 'Csc Dcs Session',
			'CSC_DCS_LASTSESSION' => 'datetime = YYYY-MM-DD HH:MM:SS',
			'CSC_DCS_IP' => 'Csc Dcs Ip',
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

		$criteria->compare('CSC_DCS_CID',$this->CSC_DCS_CID,true);
		$criteria->compare('CSC_DCS_TID',$this->CSC_DCS_TID,true);
		$criteria->compare('CSC_DCS_SESSION',$this->CSC_DCS_SESSION,true);
		$criteria->compare('CSC_DCS_LASTSESSION',$this->CSC_DCS_LASTSESSION,true);
		$criteria->compare('CSC_DCS_IP',$this->CSC_DCS_IP,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return V_CSCCOREDOWNCENTRALSESSION the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
