<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;


use FacebookAds\Api;
use FacebookAds\Logger\CurlLogger;
use FacebookAds\Object\AdAccount;
use FacebookAds\Object\Campaign;
use FacebookAds\Object\Fields\CampaignFields;


class TestController extends Controller
{
    public function google(){



    }

    public function facebook(){

        /* $app_id = "{app-id}";
        $app_secret = "{appsecret}";
        $access_token = "{access-token}";
        $account_id = "act_{{adaccount-id}}";

        Api::init($app_id, $app_secret, $access_token);

        $account = new AdAccount($account_id);
        $cursor = $account->getCampaigns();


        foreach ($cursor as $campaign) {
          echo $campaign->{CampaignFields::NAME}.PHP_EOL;
        } */
    }
}
