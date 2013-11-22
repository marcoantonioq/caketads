<?php
App::uses('Controller', 'Controller');

class AppController extends Controller {
	public $components = array(
		'RequestHandler',
        'Session',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array(
                        'username' => 'email'
                    ),
                )
            ),
            // /*
            'authError' => 'Você não possui autorização para executar esta ação.',
            'authorize' => array('Controller'),
            'loginAction' => array(
                'admin' => null,
                'plugin' => null,
                'controller' => 'users',
                'action' => 'login'
            ),
            'loginRedirect' => array('admin' => false,'controller' => 'pages', 'action' => 'display'),
            'logoutRedirect' => array('admin' => false,'controller' => 'pages', 'action' => 'display'),
            // */
        )
    );
	
	public function beforeFilter() {
		parent::beforeFilter();
        
        if(isset($this->request->params['prefix'])){
            if($this->request->params['prefix']=='admin'){
                $this->layout = 'admin';
            } 
        }else{
            $this -> layout = 'user';
        }

        // liberar tudo
        //$this->Auth->allow();

        // negar tudo
        //$this->Auth->deny();
    }

    public function isAuthorized($user = null){
        // Apenas os administradores podem acessar as funções de administrador
        if (isset($this->request->params['admin'])) {
            //pr($this->request); exit;
            return (bool)($user['grupo_id'] == 1);            
        }
        //somente o admin tem acesso a /admin/controller/action
        if (empty($this->request->params['admin'])) {
            return true;
        }
        // Default deny
        return false;
    }

}
