<?php

namespace App\Recaptcha;

use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Service servant à vérifier auprès des serveurs de Google si le  captcha a correctement été validé
 */
class RecaptchaValidator{

    /**
     * Stockage du service ParameterBagInterface de Synfony pour accèder aux paramètres globaux du site
     */
    private $params;

    /**
     * Constructeur de la class servant a demaner une instance du service ParameterBagInterface  à Synfony puis à hydrater l'attribut $this->params avec ce dernier
     */
    public function __construct(ParameterBagInterface $params)
    {
        $this->params = $params;
    }
    
        /**
     * Méthode servant à vérifier auprès de Google si le  captcha $recaptchaResponse et l'adresse IP $ip correspondent à une captcha correctement validé
     * La méthode renverra true si le captcha est correcte, sinon false
     */
    public function verify(string $recaptchaResponse, string $ip = null){

        if(empty($recaptchaResponse)) {
            return false;
        }
        $params = [
            'secret'    => $this->params->get('google_recaptcha_private_key'),
            'response'  => $recaptchaResponse
        ];
        if($ip){
            $params['remoteip'] = $ip;
        }
        $url = "https://www.google.com/recaptcha/api/siteverify?" . http_build_query($params);
        if(function_exists('curl_version')){
            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_HEADER, false);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 10);
            curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
            $response = curl_exec($curl);
        }else{
            $response = file_get_contents($url);
        }
        if(empty($response) || is_null($response)){
            return false;
        }
        $json = json_decode($response);
        return $json->success;

    }
}


