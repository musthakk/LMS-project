<!DOCTYPE html>
<html lang="en">
    <head>
        <title>LMS</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width = device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

        <?php
            include 'C:\xampp\htdocs\LMS project\mainConnect.php';

            // check if the form is submitted..
            if ($_SERVER["REQUEST_METHOD"] == "POST")
            {
                // get the submitted username and password
                $userName = $_POST["username"];
                $password = $_POST["pswd"];
                    

                if (isset($_POST["admin"])) {
                    // checkbox is checked.

                    $query = "SELECT Admin_Password FROM librarian WHERE Admin_Id = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $userName);

                    // Execute the query
                    $stmt->execute();

                    // Fetch the result
                    $stmt->bind_result($adminPassword);
                    if ($stmt->fetch()) {
                        // Display the Admin_Password value or use it as needed
                        if ($password == $adminPassword)
                        {
                            // password matches
                            header("Location: http://localhost/LMS%20project/Librarian/Admin.php");
                            exit;
                        }
                        else{
                            // Passwords do not match
                            echo '<div class="alert alert-danger alert-dismissible text-center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Unable to login.! Invalid username or password.</strong>
                            </div>';
                            // header("Refresh: 2; URL=login.php"); // Redirect to the login page after 3 seconds
                            // exit;
                        }
                    } else {
                        // No matching row found
                        echo '<div class="alert alert-danger alert-dismissible text-center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Unable to login.! Invalid username or password.</strong>
                            </div>';
                        //header("Refresh: 2; URL=login.php"); // Redirect to the login page after 3 seconds
                        //exit;
                    }
                    
                } else {
                    // The checkbox is not submitted or not checked
                    // Meaning it's a login for a Member not for an Admin..
                    $query = "SELECT Password FROM member WHERE userName = ?";
                    $stmt = $conn->prepare($query);
                    $stmt->bind_param("s", $userName);

                    // Execute the query
                    $stmt->execute();

                    // Fetch the result
                    $stmt->bind_result($MemberPassword);
                    if ($stmt->fetch()) {
                        // Display the MemberPassword value or use it as needed
                        if ($password == $MemberPassword)
                        {
                            // password matches
                            header("Location: http://localhost/LMS%20project/Member/Member.php");
                            exit;
                        }
                        else{
                            // Passwords do not match
                            echo '<div class="alert alert-danger alert-dismissible text-center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Unable to login.! Invalid username or password.</strong>
                            </div>';
                            // header("Refresh: 2; URL=login.php"); // Redirect to the login page after 3 seconds
                            // exit;
                        }
                    } else {
                        // No matching row found
                        echo '<div class="alert alert-danger alert-dismissible text-center">
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            <strong>Unable to login.! Invalid username or password.</strong>
                            </div>';
                        //header("Refresh: 2; URL=login.php"); // Redirect to the login page after 3 seconds
                        //exit;
                    }
                }

            }
                
            
        ?>

        <style>
            body{
                background-color: lightyellow;
            }

            .bg-brown{
                background-color: #510400;
            }
            
            .text-lightyellow{
                color: lightyellow;
            }

            .custom-para{
                color: white;
            }

            .nav-item{
                padding-left: 25px;
            }

            hr{
                color: white;
            }

            .login{
                margin-top: 40px;
                margin-right: 50px;
                margin-left: 50px;
            }


        </style>

    </head>

    <body>


        <div class="container" style="margin-bottom:161px;">
            <div class="row mx-5 pt-3">
                <div class="col-sm-5 p-5 text-brown text-center" style="margin-top: 100px;">
                    <p class="display-4" style="color:#510400"><b>LibraNET</b></p>
                    <p style="color:#510400"><b>Elevate Your Library Experience:</b> Seamlessly Manage, Discover, and Connect with Our Online Library Management System</p>
                </div>
                <div class="col-sm-7 p-3">
                    <div class="container-sm mt-5 d-flex justify-content-center" style="margin-left:40px;">
                        <div class="card mx-5 bg-brown" style="width:400px; height:400px;">

                            <form class="login" action="" method="post">
                                <div class="mb-3 mt-3">
                                    <input type="username" class="form-control" id="usr" placeholder="Enter username or email" name="username">
                                </div>
                                <div class="mb-3">
                                    <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pswd">
                                </div>

                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input" type="checkbox" id="mySwitch" name="admin" value="yes">
                                    <label class="form-check-label" for="mySwitch" style="color: white;">Admin</label>
                                </div>
                            
                                <div class="d-grid">
                                    <button type="submit" class="btn btn-primary btn-block rounded-5">LOGIN</button>
                                </div>
                            </form>

                            <hr>
                            
                            <p class="text-lightyellow text-center" >If you are not a member..</p>
                            <p class="display-6 text-center"><a href="#" class="btn btn-lg btn-success"><span class="spinner-grow spinner-grow-sm"></span> Buy your membership now.</a></p>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        

        <!-- Footer Element of the page !-->
        <footer class="footer mt-5 pt-3 bg-dark text-center text-white">
            <div class=" d-flex align-items-center justify-content-center">
                <p>&copy; Copyright 2023 LibraNET. All rights reserved.</p>
            </div>
        </footer>
        
    </body>
</html>
