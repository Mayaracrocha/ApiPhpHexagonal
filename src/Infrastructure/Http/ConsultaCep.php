<?php

namespace Infrastructure\Http;

class ConsultaCep
{
    public function __construct()
    {
    }

    public function consultaCep(string $endCep): mixed
    {
        //INICIA O CURL
        $curl = curl_init();

        //CONFIGURAÇÕES DO CURL
        curl_setopt_array($curl, [
            CURLOPT_URL            => 'viacep.com.br/ws/' . $endCep . '/json/',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_CUSTOMREQUEST  => 'GET',
        ]);
        //RESPONSE
        $respons = curl_exec($curl);
        //FECHA A CONEXÃO ABERTA
        curl_close($curl);
        //RETORNA
        //return CriarEnderecoDto::fromViaCep(json_decode($respons));

        return json_decode($respons);
    }
}
