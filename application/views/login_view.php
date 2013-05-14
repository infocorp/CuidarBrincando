<form class="form-horizontal" action="<?php echo site_url('login')?>" method="POST">
  <fieldset>
    <div id="legend">
      <legend class="">Login</legend>
    </div>    
    <div class="control-group">
      <!-- Username -->
      <label class="control-label"  for="username">Email</label>
      <div class="controls">
        <input type="text" id="username" name="username" placeholder="" class="input-xlarge">
      </div>
    </div>

    <div class="control-group">
      <!-- Password-->
      <label class="control-label" for="password">Senha</label>
      <div class="controls">
        <input type="password" id="password" name="password" placeholder="" class="input-xlarge">
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