<?php  
$pdo = require_once 'database.php';

$errors = [];

$student_name = '';
$instrument = '';
$parent_name = '';
$parent_email = '';
$phone = '';

// Get user's id to show in page header 
$id = $_GET['id'] ?? null;

// Get user's name to show in page header
$stmt = $pdo->prepare("SELECT name FROM users WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

$name = $user['name'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'New student successfully created';

  require_once 'validation/validate_create_student.php';

  if(empty($errors)) {
    $stmt = $pdo->prepare(
      "INSERT INTO students 
        (student_name, user_id, instrument, parent_name, parent_email, phone) 
      VALUES 
        (:student_name, :user_id, :instrument, :parent_name, :parent_email, :phone)"
    );

    $stmt->bindValue(':student_name', $student_name);
    $stmt->bindValue(':user_id', $id);
    $stmt->bindValue(':instrument', $instrument);
    $stmt->bindValue(':parent_name', $parent_name);
    $stmt->bindValue(':parent_email', $parent_email);
    $stmt->bindValue(':phone', $phone);

    $stmt->execute();

    header("Location: user_students.php?id=" . $id);
  }
}
?>

<?php include('partials/header.php'); ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/user_students.php?id=<?= $id ?>" class="btn btn-secondary">Back to students</a>
        </p>

        <h1>Create new student for <?= $name ?></h1>

        <?php require_once 'partials/student_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>