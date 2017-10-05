<?php

session_start();

echo 'Logged In as: '.$_SESSION['username'];



//Authorised Access
if(isset($_SESSION['auth_token'])) {
    include "connectdb.php";
    $add = md5("add");
    $delete = md5("delete");
    $update = md5("update");
    $search = md5("search");
    ?>


<html>
    <head>

    </head>
    <body>
        
        
<?php
    
if ($_SESSION['username']=="customer" )    
{
  ?>
        <div align="center">
         To Search a Product, Click: <button onclick="location.href = 'home.php?event=<?= $search; ?>';">Search Product</button> <br> <br>
        <button onclick="location.href = 'logout.php';">Logout</button> <br> <br>
    </div>
<?php        
        
}
else        
{   ?>
    <div align="center">
         To Insert a Product, Click: <button onclick="location.href = 'home.php?event=<?= $add; ?>';">Insert Product</button> <br> <br>
         To Delete a Product, Click: <button onclick="location.href = 'home.php?event=<?= $delete; ?>';">Delete Product</button> <br> <br>
         To Update a Product, Click: <button onclick="location.href = 'home.php?event=<?= $update; ?>';">Update Product</button><br> <br>
         To Search a Product, Click: <button onclick="location.href = 'home.php?event=<?= $search; ?>';">Search Product</button> <br> <br>
         Click Update to get Product List. <br><br>
        <button onclick="location.href = 'logout.php';">Logout</button> <br> <br>
    </div>
       <?php
}
             
   ?> 
    
    
    <div align="center">
    <?php
    //If Insert Option is selected
        if (isset($_GET['event']) && $_GET['event'] == md5("add")) {
            ?>
            <br> 
            <br>
            <br> 
            <br>
            
            <form action="routing.php?event=<?=$add;?>" method="post">
                Product Name: <input type="text" name="name" placeholder="Enter Product Name"><br><br>
                Description: <input type="text" name="desc" placeholder="Enter Product Description"><br><br>
                Quantity: <input type="text" name="quantity" placeholder="Enter Product Quantity"><br><br>
                Price: <input type="text" name="price" placeholder=" Enter Product Price"><br><br>
                Serial No: <input type="text" name="sl_no" placeholder="Serial Number"><br><br>
                Product Category: <select name="category">
                    <option value="Electronics">Electronics</option>
                    <option value="Men">Men</option>
                    <option value="Women">Women</option>
                    <option value="Baby & Kids">Baby & Kids</option>
                    <option value="Home & Furniture">Home & Furniture</option>
                    <option value="Books & Media">Books & Media</option>
                    <option value="Auto & Sports">Auto & Sports</option>
                </select><br><br>
                
               <?php
                if ($_SESSION['username']=="admin" )    
                { ?>
                Seller: <input type="text" name="seller" placeholder="Enter Seller Details"> <br><br>
                <?php
                }
                else
                { ?>
                Seller: <input type="text" name="seller" value="<?php echo $_SESSION['username'] ?>" readonly="readonly"> <br><br>
                <?php
                }
                ?>
                
                Username: <input type="text" name="user" value="<?php echo $_SESSION['username'] ?>" readonly="readonly"> <br><br>

                
                
           
                
                
                <input type="submit" value="Add"><br>
            </form>
        
            <?php
        }
    
    //If Delete Option is selected
    if (isset($_GET['event']) && $_GET['event'] == md5("delete")) {
        
        $user=$_SESSION['username'];
        $fetch_details_query="SELECT * FROM products";
        
        if ($user!="admin" )    
        {  
            $fetch_details_query = "SELECT * FROM products WHERE seller = '$user'";
        }
        
        
        $result_query = mysqli_query($con,$fetch_details_query);
        ?>
        <table>
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Serial No.</th>
            <th>Category</th>
            <th>Seller</th>
            <th>Operation</th>
           
            </thead>
            <tbody>
            <?php
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['productId'];
                $product_name = $row['productName'];
                $product_desc = $row['productInfo'];
                $quantity = $row['productQuantity'];
                $price = $row['productPrice'];
                $sl_no = $row['serial_no'];
                $category = $row['productCategory'];
                $seller = $row['seller'];
                ?>
                <tr>
                    <td><?=$product_id;?></td>
                    <td><?=$product_name;?></td>
                    <td><?=$product_desc;?></td>
                    <td><?=$quantity;?></td>
                    <td><?=$price;?></td>
                    <td><?=$sl_no;?></td>
                    <td><?=$category;?></td>
                    <td><?=$seller;?></td>
                  
                    <td><button onclick="location.href = 'routing.php?event=<?=$delete;?>&id=<?=$product_id;?>';">Delete</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
    
    
    //If Update Option is selected
    if (isset($_GET['event']) && $_GET['event'] == md5("update")) {
        $fetch_details_query = "SELECT * FROM products";
        $result_query = mysqli_query($con,$fetch_details_query);
        ?>
        <table>
            <thead>
            <th>Id</th>
            <th>Name</th>
            <th>Description</th>
            <th>Quantity</th>
            <th>Cost</th>
            <th>Serial No</th>
            <th>Category</th>
            <th>Seller</th>    
            <th>Operation</th>
            </thead>
            <tbody>
            
                
            <?php
            while($row = mysqli_fetch_assoc($result_query)) {
                $product_id = $row['productId'];
                $product_name = $row['productName'];
                $product_desc = $row['productInfo'];
                $quantity = $row['productQuantity'];
                $price = $row['productPrice'];
                $sl_no = $row['serial_no'];
                $category = $row['productCategory'];
                $seller = $row['seller'];
                ?>
                <tr>
                    <td><?=$product_id;?></td>
                    <td><?=$product_name;?></td>
                    <td><?=$product_desc;?></td>
                    <td><?=$quantity;?></td>
                    <td><?=$price;?></td>
                    <td><?=$sl_no;?></td>
                    <td><?=$category;?></td>
                    <td><?=$seller;?></td>
                    <td><button onclick="location.href = 'routing.php?event=update&id=<?=$product_id;?>';">Update</button></td>
                </tr>
                <?php
            }
            ?>
            </tbody>
        </table>
        <?php
    }
        
    //If Search Option is selected
    if (isset($_GET['event']) && $_GET['event'] == md5("search")) {
            ?>
            <form action="routing.php?event=<?=$search;?>" method="post">
               Enter Search Keyword <input type="text" name="keyword" placeholder="Enter value">
                <input type="submit" value="Search">
            </form>
            <center>Example: tv, mobile, refrigerator, ac, iphone, book, etc</center>
            <?php
        }
        ?>
    </div>
           
    </body>
    </html>
    <?php
} 
else {
    echo "To continue, Click: <a href='index.php'>SignIn </a>";
    echo "To continue, Click: <a href='index.php'>SignIn </a>";
}