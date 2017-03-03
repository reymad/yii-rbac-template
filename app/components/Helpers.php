<?php
/**
 * Created by PhpStorm.
 * User: jrey
 * Date: 28/03/2015
 * Time: 13:54
 */

namespace app\components;

use app\models\Fichero;
use Yii;
use yii\bootstrap\Html;
use yii\bootstrap\Nav;
use yii\helpers\FileHelper;
use yii\helpers\Url;

class Helpers
{

    public static function test(){
        echo 'component loaded correctlty!';
    }

    public static function getSocialConnected(){

        if(!Yii::$app->user->isGuest){

            if(isset(Yii::$app->user->identity->accounts['twitter'])){
                return 'twitter';
            }
            if(isset(Yii::$app->user->identity->accounts['facebook'])){
                return 'facebook';
            }
            // ... añade según tengamos mas conexiones a rrss

        }

        return false;

    }

    public static function esNif($cif)
    {

        $cif = strtoupper($cif);
        for ($i = 0; $i < 9; $i++) $num[$i] = substr($cif, $i, 1);

        //si no tiene un formato valido devuelve error
        if (!preg_match('/((^[A-Z]{1}[0-9]{7}[A-Z0-9]{1}$|^[T]{1}[A-Z0-9]{8}$)|^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            return false;
        }

        // comprobacion de NIFs estandar
        if (preg_match('/(^[0-9]{8}[A-Z]{1}$)/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 0, 8) % 23, 1)) {
                return 'nif';
            } else {
                return false;
            }
        }

        //algoritmo para comprobacion de codigos tipo CIF
        $suma = $num[2] + $num[4] + $num[6];
        for ($i = 1; $i < 8; $i += 2) {
            $suma += substr((2 * $num[$i]), 0, 1) + substr((2 * $num[$i]), 1, 1);
        }
        $n = 10 - substr($suma, strlen($suma) - 1, 1);

        //comprobacion de NIFs especiales (se calculan como CIFs o como NIFs)
        if (preg_match('/^[KLM]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr($cif, 1, 8) % 23, 1)) {
                return 'nif';
            } else {
                return false;
            }
        }

        //comprobacion de CIFs
        if (preg_match('/^[ABCDEFGHJNPQRSUVW]{1}/', $cif)) {
            if ($num[8] == chr(64 + $n) || $num[8] == substr($n, strlen($n) - 1, 1)) {
                return 'cif';
            } else {
                return false;
            }
        }

        //comprobacion de NIEs
        if (preg_match('/^[XYZ]{1}/', $cif)) {
            if ($num[8] == substr('TRWAGMYFPDXBNJZSQVHLCKE', substr(str_replace(['X', 'Y', 'Z'], ['0', '1', '2'], $cif), 0, 8) % 23, 1)) {
                return 'nie';
            } else {
                return false;
            }
        }

        //si todavia no se ha verificado devuelve error
        return false;

    }

    public static function fecha($txt, $de = false, $a = false)
    {

        if (!$de) $de = 'Y-m-d H:i:s';
        if (!$a) $a = 'd-m-Y H:i:s';
        $res = null;

        if (is_string($txt) && trim($txt) != '') {

            $datetime = new \DateTime();
            $fecha = $datetime->createFromFormat($de, $txt);

            if($fecha) {
                $res = $fecha->format($a);
            }

        }

        return ($res);

    }

    public static function array_get_path($array, $path, $value = NULL, $unset = false)
    {

        $num_args = func_num_args();

        $element = $array;

        while ($path && ($key = array_shift($path))) {

            if (!$path && $num_args >= 5 && $unset) {

                unset($element[$key]);

                unset($element);

                $element = NULL;

            } else {

                if(isset($element[$key])) $element = $element[$key];
                else return NULL;

            }

        }

        if ($num_args >= 4 && !$unset) {

            $element = $value;

        }

        return $element;

    }


	public static function enviarEmail($to, $subject, $view, $params = [], $from = false, $fromName = 'Bijoux Indiscrets', $bcc = []) {

		if(!$from) $from = Yii::$app->params['adminEmail'];

		$msg = Yii::$app->mailer->compose($view,  $params);

        $msg->setFrom([$from => $fromName]);
		$msg->setTo($to);
		$msg->setSubject($subject);
        if(!empty($bcc)) $msg->setBcc($bcc);

		$ret = $msg->send();

        return $ret;

	}

    public static function generateHash($txt) {

        return sha1(mb_strtoupper(trim($txt),'utf8'));

    }

    public static function geocode($poblacion, $cp, $direccion = false) {

        $res = false;

        //Yii::trace([$direccion,$cp,$poblacion]);

        $params = ['country:ES'];

        if(!empty($poblacion)) $params[] = 'locality:'.urlencode($poblacion);
        if(!empty($cp)) $params[] = 'postal_code:'.urlencode($cp);

        $apiKey = 'AIzaSyAvdg7uf8a_S_2tzaK5hwkjvVuy43HqglI';

        if($direccion) {
            $paramsStr = 'address='.urlencode($direccion).'&components='.implode('|',$params);
        } else {
            $paramsStr = 'components='.implode('|',$params);
        }

        $url = 'https://maps.googleapis.com/maps/api/geocode/json?key=' . $apiKey . '&' . $paramsStr;

        //Yii::trace($url);

        $curlObj = curl_init();

        curl_setopt($curlObj, CURLOPT_URL, $url);
        curl_setopt($curlObj, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlObj, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlObj, CURLOPT_HEADER, 0);
        curl_setopt($curlObj, CURLOPT_HTTPHEADER, array('Content-type:application/json'));

        $response = curl_exec($curlObj);

        Yii::trace(curl_error($curlObj));

        $json = json_decode($response,true);
        //Yii::trace($json);
        if (is_array($json) && !empty($json) && $json['status'] == 'OK') $res = $json['results'][0];

        curl_close($curlObj);

        return $res;

    }

    public static function castToClass($class,$object) {
        return unserialize(preg_replace('/^O:\d+:"[^"]++"/', 'O:' . strlen($class) . ':"' . $class . '"', serialize($object)));
    }
    public static function mes($mes, $short = false){
        $meses = [
            1=>'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ];
        return $short?substr($meses[$mes], 0, 3):$meses[$mes];
    }
    public static function see($var){
        echo "<pre>"; print_r($var); echo "</pre>";
    }
    public static function fileSize($bytes, $decimals = 2)
    {
        $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.2f", $bytes / pow(1024, $factor)) . @$size[$factor];
    }


    public static function getGuestMenu(){

        return
            Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'encodeLabels' => false,
                'items' => [
                    ['label' => 'Home', 'url' => ['/site/index']],
                    ['label' => 'About', 'url' => ['/site/about']],
                    ['label' => 'Contact', 'url' => ['/site/contact']],
                    Yii::$app->user->isGuest ? (
                    ['label' => 'SignUp', 'url' => ['/user/register'], 'active'=>(Url::current()=='/user/register')]// active manual
                    ) : (''),
                    Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/user/login'], 'active'=>(Url::current()=='/user/login')]// active manual
                    ) : (
                        '<li>'
                        . Html::beginForm(['/site/logout'], 'post')
                        . Html::submitButton(
                            'Logout (' . Yii::$app->user->identity->username . ')',
                            ['class' => 'btn btn-link logout']
                        )
                        . Html::endForm()
                        . '</li>'
                    )
                ],
            ]);

    }


    public static function getDateFormat($lang){
        $format = [
            'es-ES' => 'd-m-Y H:i:s',
            'en-EN' => 'y-m-d H:i:s',
        ];
        return $format[$lang];
    }

    public static function setFlash($type){

        $flashIcons = [
            'success' => 'fa fa-check',
            'warning' => 'fa fa-exclamation',
            'info'    => 'fa fa-info',
            'danger'  => 'fa fa-exclamation',
        ];

        Yii::$app->getSession()->setFlash($type, [
            'type' => $type,
            'duration' => 3000,
            'icon' => $flashIcons[$type],
            'message' => Yii::t('app','flash.message.'.$type),
            'title' => Yii::t('app','flash.title.'.$type),
            'positonY' => 'top',
            'positonX' => 'right'
        ]);

    }

    public static function adjuntoGuardar($archivo, $model, $dir, $resize=false, $prefijo = '', $padre = '', $filename = false){

        $fichero_id = false;

        // ini_set('upload_max_filesize', '10M');

        if (!is_dir($dir)) FileHelper::createDirectory($dir, 0775, true);

        $extension = pathinfo($archivo->name, PATHINFO_EXTENSION);
        if($filename) {
            $nombre = $filename . '.' . $extension;
        } else {
            $nombre = md5($filename.mt_rand()) . '.' . $extension;
        }

        if($prefijo) $nombre = $prefijo .'_' . $nombre;

        if ($archivo->saveAs($dir . $nombre)) {
            $fichero = new Fichero;
            $fichero->tabla_padre    = $model->tabla_padre;
            $fichero->tabla_padre_id = $model->tabla_padre_id;
            $fichero->ruta = '/'.$dir;
            $fichero->nombre = $nombre;
            $fichero->nombre_original = $archivo->name;
            $fichero->ruta_completa = $fichero->ruta.$fichero->nombre;
            $fichero->size = $archivo->size;
            $fichero->extension = $extension;
            $fichero->created_by = Yii::$app->user->id;
            // $fichero->status = 10;

            if ($fichero->save()) {
                $fichero_id = $fichero->fichero_id;
            }
        }
        return $fichero_id;
        /*
        if($resize) {

            switch ($resize) {

                case 'layout':

                    $alto = 425;
                    $ancho = 1400;

                    $img_resized = new Imagick($dir . $nombre);
                    $img_resized->adaptiveResizeImage($ancho, $alto);

                    self::resizeImage($dir . $nombre, $ancho, $alto, Imagick::DISPOSE_NONE, 0, false, null);

                    break;
                case 'publicacion':

                    $alto = 128;
                    $ancho = 100;

                    $img_resized = new Imagick($dir . $nombre);
                    $img_resized->adaptiveResizeImage($ancho, $alto);

                    self::resizeImage($dir . $nombre, $ancho, $alto, Imagick::DISPOSE_NONE, 0, false, null);

                    break;

                case 'noticia':// en este caso hay que guardar dos imagenes. una de 250 x 240 para el listview y otra con crop de 450 x 350 (ancho x alto)

                    // para carrusel de detalle
                    $alto = 325;
                    $ancho = 800;

                    $img_resized = new Imagick($dir . $nombre);
                    $img_resized->adaptiveResizeImage($ancho, $alto);

                    self::resizeImage($dir . $nombre, $ancho, $alto, Imagick::DISPOSE_NONE, 0, false, null);

                    // para thumbs de imagen de noticias
                    $alto = 240;
                    $ancho = 250;

                    self::adjunto_thumbnail_yii2($fichero_id,'thumb', $ancho, $alto, $dir);

                    break;


            }
        }
        */

    }// yii2

}