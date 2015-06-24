<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class ParamConfig {
    
    public $SERVER_NAME='SERVER_NAME';
    public $BANK_CODE='4410000';
    public $CID='4410601';
    public $SERVER_PORT='45000';
    public $SERVER_CLASS;
    public $SERVER_CFG='cfg/iso2003ascii.xml';
    public $CLASS_CHANNEL='channel.GSP_Tail';
    public $GATEWAY_IP = '192.168.168.110';
    public $GATEWAY_PORT = '20133';
    public $GATEWAY_CFG='cfg/iso2003ascii.xml';
    public $CONNECTION_TYPE = 'connection-less';
    public $CHANNEL_QUANTITY=1;
    public $SERVER_PRODUCT='PLN';
//                
    public $NAME_QSERVER; 
    public $NAME_QMUXPOOLING;
    public $NAME_QMUX;
    public $NAME_CHADAPTOR;
    public $NAME_LOGGER;
    public $NAME_DBPOOL;
   
    
    function __construct($param) {
        $this->SERVER_NAME=$param['SERVER_NAME'];
        $this->SERVER_PORT=$param['SERVER_PORT'];
        $this->SERVER_CFG=$param['SERVER_CFG'];
//        $this->SERVER_CLASS=$param['SERVER_CLASS'];
        $this->SERVER_PRODUCT=$param['SERVER_PRODUCT'];
        $this->CLASS_CHANNEL=$param['CLASS_CHANNEL'];
        $this->NAME_QSERVER=$param['NAME_QSERVER'];
        $this->NAME_QMUXPOOLING=$param['NAME_QMUXPOOLING'];
        $this->NAME_QMUX=$param['NAME_QMUX'];
        $this->NAME_CHADAPTOR=$param['NAME_CHADAPTOR'];
        $this->NAME_LOGGER=$param['NAME_LOGGER'];
        $this->NAME_DBPOOL=$param['NAME_DBPOOL'];
        $this->CID=$param['CID'];
        $this->PARAM=$param;
    }
    
    
//    public function getPropertyBiller($CID){
//        $biller = new DAOConfig();
//        $listBiller = $biller->getProductBiller($CID);
//        $valProp = array();
//        foreach($listBiller as $name=>$val){
//            $i=array();
//            foreach($val as $a=>$b){
//                if($i!=null){
//                    array_push($valProp, $i.'#'.$b);
//                }else{
//                    $i=$b;
//                }
//            }
//        }
//        return $listBiller;
//    }
//    
    
    
    
    
}
