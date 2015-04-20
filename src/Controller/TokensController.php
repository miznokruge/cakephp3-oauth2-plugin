<?php
namespace OAuth2\Controller;

use OAuth2\Controller\AppController as OAuth2AppController;

class TokensController extends OAuth2AppController
{
    public $allowedActions = ['getToken'];
    public function getToken() {
        $this->OAuth2->handleTokenRequest();
    }
}