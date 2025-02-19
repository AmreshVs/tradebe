<?php
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@vendor', dirname(dirname(__DIR__)) . '/app/vendor');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@upload', dirname(dirname(__DIR__)) . '/upload');

define('ACCESS_RULE_VENDOR','vendor');
define('ACCESS_RULE_ADMIN','admin');
