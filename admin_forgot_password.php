<?php

    include "connection.php";

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
</head>
<body>

    <div class="header">
        <div class="container">
            <div class="navbar">
                <div class="logo">
                   <a href="index.php"><img src="image/Epi.jpeg" alt="Logo" style="border-radius: 50%;"></a> 
                </div>
                <div class="title">
                <a href="index.php"><h3><!-- EPI-Niger online library --></h3></a>
                </div>
                <nav>
                    <ul id="menuitems">
                        <li><a href="index.php"><i class="fas fa-home"></i>  Acceuil</a></li>
                        <li><a href=""><i class="fas fa-book"></i> Livre</a></li>
                        <!-- <li><a href="">About Us</a></li>
                        <li><a href="">Contact</a></li> -->
                        <li><a href="admin.php"><i class="fas fa-user-shield"></i> Admin</a></li>
                        <li><a href="student.php"><i class="fas fa-users"></i> Etudiant</a></li>
                    </ul>
                </nav>
               <!-- <a href="cart.html"><img src="images/cart.png" alt="Cart" width="50px" height="50px" style="margin-left: 10px;" class="cart-icon"></a> 
                <img src="images/menu.png" alt="Menu" class="menu-icon" onclick="menutoggle()"> -->
            </div>
        </div>
    </div>
    <div class="banner">
        <div class="form">
            <div class="form-container">
                <div class="form-btn form-password">
                    <span onclick="login()" style="width: 100%;">Récupérer mot de passe</span>
                    <hr id="indicator" class="indi-password">
                </div>
                <form action="" id="loginform" method="post">
                    <input type="text" placeholder="User Name" name="username" required>
                    <input type="password" placeholder="Enter New Password" name="password" id="adminpass2" required>
                    <span class='show-hide-adminpass2'><i class="fas fa-eye" id="eye-adminpass2"></i></span>
                    <button type="submit" class="btn" name="change">Change</button>
                </form>
            </div>
        </div>
    </div>

    <?php

		if(isset($_POST['change']))
		{

			$res=mysqli_query($db,"SELECT * FROM `admin` WHERE username='$_POST[username]' ;");
			$count=mysqli_num_rows($res);
			if($count==0)
			{
				?>
				<script type="text/javascript">
					alert("The username doesn't match.");

				</script>
				<?php
			}
			else
			{
				if(mysqli_query($db,"UPDATE admin SET password='$_POST[password]' WHERE username='$_POST[username]';"))
				{
					?>
					<script type="text/javascript">
						alert("Your Password is successfully changed");
					</script>
				<?php
				}
			}
	
		}

	?>
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
    <script>
        var pass2 = document.getElementById("adminpass2");
        var showbtn2 = document.getElementById("eye-adminpass2");
        showbtn2.addEventListener("click",function(){
            if(pass2.type === "password"){
                pass2.type = "text";
                showbtn2.classList.add("hide");
            }
            else{
                pass2.type = "password";
                showbtn2.classList.remove("hide");
            }
        });
    </script>
</body>
</html>