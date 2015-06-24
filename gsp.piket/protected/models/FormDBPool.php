<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormDBPool extends FormQServer{
    
    
    static public function buildDBPool($param){
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $eltConnectionPool = $doc->createElement('connection-pool');
        $attrNameConn = $doc->createAttribute('name');
        $attrNameConn->value = $param['NAME_DBPOOL']."-DBPool";
        $attrClassConn = $doc->createAttribute('class');
        $attrClassConn->value = 'persistent.GSPConnectionPool';
        $attrLog = $doc->createAttribute('logger');
        $attrLog->value= $param['NAME_LOGGER'];
        $eltConnectionPool->appendChild($attrNameConn);
        $eltConnectionPool->appendChild($attrClassConn);
        $eltConnectionPool->appendChild($attrLog);
        $propertyDBPool = new PropertyProduct();
        foreach($propertyDBPool->propertyDBPool($doc) as $property){
            $eltConnectionPool->appendChild($property);
        }
        $doc->appendChild($eltConnectionPool);
        $doc->save($param['DIR'].$param['FILE_NAME_DBPOOL']);
    }
}