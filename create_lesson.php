<?php  
$pdo = require_once 'database.php';

$errors = [];

$student_id = '';
$student_name = '';
$attendance = '';
$lesson_time = '';
$lesson_date = '';

// Get user's id
$id = $_GET['id'] ?? null;

// Get teacher's name and list of all user's students to populate the dropdown menu in the form 
$stmt = $pdo->prepare(
  "SELECT 
    users.name as teacher_name,
    student_name,
    students.user_id,
    students.id
  FROM users
  JOIN students
    ON users.id = students.user_id
  WHERE user_id = $id;"
);
$stmt->bindValue(':id', $id);
$stmt->execute();
$studentsData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($studentsData); exit;

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'New student successfully created';

  require_once 'validation/validate_create_lesson.php';

  // var_dump($student_name); exit;

  if(empty($errors)) {
    $stmt = $pdo->prepare(
      "INSERT INTO lessons 
        (student_id, attendance, lesson_time, lesson_date) 
      VALUES 
        (:student_id, :attendance, :lesson_time, :lesson_date)"
    );  

    $stmt->bindValue(':student_id', $student_id);
    $stmt->bindValue(':attendance', $attendance);
    $stmt->bindValue(':lesson_time', $lesson_time);
    $stmt->bindValue(':lesson_date', $lesson_date);

    $stmt->execute();

    header("Location: user_lessons.php?id=" . $id);
  }
}
?>

<?php include('partials/header.php'); ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="user_lessons.php?id=<?= $id ?>" class="btn btn-secondary">Back to lessons</a>
        </p>

        <h1>Create new lesson for teacher: <?= $studentsData[0]['teacher_name'] ?></h1>

        <?php require_once 'partials/lesson_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>