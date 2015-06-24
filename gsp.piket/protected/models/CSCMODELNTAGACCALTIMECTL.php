<?php

/**
 * This is the model class for table "CSCMOD_EL_NTAG_ACC_ALTIME_CTL".
 *
 * The followings are the available columns in table 'CSCMOD_EL_NTAG_ACC_ALTIME_CTL':
 * @property string $CSM_ATC_ID
 * @property string $CSM_ATC_NAME
 * @property string $CSM_ATC_CID
 * @property string $CSM_ATC_DESC
 * @property integer $CSM_ATC_ALLOW_WDAY
 * @property string $CSM_ATC_ALLOW_TIME_START
 * @property string $CSM_ATC_ALLOW_TIME_END
 * @property string $CSM_ATC_CREATED
 * @property string $CSM_ATC_CREATORUID
 * @property string $CSM_ATC_CREATORUNAME
 * @property string $CSM_ATC_LASTMOD
 * @property string $CSM_ATC_LASTMODERUID
 * @property string $CSM_ATC_LASTMODERUNAME
 */
class CSCMODELNTAGACCALTIMECTL extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCMOD_EL_NTAG_ACC_ALTIME_CTL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSM_ATC_ID, CSM_ATC_NAME', 'required'),
			array('CSM_ATC_ALLOW_WDAY', 'numerical', 'integerOnly'=>true),
			array('CSM_ATC_ID, CSM_ATC_CID, CSM_ATC_CREATORUID, CSM_ATC_CREATORUNAME, CSM_ATC_LASTMODERUID, CSM_ATC_LASTMODERUNAME', 'length', 'max'=>50),
			array('CSM_ATC_NAME', 'length', 'max'=>100),
			array('CSM_ATC_DESC', 'length', 'max'=>255),
			array('CSM_ATC_ALLOW_TIME_START, CSM_ATC_ALLOW_TIME_END', 'length', 'max'=>8),
			array('CSM_ATC_CREATED, CSM_ATC_LASTMOD', 'length', 'max'=>19),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSM_ATC_ID, CSM_ATC_NAME, CSM_ATC_CID, CSM_ATC_DESC, CSM_ATC_ALLOW_WDAY, CSM_ATC_ALLOW_TIME_START, CSM_ATC_ALLOW_TIME_END, CSM_ATC_CREATED, CSM_ATC_CREATORUID, CSM_ATC_CREATORUNAME, CSM_ATC_LASTMOD, CSM_ATC_LASTMODERUID, CSM_ATC_LASTMODERUNAME', 'safe', 'on'=>'search'),
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
			'CSM_ATC_ID' => 'Csm Atc',
			'CSM_ATC_NAME' => 'Csm Atc Name',
			'CSM_ATC_CID' => 'Csm Atc Cid',
			'CSM_ATC_DESC' => 'Csm Atc Desc',
			'CSM_ATC_ALLOW_WDAY' => 'Csm Atc Allow Wday',
			'CSM_ATC_ALLOW_TIME_START' => 'Csm Atc Allow Time Start',
			'CSM_ATC_ALLOW_TIME_END' => 'Csm Atc Allow Time End',
			'CSM_ATC_CREATED' => 'Csm Atc Created',
			'CSM_ATC_CREATORUID' => 'Csm Atc Creatoruid',
			'CSM_ATC_CREATORUNAME' => 'Csm Atc Creatoruname',
			'CSM_ATC_LASTMOD' => 'Csm Atc Lastmod',
			'CSM_ATC_LASTMODERUID' => 'Csm Atc Lastmoderuid',
			'CSM_ATC_LASTMODERUNAME' => 'Csm Atc Lastmoderuname',
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

		$criteria->compare('CSM_ATC_ID',$this->CSM_ATC_ID,true);
		$criteria->compare('CSM_ATC_NAME',$this->CSM_ATC_NAME,true);
		$criteria->compare('CSM_ATC_CID',$this->CSM_ATC_CID,true);
		$criteria->compare('CSM_ATC_DESC',$this->CSM_ATC_DESC,true);
		$criteria->compare('CSM_ATC_ALLOW_WDAY',$this->CSM_ATC_ALLOW_WDAY);
		$criteria->compare('CSM_ATC_ALLOW_TIME_START',$this->CSM_ATC_ALLOW_TIME_START,true);
		$criteria->compare('CSM_ATC_ALLOW_TIME_END',$this->CSM_ATC_ALLOW_TIME_END,true);
		$criteria->compare('CSM_ATC_CREATED',$this->CSM_ATC_CREATED,true);
		$criteria->compare('CSM_ATC_CREATORUID',$this->CSM_ATC_CREATORUID,true);
		$criteria->compare('CSM_ATC_CREATORUNAME',$this->CSM_ATC_CREATORUNAME,true);
		$criteria->compare('CSM_ATC_LASTMOD',$this->CSM_ATC_LASTMOD,true);
		$criteria->compare('CSM_ATC_LASTMODERUID',$this->CSM_ATC_LASTMODERUID,true);
		$criteria->compare('CSM_ATC_LASTMODERUNAME',$this->CSM_ATC_LASTMODERUNAME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCMODELNTAGACCALTIMECTL the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
