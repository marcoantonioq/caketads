<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
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
