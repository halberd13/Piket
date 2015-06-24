<?php

class InstanceController extends Controller 
{
	public function actionIndex()
	{
                $this->render('index');
	}
        
        public function actionBuild()
	{
                if(isset($_POST['FORM'])){
                    $param = $_POST['FORM'];
                    $param['SERVER_NAME']=strtoupper($param['SERVER_NAME']);
                    $param['DC_TYPE']= PropertyProduct::explodeDcType($param);
                    $path = Yii::getPathOfAlias('webroot').'/config/'.$param['SERVER_NAME'].'/';
                    
                    if(!file_exists($path)){
                        mkdir($path, 0777, true);
                        $param['DIR']=$path;
                    }else{
                        throw new CHttpException(091,'Failed, Directory already exist.',092);
                    }
                    try {
                        if($param['SERVER_PRODUCT']=='PDAM') new BuildConfigPDAM($param);
                        else if($param['SERVER_PRODUCT']=='PLN') new BuildConfigPLN($param);
                        else if($param['SERVER_PRODUCT']=='MULTIFINANCE') new BuildConfigMultifinance($param);
                        else if($param['SERVER_PRODUCT']=='FM_PAYTV') new BuildConfigPayTV($param);
                        
                    }catch (Exception $ex) {
                        throw new ExceptionClass($ex->getMessage());
                    } finally {
                        $param = null;
                        Yii::app()->request->redirect("index.php?r=instance&rc=00");
                    }
                    
                }else 
                    throw new CHttpException(091,'Failed Insert Database, The specified post cannot be found.',092);
	}
        
        
        public function actionDownload(){
            $path = Yii::getPathOfAlias('webroot').'/config/test';
            
//            if(file_exists($path)){
//                Yii::app()->getRequest()->sendFile('CIK-0F-MULTIFINANCE-11014#7-QServer.xml', @file_get_contents($path));
//                $this->render('index');
//            }else 
//                throw new CHttpException(091,'Failed create file, The specified post cannot be found.',092);
//            
            
            
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