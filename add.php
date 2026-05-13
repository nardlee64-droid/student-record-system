<?php
include 'db.php';

if(isset($_POST['save'])){

    $student_id = $_POST['student_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    mysqli_query($conn,

    "INSERT INTO students
    (student_id, firstname, lastname, course, year_level, address, contact)

    VALUES
    ('$student_id','$firstname','$lastname','$course','$year_level','$address','$contact')");

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Add Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4" style="max-width:700px; margin:auto;">

        <!-- TITLE -->
        <h2 class="mb-4 text-center fw-bold">
            Add Student
        </h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text" name="student_id" class="form-control" required>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text" name="firstname" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text" name="lastname" class="form-control" required>
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text" name="course" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year Level</label>
                <input type="number" name="year_level" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text" name="address" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Contact</label>
                <input type="text" name="contact" class="form-control">
            </div>

            <!-- BUTTONS -->
            <div class="d-flex justify-content-between mt-4">

                <a href="index.php" class="btn btn-secondary px-4">
                    Back
                </a>

                <button type="submit" name="save" class="btn btn-success px-4">
                    Save Student
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>