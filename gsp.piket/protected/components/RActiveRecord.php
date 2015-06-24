<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class RActiveRecord extends CActiveRecord {
 
    public static $db_name=null;
    public static $db_ip=null;
    private static $dbadvert = null;
    
    protected static function getAdvertDbConnection()
    {
 
        if (self::$dbadvert !== null)
            return self::$dbadvert;
        else
        {
//             $User=User::model()->findByPk(Yii::app()->user->id);
//             $db_name = $user->db_name;
 
 
             self::$dbadvert = Yii::createComponent(array(
             'class' => 'CDbConnection',
            // other config properties...
             'connectionString'=>"mysql:host=".self::$db_ip.";dbname=".self::$db_name, //dynamic database name here
              'enableProfiling' => true,
              'enableParamLogging' => true,
              'username'=>'root',
              'password'=> 'rahasia', //password here
              'charset'=>'utf8',
              'emulatePrepare' => true,
              'enableParamLogging'=>true,
              'enableProfiling' => true,
             ));
            Yii::app()->setComponent('dbadvert', self::$dbadvert);
 
            if (self::$dbadvert instanceof CDbConnection)
            {   
                Yii::app()->db->setActive(false);
                Yii::app()->dbadvert->setActive(true);
                return self::$dbadvert;
            }
            else{
                throw new CDbException(Yii::t('yii','Active Record requires a "db" CDbConnection application component.'));
            }
 
        }
    }
}