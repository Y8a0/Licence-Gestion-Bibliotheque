<?php

	include "connection.php";
    include "student_navbar.php";
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
    <div class="request-table">
        <div class="request-container">
            <h2 class="request-title">List of Requested Books</h2>
            <?php
	    if(isset($_SESSION['login_student_username']))
		{

			$q1=mysqli_query($db,"SELECT studentid from student where studentid='$_SESSION[studentid]';");
		    $row=mysqli_fetch_assoc($q1);

			$q=mysqli_query($db,"SELECT books.bookpic,books.bookid,books.bookname,books.ISBN,books.price,books.quantity,authors.authorname,category.categoryname from  `issueinfo` join `books` on issueinfo.bookid=books.bookid join `student`on student.studentid=issueinfo.studentid join authors on authors.authorid=books.authorid join category on category.categoryid=books.categoryid where student.studentid ='$_SESSION[studentid]' and issueinfo.approve=''; ");
			if(mysqli_num_rows($q)==0)
			{
				echo "There's no pending request";
			}
			else
			{
				echo "<table class='rtable'>";
                echo "<tr style='background-color: rgb(128, 6, 0);'>";
                //Table header
                // echo "<th>"; echo "Book ID"; echo "</th>";
                echo "<th>"; echo "Books"; echo "</th>";
                echo "<th>"; echo "Author Name"; echo "</th>";
                echo "<th>"; echo "Category Name"; echo "</th>";
                echo "<th>"; echo "ISBN"; echo "</th>";
                // echo "<th>"; echo "Issue Date"; echo "</th>";
                // echo "<th>"; echo "Return Date"; echo "</th>";
                // echo "<th>"; echo "Approve Status"; echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    echo "<tr>";
                    // echo "<td>"; echo $row['bookid']; echo "</td>";
                    echo "<td>
                    <div class='table-info'>
                        <img src='images/".$row['bookpic']."'>
                        <div>
                            <p>";echo $row['bookname'];echo"</p>
                            <small>Price: ";echo $row['price'];echo" Tk.</small><br>";?>
                            <a href="?req=<?php echo $row['bookid'];?>"><button type='submit' name='remove'>Remove</button></a>
                        </div>
                    </div>
                    </td><?php
                    echo "<td>"; echo $row['authorname']; echo "</td>";
                    echo "<td>"; echo $row['categoryname']; echo "</td>";
                    echo "<td>"; echo $row['ISBN']; echo "</td>";
                    // echo "<td>"; echo $row['issuedate']; echo "</td>";
                    // echo "<td>"; echo $row['returndate']; echo "</td>";
                    // echo "<td>"; echo $row['approve']; echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
                }
            }

            ?>
        </div>
    </div>
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
    <?php
    if(isset($_GET['req']))
	{
		$id=$_GET['req'];
		mysqli_query($db,"DELETE FROM issueinfo where bookid=$id AND studentid = '$_SESSION[studentid]' AND approve=' ';");
        $res=mysqli_query($db,"SELECT quantity from books where bookid=$id;");
		while($row=mysqli_fetch_assoc($res))
		{
			if($row['quantity']==0)
			{
				mysqli_query($db,"UPDATE books SET quantity=quantity+1, status='Available' where bookid=$id;");
			}
			else
			{
				mysqli_query($db,"UPDATE books SET quantity=quantity+1 where bookid=$id;");
			}
			
		}
		?>	
		<script type="text/javascript">
			alert("Request Deleted successfully.");
			
		</script>
		<script type="text/javascript">
			window.location="request_book.php";
	    </script>
		<?php
	}
	?>
</body>
</html>