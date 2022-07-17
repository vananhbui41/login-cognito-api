<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function autheduser_returns_jwt_claims()
    {
        $time = time();
        $res = $this->withHeaders($this->getAuthHeader($time))->json('GET', '/api/autheduser');
        $res->assertStatus(200); 
        $res->assertExactJson([
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
        ]);
    }
}
