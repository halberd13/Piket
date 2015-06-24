<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class BuildFreezer{
    function __construct($param) {
        $formQServer = new FormQServer($param);
        $formQServer->buildQServer();
        $formLogger->buildLogger();
        $formDBPoll->buildDBPool();
        $formQmuxPooling->buildQMuxPooling();
        $formChAdaptor->buildChannelAdaptor();
    }
    
}