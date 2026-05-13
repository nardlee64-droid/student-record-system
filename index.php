<?php
session_start();

if(!isset($_SESSION['username'])){
    header("Location:login.php");
    exit();
}

include 'db.php';
?>

<!DOCTYPE html>
<html>
<head>

    <title>Student Record System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">

    <!-- LIVE SEARCH SCRIPT -->
    <script>
    function showResult(str) {

        let box = document.getElementById("livesearch");
        let table = document.getElementById("maindata");

        if (str.length == 0) {
            box.innerHTML = "";
            box.style.border = "0px";
            table.style.display = "table";
            return;
        }

        let xhttp = new XMLHttpRequest();

        xhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                box.innerHTML = this.responseText;
                box.style.border = "1px solid #ddd";
                table.style.display = "none";
            }
        };

        xhttp.open("GET", "index.php?ajax=1&q=" + str, true);
        xhttp.send();
    }
    </script>

</head>

<body>

<?php
/* =========================
   AJAX SEARCH RESULT
   ========================= */

if(isset($_GET['ajax']) && $_GET['ajax'] == 1){

    $q = mysqli_real_escape_string($conn, $_GET['q']);

    $sql = "SELECT * FROM students
            WHERE firstname LIKE '%$q%'
            OR lastname LIKE '%$q%'
            OR student_id LIKE '%$q%'
            OR course LIKE '%$q%'
            OR address LIKE '%$q%'";

    $result = mysqli_query($conn, $sql);

    echo "<table class='table table-bordered table-hover mt-2'>";
    echo "<tr class='table-dark'>
            <th>ID</th>
            <th>Student ID</th>
            <th>Name</th>
            <th>Course</th>
            <th>Year</th>
            <th>Address</th>
            <th>Contact</th>
            <th>Actions</th>
          </tr>";

    if(mysqli_num_rows($result) > 0){

        while($row = mysqli_fetch_assoc($result)){

            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['student_id']}</td>
                    <td>{$row['firstname']} {$row['lastname']}</td>
                    <td>{$row['course']}</td>
                    <td>{$row['year_level']}</td>
                    <td>{$row['address']}</td>
                    <td>{$row['contact']}</td>

                    <td>

                        <a href='edit.php?id={$row['id']}' class='btn btn-warning btn-sm'>
                            Edit
                        </a>

                        <a href='delete.php?id={$row['id']}'
                           class='btn btn-danger btn-sm'
                           onclick='return confirm(\"Delete this student?\")'>
                            Delete
                        </a>

                    </td>

                  </tr>";
        }

    } else {

        echo "<tr>
                <td colspan='8' class='text-center text-danger'>
                    No results found
                </td>
              </tr>";
    }

    echo "</table>";
    exit();
}
?>

<div class="container mt-5">

    <div class="card shadow p-4">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h2 class="fw-bold">
                    Student Record Management System
                </h2>

                <p class="text-muted">
                    Welcome, <?php echo $_SESSION['username']; ?>
                </p>

            </div>

            <div>

                <a href="add.php" class="btn btn-primary">Add Student</a>

                <a href="logout.php" class="btn btn-danger">Logout</a>

            </div>

        </div>

        <!-- LIVE SEARCH -->
        <input
            type="text"
            class="form-control mb-3"
            placeholder="Search student..."
            onkeyup="showResult(this.value)"
        >

        <div id="livesearch"></div>

        <!-- READ TABLE -->
        <?php
        $result = mysqli_query($conn, "SELECT * FROM students");
        ?>

        <table class="table table-bordered table-hover mt-3" id="maindata">

            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Student ID</th>
                    <th>Name</th>
                    <th>Course</th>
                    <th>Year</th>
                    <th>Address</th>
                    <th>Contact</th>
                    <th>Actions</th>
                </tr>
            </thead>

            <tbody>

            <?php while($row = mysqli_fetch_assoc($result)) { ?>

                <tr>

                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['student_id']; ?></td>
                    <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                    <td><?php echo $row['course']; ?></td>
                    <td><?php echo $row['year_level']; ?></td>
                    <td><?php echo $row['address']; ?></td>
                    <td><?php echo $row['contact']; ?></td>

                    <td>

                        <a href="edit.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-warning btn-sm">
                            Edit
                        </a>

                        <a href="delete.php?id=<?php echo $row['id']; ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Delete this student?')">
                            Delete
                        </a>

                    </td>

                </tr>

            <?php } ?>

            </tbody>

        </table>

    </div>

</div>

</body>
</html>