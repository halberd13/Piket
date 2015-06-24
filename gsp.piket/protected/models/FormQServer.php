<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormQServer {
    
    public static $doc;
    
    function __construct() {
        static::$doc = new DOMDocument('1.0');
    }

    static public function buildQServer($param, $requestListener=null){
        if($requestListener!=null) $doc = self::$doc;
        else $doc= new DOMDocument ('1.0');
        $doc->formatOutput = true;
        $eltServer = $doc->createElement('server');
        $attrServerName = $doc->createAttribute('name');
        $attrServerName->value=$param['NAME_QSERVER'];
        $attrServerClass = $doc->createAttribute('class');
        $attrServerClass->value='org.jpos.q2.iso.QServer';
        $attrServerLogger = $doc->createAttribute('logger');
        $attrServerLogger->value=  $param['NAME_LOGGER'];
        $eltServer->appendChild($attrServerName);
        $eltServer->appendChild($attrServerClass);
        $eltServer->appendChild($attrServerLogger);
        
        $attrAttr = $doc->createElement('attr',$param['SERVER_PORT']);
        $attrName = $doc->createAttribute('name');
        $attrName->value = 'port';
        $attrType = $doc->createAttribute('type');
        $attrType->value='java.lang.Integer';
        $attrAttr->appendChild($attrName);
        $attrAttr->appendChild($attrType);
        $eltServer->appendChild($attrAttr);
        $eltServer->appendChild(self::buildChannel($doc, $param));
        if($requestListener!=null){
            foreach($requestListener as $products=>$requestListener){
                $eltServer->appendChild($requestListener);
            }
        }else {
            $eltServer->appendChild(self::buildRequestListener($doc, $param));
        }
        
        $eltServer->appendChild(self::buildRequestListenerUnhandle($doc, $param));
        $doc->appendChild($eltServer);
        $doc->save($param['DIR'].$param['FILE_NAME_QSERVER']);
    }
    
    private function buildChannel(DOMDocument $doc, $param){
        $eltChannel = $doc->createElement('channel');
        $attrChannelName = $doc->createAttribute('name');
        $attrChannelName->value = $param['NAME_QSERVER'].'Channel';
        $attrChannelClass = $doc->createAttribute('class');
        $attrChannelClass->value = $param['CLASS_CHANNEL'];
        $attrChannelLogger = $doc->createAttribute('logger');
        $attrChannelLogger->value = $param['NAME_LOGGER'];
        $attrChannelPackager = $doc->createAttribute('packager');
        $attrChannelPackager->value = 'org.jpos.iso.packager.GenericPackager';
        
        $eltChannelProperty = $doc->createElement('property');
        $attrChannelPropertyName =  $doc->createAttribute('name');
        $attrChannelPropertyName->value='packager-config';
        $attrChannelPropertyValue =  $doc->createAttribute('value');
        $attrChannelPropertyValue->value = $param['SERVER_CFG'];
        $eltChannelProperty->appendChild($attrChannelPropertyName);
        $eltChannelProperty->appendChild($attrChannelPropertyValue);
        
        $eltChannel->appendChild($attrChannelName);
        $eltChannel->appendChild($attrChannelClass);
        $eltChannel->appendChild($attrChannelClass);
        $eltChannel->appendChild($attrChannelLogger);
        $eltChannel->appendChild($attrChannelPackager);
        $eltChannel->appendChild($eltChannelProperty);
        
        return $eltChannel;
    }
    
    
    public static function buildRequestListener(DOMDocument $doc, $param){
        try {
            $eltRequestListener = $doc->createElement('request-listener');
            $attrReqListenerClass = $doc->createAttribute('class');
            $attrReqListenerClass->value = $param['SERVER_CLASS'];
            $attrReqListenerLogger = $doc->createAttribute('logger');
            if(isset($param['NAME_LOGGER_PRIVATE'])){
                $attrReqListenerLogger->value = $param['NAME_LOGGER_PRIVATE'];
            }else{
                $attrReqListenerLogger->value = $param['NAME_LOGGER'];
            }
            $attrReqListenerRealm =  $doc->createAttribute('realm');
            $attrReqListenerRealm->value=$param['SERVER_PRODUCT'];
            $eltRequestListener->appendChild($attrReqListenerClass);
            $eltRequestListener->appendChild($attrReqListenerLogger);
            $eltRequestListener->appendChild($attrReqListenerRealm);
            $propertyProduct = new PropertyProduct();
            if(substr($param['SERVER_PRODUCT'],0,4)=="PDAM"){
                $listProperty = $propertyProduct->propertyQserverPDAM($doc, $param);
            }else if($param['SERVER_PRODUCT']=='POSTPAID' || $param['SERVER_PRODUCT']=='PREPAID' || $param['SERVER_PRODUCT']=='NONTAGLIS' ){
                $listProperty = $propertyProduct->propertyQserverPLN($doc, $param);
            }else if($param['SERVER_PRODUCT']=='VSI-WOM' || $param['SERVER_PRODUCT']=='VSI-MAF_MCF' || $param['SERVER_PRODUCT']=='VSI-BAF' || $param['SERVER_PRODUCT']=='TEKTAYA-FIF' ){
                $listProperty = $propertyProduct->propertyQserverMultifinance($doc, $param);
            }else if($param['SERVER_PRODUCT']=='FM_PAYTV'){
                $listProperty = $propertyProduct->propertyQserverPayTV($doc, $param);
            }else if($param['SERVER_PRODUCT']=='FREEZER-UAT'){
                $listProperty = $propertyProduct->propertyFreezer($doc, $param);
            }
            foreach($listProperty as $property){
                $eltRequestListener->appendChild($property);
            }
        }catch (Exception $ex) {
            throw new CHttpException(031,'Failed to Create. Server Product doesn\'t exist.');
        }finally{
            return $eltRequestListener;
        }
        
        
    }
    

    
    private function buildRequestListenerUnhandle(DOMDocument $doc, $param){
        $eltRequestListenerUnhandle = $doc->createElement('request-listener');
        $attrReqListenerClass = $doc->createAttribute('class');
        $attrReqListenerClass->value = 'listener.switcher.unhandleproduct';
        $attrReqListenerLogger = $doc->createAttribute('logger');
        $attrReqListenerLogger->value = $param['NAME_LOGGER'];
        $attrReqListenerRealm =  $doc->createAttribute('realm');
        $attrReqListenerRealm->value= 'Unhandle';
        $eltRequestListenerUnhandle->appendChild($attrReqListenerClass);
        $eltRequestListenerUnhandle->appendChild($attrReqListenerLogger);
        $eltRequestListenerUnhandle->appendChild($attrReqListenerRealm);
        
        return $eltRequestListenerUnhandle;
    }
    
}

