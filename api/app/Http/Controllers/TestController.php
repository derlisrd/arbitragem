<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Facebook;

class TestController extends Controller
{
    public function google(){



    }

    public function facebook(){

        $app_id = "1128278461236313";
        $app_secret = "3694465af9dedc5cc06499718d35734c";
        $access_token = "9ef8cd796ed3db79f843eaabf2f58171";
        $account_id = "act_143321434467456";


        $fb = new Facebook\Facebook([
            'app_id' => '757012725447864',
            'app_secret' => '0d0ad43ec38d152d660198efb8e7d154',
            'default_graph_version' => 'v2.10',
            ]);

          $helper = $fb->getRedirectLoginHelper();

          $permissions = ['email']; // Optional permissions
          $loginUrl = $helper->getLoginUrl('https://arbitragem.saetapp.com/api/facebook', $permissions);

          echo '<a href="' . $loginUrl . '">Log in with Facebook!</a>';
    }

    public function politicas(){


        return view('politicas');
    }

    public function facebookcallback(){

        if(!session_id()) {
            session_start();
        }

        $fb = new Facebook\Facebook([
            'app_id' => '757012725447864',
            'app_secret' => '0d0ad43ec38d152d660198efb8e7d154',
            'default_graph_version' => 'v2.10',
        ]);

        $helper = $fb->getRedirectLoginHelper();


        $_SESSION['FBRLH_state']=$_GET['state']; //definindo o valor de state na session
        $_SESSION['fb_access_token'] = $accessToken; //definindo o access token na session

        try {
            $accessToken = $helper->getAccessToken();
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Deu erro no Graph: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Deu erro no SDK: ' . $e->getMessage();
            exit;
        }

        if (! isset($accessToken)) {
            if ($helper->getError()) {
                header('HTTP/1.0 401 Unauthorized');
                echo "Error: " . $helper->getError() . "\n";
                echo "Error Code: " . $helper->getErrorCode() . "\n";
                echo "Error Reason: " . $helper->getErrorReason() . "\n";
                echo "Error Description: " . $helper->getErrorDescription() . "\n";
            } else {
                header('HTTP/1.0 400 Bad Request');
                echo 'Bad request';
            }
            exit;
        }

        // Dados do Access Token:
        echo '<h3>Access Token</h3>';
        var_dump($accessToken->getValue());

        try {
            $response = $fb->get('/me', $accessToken->getValue());
        } catch(\Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Deu erro no Graph: ' . $e->getMessage();
            exit;
        } catch(\Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Deu erro no SDK: ' . $e->getMessage();
            exit;
        }

        $me = $response->getGraphUser();
        echo '<br/><br/> Logado como: ' . $me->getName();



    }


}
