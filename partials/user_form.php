<?php if(!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
      <div><?= $error ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form action="" method="post">

  <div class="form-group">
    <label for="name">Name</label>
    <input type="text" name="name" value="<?= $name ?>">
  </div>

  <div class="form-group">
    <label for="username">Username</label>
    <input type="text" name="username" value="<?= $username ?>">
  </div>

  <div class="form-group">
    <label for="email">Email</label>
    <input type="text" name="email" value="<?= $email ?>">
  </div>

  <button class="btn btn-success">Submit</button>

</form>