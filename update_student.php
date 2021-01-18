<?php 
$pdo = require_once 'database.php';

// get student id 
$id = $_GET['id'] ?? null;
// var_dump($id); exit;

if(!$id) {
  header('Location: users.php');
  exit;
}

// get the student by id and populate all the form inputs
$stmt = $pdo->prepare("SELECT student_name, user_id, instrument, parent_name, parent_email, phone FROM students WHERE id = :id");

$stmt->bindValue(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// and populate all the form inputs
$student_name = $user['student_name'];
$instrument = $user['instrument'];
$user_id = $user['user_id'];
$parent_name = $user['parent_name'];
$parent_email = $user['parent_email'];
$phone = $user['phone'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'Student successfully updated';

  require_once 'validation/validate_update_student.php';

  if(empty($errors)) {
    $stmt = $pdo->prepare(
      "UPDATE students SET student_name = :student_name, instrument = :instrument, parent_name = :parent_name, parent_email = :parent_email, phone = :phone WHERE id = :id"

      // UPDATE students SET instrument = 'violin', parent_name = 'self', parent_email = 'nina@gmail.com', phone = '123-123-1234' WHERE id = 9
    );

    $stmt->bindValue(':student_name', $student_name);
    $stmt->bindValue(':instrument', $instrument);
    $stmt->bindValue(':parent_name', $parent_name);
    $stmt->bindValue(':parent_email', $parent_email);
    $stmt->bindValue(':phone', $phone);
    $stmt->bindValue(':id', $id);

    $stmt->execute();

    header("Location: user_students.php?id=" . $user_id);
  }
}

?>

<?php require_once 'partials/header.php'; ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="user_students.php?id=<?= $user_id ?>" class="btn btn-secondary">Back to students</a>
        </p>

        <h1>Edit Student</h1>

        <?php require_once 'partials/student_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>