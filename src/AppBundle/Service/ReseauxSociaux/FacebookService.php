<?php

namespace AppBundle\Service\ReseauxSociaux;


use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;

class FacebookService
{
// Ces variables réceptionnerons nos identifiants
    private $appId;
    private $appSecret;
    private $pageID;
    private $token;
    // Cette variable contiendra notre connexion avec l’API et sera utilisé pour interagir
    private $connection;

    public function __construct($appId,$appSecret,$pageID,$token)
    {
        $this->appId = $appId;
        $this->appSecret = $appSecret;
        $this->pageID = $pageID;
        $this->token = $token;

        // Cette instruction nous permettra de nous connecter à l'API
        $this->connection = new Facebook([
            'app_id' => $this->appId,
            'app_secret' => $this->appSecret,
            'default_graph_version' => 'v2.8',
        ]);

    }

    // Cette fonction permettra de poster sur notre page Facebook
    public function poster($msg)
    {
        //cette array contendra les paramètres de notre requête, ici on se contente d'envoyer un texte, mais on pourrait envoyer également avec d'autre paramêtre un lien, une image, etc...
        $attachment = array(
            'access_token' => $this->token,
            'message' => $msg
        );

        // on poste sur notre page Facebook
        try {
            $this->connection->post('/' . $this->pageID . '/feed', $attachment, $this->token);
        } catch (FacebookSDKException $e) {
            dump($e->getMessage());
        }

    }
}