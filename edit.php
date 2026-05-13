<?php
include 'db.php';

$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM students WHERE id='$id'");
$row = mysqli_fetch_assoc($query);

if(isset($_POST['update'])){

    $student_id = $_POST['student_id'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $course = $_POST['course'];
    $year_level = $_POST['year_level'];
    $address = $_POST['address'];
    $contact = $_POST['contact'];

    mysqli_query($conn,

    "UPDATE students SET
    student_id='$student_id',
    firstname='$firstname',
    lastname='$lastname',
    course='$course',
    year_level='$year_level',
    address='$address',
    contact='$contact'

    WHERE id='$id'");

    header("Location:index.php");
}
?>

<!DOCTYPE html>
<html>
<head>

    <title>Edit Student</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

</head>

<body>

<div class="container mt-5">

    <div class="card shadow p-4" style="max-width:700px; margin:auto;">

        <!-- TITLE -->
        <h2 class="text-center fw-bold mb-4">
            Edit Student
        </h2>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Student ID</label>
                <input type="text"
                       name="student_id"
                       value="<?php echo $row['student_id']; ?>"
                       class="form-control" required>
            </div>

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label class="form-label">First Name</label>
                    <input type="text"
                           name="firstname"
                           value="<?php echo $row['firstname']; ?>"
                           class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label class="form-label">Last Name</label>
                    <input type="text"
                           name="lastname"
                           value="<?php echo $row['lastname']; ?>"
                           class="form-control" required>
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Course</label>
                <input type="text"
                       name="course"
                       value="<?php echo $row['course']; ?>"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Year Level</label>
                <input type="number"
                       name="year_level"
                       value="<?php echo $row['year_level']; ?>"
                       class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Address</label>
                <input type="text"
                       name="address"
                       value="<?php echo $row['address']; ?>"
                       class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Contact</label>
                <input type="text"
                       name="contact"
                       value="<?php echo $row['contact']; ?>"
                       class="form-control">
            </div>

            <!-- BUTTONS -->
            <div class="d-flex justify-content-between mt-4">

                <a href="index.php" class="btn btn-secondary px-4">
                    Back
                </a>

                <button type="submit" name="update" class="btn btn-primary px-4">
                    Update Student
                </button>

            </div>

        </form>

    </div>

</div>

</body>
</html>