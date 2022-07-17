<?php

namespace Tests;

use App\Models\PublicKey;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    function getDummyDecodedJwt($time)
{
    $header = [
        "kid" => "FXpFvrU4jb81twqwUHBzNhKnJdoyOp0dUl5mdESDlMM=",
        "alg" => "RS256"
    ];
    
    $payload = [
        "sub"=> "5ec4aeb2-6972-4383-8b14-0bb57edebb35",
        "iss"=> "https://cognito-idp.ap-northeast-1.amazonaws.com/ap-northeast-1_mIMELctEy",
        "client_id"=> "81ahi7a293t255dqqd52dfank",
        "origin_jti"=> "4508624b-78cd-4ed7-af70-b44a36e6a426",
        "event_id"=> "1074b427-bfeb-4c91-8a6b-96a4c616abb9",
        "token_use"=> "access",
        "scope"=> "aws.cognito.signin.user.admin",
        "auth_time"=> 1657095799,
        "exp"=> 1657099399,
        "iat"=> 1657095799,
        "jti"=> "f25eda01-bc45-4b51-a1fb-db6194356cc0",
        "username"=> "5ec4aeb2-6972-4383-8b14-0bb57edebb35"
    ];
    
    return [$header, $payload];
}
function getAuthHeader($time=null)
{
    if (is_null($time)) {
        $time = time();
    }
    
    //create key pair.
    $key = openssl_pkey_new();
    
    //create private key.
    $passphrase = 'passphrase!';
    openssl_pkey_export($key, $privateKey, $passphrase);
    $privateKeyId = openssl_get_privatekey($privateKey, $passphrase);
    
    //create public key.
    $keyDetails = openssl_pkey_get_details($key);
    $publicKey = $keyDetails['key'];
    
    //get payload.
    list($header, $payload) = $this->getDummyDecodedJwt($time);
    
    //insert DB tabale row.
    PublicKey::create(['kid' => $header['kid'], 'public_key' => $publicKey]);
    
    //create JWT
    $jwt = JWT::encode($payload, $privateKeyId, 'RS256', null, $header);
    
    //return header
    return [
        'Authorization' => 'Bearer '. $jwt, 
        'Accept' => 'application/json'
    ];
}
}
