<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ServiceController extends Controller
{
  

    public function  service(){
        
        $api_server = 'http://ead.portalava.com.br/web_service/getDisciplinas';
        $api_http_user = '1590e99c63d124e374345de71205ddb7c63a0b8d';
        $api_http_pass = 'afb94979f63f3038b84344d7ac37febe39748167';
        $chave_acesso = '7913463604cb98568ccfefe484f66f37';
        $chave_name = 'EAD-API-KEY';
        $format = 'json';
        $params = array();
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "{$api_server}/format/{$format}");
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_DIGEST);
        curl_setopt($curl, CURLOPT_USERPWD, "{$api_http_user}:{$api_http_pass}");
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("{$chave_name}:{$chave_acesso}"));
        curl_setopt($curl, CURLOPT_NOBODY, 1);
        curl_exec($curl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
        $output = curl_exec($curl);

        dd($output);

        print_r($output); // Resposta do WebService
        
    }
}
