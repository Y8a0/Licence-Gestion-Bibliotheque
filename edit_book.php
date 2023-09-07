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
			
			$id=$_GET['ed'];
			$q= "SELECT books.bookpic,books.bookid,books.bookname,authors.authorid,authors.authorname,category.categoryid,category.categoryname,books.ISBN,books.price,quantity,status from  `books`join `authors` on authors.authorid=books.authorid join `category` on category.categoryid=books.categoryid where bookid=$id";
			$res=mysqli_query($db,$q) or die(mysqli_error());
			
			while($row=mysqli_fetch_assoc($res))
			{
				$bookid=$row['bookid'];
                $pic=$row['bookpic'];
				$bookname=$row['bookname'];
				$authorid=$row['authorid'];
				$categoryid=$row['categoryid'];
				$authorname=$row['authorname'];
				$categoryname=$row['categoryname'];
				$ISBN=$row['ISBN'];
				$price=$row['price'];
				$quantity=$row['quantity'];
				$status=$row['status'];

			}
	    ?>
        <div class="form form-book">
            <div class="form-container edit-form-container edit-book-container">
                <div class="form-btn">
                    <span onclick="login()" style="width: 100%;">Editer l'info du livre</span>
                    <hr id="indicator" class="add-author">
                </div>
                <form action="" id="loginform" method="post" enctype="multipart/form-data">
                    <div class="label book-img">
                        <?php echo "<img width='50px' height='50px' src='images/".$pic."'>"?>
                    </div>
                    <div class="label">
                        <label for="studentid">livre ID : </label>
                        <b style="font-size: 15px;">
                        <?php
			                echo $bookid;
			            ?>
                    </b><br>
                    </div>
                    <div class="label">
                        <label for="bookname">Nom du livre : </label>
                    </div>
                    <input type="text"  name="bookname" value="<?php echo $bookname; ?>">
                    <div class="label">
                        <label for="authorname">Nom d'auteur : </label>
                    </div>
                    <select class="form-control" name="authorname" >
                        <option value="<?php echo $authorid;?>"><?php echo $authorname;?></option>
                        <?php while($row1=mysqli_fetch_array($res1))
                        {
                            if($authorname==$row1['authorname'])
                            {
                                continue;
                            }
                            else
                            {
                                ?>
                                <option value="<?php echo $row1['authorid'];?>"><?php echo $row1['authorname'];?></option>
                                <?php
                            }
                        }
                        ?>        
                    </select>
                    <div class="label">
                        <label for="authorname">Nom du categorie : </label>
                    </div>
                    <select class="form-control" name="categoryname">
                        <option value="<?php echo $categoryid;?>"><?php echo $categoryname;?></option>
                        <?php while($row2=mysqli_fetch_array($res2))
                        {
                            if($categoryname==$row2['categoryname'])
                            {
                                continue;
                            }
                            else
                            {
                                ?>
                                <option value="<?php echo $row2['categoryid'];?>"><?php echo $row2['categoryname'];?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>
                    <div class="label">
                        <label for="ISBN">ISBN : </label>
                    </div>
                    <input type="text"  name="ISBN" value="<?php echo $ISBN; ?>">
                    <div class="label">
                        <label for="price">Price : </label>
                    </div>
                    <input type="text"  name="price" value="<?php echo $price; ?>">
                    <div class="label">
                        <label for="quantity">Quantité : </label>
                    </div>
                    <input type="text"  name="quantity" value="<?php echo $quantity; ?>">
                    <div class="label">
                        <label for="status">Status : </label>
                    </div>
                    <input type="text"  name="status" value="<?php echo $status; ?>">
                    <div class="label">
                        <label for="pic">Update Picture :</label>
                    </div>
                    <input type="file"  name="file" class="file">
                    <button type="submit" class="btn" name="submit">Valider</button>
                </form>
            </div>
        </div>
    </div>
    <?php
        if(isset($_POST['submit']) && !empty($_FILES["file"]["name"]))
        {
            
            $bookname=$_POST['bookname'];
            $authorname=$_POST['authorname'];
            $categoryname=$_POST['categoryname'];
            $ISBN=$_POST['ISBN'];
            $price=$_POST['price'];
            $quantity=$_POST['quantity'];
            $status=$_POST['status'];
            move_uploaded_file($_FILES['file']['tmp_name'],"images/".$_FILES['file']['name']);
            $pic = $_FILES['file']['name'];

            $q1="UPDATE books SET bookpic = '$pic',bookname='$bookname',authorid='$authorname',categoryid='$categoryname',ISBN='$ISBN',price='$price',quantity='$quantity',status='$status' where bookid=".$id.";";
            if(mysqli_query($db,$q1))
            {
                ?>
                <script type="text/javascript">
                    alert("Book updated successfully.");
                    window.location="manage_books.php";
                </script>
                <?php
            }
        }
        else if(isset($_POST['submit']))
        {
            
            $bookname=$_POST['bookname'];
            $authorname=$_POST['authorname'];
            $categoryname=$_POST['categoryname'];
            $ISBN=$_POST['ISBN'];
            $price=$_POST['price'];
            $quantity=$_POST['quantity'];
            $status=$_POST['status'];
        
            $q1="UPDATE books SET bookname='$bookname',authorid='$authorname',categoryid='$categoryname',ISBN='$ISBN',price='$price',quantity='$quantity',status='$status' where bookid=".$id.";";
            if(mysqli_query($db,$q1))
            {
                ?>
                <script type="text/javascript">
                    alert("Book updated successfully.");
                    window.location="manage_books.php";
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