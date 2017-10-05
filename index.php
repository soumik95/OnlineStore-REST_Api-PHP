<?php

session_start();

if(isset($_SESSION['auth_token'])) 
{
    header("Location: home.php");
} 
else 
{
?>


<html>
<head>
    <title>Store:: LogIn</title>
    <link href="style.css" rel="stylesheet" type="text/css">
</head>

<body>
        <div id="main" >
            <div id="login" >
                <h2>Login Form</h2>

                <form action="authentication.php" method="post">

                    <label>UserName :</label>
                    <input type="text" name="username" placeholder="Enter username" ><br><br>

                    <label>Password :</label>
                        <input type="password" name="password" placeholder="Enter password"><br><br>

                        <input type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>
    <font color="blue">
    <b><u>Guide</u></b><br><br>
    <b>Customer:</b> Can perform Search operation only<br>
    Username: <b>customer</b> Password: <b>1234</b> <br><br>
    
    <b>Seller:</b> Can Insert, Update, Delete and Search. <b>Can't Modify/Delete other User's data.</b><br>
    Username: <b>sellerA</b> Password: <b>1234</b> <br>
    Username: <b>sellerB</b> Password: <b>1234</b> <br><br>
    
    
    <b>Admin:</b> Can perform Insert, Update, Delete and Search operation on all data.<br>
    Username: <b>admin</b> Password: <b>1234</b>
    </font>
    </body>
</html>
<?php } ?>





