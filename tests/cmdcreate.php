<?php
/**
 * @link   https://www.init.lu
 * @author Cao Kang(caokang@outlook.com)
 * Date: 2018/5/17
 * Time: 下午9:36
 * Source: cmdcreate.php
 * Project: libiocm
 */

require '../vendor/autoload.php';
$config = require './config.php';
$app = new Zeevin\Libiocm\Application($config);
$iotConfig = $app['config']->get('iot');
$cacheConfig = $app['config']->get('cache');

$request = new \Zeevin\Libiocm\Cmd\RequestAttribute\DeviceCommands\Create\Request();
$device_id = '2f41a999-3031-41bf-8aeb-a4d27eb9b547';
$random = bin2hex(random_bytes(4));
$request->getBody()->setDeviceId($device_id)->getCommand()->setServiceId('TEST_SERVICEID_'.$random)
    ->setMethod('TEST_METHOD'.$random)->setParas(['t1'=>'a','t2'=>'b']);

/** @var \Zeevin\Libiocm\Cmd\CreateClient $app1 */
$app1 = $app['cmd.create'];
//print_r($request->serialize());exit;
$ret =  $app1->setUrlParams(http_build_query(['appid'=>$iotConfig['appId']]))->request($request->serialize())->getResult('json');
print_r($ret);