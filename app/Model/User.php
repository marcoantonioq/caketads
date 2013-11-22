<?php
App::uses('AppModel', 'Model');
App::uses('AuthComponent', 'Controller/Component');
/**
 * User Model
 *
 * @property Grupo $Grupo
 */
class User extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'nome' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
                'required' => true,
                'allowEmpty' => false,
                'rule' => 'isUnique',
                'message' => 'e-mail já está em uso.'
            )
		),
		'grupo_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'password' => array(
			'required' => false,
            'allowEmpty' => false,
            'rule' => 'comparePwd',
            'message' => 'Incompatibilidade de senha ou menos de 6 caracteres.'
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Grupo' => array(
			'className' => 'Grupo',
			'foreignKey' => 'grupo_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);


	public function beforeSave($options = array()) {
		// # empty password -> não update
		//pr($this->data); exit;
	    if (empty($this->data['User']['password'])) { 
            unset($this->data['User']['password']);
        } else {
        	$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
            //$this->data['User']['password'] = Security::hash($this->data['User']['password'], null, true);
        }
        //echo "<hr>"; pr($this->data); exit;
	    return true;
    }  

    public function comparePwd($check) {
        $check['password'] = trim($check['password']);

        if (!isset($this->data['User']['id']) && strlen($check['password']) < 6) {
            return false;
        }

        if (isset($this->data['User']['id']) && empty($check['password'])) {
            return true;
        }

        $r = ($check['password'] == $this->data['User']['password2'] && strlen($check['password']) >= 6);

        if (!$r) {
            $this->invalidate('password2', __d('user', 'Senha inválida.'));
        }

        return $r;
    }

}
