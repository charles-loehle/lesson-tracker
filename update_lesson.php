<?php  
$pdo = require_once 'database.php';

// Get lesson's id  
$lesson_id = $_GET['id'] ?? null;

// var_dump($lesson_id); exit;

if(!$lesson_id) {
  header('Location: index.php');
  exit;
}

// Get the lesson by id to populate the form inputs 
$stmt = $pdo->prepare("SELECT student_id, attendance, lesson_time, lesson_date FROM lessons WHERE lessons.id = :id");
$stmt->bindValue(':id', $lesson_id);
$stmt->execute();
$lessonData = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($lessonData['lesson_time']); exit;

// populate all the form inputs
$student_id = $lessonData['student_id'];
$attendance = $lessonData['attendance'];
$lesson_time = $lessonData['lesson_time'];
$lesson_date = $lessonData['lesson_date'];

// Get the student's name who owns the lesson to put in page heading and user's id from user_id to put in redirect after update
$stmt = $pdo->prepare("SELECT student_name, user_id FROM students WHERE students.id = :student_id");
$stmt->bindValue('student_id', $student_id);
$stmt->execute();
$studentData = $stmt->fetch(PDO::FETCH_ASSOC);
// var_dump($studentData['user_id']); exit;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'New student successfully updated';

  require_once 'validation/validate_update_lesson.php';

  // var_dump($student_name); exit;

  // update the lesson
  if(empty($errors)) {
    $stmt = $pdo->prepare(
        "UPDATE lessons SET
          attendance = :attendance,
          lesson_time = :lesson_time,
          lesson_date = :lesson_date
        WHERE id = $lesson_id"
    );  

    $stmt->bindValue(':attendance', $attendance);
    $stmt->bindValue(':lesson_time', $lesson_time);
    $stmt->bindValue(':lesson_date', $lesson_date);

    $stmt->execute();

    header("Location: user_lessons.php?id=" . $studentData['user_id']);
  }
}
?>

<?php include('partials/header.php'); ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/user_lessons.php?id=<?= $studentData['user_id'] ?>" class="btn btn-secondary">Back to lessons</a>
        </p>

        <h1>Update Lesson for student: <?= $studentData['student_name'] ?></h1>

        <?php require_once 'partials/lesson_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>