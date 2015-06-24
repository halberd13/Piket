<?php

class SelfServiceController extends Controller
{
	public function actionIndex()
	{
//                $con=ssh2_connect('192.168.168.130', 22);
//                ssh2_auth_password($con, 'user', 'password');
//                $shell=ssh2_shell($con, 'xterm');
//                fwrite( $shell, 'cd /dir_one;'.PHP_EOL);
//                fwrite( $shell, 'ls -la;'.PHP_EOL);
//                fwrite( $shell, 'cd /dir_two;'.PHP_EOL);
//                fwrite( $shell, 'ls -la;'.PHP_EOL);
//                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "http://localhost:8080/greeting");
                curl_setopt($ch, CURLOPT_POST, 1);// set post data to true
                curl_setopt($ch, CURLOPT_POSTFIELDS,$data);
                curl_exec($ch);
                curl_close($ch);
                $this->render('index');
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