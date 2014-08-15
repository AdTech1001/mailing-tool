
<div class="container">
<h1><?php echo nltool\Controllers\ControllerBase::translate('loginTitle'); ?></h1>


<div class="loginForm">
  <form action="<?php echo $form->getAction(); ?>" method="POST">
   <label for="username">Email: </label>
    <?php echo $form->render('username'); ?><br/>
    

    <label for="password">Password: </label>
    <?php echo $form->render('password'); ?><br>
    

    <?php echo $form->render('login'); ?>
  </form>
</div>
</div>