<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormLogger extends FormQServer{
        
    static public function buildLogger($param){
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $eltLogger = $doc->createElement('logger');
        $attrName = $doc->createAttribute('name');
        $attrName->value = $param['NAME_LOGGER'];
        $attrClass = $doc->createAttribute('class');
        $attrClass->value = 'org.jpos.q2.qbean.LoggerAdaptor';
        $eltLogger->appendChild($attrName);
        $eltLogger->appendChild($attrClass);
        $eltLogListener_1 = $doc->createElement('log-listener');
        $attrClassLogListener = $doc->createAttribute('class');
        $attrClassLogListener->value = 'org.jpos.util.BufferedLogListener';
        $propertyLogListener = new PropertyProduct();
        $propertyLogListener_1 = $propertyLogListener->propertyLogListener($doc, $param['NAME_LOGGER_FILE']);
        $eltLogListener_1->appendChild($attrClassLogListener);
        for($i=0;$i<2;$i++) $eltLogListener_1->appendChild($propertyLogListener_1[$i]);
        $eltLogListener_2= $doc->createElement('log-listener');
        $attrClassLogListener_2 = $doc->createAttribute('class');
        $attrClassLogListener_2->value = 'org.jpos.util.DailyLogListener';
        $propertyLogListener_2 = $propertyLogListener->propertyLogListener($doc, $param['NAME_LOGGER_FILE']);
        $eltLogListener_2->appendChild($attrClassLogListener_2);
        for($i=2;$i<count($propertyLogListener_2);$i++) $eltLogListener_2->appendChild($propertyLogListener_2[$i]);
        $eltLogger->appendChild($eltLogListener_1);
        $eltLogger->appendChild($eltLogListener_2);
        $doc->appendChild($eltLogger);
        $doc->save($param['DIR'].$param['FILE_NAME_LOGGER']);
    }
    
    
}