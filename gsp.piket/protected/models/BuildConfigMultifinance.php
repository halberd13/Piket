<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BuildConfigMultifinance{
    
    public function __construct($param){
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-MULTIFINANCE-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-MULTIFINANCE-'.$param['SERVER_PORT'];
        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-MULTIFINANCE-'.$param['SERVER_PORT'].'#1-Logger.xml';
        
        $diffProduct = array("VSI-MAF_MCF"=>"86001","VSI-WOM"=>"86002","VSI-BAF"=>"86003","TEKTAYA-FIF"=>"86501");
        $SORT=array('-0B-','-0C-','-0D-','-0E-');
        $i=0;
        $requestListener =  array();
        $formQserver = new FormQServer();
        $param['SERVER_CLASS']='listener.switcher.MultifinanceG2';
        
        foreach($diffProduct as $SERVER_PRODUCT=>$BILLER_CODE){
            $param['SERVER_PRODUCT']=$SERVER_PRODUCT;
            $param['BILLER_CODE']=$BILLER_CODE;
            $param['GATEWAY_IP']="127.0.0.1";
            if(substr($SERVER_PRODUCT, 0, 3)=="VSI"){
                $param['GATEWAY_PORT']=(int)$param['SERVER_PORT'] + 123;
            }else {
                $param['GATEWAY_PORT']=(int)$param['SERVER_PORT'] + 234;
            }
            
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
            
            FormDBPool::buildDBPool($param);
            FormChannelAdaptor::buildChannelAdaptor($param);
            FormQmux::buildQmux($param);
            FormQmuxPooling::buildQMuxPooling($param);
            $requestListener = array_merge($requestListener, array($SERVER_PRODUCT=>$formQserver->buildRequestListener(FormQServer::$doc, $param)));
            $i++;
        }
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-0F-MULTIFINANCE-'.$param['SERVER_PORT'].'-QServer';
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].'-0F-MULTIFINANCE-'.$param['SERVER_PORT'].'#7-QServer.xml';
        $param['SERVER_PRODUCT']="MULTIFINANCE";
        FormLogger::buildLogger($param);
        $formQserver->buildQServer($param, $requestListener);
        if($param['HAS_FREEZER']=='1'){
            $this->buildFreezerMultifinance($param);
        }
    }
    
    
    private function buildFreezerMultifinance($param){
        $nameFreezers = array("VSI","TEKTAYA");
        $param['SERVER_CLASS']='listener.uat.v2.Normal';
        $param['SERVER_PRODUCT']='FREEZER-UAT';
        $SERVER_PORT = $param['SERVER_PORT'];
        foreach($nameFreezers as $nameFreezer){
            if($nameFreezer=="VSI"){
                $param['SERVER_PORT']= $SERVER_PORT + 123;
                $param['GATEWAY_IP']=  InstancePortIP::$IP_GW_FINANCE_VSI;
                $param['GATEWAY_PORT']=  InstancePortIP::$PORT_GW_FINANCE_VSI;
            }else {
                $param['SERVER_PORT']= $SERVER_PORT + 234;
                $param['GATEWAY_IP']=  InstancePortIP::$IP_GW_FINANCE_TEKTAYA;
                $param['GATEWAY_PORT']=  InstancePortIP::$PORT_GW_FINANCE_TEKTAYA;
            }
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
            FormChannelAdaptor::buildChannelAdaptor($param);
            FormQmux::buildQmux($param);
            FormQmuxPooling::buildQMuxPooling($param);
            $formQServer = new FormQServer($param);
            $formQServer->buildQServer($param);
        }
    }
    
    
    
    
    
    
    
    
    
    
}