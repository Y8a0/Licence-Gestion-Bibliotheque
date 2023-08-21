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
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">

</head>
<body>
    <div class="search-bar admin-search">
        <form action="" method='post'>
            <input type="search" name='search' placeholder='Search by Category Name' required>
            <button type='submit' name='submit'><i class="fas fa-search"></i></button>
        </form>
    </div>
    <div class="request-table">
        <div class="request-container">
            <h2 class="request-title student-info-title">List of Categories</h2>
            <?php

		if(isset($_POST['submit']))
		{
			$q=mysqli_query($db,"SELECT * FROM category where categoryname like '%$_POST[search]%'; ");
			if(mysqli_num_rows($q)==0)
			{
				echo "Sorry! No Categories found. Try searching again";

			}
			else
			{
				echo "<table class='rtable authortable'>";
                echo "<tr style='background-color: rgb(128, 6, 0);'>";
                //Table header
                echo "<th>"; echo "Category ID"; echo "</th>";
                echo "<th>"; echo "Category Name"; echo "</th>";
                echo "<th>"; echo "Action"; echo "</th>";
                echo "</tr>";

                while($row=mysqli_fetch_assoc($q))
                {
                    echo "<tr>";
                    echo "<td>"; echo $row['categoryid']; echo "</td>";
                    echo "<td>"; echo $row['categoryname']; echo "</td>";
                    echo "<td>";?><a href="edit_category.php?ed=<?php echo $row['categoryid'];?>"><button style="font-weight:bold;" type="submit" name="submit1" class="btn btn-default actionbtn"><i class="fas fa-edit"></i> Edit
			        </button>
                    </a>
                    <a href="delete_category.php?del=<?php echo $row['categoryid'];?>"><button onclick="del()" style="font-weight:bold;" type="submit" name="submit1" class="delbtn" ><i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </a>
			        <?php 
			        echo "</td>";
                    echo "</tr>";
                }
                echo "</table>";
		    }
		}
			//if button is not pressed
		else
		{
			$res=mysqli_query($db,"SELECT * FROM category; ");
            echo "<table class='rtable authortable'>";
                echo "<tr style='background-color: rgb(128, 6, 0);'>";
                //Table header
                echo "<th>"; echo "Category ID"; echo "</th>";
                echo "<th>"; echo "Category Name"; echo "</th>";
                echo "<th>"; echo "Action"; echo "</th>";
                echo "</tr>";

            while($row=mysqli_fetch_assoc($res))
            {
                echo "<tr>";
                echo "<td>"; echo $row['categoryid']; echo "</td>";
                echo "<td>"; echo $row['categoryname']; echo "</td>";
                echo "<td>";?><a href="edit_category.php?ed=<?php echo $row['categoryid'];?>"><button style="font-weight:bold;" type="submit" name="submit1" class="btn btn-default actionbtn"><i class="fas fa-edit"></i> Edit
                </button>
                </a>
                <a href="delete_category.php?del=<?php echo $row['categoryid'];?>"><button onclick="del()" style="font-weight:bold;" type="submit" name="submit1" class="delbtn"><i class="fas fa-trash-alt"></i> Delete
                </button></a>
                
                <?php 
                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";

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
    <!-- <script>
        function del(){
            var proceed = confirm("Are you sure want to delete?");
            if(proceed){
                window.location="delete_author.php";
            }
            else{
                window.location="manage_authors.php";
            }
        }
    </script> -->
</body>
</html>