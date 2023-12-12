<?php
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = '370projectp2';

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

function getAvailableCourses() {
    global $conn;
    $sql = "SELECT * FROM cms";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $courses = [];
    while ($row = $result->fetch_assoc()) {
        $courses[] = $row;
    }

    return $courses;
}

function getSelectedCourses($userEmail) {
    global $conn;
    $sql = "SELECT selected_course_1, selected_course_2, selected_course_3 FROM students_courses WHERE email = '$userEmail'";
    $result = $conn->query($sql);

    if (!$result) {
        die("Query failed: " . $conn->error);
    }

    $row = $result->fetch_assoc();

    return $row;
}

function updateSelectedCourses($userEmail, $selectedCourses) {
    global $conn;

    $course1 = $selectedCourses['selected_course_1'] ?? '';
    $course2 = $selectedCourses['selected_course_2'] ?? '';
    $course3 = $selectedCourses['selected_course_3'] ?? '';

    $sql = "UPDATE students_courses 
            SET selected_course_1 = '$course1', 
                selected_course_2 = '$course2', 
                selected_course_3 = '$course3' 
            WHERE email = '$userEmail'";

    if ($conn->query($sql) === TRUE) {
        echo "Advising submitted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>


