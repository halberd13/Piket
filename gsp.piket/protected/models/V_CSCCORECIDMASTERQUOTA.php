<?php

/**
 * This is the model class for table "CSCCORE_CID_MASTER_QUOTA".
 *
 * The followings are the available columns in table 'CSCCORE_CID_MASTER_QUOTA':
 * @property string $CSC_CMQ_ID
 * @property double $CSC_CMQ_BALANCE
 * @property double $CSC_CMQ_MAXQUOTA
 * @property double $CSC_CMQ_MINQUOTA
 * @property string $CSC_CMQ_LASTMOD
 * @property string $CSC_CMQ_LASTUPDATED
 * @property string $CSC_CMQ_SUBID
 * @property string $CSC_CMQ_NAME
 */
class V_CSCCORECIDMASTERQUOTA extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_CID_MASTER_QUOTA';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_CMQ_BALANCE, CSC_CMQ_MAXQUOTA, CSC_CMQ_MINQUOTA', 'numerical'),
			array('CSC_CMQ_ID', 'length', 'max'=>10),
			array('CSC_CMQ_LASTMOD, CSC_CMQ_LASTUPDATED', 'length', 'max'=>20),
			array('CSC_CMQ_SUBID', 'length', 'max'=>12),
			array('CSC_CMQ_NAME', 'length', 'max'=>100),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_CMQ_ID, CSC_CMQ_BALANCE, CSC_CMQ_MAXQUOTA, CSC_CMQ_MINQUOTA, CSC_CMQ_LASTMOD, CSC_CMQ_LASTUPDATED, CSC_CMQ_SUBID, CSC_CMQ_NAME', 'safe', 'on'=>'search'),
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
			'CSC_CMQ_ID' => 'Csc Cmq',
			'CSC_CMQ_BALANCE' => 'Csc Cmq Balance',
			'CSC_CMQ_MAXQUOTA' => 'Csc Cmq Maxquota',
			'CSC_CMQ_MINQUOTA' => 'Csc Cmq Minquota',
			'CSC_CMQ_LASTMOD' => 'Csc Cmq Lastmod',
			'CSC_CMQ_LASTUPDATED' => 'Csc Cmq Lastupdated',
			'CSC_CMQ_SUBID' => 'Csc Cmq Subid',
			'CSC_CMQ_NAME' => 'Csc Cmq Name',
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

		$criteria->compare('CSC_CMQ_ID',$this->CSC_CMQ_ID,true);
		$criteria->compare('CSC_CMQ_BALANCE',$this->CSC_CMQ_BALANCE);
		$criteria->compare('CSC_CMQ_MAXQUOTA',$this->CSC_CMQ_MAXQUOTA);
		$criteria->compare('CSC_CMQ_MINQUOTA',$this->CSC_CMQ_MINQUOTA);
		$criteria->compare('CSC_CMQ_LASTMOD',$this->CSC_CMQ_LASTMOD,true);
		$criteria->compare('CSC_CMQ_LASTUPDATED',$this->CSC_CMQ_LASTUPDATED,true);
		$criteria->compare('CSC_CMQ_SUBID',$this->CSC_CMQ_SUBID,true);
		$criteria->compare('CSC_CMQ_NAME',$this->CSC_CMQ_NAME,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return V_CSCCORECIDMASTERQUOTA the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
