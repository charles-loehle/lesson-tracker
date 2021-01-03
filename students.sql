-- EXPLICIT INNER JOIN
SELECT 
    name, 
    username, 
    email, 
    student_name,
    instrument, 
    parent_name,
    parent_email,
    phone
FROM users
JOIN students
    ON users.id = students.user_id;

-- EXPLICIT INNER JOIN
SELECT 
    name, 
    student_name,
    instrument
FROM users
JOIN students
    ON users.id = students.user_id;

CREATE TABLE users (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) UNIQUE NOT NULL,
    username VARCHAR(255) UNIQUE NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    created_at TIMESTAMP DEFAULT NOW()
);

CREATE TABLE students (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100) NOT NULL,
    user_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    instrument VARCHAR(255),
    FOREIGN KEY(user_id) 
        REFERENCES users(id)
        ON DELETE CASCADE
);

ALTER TABLE students INSERT (
    parent_name VARCHAR(100),
    parent_email VARCHAR(100),
    phone VARCHAR(100)
);

CREATE TABLE lessons (
    id INTEGER AUTO_INCREMENT PRIMARY KEY,
    attendance VARCHAR(255),
    lesson_time TIME NOT NULL,
    lesson_date DATE NOT NULL,
    student_id INTEGER NOT NULL,
    user_id INTEGER NOT NULL,
    created_at TIMESTAMP DEFAULT NOW(),
    FOREIGN KEY(student_id) 
        REFERENCES students(id)
        ON DELETE CASCADE;
);

INSERT INTO users (username, email) 
VALUES ('BoyGeorge', 'george@gmail.com'),
       ('GeorgeMichael', 'gm@gmail.com'),
       ('DavidBowie', 'david@gmail.com'),
       ('Blueteele', 'blue@gmail.com'),
       ('BetteDavis', 'bette@aol.com');

INSERT INTO students (student_name, user_id, instrument, parent_name, parent_email, phone) 
VALUES ('Lliam Resendez', 1, 'violin'),
	('Sofia Friedman', 1, 'guitar'), 
	('Ellie Friedman', 2, 'violin'),
('Bob Jones', 2, 'violin'),
('Ted Smith', 3, 'violin'),
('John Smith', 3, 'guitar');

-- Lily Guverson	guitar	Lorna	lorna@yahoo.com	444-444-4444
-- Gabe Toodles	kazzoo	Ryan	ryan@yahoo.com	555-555-5555
-- Aaron Eddie	Skin flute	Qwerty	qwerty@gmail.com	666-666-6666

INSERT INTO lessons (attendance, lesson_time, lesson_date, student_id, user_id)
VALUES ('present', '17:30:00', '2020-12-30', 3, 3),
('present', '18:00:00', '2020-12-30', 2, 3),
('present', '19:30:00', '2020-12-30', 1, 3),
('absent', '19:30:00', '2020-12-29', 4, 5),
('absent', '18:30:00', '2020-12-29', 5, 5),
('present', '17:30:00', '2020-12-29', 6, 5),
('absent', '16:30:00', '2020-12-29', 1, 5);

DELETE FROM users WHERE email = 'george@gmail.com';

DELETE FROM students WHERE student_name = 'Bob Jones';

ALTER TABLE students CHANGE email parent_email VARCHAR(100);


/*========== QUERIES==================*/

-- USERS ----------------------------

-- Create user 
INSERT INTO users (name, username, email) VALUES (:name, :username, :email);

-- Get all users
SELECT name, username, email FROM users ORDER BY username ASC;

-- Update user 
SELECT * FROM users WHERE id = :id;
UPDATE users SET name = :name, username = :username, email = :email WHERE id = :id;

-- Delete user 
DELETE FROM users WHERE id = :id;


  
-- STUDENTS -------------------------------

-- Create student 
INSERT INTO students (student_name, user_id, instrument, parent_name, parent_email, phone) VALUES ('Kate Borsci', :user_id, 'violin', 'Mrs. Borsci', 'Borsci@gmail.com', '123-123-1234');
INSERT INTO students (student_name, user_id, instrument, parent_name, parent_email, phone) VALUES (:student_name, :user_id, :instrument, :parent_name, :parent_email, :phone);

-- Get all students
SELECT student_name, user_id, instrument, parent_name, email, phone FROM students ORDER BY name ASC;

-- Get all of a single user's students 
SELECT * FROM students WHERE user_id = :user_id;

SELECT 
    name, 
    student_name,
    instrument, 
    parent_name,
    parent_email,
    phone
FROM users
JOIN students
    ON users.id = students.user_id
WHERE user_id = :user_id;

-- Get all users and their students 
SELECT 
    name, 
    username, 
    email, 
    student_name,
    instrument, 
    parent_name,
    parent_email,
    phone
FROM users
JOIN students
    ON users.id = students.user_id;

-- Udate student 
SELECT * FROM students WHERE id = :id;
UPDATE students SET
          student_name = :student_name, 
          user_id = :user_id,
          created_at = :created_at,
          instrument = :instrument, 
          parent_name = :parent_name, 
          parent_email = :parent_email, 
          phone = :phone
          WHERE id = :id

-- Delete student 
DELETE FROM students WHERE id = :id;


-- LESSONS ------------------------------------

-- Create lesson
INSERT INTO lessons (attendance, lesson_time, lesson_date, student_id) VALUES ('', '12:00:00', '2020-01-02', :student_id);

-- Get all lessons
SELECT * FROM lessons;

-- Get single lesson by lesson id 
SELECT attendance, lesson_time, lesson_date FROM lessons WHERE lessons.id = :id;

-- Get all of a single user's lessons 
SELECT * FROM lessons WHERE user_id = :user_id;

-- Get all of a user's lessons 
SELECT name, student_name, lesson_time, lesson_date 
FROM users 
INNER JOIN students
-- primary key = foreign key 
ON users.id = students.user_id
INNER JOIN lessons 
ON users.id = lessons.user_id



SELECT 
    name, 
    student_name,
    instrument,
    lessons.lesson_time,
    lessons.lesson_date
FROM lessons
INNER JOIN students 
    ON students.

-- Udate lessons
SELECT * FROM lessons WHERE id = :id;
UPDATE lessons SET
    attendance = :attendance,
    lesson_time = :lesson_time,
    lesson_date = :lesson_date,
WHERE id = :id

UPDATE lessons SET
    attendance = 'present'
WHERE id = 8;

-- Delete lesson
DELETE FROM lessons WHERE id = :lesson_id;


* working for David Bowie and all *
  SELECT
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
  WHERE users.id = 3