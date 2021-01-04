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
  -- users
    name AS teacher_name,
  -- students 
    students.id as student_id,
    students.student_name,
    students.instrument,
  -- lessons 
    lessons.attendance,
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

// var_dump($lessons[0]['student_id']); exit;

?>

<?php require_once 'partials/header.php'; ?>
  <section class="main">
    <div class="container">
    <p>
          <a href="index.php" class="btn btn-secondary">Back to users</a>
        </p>

        <?php if(!$lessons) { ?>
          <h1>No Lessons For This Teacher</h1>
        <?php } else { ?>
          <h1><?= $lessons[0]['teacher_name'] ?>'s Lessons</h1>
        <?php } ?>  

        <p>
          <a href="create_lesson.php?id=<?= $id ?>" class="btn btn-success btn-sm">Add Lesson</a>
        </p>

        <table class="table">
        <thead>
          <tr>
            <th>#</th>
            <th>Student Name</th>
            <th>Instrument</th>
            <th>Lesson Time</th>
            <th>Lesson Date</th>
            <th>Attendance</th>
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
              <td><?= $lesson['attendance'] ?></td>
              <td>
              <a href="update_lesson.php?id=<?= $lesson['lesson_id'] ?>" class="btn btn-sm btn-outline-primary">Edit</a>

                <form class="td-form" action="delete_lesson.php" method="post">
                  <input type="hidden" name="lesson_id" value="<?= $lesson['lesson_id'] ?>" />
                  <input type="hidden" name="user_id" value="<?= $id ?>" />
                  <button class="btn btn-sm btn-outline-danger">Delete Lesson</button>
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