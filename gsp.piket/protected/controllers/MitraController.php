<?php

class MitraController extends Controller
{
    
    private $FORM= array();
    private static $DML=array();
    
    public function actionIndex()
	{
            $model = CSCCOREDOWNCENTRAL::model()->findAll();
            if (isset($_POST['cid'])){
                $detil = Yii::app()->db->createCommand()
                        ->select('b.CSC_B_ID
                                    , d.CSC_B_NAME
                                    , a.CSC_DC_ID
                                    , a.CSC_DC_NAME
                                    , a.CSC_DC_TERMINAL_TYPE
                                    , c.CSC_BS_BID
                                    , f.CSC_BI_NAME')
                        ->from('CSCCORE_DOWN_CENTRAL a')
                        ->join('CSCCORE_BANK_DOWNLINE b', 'a.CSC_DC_ID = b.CSC_D_ID')
                        ->join('CSCCORE_BILLER_SWITCHER c', 'b.CSC_B_ID = c.CSC_BS_BCID and b.CSC_BI_ID = c.CSC_BS_BID')
                        ->join('CSCCORE_BANK d', 'b.CSC_B_ID = d.CSC_B_ID')
                        ->join('CSCCORE_BILLER f','f.CSC_BI_ID = c.CSC_BS_BID')
                        ->where('a.CSC_DC_ID =:cid', array(':cid'=>$_POST['cid']))
                        ->order('c.CSC_BS_BID')
                        ->queryAll();
                echo json_encode($detil);
            }   
		$this->render('index', array('model'=>$model));
            
	}
        
        public function actionSet_DB(){
            $db_name = DAOConfig::getDatabases();
            
            if(isset($_POST['DB'])){
                DAOConfig::getAdvertDbConnection($_POST['IP'], $_POST['DB']);
                var_dump(Yii::app()->db);
                var_dump(CSCCOREBILLER::findBillerID("0087"));
            }else{
                var_dump(Yii::app()->db);
            }
            $this->render('set_db', array('databases'=>$db_name));
        }
        
        public function actionSetting() {
            $CSCCOREDOWNCENTRAL = new CSCCOREDOWNCENTRAL();
            $CSCCOREBANK = new CSCCOREBANK();
            $CSCCOREBILLER = new CSCCOREBILLER();
            $listBiller = CHtml::listData(CSCCOREBILLER::model()->findAll(),'CSC_BI_ID','CSC_BI_NAME');
            $listPartner = CHtml::listData(CSCCOREDOWNCENTRAL::model()->findAll('CSC_DC_ID=CSC_DC_ID order by CSC_DC_NAME'),'CSC_DC_ID','CSC_DC_NAME');
            $listBank = CHtml::listData(CSCCOREBANK::model()->findAll(),'CSC_B_ID','CSC_B_NAME');
            $CSC_DC_NAME=null;
            
            if(isset($_POST['CSCCOREDOWNCENTRAL'])){
                $CSC_B_ID=$_POST['CSCCOREBANK']['CSC_B_ID'];
                $CSC_DC_NAME=$_POST['CSCCOREDOWNCENTRAL']['CSC_DC_NAME'];
                $CSC_DC_PIC_NAME=$_POST['CSCCOREDOWNCENTRAL']['CSC_DC_PIC_NAME'];
                $CSC_DC_PHONE=$_POST['CSCCOREDOWNCENTRAL']['CSC_DC_PHONE'];
                $countCSC_DC_TERMINAL_TYPE=  count($_POST['CSCCOREDOWNCENTRAL']['CSC_DC_TERMINAL_TYPE']);
                
                //this loop for insert table CSCCOREDOWNCENTRAL following how many terminal type 
                for($i=0;$i<$countCSC_DC_TERMINAL_TYPE;$i++){
                    $CSC_DC_ID=$CSCCOREDOWNCENTRAL->getCentralID($CSC_B_ID);
                    $insertCSCCOREDOWNCENTRAL = $CSCCOREDOWNCENTRAL;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_ID=$CSC_DC_ID;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_NAME=$CSC_DC_NAME;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_CITY=null;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_ADDRESS=null;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_PHONE=$CSC_DC_PHONE;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_PIC_NAME=$CSC_DC_PIC_NAME;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_PIC_PHONE="";
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_TYPE=1;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_TERMINAL_TYPE=$_POST['CSCCOREDOWNCENTRAL']['CSC_DC_TERMINAL_TYPE'][$i];;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_PARTNER_CODE=null;
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_REGISTERED=new CDbExpression('NOW()');
                    $insertCSCCOREDOWNCENTRAL->CSC_DC_ISBLOCKED=0;
                    $totalRowInsertSuccess=0;
                    $totalRowInsertFailed=0;
                    
                    if($insertCSCCOREDOWNCENTRAL->save(true)){
                        $totalRowInsertSuccess++;
                    }else{
                        $totalRowInsertFailed++;
                    }
                    
                    //check biller product for registered CSCCORE_BANK_DOWNLINE
                    $countCSCCOREBILLER= count($_POST['CSCCOREBILLER']['CSC_BI_ID']);
                    for($i=0;$i<$countCSCCOREBILLER;$i++){
                        $iCSCCOREBANKDOWNLINE = new CSCCOREBANKDOWNLINE();
                        $iV_CSCCOREBANKDOWNLINE = new V_CSCCOREBANKDOWNLINE();
                        $CSC_BI_NAME = $_POST['CSCCOREBILLER']['CSC_BI_NAME'][$i];
                        $CSC_BI_ID = $CSCCOREBILLER->getBillerID($CSC_BI_NAME);
                        if(is_array($getBillerID)){
                            for($x=0;$x<count($CSC_BI_ID);$x++){
                                $iCSCCOREBANKDOWNLINE->CSC_B_ID=$CSC_DC_NAME;
                                $iCSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_DC_ID;
                                $iCSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_BI_ID[$x];
                            }
                        }else if($CSC_BI_ID=='5001'){
                            $iV_CSCCOREBANKDOWNLINE->CSC_B_ID=$CSC_DC_NAME;
                            $iV_CSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_DC_ID;
                            $iV_CSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_BI_ID;
                        }else {
                            $iCSCCOREBANKDOWNLINE->CSC_B_ID=$CSC_DC_NAME;
                            $iCSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_DC_ID;
                            $iCSCCOREBANKDOWNLINE->CSC_D_ID=$CSC_BI_ID;
                        }
                    }
               }
                
               Yii::app()->request->redirect('index.php?r=mitra/route&cdc='.$countCSC_DC_TERMINAL_TYPE);
            }
            
            
            $this->render('setting', array(
                'model' => $CSCCOREDOWNCENTRAL, 
                'listBank'=> $listBank, 
                'bank' => $CSCCOREBANK,
                'listBiller'=> $listBiller,
                'listPartner'=> $listPartner,
                'biller'=>$CSCCOREBILLER));
        }
        
        
        public function actionRegistration(){
//            throw new CHttpException(091,'Under Construction');
            $CSCCOREDOWNCENTRAL = new CSCCOREDOWNCENTRAL();
            $CSCCOREBANK = new CSCCOREBANK();
            $CSCCOREBILLER = new CSCCOREBILLER();
            $listBiller = CHtml::listData(CSCCOREBILLER::model()->findAll(),'CSC_BI_ID','CSC_BI_NAME');
            $listBank = CHtml::listData(CSCCOREBANK::model()->findAll(),'CSC_B_ID','CSC_B_NAME');
            
            if(isset($_POST['FORM'])){
                $CSC_B_ID=$_POST['FORM']['CSC_B_ID'];
                  
                try {
                    self::$DML = new RouteProduct($_POST['FORM']);
                    $this->render('dml', array("dml"=>  self::$DML));
                } catch (Exception $ex) {
                    throw new CHttpException(091,'092 Failed Insert Database, The specified post cannot be found.');
                }
            }else {
            
                $this->render('registration', array(
                    'model' => $CSCCOREDOWNCENTRAL, 
                    'listBank'=> $listBank, 
                    'bank' => $CSCCOREBANK,
                    'listBiller'=> $listBiller,
                    'biller'=>$CSCCOREBILLER,));
            }
        }
        
        public function actionDML(){
        $this->render('dml', array("dml"=>self::$DML));
        }
        
        public function actionGetCID() {
            if(isset($_POST['getCID']) && $_POST['getCID']==true){
                $CSCCOREDOWNCENTRAL = new CSCCOREDOWNCENTRAL();
                echo $CSCCOREDOWNCENTRAL->getCentralID($_POST['bank_code']);
            }
        }
	// Uncomment the following methods and override them if needed
	/*
	public function filters()
	{
		// return the filter configuration for this controller, e.g.:
		return array(
			'inlineFilterName',
			array(
				'class'=>'path.to.FilterClass',
				'propertyName'=>'propertyValue',
			),
		);
	}

	public function actions()
	{
		// return external action classes, e.g.:
		return array(
			'action1'=>'path.to.ActionClass',
			'action2'=>array(
				'class'=>'path.to.AnotherActionClass',
				'propertyName'=>'propertyValue',
			),
		);
	}
	*/
}