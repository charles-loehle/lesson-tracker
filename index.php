<?php 
$pdo = require_once 'database.php';

$stmt = $pdo->prepare('SELECT * FROM users ORDER BY username ASC');

$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

session_start();

$success = '';

if (isset($_SESSION['success'])) {
  $success = $_SESSION['success'];
  unset($_SESSION['success']);
}

?>

<?php require_once 'partials/header.php' ?>
  <section class="main">
    <div class="container">
      <h1>Users</h1>

      <p>
        <a href="create_user.php" class="btn btn-success btn-sm">Add User</a>
      </p>
      <?php if($success): ?>
        <div class="alert alert-success">
          <div><?= $success ?></div>
        </div>
      <?php endif; ?>

      <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>username</th>
            <th>Email</th>
            <th>Start Date</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($users as $i => $user): ?>
            <tr>
              <th><?= $i + 1 ?></th>
              <td><?= $user['name'] ?></td>
              <td><?= $user['username'] ?></td>
              <td><?= $user['email'] ?></td>
              <td><?= $user['created_at'] ?></td>

              <td>
                <a href="update_user.php?id=<?= $user['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form class="td-form" action="delete_user.php" method="post">
                  <input type="hidden" name="id" value="<?= $user['id'] ?>" />
                  <button class="btn btn-sm btn-outline-danger">Delete</button>
                </form>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </section>

</body>
</html>