<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class PropertyProduct{
    
    public function propertyQserverPDAM(DOMDocument $doc, $param){
        $attrProperty = array(
               "kd-sw" => "GS10AG3",
                "max-load"=> "1000",
                "timeout"=> "30000",
                "maintaincentralid" => "n"  ,
                "admin" => "1600",
                "debetbalance"=> "n"  ,
                "debetincludeadmin" => "y"  ,
                "cutoff-begin"=> "23:45:00",
                "cutoff-end"=> "00:15:00",
                "merchantreg"=> "6012#6012,6015#6015,5111#6014,5112#6013,6010#6010,6017#6017",
                "product_biller"=> $param['BILLER_PRODUCT'],
                "bankcodereg"=> $param['BANK_CODE'],
                "centralidreg"=> $param['CID'],
                "selfsignon"=> $param['CID'],
                "selfsignonbyotherbank" => "090301#090301",
                "map39" => "0000#00",
                "logca" => "y"  ,
                "autoreversal"=> "n"  ,
                "info-text" => "PDAM MENYATAKAN RESI INI SEBAGAI BUKTI PEMBAYARAN YANG SAH",
                "DBPoolName1"=> $param['NAME_DBPOOL']."-DBPool",
                "DBPoolName2"=> $param['NAME_DBPOOL']."-DBPool",
                "destination-mux"=> $param['NAME_QMUXPOOLING'],
                "autoreversal"=> "y"  ,
                "autoadvice"=> "n"  ,
                "freezePayment" => "n"  ,
                "freezeReversal"=> "n"  ,
                "freezeAdvice"=> "n"  ,
                "freezeDuration"=> "60000"
        );
        return $this->buildProperty($doc, $attrProperty);
    }
    public function propertyQserverPayTV(DOMDocument $doc, $param){
        $attrProperty = array(
               "kd-sw"=>"GS10AG3",
                "max-load"=>"1000",
                "timeout"=>"30000",       
                "area"=>"",      
                "maintaincentralid"=>"n",   
                "admin"=>"0",                        
                "debetbalance"=>"y",                        
                "debetincludeadmin"=>"y",                        
                "cutoff-begin"=>"23:45:00",      
                "cutoff-end"=>"00:15:00",      
                "selfsignon"=>$param['CID']."#".$param['CID'],           
                "selfsignonbyotherbank"=>$param['CID']."#".$param['CID'],    
                "map39"=>"0000#00",                       
                "logca"=>"y",            
                "autoreversal"=>"n",            
                "DBPoolName"=>$param['NAME_DBPOOL']."-DBPool",
                "destination-mux"=> $param['NAME_QMUXPOOLING'],
        );
        return $this->buildProperty($doc, $attrProperty);
    }
    public function propertyChannelAdaptor(DOMDocument $doc, $param){
        $attrProperty = array(
            "connect-timeout"=>"5000",
            "timeout"=>"30000",
            "host"=>$param['GATEWAY_IP'],
            "port"=>$param['GATEWAY_PORT'],
            "alternate-host"=>"127.0.0.1",
            "alternate-port"=>"30141",
            "packager-config"=>$param['SERVER_CFG']
        );
        return $this->buildProperty($doc, $attrProperty);
    }
  
    public function propertyLogListener(DOMDocument $doc, $SERVER_LOG){
        $attrProperty=array(
            "max-size"=>"1",
            "name"=>"logger.Q2.buffered",
            "window"=>"86400",
            "prefix"=>'log/'.$SERVER_LOG,
            "suffix"=>".log",
            "date-format"=>"-yyyyMMdd",
            "compression-format"=>"gzip"
        );
        return $this->buildProperty($doc, $attrProperty);
    }
    
    public function propertyDBPool(DOMDocument $doc){
        $attrProperty=array(
            "jdbc.driver"=>"com.mysql.jdbc.Driver",
            "jdbc.url"=>"jdbc:mysql://localhost:3306/GSP_SWITCHER_DEMO_2",
            "jdbc.user"=>"sw_user_demo",
            "sql-check-statement"=>"select now()",
            "jdbc.password"=>"sw_pwd_demo",
            "initial-connections"=>"5",
            "startup-connections"=>"5",
            "max-connections"=>"10",
            "wait-if-busy"=>"false"
        );
        return $this->buildProperty($doc, $attrProperty);
    }
    
    
    public function propertyQserverPLN(DOMDocument $doc, $param){
        $attrProperty=array(
            "kd-sw"=>"GS10AG3",
            "max-load"=>"1200",
            "timeout"=>"20000",
            "area"=>"",
            "ceksignon"=>"y",
            "maintaincentralid"=>"n",
            "admin"=>"1600",
            "debetbalance"=>"n",
            "debetincludeadmin"=>"y",
            "cutoff-begin"=>"23:45:00",
            "cutoff-end"=>"00:15:00",
            "bankcodereg"=>$param['BANK_CODE']."#".$param['BANK_CODE'],
            "centralidreg"=>$param['CID']."#".$param['CID'],
            "selfsignon"=>$param['CID']."#".$param['CID'],
            "selfsignonbyotherbank"=>$param['BANK_CODE']."#".$param['BANK_CODE'],
            "map39"=>"0000#00",
            "logca"=>"y",
            "info-text"=>"Rincian Tagihan dapat diakses di www.pln.co.id atau PLN terdekat",
            "destination-mux"=> $param['NAME_QMUXPOOLING'],
            "DBPoolName"=> $param['NAME_DBPOOL'].'-DBPool',
        );
        if($param['SERVER_PRODUCT']=="POSTPAID" || $param['SERVER_PRODUCT']=="NONTAGLIS"){
            $addAttr = array(
                "autoreversal"=>"n",
                "usepaymentrefnum"=>"y",
                "numericswitcherrefnum"=>"y",
                "cekadmin"=>"y",
                "adminbymerchant"=>"n",
                "tightadmin"=>"n",
            );
            $attrProperty= array_merge($attrProperty, $addAttr);
        }else if($param['SERVER_PRODUCT']=="PREPAID"){
            $addAttr =  array(
                "autoadvice"=>"n",
                "autounsoldtoken"=>"n",
                "minpayment"=>"20000",
                "maxpayment"=>"1000000",
                "usepaymentrefnum"=>"y",
                "numericswitcherrefnum"=>"y",
                "cekadmin"=>"y",
                "adminbymerchant"=>"n",
                "tightadmin"=>"n",
            );
            $attrProperty = array_merge($attrProperty, $addAttr);
        } 
        return $this->buildProperty($doc, $attrProperty);
    }
    
    public function propertyQserverMultifinance(DOMDocument $doc, $param){
        $attrProperty=array(
            "kd-sw"=>"GS10AG3",
            "max-load"=>"1200",
            "timeout"=>"20000",
            "ceksignon"=>"y",
            "maintaincentralid"=>"n",
            "admin"=>"1600",
            "debetbalance"=>"n",
            "debetincludeadmin"=>"y",
            "product"=>$param['BILLER_CODE'],
            "cutoff-begin"=>"23:45:00",
            "cutoff-end"=>"00:15:00",
            "merchantreg"=>$param['DC_TYPE'],
            "cekdeposit"=>"y",
            "bankcodereg"=>$param['BANK_CODE']."#".$param['BANK_CODE'],
            "centralidreg"=>$param['CID']."#".$param['CID'],
            "selfsignon"=>$param['CID']."#".$param['CID'],
            "selfsignonbyotherbank"=>$param['BANK_CODE']."#".$param['BANK_CODE'],
            "map39"=>"0000#00".",0014#14",
            "logca"=>"y",
            "info-text"=>"Bukti pembayaran ini adalah sah",
            "destination-mux"=> $param['NAME_QMUXPOOLING'],
            "DBPoolName"=> $param['NAME_DBPOOL'].'-DBPool',
        );
        if($param['SERVER_PRODUCT']=="TEKTAYA-FIF" ){
            $addAttr = array(
                "autoadvice"=>"n",
            );
            $attrProperty= array_merge($attrProperty, $addAttr);
        }else{
            $addAttr =  array(
                "autoreversal"=>"n",
            );
            $attrProperty = array_merge($attrProperty, $addAttr);
        } 
        return $this->buildProperty($doc, $attrProperty);
    }
    
    
    public function propertyFreezer(DOMDocument $doc, $param){
        $attrProperty=array(
            "delay_inq_request"=>"0",
            "delay_inq_response"=>"0",
            "delay_pay_request"=>"0",
            "delay_pay_response"=>"0",
            "delay_adv_request"=>"0",
            "delay_adv_response"=>"0",
            "delay_advrepeat_request"=>"0",
            "delay_advrepeat_response"=>"0",
            "delay_rev_request"=>"0",
            "delay_rev_response"=>"0",
            "delay_revrepeat_request"=>"0",
            "delay_revrepeat_response"=>"0",
            "timeout"=>"20000",
            "destination-mux"=>$param['NAME_QMUXPOOLING'],
        );
        return $this->buildProperty($doc, $attrProperty);
    }
    
    
    public function buildProperty(DOMDocument $doc, array $attr){
        $i=0;
        foreach($attr as $name => $value){
            $eltProperty[$i] = $doc->createElement('property');
            $attrPropertyName[$i] = $doc->createAttribute('name'); 
            $attrPropertyName[$i]->value = $name; 
            $attrPropertyValue[$i] = $doc->createAttribute('value');
            $attrPropertyValue[$i]->value= $value;
            $eltProperty[$i]->appendChild($attrPropertyName[$i]);
            $eltProperty[$i]->appendChild($attrPropertyValue[$i]);
            $i++;
        }
        unset($i);
        return $eltProperty;
        
    }
    
    public static function explodeDcType($param){
        $rVal = null;
        foreach($param['DC_TYPE'] as $selected){
            if($rVal!=null) $rVal=$rVal.','.$selected.'#'.$selected;
            else $rVal=$selected.'#'.$selected;
        }
        return $rVal;
    }
    
}