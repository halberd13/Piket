<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormChannelAdaptor{
    
    static public function buildChannelAdaptor($param){
        for($i=1;$i<=$param['CHANNEL_QUANTITY'];$i++){
            $doc = new DOMDocument('1.0');
            $doc->formatOutput = true;
            $eltChannelAdaptor = $doc->createElement('channel-adaptor');
            $attrName = $doc->createAttribute('name');
            $attrName->value = $param['NAME_CHADAPTOR'].$i;
            $attrClass = $doc->createAttribute('class');
            if($param['CONNECTION_TYPE']=='connection-less'){
                $attrClass->value = 'org.jpos.q2.iso.OneShotChannelAdaptor';
            }else if ($param['CONNECTION_TYPE']=='connection-oriented'){
                $attrClass->value = 'org.jpos.q2.iso.ChannelAdaptor';
            }
            $attrLog = $doc->createAttribute('logger');
            $attrLog->value = $param['NAME_LOGGER'];
            $eltChannelAdaptor->appendChild($attrName);
            $eltChannelAdaptor->appendChild($attrClass);
            $eltChannelAdaptor->appendChild($attrLog);
            $eltChannel = $doc->createElement('channel');
            $attrNameChannel = $doc->createAttribute('name');
            $attrNameChannel->value = $param['NAME_CHADAPTOR'].$i.'-Channel';
            $attrClassChannel =  $doc->createAttribute('class');
            $attrClassChannel->value = $param['CLASS_CHANNEL'];
            $attrPackager = $doc->createAttribute('packager');
            $attrPackager->value='org.jpos.iso.packager.GenericPackager';
            $attrLogChannel = $doc->createAttribute('logger');
            $attrLogChannel->value= $param['NAME_LOGGER'];
            $eltChannel->appendChild($attrNameChannel);
            $eltChannel->appendChild($attrClassChannel);
            $eltChannel->appendChild($attrLogChannel);
            $eltChannel->appendChild($attrPackager);
            $eltProperty = new PropertyProduct();$eltProperty = $eltProperty->propertyChannelAdaptor($doc , $param);
            foreach($eltProperty as $property){
                $eltChannel->appendChild($property);
            }
            
            $eltIn = $doc->createElement('in', $param['NAME_CHADAPTOR'].$i.'-send');
            $eltOut = $doc->createElement('out', $param['NAME_CHADAPTOR'].$i.'-receive');
            $eltChannelAdaptor->appendChild($eltChannel);
            $eltChannelAdaptor->appendChild($eltIn);
            $eltChannelAdaptor->appendChild($eltOut);
            if($param['CONNECTION_TYPE']=='connection-less'){
                $eltMaxConnection = $doc->createElement('max-connections','5');
                $eltSpace = $doc->createElement('space', 'tspace:default');
            }else if ($param['CONNECTION_TYPE']=='connection-oriented'){
                $eltMaxConnection = $doc->createElement('reconnect-delay','5000');
                $eltSpace = $doc->createElement('space', 'tspace:default');
            }
            $eltChannelAdaptor->appendChild($eltMaxConnection);
            $eltChannelAdaptor->appendChild($eltSpace);
            $doc->appendChild($eltChannelAdaptor);
            $doc->save($param['DIR'].$param['FILE_NAME_CHADAPTOR'].$i.".xml");
        }
    }
    
}