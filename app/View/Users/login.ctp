<?php echo $this->Session->flash('auth'); ?>
<br><?= $this->Form->create('User'); ?>
<div id="login">
    <fieldset>
        <legend>Login</legend>
        <?php
            echo $this->Form->input('email', array(
                'label'=>'Email: '
            ));
            echo $this->Form->input('password', array(
                'label'=>'Senha: '
            ));
            
            echo $this->Form->submit(
                'Enviar'
            );
        ?>
    </fieldset>
    <?php echo $this->Form->end(); ?>
</div>