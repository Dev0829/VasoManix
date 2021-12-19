<?php


namespace app\helpers;


use app\models\User;

class UtilityHelper
{
    static public function isAdmin() {

        if (\Yii::$app->user->isGuest === FALSE && \Yii::$app->user->identity->role == User::ROLE_ADMIN)
            return TRUE;

        return FALSE;
    }
    static public function getCustomParameters($paramName) {

        return isset(\Yii::$app->params [$paramName]) ? \Yii::$app->params [$paramName] : '';
    }
    static public function cryptPass($x) {

        return crypt($x,
                     \Yii::$app->params['salt']);
    }

    public static function getClientIp() {

        $ipAddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipAddress = $_SERVER['HTTP_CLIENT_IP']; else if (isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED_FOR']; else if (isset($_SERVER['HTTP_X_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_X_FORWARDED']; else if (isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipAddress = $_SERVER['HTTP_FORWARDED_FOR']; else if (isset($_SERVER['HTTP_FORWARDED']))
            $ipAddress = $_SERVER['HTTP_FORWARDED']; else if (isset($_SERVER['REMOTE_ADDR']))
            $ipAddress = $_SERVER['REMOTE_ADDR']; else
            $ipAddress = 'UNKNOWN';

        return $ipAddress;
    }
}