<?php if(!empty($errors)): ?>
  <div class="alert alert-danger">
    <?php foreach($errors as $error): ?>
      <div><?= $error ?></div>
    <?php endforeach; ?>
  </div>
<?php endif; ?>

<?php 

// echo stripos($_SERVER['REQUEST_URI'], 'create_lesson.php');
?>

<form action="" method="post">

  <!-- only show select menu on create_lesson.php -->
  <?php if(stripos($_SERVER['REQUEST_URI'], 'create_lesson.php')): ?> 
    <div class="form-group"> 
      <label for="student_name">Student Name</label>
      <select name="student_id">
        <option value="">Select a student</option>
        <?php foreach($studentsData as $studentName): ?>
          <option value="<?php echo $studentName['id'] ?>"><?php echo $studentName['student_name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  <?php endif; ?>

  <div class="form-group">
    <label for="attendance">Attendance</label>
    <input type="text" name="attendance" value="<?= $attendance ?>">
  </div>

  <div class="form-group">
    <label for="lesson_time">Lesson Time</label>
    <input type="text" name="lesson_time" value="<?= $lesson_time ?>">
  </div>

  <div class="form-group">
    <label for="lesson_date">Lesson Date</label>
    <input type="text" name="lesson_date" value="<?= $lesson_date ?>">
  </div>

  <button class="btn btn-success">Submit</button>

</form>