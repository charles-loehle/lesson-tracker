<?php 
$pdo = require_once 'database.php';

// get user id 
$id = $_GET['id'] ?? null;

if(!$id) {
  header('Location: index.php');
  exit;
}

// get the user by id and populate all the form inputs
$stmt = $pdo->prepare("SELECT name, username, email FROM users WHERE id = :id");
$stmt->bindValue(':id', $id);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// and populate all the form inputs
$name = $user['name'];
$username = $user['username'];
$email = $user['email'];

if($_SERVER['REQUEST_METHOD'] === 'POST') {

  session_start();

  $_SESSION['success'] = 'User successfully updated';

  require_once 'validation/validate_update_user.php';

  if(empty($errors)) {
    $stmt = $pdo->prepare(
      "UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id"
    );

    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':id', $id);

    $stmt->execute();

    header('Location: index.php');
  }
}

?>

<?php require_once 'partials/header.php'; ?>

  <section class="main">
    <div class="container">
      <div class="form-container">
        <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/" class="btn btn-secondary">Back to users</a>
        </p>

        <h1>Edit user</h1>

        <?php require_once 'partials/user_form.php' ?>

      </div>
    </div>
  </section>
</body>
</html>