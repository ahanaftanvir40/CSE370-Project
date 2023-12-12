<?php
session_start();

// Include the database connection file
include('connection.php');

// Check if the teacher is logged in
if (!isset($_SESSION['teacher_id'])) {
    header('location: teacher_signin.php');
    exit();
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through submitted grades and update the students_courses table
    foreach ($_POST['grades'] as $studentEmail => $grades) {
        $gradeCourseId1 = $grades['course1'];
        $gradeCourseId2 = $grades['course2'];
        $gradeCourseId3 = $grades['course3'];

        // Perform SQL update for each student
        $updateQuery = "UPDATE students_courses 
                        SET grade_course_id_1 = '$gradeCourseId1', 
                            grade_course_id_2 = '$gradeCourseId2', 
                            grade_course_id_3 = '$gradeCourseId3' 
                        WHERE email = '$studentEmail'";

        // Check if the query was successful
        if (mysqli_query($conn, $updateQuery)) {
            echo "Grades updated successfully!";
        } else {
            echo "Error updating grades: " . mysqli_error($conn);
        }
    }
}

// Retrieve student information from the students_courses table
$query = "SELECT email, selected_course_1, selected_course_2, selected_course_3 
          FROM students_courses";

// Check if the query was successful
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error retrieving student information: " . mysqli_error($conn));
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grade Students</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="mb-4">Grade Students</h2>
        <form method="post">
            <table class="table">
                <thead>
                    <tr>
                        <th>Student Email</th>
                        <th>Selected Course 1</th>
                        <th>Selected Course 2</th>
                        <th>Selected Course 3</th>
                        <th>Grade for Course 1</th>
                        <th>Grade for Course 2</th>
                        <th>Grade for Course 3</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <tr>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['selected_course_1'] ?></td>
                            <td><?= $row['selected_course_2'] ?></td>
                            <td><?= $row['selected_course_3'] ?></td>
                            <td><input type="text" name="grades[<?= $row['email'] ?>][course1]" class="form-control"></td>
                            <td><input type="text" name="grades[<?= $row['email'] ?>][course2]" class="form-control"></td>
                            <td><input type="text" name="grades[<?= $row['email'] ?>][course3]" class="form-control"></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-primary">Submit Grades</button>
        </form>
    </div>

    <!-- Include Bootstrap JS and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// No need to close the connection here, as it will be automatically closed when the script finishes execution
?>
