<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormQmux extends FormChannelAdaptor{
   
    static public function buildQmux($param){
        for($i=1;$i<=$param['CHANNEL_QUANTITY'];$i++){
            $doc = new DOMDocument('1.0');
            $doc->formatOutput = true;
            $eltMux = $doc->createElement('mux');
            $attrClass = $doc->createAttribute('class');
            $attrClass->value= 'mux.MuxPLN';
            $attrLog = $doc->createAttribute('logger');
            $attrLog->value = $param['NAME_LOGGER'];
            $attrName = $doc->createAttribute('name');
            $attrName->value= $param['NAME_QMUX'].$i;
            $eltIn = $doc->createElement('in', $param['NAME_CHADAPTOR'].$i.'-receive');
            $eltOut = $doc->createElement('out', $param['NAME_CHADAPTOR'].$i.'-send');
            $eltMux->appendChild($attrClass);
            $eltMux->appendChild($attrLog);
            $eltMux->appendChild($attrName);
            $eltMux->appendChild($eltIn);
            $eltMux->appendChild($eltOut);
            if($param['CONNECTION_TYPE']=='connection-oriented'){
                $eltReady = $doc->createElement('ready', $param['NAME_CHADAPTOR'].$i.'.ready');
                $eltMux->appendChild($eltReady);
            }
            $doc->appendChild($eltMux);
            $doc->save($param['DIR'].$param['FILE_NAME_QMUX'].$i.".xml");
        }
    }
}