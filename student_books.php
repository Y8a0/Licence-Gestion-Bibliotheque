<?php

	include "connection.php";
	include "student_navbar.php";
    $res=mysqli_query($db,"SELECT * FROM category");

?> 

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Library Management System</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
</head>
<body>
    
    
    <div class="all-books">
        <div class="search-bar">
            <form action="" method='post'>
                <select name="category" class="select-category">
                    <option value="selectcat">Select Category</option>
                    <?php while($row=mysqli_fetch_array($res)):;?>
                        <option value="<?php echo $row[0];?>"><?php echo $row[1];?></option>
                    <?php endwhile;?>
                </select>
                <input type="search" name='search' placeholder='Search by Book Name'>
                <button type='submit' name='submit'><i class="fas fa-search"></i></button>
            </form>
        </div>
        <div class="small-container">
            <!-- <h2 class="all-books-title">All Books</h2> -->
            <?php
            if(isset($_POST['submit']))
            {
                if($_POST['category']!="selectcat")
                {
                
                $cat = mysqli_query($db,"SELECT categoryname FROM category where categoryid = $_POST[category];");
                $row=mysqli_fetch_assoc($cat);
                ?>
                <h2 class='all-books-title'>
                <?php
                echo $row['categoryname'];
                ?></h2>
                <?php     
                $q=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid where bookname like '%$_POST[search]%' AND books.categoryid = $_POST[category];");
                
                if(mysqli_num_rows($q)==0)
                {
                    echo "Sorry! No Books found. Try searching again";

                }
                else{
                    ?>
                    <div class="row">
                    <?php
                        while($row=mysqli_fetch_assoc($q)){
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
                                <p><b>Status: &nbsp;</b>
                                <span>
                                <?php
                                    echo $row['status'];
                                ?></span> </p>
                                <a href="requested_book.php?req=<?php echo $row['bookid'];?>"><button type="submit" name="submit1" class="btn btn-default" >Request
                                    </button>
                                </a>
                                </div>
                            </div>
                            </div>
                            <?php
                        }
                    ?>
                    </div>
                <?php 
                }  
                }
                else{
                    ?><h2 class="all-books-title">All Books</h2>
                <?php
                $q=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid where bookname like '%$_POST[search]%'; ");
                if(mysqli_num_rows($q)==0)
                {
                    echo "Sorry! No Books found. Try searching again";

                }
                else{
                    ?>
                    <div class="row">
                    <?php
                    while($row=mysqli_fetch_assoc($q)){
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
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                            <a href="requested_book.php?req=<?php echo $row['bookid'];?>"><button type="submit" name="submit1" class="btn btn-default" >Request
                                </button>
                            </a>
                            </div>
                        </div>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                <?php 
                } 
                }
                  
            }
            else{
                ?><h2 class="all-books-title">All Books</h2>
                <div class="row">
                <?php
                $res=mysqli_query($db,"SELECT books.bookid,books.bookpic,books.bookname,category.categoryname,authors.authorname,books.ISBN,books.price,quantity,status from  `books` join `category` on category.categoryid=books.categoryid join `authors` on authors.authorid=books.authorid;");
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
                            <p><b>Status: &nbsp;</b>
                            <span>
                            <?php
                                echo $row['status'];
                            ?></span> </p>
                            <a href="requested_book.php?req=<?php echo $row['bookid'];?>"><button type="submit" name="submit1" class="btn btn-default" >Request
                                </button>
                            </a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                </div>
            <?php 
            }
            ?>
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
                <p><a href="https://www.google.com/maps/place/EPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger/@13.5318916,2.1024797,17z/data=!4m14!1m7!3m6!1s0x11d0754a14323b47:0x67409acc1f19285b!2sEPI+Niger,+L'Ecole+Priv%C3%A9e+d'Ing%C3%A9nierie+du+Niger!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013!3m5!1s0x11d0754a14323b47:0x67409acc1f19285b!8m2!3d13.5318864!4d2.1050546!16s%2Fg%2F11sycs3013?entry=ttu" style="color: rgb(12, 6, 0);">EPI-Niger online library <i class="fas fa-map-marker-alt" style="color: rgb(128, 6, 0);"></i></a></p>
                <p><a href="https://www.epiniger.edu.ne/" style="color: rgb(12, 6, 0);">info@epiniger.edu.ne <i class="fas fa-paper-plane" style="color: rgb(128, 6, 0);"></i></a></p>
                <p><a href="tel:98606078" style="color: rgb(12, 6, 0);">(+227) 98.60.60.78 <i class="fas fa-phone-alt" style="color: rgb(128, 6, 0);"></i></a></p>
            </div>
        </div>
        <div class="social-links">
            <a href="https://www.facebook.com/search/top?q=epiniger&locale=fr_FR"><i class="fab fa-facebook-f" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i></a>
            <a href="https://www.instagram.com/epi.niger/"><i class="fab fa-instagram-square" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i></a>
            <i class="fab fa-twitter" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <i class="fab fa-youtube" style="color: rgb(128, 6, 0); border: 2px solid rgb(128, 6, 0);"></i>
            <p>&copy; 2023 Copyright by soft-thec</p>
        </div>
    </div>
    
</body>
</html>