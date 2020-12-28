<?php  
$pdo = require_once 'database.php';

$errors = [];

$name = '';
$username = '';
$email = '';

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'New user successfully created';

  require_once 'validation/validate_create_user.php';
  
  if(empty($errors)) {
    $stmt = $pdo->prepare(
      "INSERT INTO users (name, username, email) VALUES (:name, :username, :email)"
    );

    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);

    $stmt->execute();

    header('Location: index.php');
  }
}
?>

<?php include('partials/header.php'); ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/" class="btn btn-secondary">Back to users</a>
        </p>

        <h1>Create new user</h1>

        <?php require_once 'partials/user_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>