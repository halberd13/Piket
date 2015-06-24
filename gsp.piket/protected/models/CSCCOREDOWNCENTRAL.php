<?php

/**
 * This is the model class for table "CSCCORE_DOWN_CENTRAL".
 *
 * The followings are the available columns in table 'CSCCORE_DOWN_CENTRAL':
 * @property string $CSC_DC_ID
 * @property string $CSC_DC_NAME
 * @property string $CSC_DC_CITY
 * @property string $CSC_DC_ADDRESS
 * @property string $CSC_DC_PHONE
 * @property string $CSC_DC_PIC_NAME
 * @property string $CSC_DC_PIC_PHONE
 * @property string $CSC_DC_TYPE
 * @property string $CSC_DC_TERMINAL_TYPE
 * @property string $CSC_DC_PARTNER_CODE
 * @property string $CSC_DC_REGISTERED
 * @property integer $CSC_DC_ISBLOCKED
 */
class CSCCOREDOWNCENTRAL extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'CSCCORE_DOWN_CENTRAL';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('CSC_DC_ID', 'required'),
			array('CSC_DC_ISBLOCKED', 'numerical', 'integerOnly'=>true),
			array('CSC_DC_ID', 'length', 'max'=>7),
			array('CSC_DC_NAME, CSC_DC_PIC_NAME, CSC_DC_PIC_PHONE', 'length', 'max'=>100),
			array('CSC_DC_CITY', 'length', 'max'=>25),
			array('CSC_DC_ADDRESS', 'length', 'max'=>255),
			array('CSC_DC_PHONE', 'length', 'max'=>50),
			array('CSC_DC_TYPE', 'length', 'max'=>2),
			array('CSC_DC_TERMINAL_TYPE', 'length', 'max'=>4),
			array('CSC_DC_PARTNER_CODE', 'length', 'max'=>5),
			array('CSC_DC_REGISTERED', 'length', 'max'=>19),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('CSC_DC_ID, CSC_DC_NAME, CSC_DC_CITY, CSC_DC_ADDRESS, CSC_DC_PHONE, CSC_DC_PIC_NAME, CSC_DC_PIC_PHONE, CSC_DC_TYPE, CSC_DC_TERMINAL_TYPE, CSC_DC_PARTNER_CODE, CSC_DC_REGISTERED, CSC_DC_ISBLOCKED', 'safe', 'on'=>'search'),
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
			'CSC_DC_ID' => 'Csc Dc',
			'CSC_DC_NAME' => 'Csc Dc Name',
			'CSC_DC_CITY' => 'used for Voucher Systems',
			'CSC_DC_ADDRESS' => 'Csc Dc Address',
			'CSC_DC_PHONE' => 'Csc Dc Phone',
			'CSC_DC_PIC_NAME' => 'Csc Dc Pic Name',
			'CSC_DC_PIC_PHONE' => 'Csc Dc Pic Phone',
			'CSC_DC_TYPE' => '0=Institution with no CENTRAL, 1=Institution with own CENTRAL',
			'CSC_DC_TERMINAL_TYPE' => '6010 = Teller, 6011 = ATM, 6012 = POS, 6013 = AutoDebit/giralisasi, 6014 = Internet, 6015 = Kiosk, 6016 = Phone Banking / Call Center, 6017 = Mobile Banking, 6018 = EDC',
			'CSC_DC_PARTNER_CODE' => 'Used for PLN Produk for generate payment refnum',
			'CSC_DC_REGISTERED' => 'Csc Dc Registered',
			'CSC_DC_ISBLOCKED' => 'Csc Dc Isblocked',
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

		$criteria->compare('CSC_DC_ID',$this->CSC_DC_ID,true);
		$criteria->compare('CSC_DC_NAME',$this->CSC_DC_NAME,true);
		$criteria->compare('CSC_DC_CITY',$this->CSC_DC_CITY,true);
		$criteria->compare('CSC_DC_ADDRESS',$this->CSC_DC_ADDRESS,true);
		$criteria->compare('CSC_DC_PHONE',$this->CSC_DC_PHONE,true);
		$criteria->compare('CSC_DC_PIC_NAME',$this->CSC_DC_PIC_NAME,true);
		$criteria->compare('CSC_DC_PIC_PHONE',$this->CSC_DC_PIC_PHONE,true);
		$criteria->compare('CSC_DC_TYPE',$this->CSC_DC_TYPE,true);
		$criteria->compare('CSC_DC_TERMINAL_TYPE',$this->CSC_DC_TERMINAL_TYPE,true);
		$criteria->compare('CSC_DC_PARTNER_CODE',$this->CSC_DC_PARTNER_CODE,true);
		$criteria->compare('CSC_DC_REGISTERED',$this->CSC_DC_REGISTERED,true);
		$criteria->compare('CSC_DC_ISBLOCKED',$this->CSC_DC_ISBLOCKED);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CSCCOREDOWNCENTRAL the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getCentralID($CSC_B_ID){
            $CSCCOREDOWNCENTRAL = new CSCCOREDOWNCENTRAL();
            $CSC_DC_ID=null;
            $isNewRecord=true;
            $indexID = 1;
            while($isNewRecord){
                if($indexID<10){
                    $pad="000";
                }else if ($indexID<100){
                    $pad="00";
                }else if ($indexID<1000){
                    $pad="0";
                }
                $newCID = substr($CSC_B_ID, 0, 3).$pad.$indexID;
                $record = $CSCCOREDOWNCENTRAL->findByAttributes(array('CSC_DC_ID'=>$newCID));
                if($CSC_B_ID==0){
                    $isNewRecord=false;
                    $CSC_DC_ID=null;
                }else if($record==null){
                    $CSC_DC_ID = $newCID;
                    $isNewRecord=false;
                }else{
                    $indexID++;
                    $isNewRecord=true;
                }
            }
            return $CSC_DC_ID;
        }
        
}
