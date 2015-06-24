<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RouteProduct{

    public $CSCCORE_DOWN_CENTRAL;
    public $CSCCORE_BANK_DOWNLINE;
    public $CSCCORE_CID_QUOTA=array();
    public $ACCESS_TIME= array();
    public $history = array();


    public function __construct($post){
        $this->doRoute($post);
    }

    private function doRoute($post){
        $this->insertDownCentral($post);
        $this->insertBankDownline($post);
        $this->insertAccessTime($post);
        $this->insertQuotaBalance($post);
    }
    
    private function insertQuotaBalance($post){
        $biller_code = $post['CSC_BI_ID'];
        foreach($biller_code as $biller){
            array_push($this->CSCCORE_CID_QUOTA, array("CSCCORE_CID_QUOTA"=>"INSERT INTO GSP_NEW_SWITCH.CSCCORE_CID_QUOTA (CSC_CQ_CID, CSC_CQ_PAN, CSC_CQ_MASTERQUOTA_ID) 
	VALUES ('".$post['CSC_DC_ID']."', '".$biller."', '".$post['CSC_DC_ID']."');"));
        }
        array_push($this->CSCCORE_CID_QUOTA, array("CSCCORE_CID_MASTER_QUOTA"=>"INSERT INTO GSP_NEW_SWITCH.CSCCORE_CID_MASTER_QUOTA (CSC_CMQ_ID, CSC_CMQ_BALANCE, CSC_CMQ_MAXQUOTA, CSC_CMQ_MINQUOTA, CSC_CMQ_LASTMOD, CSC_CMQ_LASTUPDATED, CSC_CMQ_SUBID, CSC_CMQ_NAME) 
	VALUES ('".$post['CSC_DC_ID']."', 100000000, NULL, 100000.0, '".date('Y-m-d H:i:s')."', '".date('Y-m-d H:i:s')."', NULL, NULL);"));
    }

    private function insertBankDownline($post){
        $arrBiller = $post['CSC_BI_ID'];
        $CSCCORE_BANK_DOWNLINE=1;
        $CSCMOD_WAU_CENTRAL_ADM_FEE=1;
        $array = array();
        foreach($arrBiller as $kode_biller){
            array_push($array, "INSERT INTO GSP_SWITCHER_DEMO_2.CSCCORE_BANK_DOWNLINE (CSC_B_ID, CSC_D_ID, CSC_BI_ID) VALUES ('".$post['CSC_B_ID']."', '".$post['CSC_DC_ID']."', '".$kode_biller."');");

//            $this->CSCCORE_BANK_DOWNLINE = new CSCCOREBANKDOWNLINE();
//            $this->CSCCORE_BANK_DOWNLINE->CSC_B_ID = $post['CSC_B_ID'];
//            $this->CSCCORE_BANK_DOWNLINE->CSC_D_ID = $post['CSC_DC_ID'];
//            $this->CSCCORE_BANK_DOWNLINE->CSC_BI_ID = $kode_biller;
//            if($this->CSCCORE_BANK_DOWNLINE->save(true)){
//                $CSCCORE_BANK_DOWNLINE++;
//            }
//            $this->CSCMOD_WAU_CENTRAL_ADM_FEE = new CSCMODWAUCENTRALADMFEE();
//            $this->CSCMOD_WAU_CENTRAL_ADM_FEE->CSM_CAF_CID=$post['CSC_DC_ID'];
//            $this->CSCMOD_WAU_CENTRAL_ADM_FEE->CSM_CAF_FEE=$post['CSM_CAF_FEE'];
//            $this->CSCMOD_WAU_CENTRAL_ADM_FEE->CSM_CAF_CREATED=date('Y-m-d H:i:s');
//            $this->CSCMOD_WAU_CENTRAL_ADM_FEE->CSM_CAF_BIID = $kode_biller;
//            if($this->CSCMOD_WAU_CENTRAL_ADM_FEE->save(true)){
//                $CSCMOD_WAU_CENTRAL_ADM_FEE++;
//            }
        }
//        array_push($history, array("CSCCORE_BANK_DOWNLINE"=>$CSCCORE_BANK_DOWNLINE-1));
//        array_push($history, array("CSCMOD_WAU_CENTRAL_ADM_FEE"=>$CSCMOD_WAU_CENTRAL_ADM_FEE-1));
        return $this->CSCCORE_BANK_DOWNLINE = $array;
    }

    private function insertDownCentral($post){
        $this->CSCCORE_DOWN_CENTRAL = "INSERT INTO GSP_SWITCHER_DEMO_2.CSCCORE_DOWN_CENTRAL (CSC_DC_ID, CSC_DC_NAME, CSC_DC_CITY, CSC_DC_ADDRESS, CSC_DC_PHONE, CSC_DC_PIC_NAME, CSC_DC_PIC_PHONE, CSC_DC_TYPE, CSC_DC_TERMINAL_TYPE, CSC_DC_PARTNER_CODE, CSC_DC_REGISTERED, CSC_DC_ISBLOCKED)
	VALUES ('".$post['CSC_DC_ID']."', '".$post['CSC_DC_NAME']."', '".$post['CSC_DC_CITY']."', 'Bandung City', null, '".$post['CSC_DC_PIC_NAME']."', null, 1, '6012', NULL, '".date('Y-m-d H:i:s')."', 0);
        ";
//        $this->CSCCORE_DOWN_CENTRAL = new CSCCOREDOWNCENTRAL();
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_ID=$post['CSC_DC_ID'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_NAME=$post['CSC_DC_NAME'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_CITY=$post['CSC_DC_CITY'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_ADDRESS="Bandung City";
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_PIC_NAME=$post['CSC_DC_PIC_NAME'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_PHONE=$post['CSC_DC_PHONE'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_PIC_PHONE=null;
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_TERMINAL_TYPE="6012";
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_TYPE=$post['CSC_DC_TYPE'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_PARTNER_CODE=$post['CSC_DC_PARTNER_CODE'];
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_REGISTERED=date('Y-m-d H:i:s');
//        $this->CSCCORE_DOWN_CENTRAL->CSC_DC_ISBLOCKED=0;

//        if($this->CSCCORE_DOWN_CENTRAL->save(true)){
//            array_push($history, array("CSCCORE_DOWN_CENTRAL"=>$CSCCORE_DOWN_CENTRAL=1));
//        }
        return $this->CSCCORE_DOWN_CENTRAL;
    }

    private function insertAccessTime($post){
        $ACCESS_TIME=0;
        $array= array();
        for($i=0;$i<7;$i++){
            $day=null;
            if($i==0) $day ="Monday";
            else if($i==1) $day ="Tuesday";
            else if($i==2) $day ="Wednesday";
            else if($i==3) $day ="Thursday";
            else if($i==4) $day ="Friday";
            else if($i==5) $day ="Saturday";
            else if($i==6) $day ="Sunday";
            array_push($this->ACCESS_TIME, 
                    "INSERT INTO GSP_SWITCHER_DEMO_2.CSCMOD_WAU_ACC_ALTIME_CTL 
                        (CSM_ATC_ID, CSM_ATC_NAME, CSM_ATC_CID, CSM_ATC_DESC, CSM_ATC_ALLOW_WDAY, CSM_ATC_ALLOW_TIME_START, CSM_ATC_ALLOW_TIME_END, CSM_ATC_CREATED, CSM_ATC_CREATORUID, CSM_ATC_CREATORUNAME, CSM_ATC_LASTMOD, CSM_ATC_LASTMODERUID, CSM_ATC_LASTMODERUNAME) 
                        VALUES 
                        ('".$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i."', '".$post['CSC_DC_NAME']."- ".$day."', '".$post['CSC_DC_ID']."', NULL, ".$i.", '00:00:00', '23:59:59', '".date('Y-m-d H:i:s')."', 'u1', 'comm', '".date('Y-m-d H:i:s')."', 'u1', 'comm');");
            
        }
        return $this->ACCESS_TIME;
    }

    private function insertAccessTimePDAM($post){
        $CSCMOD_WAU_ACC_ALTIME_CTL=0;
        for($i=0;$i<7;$i++){
            $this->CSCMOD_WAU_ACC_ALTIME_CTL = new CSCMODWAUACCALTIMECTL();
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_ID=$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i;
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_NAME=$post['CSC_DC_NAME'];
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_CID=$post['CSC_DC_ID'];
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_DESC=null;
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_ALLOW_WDAY=$i;
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_START="00:00:00";
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_END="23:59:59";
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_CREATED=date('Y-m-d H:i:s');
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_CREATORUID="devel";
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_CREATORUNAME="id.co.gsp";
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_LASTMOD=date('Y-m-d H:i:s');
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUID="devel";
            $this->CSCMOD_WAU_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUNAME="id.co.gsp";
            if($this->CSCMOD_WAU_ACC_ALTIME_CTL->save(true)){
                $CSCMOD_WAU_ACC_ALTIME_CTL=$i+1;
            }
        }
        array_push($history, array("CSCMOD_WAU_ACC_ALTIME_CTL"=>$CSCMOD_WAU_ACC_ALTIME_CTL));
    }
    private function insertAccessTimePhone($post){
        $CSCMOD_PHONE_ACC_ALTIME_CTL=0;
        for($i=0;$i<7;$i++){
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL = new CSCMODPHONEACCALTIMECTL();
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_ID=$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i;
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_NAME=$post['CSC_DC_NAME'];
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_CID=$post['CSC_DC_ID'];
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_DESC=null;
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_WDAY=$i;
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_START="00:00:00";
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_END="23:59:59";
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_CREATED=date('Y-m-d H:i:s');
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_CREATORUID="devel";
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_CREATORUNAME="id.co.gsp";
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_LASTMOD=date('Y-m-d H:i:s');
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUID="devel";
            $this->CSCMOD_PHONE_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUNAME="id.co.gsp";
            if($this->CSCMOD_PHONE_ACC_ALTIME_CTL->save(true)){
                $CSCMOD_PHONE_ACC_ALTIME_CTL=$i+1;
            }
        }
        array_push($history, array("CSCMOD_PHONE_ACC_ALTIME_CTL"=>$CSCMOD_PHONE_ACC_ALTIME_CTL));
    }

    private function insertAccessTimePostpaid($post){
        $CSCMOD_EL_POST_ACC_ALTIME_CTL=0;
        for($i=0;$i<7;$i++){
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL = new CSCMODELPOSTACCALTIMECTL();
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_ID=$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i;
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_NAME=$post['CSC_DC_NAME'];
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_CID=$post['CSC_DC_ID'];
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_DESC=null;
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_ALLOW_WDAY=$i;
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_START="00:00:00";
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_END="23:59:59";
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_CREATED=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_CREATORUID="devel";
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_CREATORUNAME="id.co.gsp";
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_LASTMOD=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUID="devel";
            $this->CSCMOD_EL_POST_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUNAME="id.co.gsp";
            if($this->CSCMOD_EL_POST_ACC_ALTIME_CTL->save(true)){
                $CSCMOD_EL_POST_ACC_ALTIME_CTL=$i+1;
            }
        }
        array_push($history, array("CSCMOD_EL_POST_ACC_ALTIME_CTL"=>$CSCMOD_EL_POST_ACC_ALTIME_CTL));
    }

    private function insertAccessTimePrepaid($post){
        $CSCMOD_EL_PRE_ACC_ALTIME_CTL=0;
        for($i=0;$i<7;$i++){
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL = new CSCMODELPREACCALTIMECTL();
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_ID=$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i;
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_NAME=$post['CSC_DC_NAME'];
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_CID=$post['CSC_DC_ID'];
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_DESC=null;
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_WDAY=$i;
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_START="00:00:00";
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_END="23:59:59";
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_CREATED=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_CREATORUID="devel";
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_CREATORUNAME="id.co.gsp";
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_LASTMOD=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUID="devel";
            $this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUNAME="id.co.gsp";
            if($this->CSCMOD_EL_PRE_ACC_ALTIME_CTL->save(true)){
                $CSCMOD_EL_PRE_ACC_ALTIME_CTL=$i+1;
            }
        }
        array_push($history, array("CSCMOD_EL_PRE_ACC_ALTIME_CTL"=>$CSCMOD_EL_PRE_ACC_ALTIME_CTL));
    }

    private function insertAccessTimeNontaglis($post){
        $CSCMOD_EL_NTAG_ACC_ALTIME_CTL=0;
        for($i=0;$i<7;$i++){
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL = new CSCMODELNTAGACCALTIMECTL();
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_ID=$post['CSC_DC_PARTNER_CODE'].$post['CSC_DC_ID'].$i;
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_NAME=$post['CSC_DC_NAME'];
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_CID=$post['CSC_DC_ID'];
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_DESC=null;
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_ALLOW_WDAY=$i;
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_START="00:00:00";
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_ALLOW_TIME_END="23:59:59";
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_CREATED=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_CREATORUID="devel";
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_CREATORUNAME="id.co.gsp";
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_LASTMOD=date('Y-m-d H:i:s');
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUID="devel";
            $this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->CSM_ATC_LASTMODERUNAME="id.co.gsp";
            if($this->CSCMOD_EL_NTAG_ACC_ALTIME_CTL->save(true)){
                $CSCMOD_EL_NTAG_ACC_ALTIME_CTL=$i+1;
            }
        }
        array_push($history, array("CSCMOD_EL_NTAG_ACC_ALTIME_CTL"=>$CSCMOD_EL_NTAG_ACC_ALTIME_CTL));
    }



}