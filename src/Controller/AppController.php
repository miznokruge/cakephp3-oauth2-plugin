<?php
namespace OAuth2\Controller;

use App\Controller\AppController as BaseController;
use Cake\Event\Event;

/**
 * Class AppController
 * @property \OAuth2\Controller\Component\OAuth2Component $OAuth2
 * @package OAuth2\Controller
 */
class AppController extends BaseController
{
    public function initialize()
    {
        $this->loadComponent('OAuth2.OAuth2');

        parent::initialize();
    }

    public function beforeFilter(Event $event)
    {
        $this->autoRender = false;
        parent::beforeFilter($event);
    }
}