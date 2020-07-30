<?php

namespace common\helper;


use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\helpers\StringHelper;
use yii\helpers\Url;


class Coms
{
    /**
     *
     */
    const SUCCESS = 200;
    const ERROR = 422;
    const DELETE = 100;
    const FILTER = 'FILTER_';
    const PLACEHOLDER_DEFAULT = 'default';
    const PLACEHOLDER_BANNER = 'banner';

    const ITEM_SEPERATOR = ':';
    const INGREDIENT_SEPERATOR = ',';
    const MAX_QUANTITY = 100;

    const SES_CART = 'SES_CART';
    const SES_CHECKOUT = 'SES_CHECKOUT';
    const ITEM_BRANCH = 'ITEM_BRANCH';

    const UNAUTHORIZED = 401; 

    const ITEM_COUNT = 'ITEM_COUNT';

    const COUPON_CODE = 'COUPON_CODE';
    const DELIVERY_TIP = 'TIP';

    /**
     * @param $path
     * @param bool $echo
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public static function res($path, $echo = true, $scheme = false)
    { 
        $path = ltrim($path, '/');

        $app = Yii::getAlias('@app');
        if ($app === Yii::getAlias('@api')) {
            $app = Yii::getAlias('@frontend');
        }
        $app = basename($app);

        $path = sprintf('/%s/web/theme/%s', $app, $path);

        if ($scheme) {
            $path = sprintf('%s/%s', Yii::$app->getRequest()->getHostInfo(), ltrim($path, '/'));
        }

        if ($echo === false) {
            return $path;
        }

        echo $path;
    }
    /**
     * @param $path
     * @param bool $echo
     * @param bool $scheme
     * @return string
     * @throws \yii\base\InvalidParamException
     */
    public static function checkExist($url, $scheme = true)
    {
        $checkingPath = Yii::getAlias('@approot').$url;
        if (!file_exists($checkingPath)) {
            $cofigModel = new \backend\models\Configuration;
            $placeholder_image = Yii::$app->getRequest()->getHostInfo().'/'.$cofigModel::get($cofigModel::APP_PLACEHOLDER_PATH);
            return $placeholder_image;
        }
        if ($scheme) {
            return Yii::$app->getRequest()->getHostInfo().'/'.$url;
        }
        return $url;
    }

     public static function checkExistImage($url, $scheme = true)
    {
        $checkingPath = Yii::getAlias('@approot').$url;
        if (!file_exists($checkingPath)) {
            
            return $checkingPath;
        }
        if ($scheme) {
            return Yii::$app->getRequest()->getHostInfo().'/'.$url;
        }
        return $url;
    }

    /**
     * @param $path
     * @param bool $echo
     * @return mixed
     */
    public static function front_res($path, $echo = true, $host = false)
    {
        $path = ltrim($path, '/');
        $path = sprintf('/frontend/web/theme/%s', $path);
        if ($host === true) {
            return Yii::$app->request->hostInfo . $path;
        }
        if ($echo === false) {
            return $path;
        } else {
            echo $path;
        }


    }

    /**
     * Method to generate an random string of length 16 by default
     *
     * @param int $length
     * @param bool $escSpecialChar
     * @return bool|string
     * @throws \yii\base\InvalidParamException
     * @throws \yii\base\Exception
     */
    public static function generateRandomString($length = 16, $escSpecialChar = false)
    {
        if ($escSpecialChar) {
            $bytes = Yii::$app->getSecurity()->generateRandomKey($length);

            $bytes = StringHelper::base64UrlEncode($bytes);
            $bytes = preg_replace('/[^A-Za-z0-9 ]/', '', $bytes);

            $randomStr = substr($bytes, 0, $length);

        } else {
            $randomStr = Yii::$app->getSecurity()->generateRandomString($length);
        }

        return $randomStr;
    }

    /**
     * @param $text
     * @return mixed|string
     */
    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

    /**
     * @param $msg
     * @throws \yii\base\InvalidParamException
     */
    public static function apiLog($msg)
    {
        self::log($msg, 'ApiLog');
    }

    /**
     * Custom logger.
     * Given messages are logged mainly for debugging purpose to see the execution work flow of some code.
     *
     * @param $msg
     * @param string|null $fileName
     *
     * @throws \yii\base\InvalidParamException
     */
    public static function log($msg, $fileName = null)
    {
        $fileName = $fileName === null ? 'comLog' : $fileName;

        $runTimePath = Yii::getAlias('@runtime');
        $i = 1;
        $flag = true;
        $txt = sprintf("\n[%s]\t%s\t", date('h:i A Y-m-d', time()), $msg);
        $path = "$runTimePath/$fileName.txt";

        if (file_exists($path)) {

            #  1 MB Size (1048576 Bytes / 1024 Bytes => 1024 KB => 1 MB )
            if ((filesize($path) / 1024) >= 1024) {
                while ($flag) {
                    $c_path = "$runTimePath/$fileName.txt.$i";
                    if (!file_exists($c_path)) {
                        $i--;
                        for ($j = $i; $j >= 1; $j--) {
                            $pathLB = "$runTimePath/$fileName.txt.$j";
                            $pathL = "$runTimePath/$fileName.txt." . ($j + 1);
                            rename($pathLB, $pathL);
                        }
                        rename($path, "$path.1");
                        $flag = false;
                    }
                    $i++;
                }
            }
        }
        file_put_contents("$runTimePath/$fileName.txt", $txt, FILE_APPEND);
    }

    /**
     * @param $value
     * @return float
     * @throws \Brick\Math\Exception\ArithmeticException
     */
    public static function scale($value)
    {
        return BigDecimal::of($value)
            ->toScale(2, RoundingMode::HALF_CEILING)
            ->toFloat();
    }
    
    /**
     * 
     * @param type $value
     * @return type
     */
    public static function round($value)
    { 
       $temp_value = number_format($value, 0);
       $number = substr($value,strlen($value)-1);
       $array = array(1,2,6,7);
       if(in_array($number, $array)) {
           return number_format(($temp_value.'.'.floor($number/5) * 5), 2);
       } else { 
           return number_format(($temp_value.'.'.ceil($number/5) * 5), 2);
       }
    }

    /**
     * @param $url
     * @param bool $returnUrl
     * @return array|string
     */
    public static function parseUrl($url, $returnUrl = false)
    {
        $parts = explode('/', $url);
        $controller = $parts[0];
        if (array_key_exists(1, $parts)) {
            $action = $parts[1];
            if (array_key_exists(2, $parts) || $parts[0] === $parts[1]) {
                $controller = "$parts[0]/$parts[1]";
                $action = 'index';
                if (isset($parts[2])) {
                    $action = $parts[2];
                }
            }
        } else {
            $action = 'index';
        }
        if ($returnUrl) {
            return "$controller/$action";
        }
        return array('controller' => $controller, 'action' => $action);
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function unsetSession($key)
    {
        return Yii::$app->getSession()->remove($key);
    }

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public static function setParam($key, $value)
    {
        return Yii::$app->params[$key] = $value;
    }

    /**
     * @param $msg
     */
    public static function successFlash($msg)
    {
        Yii::$app->getSession()->setFlash('success', $msg);
    }

    /**
     * @param $msg
     */
    public static function failureFlash($msg)
    {
        Yii::$app->getSession()->setFlash('error', $msg);
    }

    /**
     * @param $msg
     */
    public static function infoFlash($msg)
    {
        Yii::$app->getSession()->setFlash('info', $msg);
    }

    /**
     * @param $className
     * @return array
     * @throws \yii\base\InvalidParamException
     * @throws \ReflectionException
     */
    public static function getFilter($className)
    {
        $reflect = new \ReflectionClass($className);
        $className = sprintf('%s%s', self::FILTER, $reflect->getShortName());

        $filter = [];
        if (Com::isSession($className)) {
            $filter = Com::session($className);
        }

        return $filter === null ? [] : $filter;
    }

    /**
     * @param $className
     * @param $filter
     * @throws \ReflectionException
     * @throws \yii\base\InvalidParamException
     */
    public static function setFilter($className, array $filter = [])
    {
        $reflect = new \ReflectionClass($className);
        self::setSession(sprintf('%s%s', self::FILTER, $reflect->getShortName()), $filter);
    }

    /**
     * @param $key
     * @return bool
     */
    public static function isSession($key)
    {
        return Yii::$app->getSession()->has($key);
    }

    /**
     * @param string $key the session variable name
     * @return mixed
     */
    public static function session($key)
    {
        return Yii::$app->getSession()->get($key);
    }

    /**
     * @param string $key session variable name
     * @param mixed $value session variable value
     * @return mixed
     */
    public static function setSession($key, $value)
    {
        return Yii::$app->getSession()->set($key, $value);
    }

    /**
     * @param $value
     * @param bool $appendCurrency
     * @return string
     */
    public static function moneyFormat($value, $appendCurrency = null)
    {
        $scale = Configuration::get(Configuration::CURRENCY_DECIMAL_PLACE);
        $value = number_format((double)$value, (int)$scale);
        
        if ( $appendCurrency !== null ) {
            if (Configuration::get(Configuration::CURRENCY_SYMBOL_LEFT) != 0) {
                $value = Configuration::get(Configuration::CURRENCY_SYMBOL) . " $value";
            } else {
                $value = "$value " . Configuration::get(Configuration::CURRENCY_SYMBOL);
            }
        }
        
        return $value;
    }

     public static function distanceFormat($value, $scale = 1)
    {
        return number_format((double)$value, $scale).' km';
    }
    /**
     * @param array $swapArr
     * @param $swapFromPos
     * @param $swapToPos
     * @throws \yii\base\InvalidParamException
     *
     * @link https://stackoverflow.com/a/22839021/5798881
     */
    public static function arraySwap(array &$swapArr, $swapFromPos, $swapToPos)
    {
        if (!ArrayHelper::keyExists($swapFromPos, $swapArr) || !ArrayHelper::keyExists($swapToPos, $swapArr)) {
            throw new InvalidParamException('Invalid param $position');
        }
        list($swapArr[$swapFromPos], $swapArr[$swapToPos]) = array($swapArr[$swapToPos], $swapArr[$swapFromPos]);
    }

    public static function setPriceFormat($price, $decimalPlace = null)
    {
        return number_format($price, 2);
    }

    /**
     * Get JSON Data
     * @param  string $type [POST, GET, PUT]
     * @param  string $url [Run URL]
     * @param  array $postArray [POST Array]
     * @return JSON              [JSON Values]
     * @author Senthil T <senthilkumar.t@technoduce.com>
     */
    public static function getJsonData($type = 'GET', $url = '', $postArray = array(), $body = 0)
    {
        if ($body == 1) {
            $postArray = json_encode($postArray);
            $header = array(
                'Content-Type: application/json',
                'Authorization: Bearer ' . Configuration::get(Configuration::DELIVERY_BOY_BEARER),
            );
        } else {
            $header = array(
                'cache-control: no-cache',
                'Authorization: Bearer ' . Configuration::get(Configuration::DELIVERY_BOY_BEARER),
            );
        }

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $type,
            CURLOPT_POSTFIELDS => $postArray,
            CURLOPT_HTTPHEADER => $header,
        ));
       
        $response = curl_exec($curl);
        $err = curl_error($curl);
        # curl_close($curl);

        /*temporary log */
        if (is_array($postArray)) {
            $postArray = Json::encode($postArray);
        }
//        print_r(curl_getinfo($curl));
//exit;
        $response_code = '';
        $trace = '';
        if ($response == null) {
            $response_code = 'null';
            $trace = 'Node server is down! try again some time.';
        } else {
            if (isset($response->status)) {
                $response_code = $response->status;
                $trace = $response->data;
            }
        }
//
//        $nodeLogModel = new NodeApiLog();
//        $nodeLogModel->request_url = $url;
//        $nodeLogModel->request_method = $type;
//        $nodeLogModel->request_data = $postArray;
//        $nodeLogModel->response_code = $response_code;
//        $nodeLogModel->response_data = $response;
//        $nodeLogModel->trace = $trace;
//        $nodeLogModel->created_at = date('Y-m-d H:m:s');
//        $nodeLogModel->save();

        /* @var $db Connection */
        /*$db = Yii::$app->sqliteDb;

        if ($db->getSchema()->getTableSchema('node_api_log') === null) {
            $db->createCommand()->createTable('node_api_log', [
                'node_api_log_id' => Schema::TYPE_BIGPK,
                'request_url' => Schema::TYPE_TEXT,
                'request_method' => Schema::TYPE_STRING,
                'request_data' => Schema::TYPE_TEXT,
                'response_code' => Schema::TYPE_SMALLINT,
                'response_data' => Schema::TYPE_TEXT,
                'trace' => Schema::TYPE_TEXT,
                'created_at' => Schema::TYPE_DATETIME
            ])->execute();
        }

        if ($db->getSchema()->getTableSchema('node_api_log') !== null) {
            if (is_array($postArray)) {
                $postArray = Json::encode($postArray);
            }

            $response_code = '';
            $trace = '';
            if ($response == null) {
                $response_code = 'null';
                $trace = 'Node server is down! try again some time.';
            } else if (isset($response->status)) {
                $response_code = $response->status;
                $trace = $response->data;
            }

            $db->createCommand()->insert('node_api_log', [
                'request_url' => $url,
                'request_method' => $type,
                'request_data' => $postArray,
                'response_code' => $response_code,
                'response_data' => $response,
                'trace' => $trace,
                'created_at' => date('Y-m-d H:m:s')
            ])->execute();
        }*/

        return json_decode($response);
    }

    /**
     * @param bool $host
     * @param string $type
     * @return string
     */
    public static function getImagePlaceholder($host = true, $type = self::PLACEHOLDER_DEFAULT)
    {
        switch ($type) {
            case self::PLACEHOLDER_DEFAULT:
                $path = '/frontend/web/theme/images/placeholder.png';
                break;
            case self::PLACEHOLDER_BANNER:
                $path = '/frontend/web/theme/images/banner-sample.png';
                break;
            default:
                $path = '/frontend/web/theme/images/placeholder.png';
                break;
        }

        if ($host) {
            return self::absUploadPath($path);
        }
        return $path;
    }

    /**
     * @param $path
     * @return string
     */
    public static function absUploadPath($path)
    {
        if (Url::isRelative($path)) {
            return sprintf('%s/%s', Yii::$app->getRequest()->getHostInfo(), ltrim($path, '/'));
        }
        return $path;
    }

    /**
     * @param int $defaultCount
     * @return int|mixed
     */
    public static function postPerPage($defaultCount = 20)
    {
        $count = self::param('postsPerPage');

        if ($count === null) {
            $count = $defaultCount;
        }
        # return 1;
        return $count;
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function param($key)
    {
        return Yii::$app->params[$key];
    }

    /**
     * @param $value
     * @param $scale
     * @return mixed
     */
    public function toFloat($value, $scale)
    {
        return $value;
    }

    /**
     * @return int
     */
    public static function getCartCount()
    {
        if (self::isSession(self::SES_CART) && self::session(self::SES_CART) != '') {
            return count(self::session(self::SES_CART));
        }
        return 0;

    }


    public static function getCartData()
    {
        if (self::isSession(self::SES_CART)) {
            return self::session(self::SES_CART);
        }

        return 0;

    }

    /**
     * @param $url
     * @return string
     */
    public static function apiUrlTo($url)
    {
        $url = ltrim($url, '/');

        return "/api/v1/$url";
    }
    
    /**
    * @param null $langCode
    * @return bool
    * To check site current language 
    */
    public static function isSiteLang($langCode = null)
    {
        if ($langCode === null) {
            $langCode = Yii::$app->language;
        }

        return strtoupper($langCode) === strtoupper(Yii::$app->language);
    }
    /**
     * @param $jsonStr
     * @return bool
     */
    public static function isJson($jsonStr)
    {
        if (is_numeric($jsonStr)) {
            return false;
        }
        json_decode($jsonStr);
        return json_last_error() === JSON_ERROR_NONE;
    }
    public static function roundUp($value, $significance = 0.05)
    {     
        $value = number_format((float)$value, 2, '.', '');   
        $temp_value = explode('.', $value);               
        $number = substr($temp_value[1],strlen($temp_value[1])-1);
        $array = array(1,2,6,7);
        
        if(in_array($number, $array)) {
            $value = round($value, 1);
            return number_format((float)$value, 2, '.', '');
        } else { 
            return (ceil($value/$significance)*$significance);
        }
    }
}