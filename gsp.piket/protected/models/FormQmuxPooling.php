<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class FormQmuxPooling extends FormQmux{
    
 
    static public function buildQMuxPooling($param){
        $doc = new DOMDocument('1.0');
        $doc->formatOutput = true;
        $eltMuxPooling = $doc->createElement('mux-pooling');
        $attrClass = $doc->createAttribute('class');
        $attrClass->value = 'org.jpos.q2.iso.MUXPool';
        $attrName =  $doc->createAttribute('name');
        $attrName->value = $param['NAME_QMUXPOOLING'];
        $attrLogName = $doc->createAttribute('logger');
        $attrLogName->value= $param['NAME_LOGGER'];
        $eltMuxPooling->appendChild($attrClass);
        $eltMuxPooling->appendChild($attrName);
        $eltMuxPooling->appendChild($attrLogName);
        $nameMuxes=null;
        for($i=1;$i<=$param['CHANNEL_QUANTITY'];$i++){
            if($nameMuxes!=null){
                $nameMuxes = $nameMuxes." ".$param['NAME_QMUX'].$i;
            }else{
                $nameMuxes = $param['NAME_QMUX'].$i;
            }
        }
        $eltMuxes = $doc->createElement('muxes', $nameMuxes);
        $eltMuxPooling->appendChild($eltMuxes);
        $eltStrategy =  $doc->createElement('strategy', 'round-robin');
        $eltMuxPooling->appendChild($eltStrategy);
        $doc->appendChild($eltMuxPooling);
        $doc->save($param['DIR'].$param['FILE_NAME_QMUXPOOLING']);
        
    }
}