<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


class BuildConfigPDAM {
    public static $echoFile;
    
    function __construct(array $param) {
        $formQServer = new FormQServer();
        $biller = DAOConfig::getProductBiller($param['CID']);
        $param['SERVER_PORT'] =$param['SERVER_PORT_1'];
        $param['SERVER_CLASS']='listener.switcher.switcher_pdam';
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-PDAM-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-PDAM-'.$param['SERVER_PORT'];
        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-PDAM-'.$param['SERVER_PORT'].'#1-Logger.xml';
        $requestListener = array();
        $echo= array();
        foreach($biller as $arr){
            $param['GATEWAY_IP'] = $arr['GATEWAY_IP'];
            $param['GATEWAY_PORT']=$arr['GATEWAY_PORT'];
            $param['BILLER_PRODUCT'] = $arr['BILLER_CODE'].'#'.$arr['BILLER_DISTRIBUTION'];
            $BILLER_EXIST = str_replace(" ", "", $arr['BILLER_NAME']);
            $SERVER_PRODUCT = substr($BILLER_EXIST,strpos($BILLER_EXIST,'-')+1);
            $param['SERVER_PRODUCT']= $SERVER_PRODUCT;
            $param['NAME_DBPOOL'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'];
            $param['NAME_CHADAPTOR'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-ChAdaptor_';
            $param['NAME_QMUX'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMux_';
            $param['NAME_QMUXPOOLING'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMuxPooling';
            $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QServer';
            
            $param['FILE_NAME_DBPOOL'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#2-DBPool.xml';
            $param['FILE_NAME_CHADAPTOR'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#3-ChAdaptor_';
            $param['FILE_NAME_QMUX'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#4-QMux_";
            $param['FILE_NAME_QMUXPOOLING'] = $param['SERVER_NAME'].'-0B-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#5-QMuxPooling.xml";
            
            FormDBPool::buildDBPool($param);
            FormChannelAdaptor::buildChannelAdaptor($param);
            FormQmux::buildQmux($param);
            FormQmuxPooling::buildQMuxPooling($param);
            
            $requestListener = array_merge($requestListener, array($SERVER_PRODUCT=>FormQServer::buildRequestListener(FormQServer::$doc, $param)));
            $this->echoFile = array_merge($echo, $param);
        }
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-0C-PDAM-'.$param['SERVER_PORT'].'-QServer';
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].'-0C-PDAM-'.$param['SERVER_PORT'].'#6-QServer.xml';
        $this->echoFile = array_merge($echo, $param);
        
        FormLogger::buildLogger($param);
        $formQServer->buildQServer($param, $requestListener);
    }
    
}