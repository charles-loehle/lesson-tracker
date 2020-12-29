<?php 
$pdo = require_once 'database.php';

// get user id 
$id = $_GET['id'] ?? null;

if(!$id) {
  header('Location: index.php');
  exit;
}

$stmt = $pdo->prepare(
  "SELECT 
    name, 
    students.id,
    student_name,
    user_id,
    instrument, 
    parent_name,
    parent_email,
    phone
  FROM users
  JOIN students
    ON users.id = students.user_id
  WHERE user_id = $id;"
);

$stmt->bindValue(':id', $id);
$stmt->execute();
$students = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($students); exit;

?>

<?php require_once 'partials/header.php'; ?>
  <section class="main">
    <div class="container">

        <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/" class="btn btn-secondary">Back to users</a>
        </p>

        <?php if(!$students) { ?>
          <h1>No Students For This Teacher</h1>
        <?php } else { ?>
          <h1><?= $students[0]['name'] ?>'s Students</h1>
        <?php } ?>  

        <p>
          <a href="create_student.php?id=<?= $id ?>" class="btn btn-success btn-sm">Add Student</a>
        </p>

        <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Teacher Name</th>
            <th>Student Name</th>
            <th>Instrument</th>
            <th>Parent Name</th>
            <th>Parent Email</th>
            <th>Phone</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($students as $i => $student): ?>
            <tr>
              <th><?= $i + 1 ?></th>
              <td><?= $student['name'] ?></td>
              <td><?= $student['student_name'] ?></td>
              <td><?= $student['instrument'] ?></td>
              <td><?= $student['parent_name'] ?></td>
              <td><?= $student['parent_email'] ?></td>
              <td><?= $student['phone'] ?></td>
              <td>
              <a href="update_student.php?id=<?= $student['id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>
                <form class="td-form" action="delete_student.php" method="post">
                  <input type="hidden" name="id" value="<?= $student['id'] ?>" />
                  <input type="hidden" name="user_id" value="<?= $student['user_id'] ?>" />
                  <button class="btn btn-sm btn-outline-danger">Delete Student</button>
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