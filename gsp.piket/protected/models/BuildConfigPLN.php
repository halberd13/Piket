<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BuildConfigPLN{
    
    public function __construct($param) {
       $param['GATEWAY_IP']=  InstancePortIP::$IP_GW_PLN; 
       $param['GATEWAY_PORT']=  InstancePortIP::$PORT_GW_PLN; 
       if($param['DIFF_PORT']=="1") $this->handleDiffPort($param);
       else if($param['DIFF_PORT']=="0") $this->handleOnePort($param);
                
    }
    
    private function handleDiffPort($param){
        $diffProduct = array("POSTPAID"=>$param['SERVER_PORT_1'],"PREPAID"=>$param['SERVER_PORT_2'],"NONTAGLIS"=>$param['SERVER_PORT_3']);
        $SORT=array('-0B-','-0C-','-0D-');
        $i=0;
        foreach($diffProduct as $SERVER_PRODUCT=>$SERVER_PORT){
            $param['SERVER_PRODUCT']=$SERVER_PRODUCT;
            $param['SERVER_PORT']=$SERVER_PORT;
            $param['GATEWAY_IP']=  "localhost";
            
            
            $param['NAME_LOGGER'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-Logger';
            $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'];
            $param['NAME_LOGGER_PRIVATE'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-LoggerPrivate';
            $param['NAME_LOGGER_PRIVATE_FILE'] = $param['SERVER_NAME'].'-'.$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-LoggerPrivate';
            $param['NAME_DBPOOL'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'];
            $param['NAME_CHADAPTOR'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-ChAdaptor_';
            $param['NAME_QMUX'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMux_';
            $param['NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QMuxPooling';
            $param['NAME_QSERVER'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'-QServer';
            
            $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#1-Logger.xml';
            $param['FILE_NAME_LOGGER_PRIVATE'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#2-LoggerPrivate.xml';
            $param['FILE_NAME_DBPOOL'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#3-DBPool.xml';
            $param['FILE_NAME_CHADAPTOR'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#4-ChAdaptor_';
            $param['FILE_NAME_QMUX'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#5-QMux_";
            $param['FILE_NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT']."#6-QMuxPooling.xml";
            $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].$SORT[$i].$SERVER_PRODUCT.'-'.$param['SERVER_PORT'].'#7-QServer.xml';
            
            if($SERVER_PRODUCT=="POSTPAID"){
                $param['GATEWAY_PORT']= $SERVER_PORT + 123;
                if($param['HAS_FREEZER']=="1"){
                    $param['SERVER_PORT'] = $SERVER_PORT + 123;
                    $this->buildFreezerPLN($param, $SORT[$i]);
                }
            }else if($SERVER_PRODUCT=="PREPAID"){
                $param['GATEWAY_PORT']= $SERVER_PORT + 234;
                if($param['HAS_FREEZER']=="1"){
                    $param['SERVER_PORT'] = $SERVER_PORT + 234;
                    $this->buildFreezerPLN($param, $SORT[$i]);
                }
            }else {
                $param['GATEWAY_PORT']= $SERVER_PORT + 321;
                if($param['HAS_FREEZER']=="1"){
                    $param['SERVER_PORT'] = $SERVER_PORT + 321;
                    $this->buildFreezerPLN($param, $SORT[$i]);
                }
            }
            FormLoggerPrivate::buildLoggerPrivate($param);
            FormLogger::buildLogger($param);
            FormDBPool::buildDBPool($param);
            FormChannelAdaptor::buildChannelAdaptor($param);
            FormQmux::buildQmux($param);
            FormQmuxPooling::buildQMuxPooling($param);
            if($SERVER_PRODUCT=='POSTPAID')$param['SERVER_CLASS']='listener.switcher.v2.plnpostpaid';
            else if($SERVER_PRODUCT=='PREPAID')$param['SERVER_CLASS']='listener.switcher.v2.plnprepaid';
            else if($SERVER_PRODUCT=='NONTAGLIS')$param['SERVER_CLASS']='listener.switcher.v2.plnnontag';
            FormQServer::buildQServer($param);
            $i++;
            
            
        }
    }
    
    private function handleOnePort($param){
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-PLN-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].'-PLN-'.$param['SERVER_PORT'];
        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].'-0A-PLN-'.$param['SERVER_PORT'].'#1-Logger.xml';
        
        $diffProduct = array("POSTPAID"=>$param['SERVER_PORT'] + 123,"PREPAID"=>$param['SERVER_PORT'] + 234,"NONTAGLIS"=>$param['SERVER_PORT'] + 321);
        $SORT=array('-0B-','-0C-','-0D-');
        $i=0;
        $requestListener = array();
        $formQServer = new FormQServer();//create new instance for entire product in one qserver
        foreach($diffProduct as $SERVER_PRODUCT=>$GATEWAY_PORT){
            $param['SERVER_PRODUCT']=$SERVER_PRODUCT;
            $param['GATEWAY_IP']=  "localhost";
            $param['GATEWAY_PORT']= $GATEWAY_PORT;
            
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
            if($SERVER_PRODUCT=='POSTPAID')$param['SERVER_CLASS']='listener.switcher.v2.plnpostpaid';
            else if($SERVER_PRODUCT=='PREPAID')$param['SERVER_CLASS']='listener.switcher.v2.plnprepaid';
            else if($SERVER_PRODUCT=='NONTAGLIS')$param['SERVER_CLASS']='listener.switcher.v2.plnnontag';
            $requestListener = array_merge($requestListener, array($SERVER_PRODUCT=>FormQServer::buildRequestListener(FormQServer::$doc, $param)));
            $i++;
        }
        $param['SERVER_PORT']=$param['SERVER_PORT_1'];
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].'-0E-PLN-'.$param['SERVER_PORT'].'-QServer';
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].'-0E-PLN-'.$param['SERVER_PORT'].'#7-QServer.xml';
        $param['SERVER_PRODUCT']="PLN";
        FormLogger::buildLogger($param);
        FormQServer::buildQServer($param, $requestListener);
        
        //Create Freezer
        $a=0;
        foreach($diffProduct as $SERVER_PRODUCT=>$GATEWAY_PORT){
            $param['SERVER_PRODUCT']=$SERVER_PRODUCT;
            $param['SERVER_PORT'] = $GATEWAY_PORT;
            if($param['HAS_FREEZER']=="1"){
                $this->buildFreezerPLN($param, $SORT[$a]);
            }
            $a++;
        }
    }
    
    private function buildFreezerPLN($param, $sort){
        $param['SERVER_CLASS']='listener.uat.v2.Normal';
        $param['NAME_LOGGER'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'-Logger';
        $param['NAME_LOGGER_FILE'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'];
        $param['NAME_CHADAPTOR'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'-ChAdaptor_';
        $param['NAME_QMUX'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'-QMux_';
        $param['NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'-QMuxPooling';
        $param['NAME_QSERVER'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'-QServer';

        $param['FILE_NAME_LOGGER'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'#1-Logger.xml';
        $param['FILE_NAME_CHADAPTOR'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'#3-ChAdaptor_';
        $param['FILE_NAME_QMUX'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT']."#4-QMux_";
        $param['FILE_NAME_QMUXPOOLING'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT']."#5-QMuxPooling.xml";
        $param['FILE_NAME_QSERVER'] = $param['SERVER_NAME'].$sort.$param['SERVER_PRODUCT'].'-UAT-'.$param['SERVER_PORT'].'#6-QServer.xml';
        
        $param['GATEWAY_IP']=  InstancePortIP::$IP_GW_PLN;
        $param['GATEWAY_PORT']=  InstancePortIP::$PORT_GW_PLN;
        
        $param['SERVER_PRODUCT']='FREEZER-UAT';
        FormLogger::buildLogger($param);
        FormChannelAdaptor::buildChannelAdaptor($param);
        FormQmux::buildQmux($param);
        FormQmuxPooling::buildQMuxPooling($param);
        $formQServerFreezer = new FormQServer($param);
        $formQServerFreezer->buildQServer($param);

        
    }
    
}