<?php

class BankController extends Controller
{
	public function actionIndex()
	{
            $model = CSCCOREBANK::model()->findAll();
		$this->render('index', array('model' => $model));
	}
        
        public function actionAdd(){
            $model= new CSCCOREBANK;
            if(isset($_POST['CSCCOREBANK'])){
                $model->attributes=$_POST['CSCCOREBANK'];
                $model->CSC_B_REGISTERED= new CDbExpression('NOW()');
                if($model->save()){
                    Yii::app()->request->redirect("index.php?r=bank");
                }else{
                    
                }
            }
            
            $this->render('add', array('model' => $model));
        }
        
        public function actionDelete(){
            $model = new CSCCOREBANK;
            if($model->deleteByPk($_POST['id'])){
                echo "1";
            }else{
                echo "0";
            }
        }
        
        public function actionUpdate(){
            
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