<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Courses</title>
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
		<style>
        body {
            background-image: url(r7.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
		</style>
</head>
<body>

    <div class="container mt-5">
        <h2 class="mb-4">Select Courses</h2>

        <?php
        include 'connection.php';

        session_start();
        if (!isset($_SESSION['user_email'])) {
            header("Location: index.php");
            exit();
        }

        $userEmail = $_SESSION['user_email'];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $selectedCourse1 = $_POST['selectedCourse1'];
            $selectedCourse2 = $_POST['selectedCourse2'];
            $selectedCourse3 = $_POST['selectedCourse3'];

            // Check for uniqueness
            if ($selectedCourse1 === $selectedCourse2 || $selectedCourse1 === $selectedCourse3 || $selectedCourse2 === $selectedCourse3) {
                echo "Error: Courses must be unique.";
            } else {
                $selectedCourses = [
                    'selected_course_1' => $selectedCourse1,
                    'selected_course_2' => $selectedCourse2,
                    'selected_course_3' => $selectedCourse3,
                ];

                updateSelectedCourses($userEmail, $selectedCourses);
            }
        }

        $availableCourses = getAvailableCourses();
        $selectedCourses = getSelectedCourses($userEmail);
        ?>

        <form action="courses.php" method="post">

            <div class="form-group">
                <label for="selectedCourse1">Select Course 1:</label>
                <select class="form-control" name="selectedCourse1" required>
                    <?php
                    foreach ($availableCourses as $course) {
                        $selected = ($course['sc'] === $selectedCourses['selected_course_1']) ? 'selected' : '';
                        echo "<option value='{$course['sc']}' $selected>{$course['sc']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="selectedCourse2">Select Course 2:</label>
                <select class="form-control" name="selectedCourse2" required>
                    <?php
                    foreach ($availableCourses as $course) {
                        $selected = ($course['sc'] === $selectedCourses['selected_course_2']) ? 'selected' : '';
                        echo "<option value='{$course['sc']}' $selected>{$course['sc']}</option>";
                    }
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="selectedCourse3">Select Course 3:</label>
                <select class="form-control" name="selectedCourse3" required>
                    <?php
                    foreach ($availableCourses as $course) {
                        $selected = ($course['sc'] === $selectedCourses['selected_course_3']) ? 'selected' : '';
                        echo "<option value='{$course['sc']}' $selected>{$course['sc']}</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Main Submit Button for Submitting All Courses -->
            <button type="submit" class="btn btn-primary" name="submit">Submit Courses</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

</body>
</html>












