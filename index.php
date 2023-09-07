<?php

    include "connection.php";
    include "index_navbar.php";
?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EPI Online Library</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    <div class="banner">
        <div class="banner-content">
            <h1>Welcome to Library</h1>
        </div>
    </div>
    <div class="trending-books all-books">
        <div class="small-container">
            <h2 class="co-title">Trending Books</h2>
            <div class="row">
            <?php
                $res=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid join trendingbook on trendingbook.bookid=books.bookid;");
                while($row=mysqli_fetch_assoc($res)){
                    ?>
                    <div class="card">
                        <!-- <img src="images/c.jpg" alt="">  -->
                        <?php
                            echo "<img src='images/".$row['bookpic']."'>";
                        ?>
                        <div class="card-body">
                            <h4 style="font-size: 18px;">
                                <?php
                                    echo $row['bookname'];
                                ?></h4>
                                <p style="font-size: 18px">Price: 
                                <?php
                                    echo $row['price'];
                                ?> Tk.</p>
                            
                            <div class="overlay"></div>
                            <div class="sub-card">
                            <p><b>Book Name: &nbsp;</b> 
                            <?php
                                echo $row['bookname'];
                            ?></p>  
                            <p><b>Category Name: &nbsp;</b> 
                            <?php
                                echo $row['categoryname'];
                            ?></p>
                            <p><b>Author Name: &nbsp;</b> 
                            <?php
                                echo $row['authorname'];
                            ?></p>
                            <p><b>ISBN: &nbsp;</b> 
                            <?php
                                echo $row['ISBN'];
                            ?></p>
                            <p><b>Quantity: &nbsp;</b> 
                            <?php
                                echo $row['quantity'];
                            ?></p>
                            <p><b>Price:</b> 
                            <?php
                                echo $row['price'];
                            ?> Tk.</p> 
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- <div class="card">
                    <img src="images/c.jpg" alt=""> 
                    <div class="card-body">
                        <h4>C</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/cplus.jpg" alt="">
                    <div class="card-body">
                        <h4>C++</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/java.jpg" alt="" class="java-img">
                    <div class="card-body">
                        <h4>Java</h4>
                        <p>$50.00</p>
                    </div>
                </div>
                <div class="card">
                    <img src="images/python2.jpg" alt="">
                    <div class="card-body">
                        <h4>Python</h4>
                        <p>$50.00</p>
                    </div>
                </div> -->
            </div>
        </div>
    </div>
    <div class="testimonial">
        <div class="small-container">
        <h2 class="co-title">Some student comments</h2>
            <div class="row">
            <?php
            $res=mysqli_query($db,"SELECT student.studentpic,FullName,feedback.rating,comment from feedback join student on student.studentid=feedback.stdid ORDER BY feedback.rating DESC");
            $total = mysqli_num_rows($res);
            $count=0;
            while($count<3 && $row=mysqli_fetch_assoc($res)){
                ?>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p><?php
                        echo $row['comment'];
                    ?></p>
                    <?php
                        ?>
                        <div class="rating"><?php
                        if($row['rating']==5){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==4){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==3){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==2){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }
                        else if($row['rating']==1){
                            ?>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <i class="far fa-star"></i>
                            <?php
                        }?>
                        </div>
                    <?php
                        echo "<img src='images/".$row['studentpic']."'>";
                    ?>
                    <?php
                        echo "<h3>";echo $row['FullName'];echo"</h3>";
                    ?>
                </div>
                <?php
                $count = $count+1;
            }
            ?>
                
                <!-- <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-1.png" alt="">
                    <h3>Sean Parker</h3>
                </div> -->
                <!-- <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-2.png" alt="">
                    <h3>Mike Smith</h3>
                </div>
                <div class="col-3">
                    <i class="fas fa-quote-left"></i>
                    <p>
                        Lorem Ipsim is simply dummy text of the printing
                        and typesetting industry. Lorem Ipsum has been the industry's standard
                        dummy text ever.
                     </p>
                     <div class="rating">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                    <img src="images/user-3.png" alt="">
                    <h3>Mabel Joe</h3>
                </div> -->
            </div>
        </div>
    </div>
    <div class="footer">
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
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                    }
                }
            }
        }
    </script>
</body>
</html>