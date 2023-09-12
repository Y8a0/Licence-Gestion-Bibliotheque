<?php

include "connection.php";
include "admin_navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>

<body>
    <div class="admin-dashboard">
        <div class="admin-dashboard-container">
            <div class="admin-dashboard-row">
                <?php

                $students = mysqli_query($db, "SELECT * FROM `student`");
                $total_students = mysqli_num_rows($students);

                ?>
                <div class="dashboard-col-4">
                    <a href="student_info.php">
                        <h3><?= $total_students; ?></h3>
                        Total des Etudents
                    </a>
                </div>
                <?php
                $books = mysqli_query($db, "SELECT * FROM `books`");
                $total_books = mysqli_num_rows($books);

                ?>
                <div class="dashboard-col-4">
                    <a href="manage_books.php">
                        <h3><?= $total_books; ?></h3>
                        Liste des livres
                    </a>
                </div>
                <?php
                $authors = mysqli_query($db, "SELECT * FROM `authors`");
                $total_authors = mysqli_num_rows($authors);

                ?>
                <div class="dashboard-col-4">
                    <a href="manage_authors.php">
                        <h3><?= $total_authors; ?></h3>
                        Liste des auteurs
                    </a>
                </div>
                <?php
                $categories = mysqli_query($db, "SELECT * FROM `category`");
                $total_categories = mysqli_num_rows($categories);

                ?>
                <div class="dashboard-col-4">
                    <a href="manage_categories.php">
                        <h3><?= $total_categories; ?></h3>
                        Liste des categories
                    </a>
                </div>
                <?php
                $requests = mysqli_query($db, "SELECT student.studentid,FullName,books.bookid,bookname,ISBN,price FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid where issueinfo.approve='' ");
                $total_requests = mysqli_num_rows($requests);
                ?>
                <div class="dashboard-col-4">
                    <a href="request_info.php">
                        <h3><?= $total_requests; ?></h3>
                        Total livres demendé
                    </a>
                </div>
                <?php
                $var = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
                $issue = mysqli_query($db, "SELECT student.studentid,FullName,books.bookid,bookname,ISBN,price FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid where issueinfo.approve='Yes' or issueinfo.approve='$var'");
                $total_issue = mysqli_num_rows($issue);

                ?>
                <div class="dashboard-col-4">
                    <a href="manage_issued_books.php">
                        <h3><?= $total_issue; ?></h3>
                        Total des livres publiés
                    </a>
                </div>
                <?php
                $var = '<p style="color:yellow; background-color:red;">RETURNED</p>';
                $returned = mysqli_query($db, "SELECT student.studentid,FullName,books.bookid,bookname,ISBN,price FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid where issueinfo.approve='$var'");
                $total_returned = mysqli_num_rows($returned);
                ?>
                <div class="dashboard-col-4">
                    <a href="returned.php">
                        <h3><?= $total_returned; ?></h3>
                        Listes renvoyées
                    </a>
                </div>
                <?php
                $var = '<p style="color:yellow; background-color:red;">EXPIRED</p>';
                $expired = mysqli_query($db, "SELECT student.studentid,FullName,books.bookid,bookname,ISBN,price FROM student inner join issueinfo on student.studentid=issueinfo.studentid inner join books on issueinfo.bookid=books.bookid where issueinfo.approve='$var'");
                $total_expired = mysqli_num_rows($expired);
                ?>
                <div class="dashboard-col-4">
                    <a href="expired.php">
                        <h3><?= $total_expired; ?></h3>
                        Listes expirées
                    </a>
                </div>
                <?php
                $trending = mysqli_query($db, "SELECT *FROM trendingbook;");
                $total_trending = mysqli_num_rows($trending);
                ?>
                <div class="dashboard-col-4">
                    <a href="trending_books.php">
                        <h3><?= $total_trending; ?></h3>
                        Livres tendances totales
                    </a>
                </div>
            </div>
            <!-- <div class="dashboard-row">
                
            </div>
            <div class="dashboard-row">
                
            </div>     -->

        </div>
    </div>
    <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <h1>Disponible</h1>
                <p><i class="far fa-clock" style="color: rgb(128, 6, 0);"></i>Lundi à vendredi - 8h:30mn à 20h</p>
                <p><i class="far fa-clock" style="color: rgb(128, 6, 0);"></i>Samedi - 8h:30mn to 13h</p>
            </div>
            <div class="footer-right">
                <h1>Contacter nous</h1>
                <p>EPI-Niger online library <a href="https://www.google.com/maps/place/EPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger/@13.5318916,2.1024797,17z/data=!4m14!1m7!3m6!1s0x11d0754a14323b47:0x67409acc1f19285b!2sEPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013!3m5!1s0x11d0754a14323b47:0x67409acc1f19285b!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013?entry=ttu"><i class="fas fa-map-marker-alt" style="color: rgb(128, 6, 0);"></i></a></p>
                <p>info@epiniger.edu.ne<i class="fas fa-paper-plane" style="color: rgb(128, 6, 0);"></i></p>
                <p>(+227) 98.60.60.78 92.41.08.08<i class="fas fa-phone-alt" style="color: rgb(128, 6, 0);"></i></p>
            </div>
        </div>
        <div class="social-links">
            <i class="fab fa-facebook-f" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <i class="fab fa-twitter" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <i class="fab fa-instagram-square" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <i class="fab fa-youtube" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <p>&copy; 2023 Copyright by soft-thec</p>
        </div>
    </div>
</body>

</html>