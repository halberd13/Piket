<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BuildConfigPayTV{
    public function __construct($param){
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-FM_PAYTV-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-FM_PAYTV-'.$param['SERVER_PORT'];
        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-FM_PAYTV-'.$param['SERVER_PORT'].'#1-Logger.xml';
        $SERVER_PRODUCT=$param['SERVER_PRODUCT'];
        $SORT=array('-0B-');
        $i=0;
        $requestListener =  array();
        $formQserver = new FormQServer();
        $param['SERVER_CLASS']='listener.switcher.v2.CableTv';
        $param['GATEWAY_IP']="127.0.0.1";
        $param['GATEWAY_PORT']=(int)$param['SERVER_PORT'] + 123;
        
        $param['NAME_LOGGER_PRIVATE'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-LoggerPrivate';
        $param['NAME_LOGGER_PRIVATE_FILE'] = $param['SERVER_NAME'].'-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-LoggerPrivate';
        $param['NAME_DBPOOL'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'];
        $param['NAME_CHADAPTOR'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-ChAdaptor_';
        $param['NAME_QMUX'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMux_';
        $param['NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMuxPooling';
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QServer';

        $param['FILE_NAME_LOGGER_PRIVATE'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#2-LoggerPrivate.xml';
        $param['FILE_NAME_DBPOOL'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#3-DBPool.xml';
        $param['FILE_NAME_CHADAPTOR'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#4-ChAdaptor_';
        $param['FILE_NAME_QMUX'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#5-QMux_";
        $param['FILE_NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#6-QMuxPooling.xml";

        FormLoggerPrivate::buildLoggerPrivate($param);
        FormDBPool::buildDBPool($param);
        FormChannelAdaptor::buildChannelAdaptor($param);
        FormQmux::buildQmux($param);
        FormQmuxPooling::buildQMuxPooling($param);
        
        
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-0F-FM_PAYTV-'.$param['SERVER_PORT'].'-QServer';
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].'-0F-FM_PAYTV-'.$param['SERVER_PORT'].'#7-QServer.xml';
        
        FormLogger::buildLogger($param);
        $formQserver->buildQServer($param);
        if($param['HAS_FREEZER']=='1'){
            $this->buildFreezerPayTV($param);
        }
    }
    
    
    private function buildFreezerPayTV($param){
        $nameFreezer = "FM_PAYTV";
        $param['SERVER_CLASS']='listener.uat.v2.NormalDelay';
        $param['SERVER_PRODUCT']='FREEZER-UAT';
        $SERVER_PORT = $param['SERVER_PORT'];
        $param['SERVER_PORT']= $SERVER_PORT + 123;
        $param['GATEWAY_IP']=  InstancePortIP::$IP_GW_PAYTV;
        $param['GATEWAY_PORT']=  InstancePortIP::$PORT_GW_PAYTV;
        
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'];
        $param['NAME_DBPOOL'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'];
        $param['NAME_CHADAPTOR'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'-ChAdaptor_';
        $param['NAME_QMUX'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'-QMux_';
        $param['NAME_QMUXPOOLING'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'-QMuxPooling';
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'-QServer';

        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'#1-Logger.xml';
        $param['FILE_NAME_DBPOOL'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'#2-DBPool.xml';
        $param['FILE_NAME_CHADAPTOR'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'#3-ChAdaptor_';
        $param['FILE_NAME_QMUX'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT']."#4-QMux_";
        $param['FILE_NAME_QMUXPOOLING'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT']."#5-QMuxPooling.xml";
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].'-'.$nameFreezer.'-UAT-'.$param['SERVER_PORT'].'#6-QServer.xml';


        FormLogger::buildLogger($param);
        FormDBPool::buildDBPool($param);
        FormChannelAdaptor::buildChannelAdaptor($param);
        FormQmux::buildQmux($param);
        FormQmuxPooling::buildQMuxPooling($param);
        $formQServer = new FormQServer($param);
        $formQServer->buildQServer($param);
        
    }
    
}