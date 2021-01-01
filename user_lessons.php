<?php 
$pdo = require_once 'database.php';

// get user id 
$id = $_GET['id'] ?? null;

if(!$id) {
  header('Location: index.php');
  exit;
}

// get all of a user's lessons
// $stmt = $pdo->prepare(
//   "SELECT
//   -- users
//     name AS teacher_name,
//   -- students 
//     students.student_name,
//     students.instrument,
//   -- lessons 
//     lessons.id AS lesson_id,
//     lessons.lesson_time,
//     lessons.lesson_date
//   FROM lessons  
//   -- join lessons and students  
//   INNER JOIN students
//     ON students.user_id = lessons.student_id
//   -- join users and students 
//   INNER JOIN users 
//     ON users.id = lessons.user_id
//   WHERE lessons.user_id = :id"
// );
$stmt = $pdo->prepare(
  "SELECT
  -- users
    name AS teacher_name,
  -- students 
    students.student_name,
    students.instrument,
  -- lessons 
    lessons.id AS lesson_id,
    lessons.lesson_time,
    lessons.lesson_date
  FROM users
  INNER JOIN students
    ON students.user_id = users.id
  INNER JOIN lessons
    ON students.id = lessons.student_id
  WHERE users.id = :id"
);

$stmt->bindValue(':id', $id);
$stmt->execute();
$lessons = $stmt->fetchAll(PDO::FETCH_ASSOC);

// var_dump($lessons); exit;

?>

<?php require_once 'partials/header.php'; ?>
  <section class="main">
    <div class="container">
    <p>
          <a href="/Brad_Traversy/php-crash-course-2020-student2/" class="btn btn-secondary">Back to users</a>
        </p>

        <?php if(!$lessons) { ?>
          <h1>No Lessons For This Teacher</h1>
        <?php } else { ?>
          <h1><?= $lessons[0]['teacher_name'] ?>'s Lessons</h1>
        <?php } ?>  

        <p>
          <a href="create_student.php?id=<?= $id ?>" class="btn btn-success btn-sm">Add Lesson</a>
        </p>

        <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Instrument</th>
            <th>Lesson Time</th>
            <th>Lesson Date</th>
            <th>Action</th>
          </tr>
        </thead>

        <tbody>
          <?php foreach($lessons as $i => $lesson): ?>
            <tr>
              <th><?= $i + 1 ?></th>
              <td><?= $lesson['student_name'] ?></td>
              <td><?= $lesson['instrument'] ?></td>
              <td><?= $lesson['lesson_time'] ?></td>
              <td><?= $lesson['lesson_date'] ?></td>
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