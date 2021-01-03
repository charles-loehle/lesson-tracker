<?php if(!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
      <div><?= $error ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<form action="" method="post">

  <div class="form-group">
    <label for="name">Student Name</label>
    <input type="text" name="student_name" value="<?= $student_name ?>">
  </div>

  <div class="form-group">
    <label for="email">Instrument</label>
    <input type="text" name="instrument" value="<?= $instrument ?>">
  </div>

  <div class="form-group">
    <label for="email">Parent Name</label>
    <input type="text" name="parent_name" value="<?= $parent_name ?>">
  </div>

  <div class="form-group">
    <label for="email">Parent Email</label>
    <input type="text" name="parent_email" value="<?= $parent_email ?>">
  </div>

    <div class="form-group">
    <label for="email">Phone</label>
    <input type="text" name="phone" value="<?= $phone ?>">
  </div>

  <button class="btn btn-success">Submit</button>

</form>