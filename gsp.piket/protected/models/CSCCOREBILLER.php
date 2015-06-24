<?php

/**
 * This is the model class for table "CSCCORE_BILLER".
 *
 * The followings are the available columns in table 'CSCCORE_BILLER':
 * @property string $CSC_BI_ID
 * @property string $CSC_BI_NAME
 * @property string $CSC_BI_ADDRESS
 * @property string $CSC_BI_PHONE
 * @property string $CSC_BI_PIC_NAME
 * @property string $CSC_BI_PIC_PHONE
 * @property string $CSC_BI_PAN
 * @property string $CSC_BI_REGISTERED
 */
class CSCCOREBILLER extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_BILLER';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_BI_ID', 'required'),
			array('CSC_BI_ID, CSC_BI_PAN', 'length', 'max'=>10),
			array('CSC_BI_NAME, CSC_BI_PIC_NAME, CSC_BI_PIC_PHONE', 'length', 'max'=>100),
			array('CSC_BI_ADDRESS', 'length', 'max'=>255),
			array('CSC_BI_PHONE', 'length', 'max'=>50),
			array('CSC_BI_REGISTERED', 'length', 'max'=>19),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_BI_ID, CSC_BI_NAME, CSC_BI_ADDRESS, CSC_BI_PHONE, CSC_BI_PIC_NAME, CSC_BI_PIC_PHONE, CSC_BI_PAN, CSC_BI_REGISTERED', 'safe', 'on'=>'search'),
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
			'CSC_BI_ID' => 'format=AAABBBBCCC -> AAA=kode product (001=electricity, 002=Telkom Phone, ...), BBB=Distribution/Area ID (e.g. 0053=DJBB, 0), CCC=Distribution Product Code/ID (e.g.: 501=POST-PAID, 502=PRE-PAID, 503=NaDa)',
			'CSC_BI_NAME' => 'Csc Bi Name',
			'CSC_BI_ADDRESS' => 'Csc Bi Address',
			'CSC_BI_PHONE' => 'Csc Bi Phone',
			'CSC_BI_PIC_NAME' => 'Csc Bi Pic Name',
			'CSC_BI_PIC_PHONE' => 'Csc Bi Pic Phone',
			'CSC_BI_PAN' => 'Csc Bi Pan',
			'CSC_BI_REGISTERED' => 'Csc Bi Registered',
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

		$criteria->compare('CSC_BI_ID',$this->CSC_BI_ID,true);
		$criteria->compare('CSC_BI_NAME',$this->CSC_BI_NAME,true);
		$criteria->compare('CSC_BI_ADDRESS',$this->CSC_BI_ADDRESS,true);
		$criteria->compare('CSC_BI_PHONE',$this->CSC_BI_PHONE,true);
		$criteria->compare('CSC_BI_PIC_NAME',$this->CSC_BI_PIC_NAME,true);
		$criteria->compare('CSC_BI_PIC_PHONE',$this->CSC_BI_PIC_PHONE,true);
		$criteria->compare('CSC_BI_PAN',$this->CSC_BI_PAN,true);
		$criteria->compare('CSC_BI_REGISTERED',$this->CSC_BI_REGISTERED,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCCOREBILLER the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function findBillerID($prefix){
            $list = Yii::app()->db->createCommand()
                    ->select('CSC_BI_ID')
                    ->from('CSCCORE_BILLER')
                    ->where('left(CSC_BI_ID,4)=:prefix', array(':prefix'=>$prefix))
                    ->order('CSC_BI_ID')
                    ->queryAll();
            return $list;
        }
        
        public static function getBillerID($StringName){
            if($StringName=="VOUCHER_PRABAYAR"){
                $BILLERID = "5001";
            }else if($StringName=="VOUCHER_PASCABAYAR"){
                $BILLERID = "5002";
            }else if($StringName=="INTERCITY_TRANSPORT"){
                $CSCCOREBILLER = new CSCCOREBILLER();
                $check = $CSCCOREBILLER->findBillerID("9290");
                $BILLERID = $check;
            }else if($StringName=="TIKET_KAI"){
                $BILLERID = "0090501";
            }else if($StringName=="FIF"){
                $BILLERID = "0086501";
            }else if($StringName=="WOM"){
                $BILLERID = "0086502";
            }else if($StringName=="BAF"){
                $BILLERID = "0086003";
            }else if($StringName=="MAF_MCF"){
                $BILLERID = "0086001";
            }
            
            return $BILLERID;
        }
        
        
        
}
