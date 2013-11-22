Home page
</p>

<?php if (empty($this->Session->read('Auth.User.grupo_id'))): ?>
	<?php echo $this->Html->link('Logar', array(
		'controller'=>'users', 
		'action'=>'login'
	)); ?>	
<?php else: ?>
	<?php
		echo $this->Session->read('Auth.User.nome').' - '; 
		echo $this->Html->link('Sair (logout)', array(
			'controller'=>'users', 
			'action'=>'logout'
		));
	?>
	</p>

	<?php if ($this->Session->read('Auth.User.grupo_id') == 1 ): ?>
	
		<?php echo $this->Html->link('Bem vindo admin', array(
			'admin'=>true,
			'controller'=>'users', 
			'action'=>'index'
		)); ?>	
		
	<?php elseif($this->Session->read('Auth.User.grupo_id') == 2): ?>
		Bem vindo Registrado
	<?php endif; ?>

<?php endif; ?>