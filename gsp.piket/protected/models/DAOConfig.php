<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class DAOConfig extends RActiveRecord{
    
    public function getProductBiller($cid){
        $data = Yii::app()->db->createCommand()
            ->select('b.CSM_BG_SERVER as GATEWAY_IP, b.CSM_BG_PORT as GATEWAY_PORT,b.CSM_BG_BILLER as BILLER_DISTRIBUTION, right(b.CSM_BG_BILLER_SW,5) as BILLER_CODE, b.CSM_BG_BILLER_NAME as BILLER_NAME')
            ->from('CSCCORE_BANK_DOWNLINE a')
            ->join('CSCMOD_WAU_BILLER_GATEWAY b', 'a.CSC_BI_ID=b.CSM_BG_BILLER_SW')
            ->where('left(a.CSC_BI_ID,4) = "0087" and a.CSC_D_ID=:cid', array(':cid'=>$cid))
            ->order('a.CSC_BI_ID')  
            ->queryAll();
        return $data;
    }
    
    static function getDatabases($ip=null){
        $list = Yii::app()->db->createCommand('show databases');
        return $list->queryAll();
    }
    
    static function getAdvertDbConnection($ip, $db_name) {
        parent::$db_ip = $ip;
        parent::$db_name = $db_name;
        parent::getAdvertDbConnection();
    }
    
 
    
}