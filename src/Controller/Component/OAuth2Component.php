<?php
namespace OAuth2\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\Controller;
use Cake\Network\Request;
use Cake\Event\Event;
use Cake\Event\EventManagerTrait;
use Cake\Network\Response;
use Cake\ORM\TableRegistry;
use OAuth2\Server as OAuth2Server;

class OAuth2Component extends Component {
    use EventManagerTrait;

    /**
     * Allowed controller actions without authentication
     *
     * @var array
     */
    public $allowedActions = [];

    /**
     * Request object
     *
     * @var \Cake\Network\Request
     */
    public $request;

    /**
     * Response object
     *
     * @var \Cake\Network\Response
     */
    public $response;

    /**
     * OAuth2Server Object
     *
     * @var object
     */
    public $OAuth2Server;

    /**
     * Initialize properties.
     *
     * @param array $config The config data.
     * @return void
     */
    public function initialize(array $config)
    {
        $controller = $this->_registry->getController();
        $this->eventManager($controller->eventManager());
        $this->request = $controller->request;
        $this->response = $controller->response;
        $this->OAuth2Server = new OAuth2Server([
            'access_token' => TableRegistry::get('OAuth2.AccessTokens'),
            'client_credentials' => TableRegistry::get('OAuth2.ClientCredentials')
        ]);
    }

    /**
     * Main execution method. Handles redirecting of unauthorized requests
     *
     * @param \Cake\Event\Event $event The startup event.
     * @return void|\Cake\Network\Response
     */
    public function startup(Event $event)
    {
        $controller = $event->subject();

        $action = strtolower($controller->request->params['action']);
        if (!$controller->isAction($action)) {
            return;
        }

        if ($this->_isAllowed($controller)) {
            return;
        }

        $event->stopPropagation();
        return $this->_unauthorized($controller);
    }

    /**
     * Checks if user is valid using OAuth2 library
     *
     * @return boolean true if allowed, false if not
     */
    protected function _isAllowed($controller) {
        return false;
    }

    /**
     * Checks if user is valid using OAuth2 library
     *
     * @return boolean true if carrying valid token, false if not
     */
    protected function _isAuthorized() {
        return true;
    }

    /**
     * return's error if unauthorized
     */
    protected function _unauthorized() {

    }
}