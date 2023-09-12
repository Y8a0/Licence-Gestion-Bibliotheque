<?php

	include "connection.php";
    include "admin_navbar.php";
    $res1=mysqli_query($db,"SELECT * FROM authors");
	$res2=mysqli_query($db,"SELECT * FROM category");
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
    <div class="edit-profile-container">
        <?php
			
			$studentid=$_GET['ed'];
			$bookid=$_GET['ed1'];

            $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
			$q= "SELECT student.studentid,FullName,studentpic,issueinfo.bookid,books.bookname,ISBN,price,bookpic,issuedate,returndate,approve,fine,authors.authorname,category.categoryname From issueinfo inner join student on issueinfo.studentid=student.studentid inner join books on issueinfo.bookid=books.bookid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where student.studentid=$studentid and (approve='yes' or approve='$var') and issueinfo.bookid=$bookid";
			$res=mysqli_query($db,$q) or die(mysqli_error());
            $t=mysqli_query($db,"SELECT * FROM timer where stdid='$studentid' and bid='$bookid';");
			$row2=mysqli_fetch_assoc($t);
			$row=mysqli_fetch_assoc($res);
			
				$studentid=$row['studentid'];
				$studentpic=$row['studentpic'];
				$FullName=$row['FullName'];
				$bookid=$row['bookid'];
				$bookpic=$row['bookpic'];
				$bookname=$row['bookname'];
				$authorname=$row['authorname'];
				$categoryname=$row['categoryname'];
				$ISBN=$row['ISBN'];
				$price=$row['price'];
				$fine=$row['fine'];
                $issuedate=$row['issuedate'];
				$returndate=$row['returndate'];
				$tm=$row2['date'];
	    ?>
        <div class="form form-book">
            <div class="form-container edit-form-container issue-book-container edit-book-container">
                <div class="form-btn">
                    <span onclick="login()" style="width: 100%;">Edit Issue Info</span>
                    <hr id="indicator" class="add-author">
                </div>
                <form action="" id="loginform" method="post" enctype="multipart/form-data">
                    <div class="label">
                        <?php echo "<img width='50px' height='50px' src='images/".$studentpic."'>"?>
                    </div>
                    <div class="label">
                        <label for="studentid">Student ID : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $studentid;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label">
                        <label for="studentid">Full Name : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $FullName;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label" style="margin-top: 10px;">
                        <?php echo "<img width='50px' height='50px' src='images/".$bookpic."'>"?>
                    </div>
                    <div class="label">
                        <label for="studentid">Book ID : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $bookid;
			            ?>
                    </b><br>
                    </div> 
                    <div class="label">
                        <label for="studentid">Nom du livre : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $bookname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Nom d'auteur : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $authorname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Nom du categorie : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $categoryname;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">ISBN : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $ISBN;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="studentid">Bien : </label>
                    </b><br>
                    <input type="text"  name="fine" value="<?php echo $fine; ?>">
                    </div>
                    <div class="label">
                        <label for="studentid">Date d'émission : </label>
                        <b style="font-size: 13px;">
                        <?php
			                echo $issuedate;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="status">Date de retour : </label>
                    </div>
                    <input type="date"  name="returndate" value="<?php echo $returndate; ?>">
                    <div class="label">
                        <label for="status">Date de retour avec heure: </label>
                    </div>
                    <?php $dbInsertDate = date('Y-m-d\TH:i:s', strtotime($tm)); ?>
                    <input type="datetime-local"  name="returndatetime" value="<?php echo $dbInsertDate; ?>">
                    <button type="submit" class="btn" name="submit" style="margin-top: 20px;">Valider</button> 
                </form>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit']))
        {
            $fine=$_POST['fine'];
            $returndate=$_POST['returndate'];
            $var='<p style="color:yellow; background-color:red;">EXPIRED</p>';
            
            $dbInsertDate = date('Y-m-d H:i:s', strtotime($_POST['returndatetime']));
            $q2="UPDATE timer SET date='$dbInsertDate' where bid=$bookid and stdid=".$studentid.";";
            
            $q1="UPDATE issueinfo SET returndate='$returndate',fine='$fine' where approve='yes' and bookid=$bookid and studentid=".$studentid.";";
            
            if(mysqli_query($db,$q1) && mysqli_query($db,$q2))
            {
                ?>

                <script type="text/javascript">
                    alert("Issued book updated successfully.");
                    window.location="manage_issued_books.php";
                </script>
                <?php
            }					
            
        }

		?>
    <!-- <div class="footer">
        <div class="footer-row">
            <div class="footer-left">
                <h1>Available</h1>
                <p><i class="far fa-clock"></i>Monday to Friday - 8h:30mn à 20h</p>
                <p><i class="far fa-clock"></i>Saturday - 8h:30mn to 13h</p>
            </div>
            <div class="footer-right">
                <h1>Get In Touch</h1>
                <p>EPI-Niger online library <a href="https://www.google.com/maps/place/EPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger/@13.5318916,2.1024797,17z/data=!4m14!1m7!3m6!1s0x11d0754a14323b47:0x67409acc1f19285b!2sEPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013!3m5!1s0x11d0754a14323b47:0x67409acc1f19285b!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013?entry=ttu"><i class="fas fa-map-marker-alt"></i></a></p>
                <p>info@epiniger.edu.ne<i class="fas fa-paper-plane"></i></p>
                <p>(+227) 98.60.60.78 92.41.08.08<i class="fas fa-phone-alt"></i></p>
            </div>
        </div>
        <div class="social-links">
            <i class="fab fa-facebook-f"></i>
            <i class="fab fa-twitter"></i>
            <i class="fab fa-instagram-square"></i>
            <i class="fab fa-youtube"></i>
            <p>&copy; 2021 Copyright by soft-thec</p>
        </div>
    </div> -->
</body>
</html>