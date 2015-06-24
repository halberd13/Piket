<?php

class TesterController extends Controller
{
        private $IP_SERVICE="127.0.0.1";
        private $PORT_SERVICE="55050";
        
	public function actionIndex()
	{   
                
                $this->render('index');
	}
        
        public function actionPDAM(){
            $FORM = $_POST['FORM'];
            $url="http://192.168.168.110:50050/devel?";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $output = curl_exec($ch);
        }

        public function tiket(){
            $FORM = $_POST['FORM'];
            $rqid=$_POST['MESSAGE_TYPE'];
            $srv=$_POST['PRODUCT_ID'];
            $idpel=$_POST['IDPEL'];
            $cid=$_POST['CID'];
            $bank=$_POST['BANK_CODE'];
            $ip=$_POST['IP'];
            $port=$_POST['PORT'];
            $dc=$_POST['MERCHANT'];
            $tid=$_POST['TERMINAL_ID'];
            $url="http://localhost:8080/catester?rqid=".$rqid."&srv=".$srv."&idpel=".$idpel."&bank=".$bank."&cid=".$cid."&ip=".$ip."&port=".$port."&dc=".$dc."&tid=".$tid."&sref=";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $output = curl_exec($ch);
            
        }
        
        public function reservation(){
            $FORM = $_POST['FORM'];
            $rqid=$_POST['MESSAGE_TYPE'];
            $srv=$_POST['PRODUCT_ID'];
            $depart=$_POST['DEPARTURE'];
            $dest=$_POST['DESTINATION'];
            $cid=$_POST['CID'];
            $bank=$_POST['BANK_CODE'];
            $ip=$_POST['IP'];
            $port=$_POST['PORT'];
            $dc=$_POST['MERCHANT'];
            $tid=$_POST['TERMINAL_ID'];
            $url="http://localhost:8080/reserve?rqid=".$rqid."&srv=".$srv."&depart=".$depart."&dest=".$dest."&bank=".$bank."&cid=".$cid."&ip=".$ip."&port=".$port."&dc=".$dc."&tid=".$tid."&sref=";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_HEADER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                curl_setopt($ch, CURLOPT_TIMEOUT, 30);
                $output = curl_exec($ch);
            
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