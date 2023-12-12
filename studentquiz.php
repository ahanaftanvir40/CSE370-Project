<?php
session_start();
require_once('connection.php');

if (!isset($_SESSION['user_id'])) {
    header('location: index.php');
    exit();
}

$userEmail = $_SESSION['user_email'];

$sql = "SELECT * FROM students_courses 
        INNER JOIN quiz ON students_courses.selected_course_1 = quiz.sc 
        WHERE students_courses.email = '$userEmail'";
$result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
$row = mysqli_fetch_assoc($result);

if ($userEmail && $row) {
    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Quiz Files</title>
        <style>
            body {
				background-image: url(r7.jpg);
				background-repeat: no-repeat;
				background-position: center;
				background-attachment: fixed;
				background-size: cover;
                background-color: #f8f9fa;
            }

            .container {
                margin-top: 50px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <h1 class="mb-4">Quiz Files</h1>
            <table class="table table-bordered table-hover">
                <thead>
                    <tr>
                        <th scope="col">Student Email</th>
                        <th scope="col">Course</th>
                        <th scope="col">Quiz Files</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?php echo $row['email'] ?></td>
                        <td><?php echo $row['selected_course_1'] ?></td>
                        <td>
                            <?php
                            // Fetch quiz files for the selected course
                            $filePath = $row['pdf_file_path'];
                            echo "<a href='$filePath' download class='btn btn-primary'>Download Quiz File</a><br>";
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>

    </html>

<?php
} else {
    echo "No Quizes for you.";
}
?>
