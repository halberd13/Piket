<?php

/**
 * This is the model class for table "CSCMOD_WAU_CENTRAL_ADM_FEE".
 *
 * The followings are the available columns in table 'CSCMOD_WAU_CENTRAL_ADM_FEE':
 * @property string $CSM_CAF_CID
 * @property string $CSM_CAF_FEE
 * @property string $CSM_CAF_CREATED
 * @property string $CSM_CAF_BIID
 */
class CSCMODWAUCENTRALADMFEE extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCMOD_WAU_CENTRAL_ADM_FEE';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSM_CAF_CID, CSM_CAF_BIID', 'required'),
			array('CSM_CAF_CID', 'length', 'max'=>7),
			array('CSM_CAF_FEE, CSM_CAF_BIID', 'length', 'max'=>10),
			array('CSM_CAF_CREATED', 'length', 'max'=>19),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSM_CAF_CID, CSM_CAF_FEE, CSM_CAF_CREATED, CSM_CAF_BIID', 'safe', 'on'=>'search'),
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
			'CSM_CAF_CID' => 'Csm Caf Cid',
			'CSM_CAF_FEE' => 'Csm Caf Fee',
			'CSM_CAF_CREATED' => 'Csm Caf Created',
			'CSM_CAF_BIID' => 'Csm Caf Biid',
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

		$criteria->compare('CSM_CAF_CID',$this->CSM_CAF_CID,true);
		$criteria->compare('CSM_CAF_FEE',$this->CSM_CAF_FEE,true);
		$criteria->compare('CSM_CAF_CREATED',$this->CSM_CAF_CREATED,true);
		$criteria->compare('CSM_CAF_BIID',$this->CSM_CAF_BIID,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCMODWAUCENTRALADMFEE the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
