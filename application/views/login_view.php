<div class="container">
  <?php if ($message = $this->session->flashdata('login_feedback')):?>
    <div class="alert alert-error">
      <?php echo $message?>
    </div>
  <?php endif;?>
  <form class="form-horizontal" action="<?php echo site_url('auth/login')?>" method="POST">
    <fieldset>
      <div id="legend">
        <legend class="">Login</legend>
      </div>    
      <div class="control-group">
        <!-- Username -->
        <label class="control-label"  for="username">Email</label>
        <div class="controls">
          <input type="text" id="username" name="username" value="<?php echo set_value('username')?>" class="input-xlarge">
          <?php echo form_error('username', '<div class="alert alert-error">', '</div>')?>
        </div>
      </div>

      <div class="control-group">
        <!-- Password-->
        <label class="control-label" for="password">Senha</label>
        <div class="controls">
          <input type="password" id="password" name="password" value="<?php echo set_value('username')?>" class="input-xlarge">
          <?php echo form_error('password', '<div class="alert alert-error">', '</div>')?>
        </div>
      </div>


      <div class="control-group">
        <!-- Button -->
        <div class="controls">
          <button class="btn btn-success">Login</button>
        </div>
      </div>
    </fieldset>
  </form>
</div>