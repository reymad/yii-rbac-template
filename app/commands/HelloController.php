<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\commands;

use SoapClient;
use SoapFault;
use yii\console\Controller;

/**
 * This command echoes the first argument that you have entered.
 *
 * This command is provided as an example for you to learn how to create console commands.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class HelloController extends Controller
{

    private $_client;

    /**
     * This command echoes what you have entered as the message.
     * @param string $message the message to be echoed.
     */
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";
    }


    public function actionCurl()
    {

        /*
         * WS Basic oauth client
         * */
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => "http://url?user=xx&pass=xx",
            CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ));
        $resp = curl_exec($curl);
        curl_close($curl);
        $resp = json_decode($resp, true);

        var_dump($resp);


        /*
         * SOAP CLIENT EXAMPLE
         * */
        $response = array();

        try {

            $this->_client = new SoapClient('http:url/xxx.asmx?wsdl', array('trace'=>1));
            $response = $this->_client->nombreWsFuncion(array(
                'usuario' => 'xxx',
                'Pass' => 'xxx'
            ));

        } catch (SoapFault $fault) {

            var_dump(array(
                'fault' => $fault,
                'request' => $this->_client->__getLastRequest(),
                'response' => $this->_client->__getLastResponse(),
            ));

        }

        return $response;

    }

}
