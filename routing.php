<?php
session_start();

if(isset($_SESSION['auth_token'])) 
{
    include "connectdb.php";
    
    
    
    
    if(isset($_GET['event']) && $_GET['event'] == md5('add')) 
    {
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $sl_no = $_POST['sl_no'];
        $category = $_POST['category'];
        $seller= $_POST['seller'];

       
        $url = "http://localhost/wingify_rest/api/AddProduct";
        
        $data = "name=$name&desc=$desc&quantity=$quantity&price=$price&sl_no=$sl_no&category=$category&seller=$seller";
        
        
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        
        print_r($output);
    } 
    else 
    {
        if(isset($_GET['event']) && $_GET['event'] == md5('delete')) 
        {
            $id = $_GET['id'];
            
            $url = "http://localhost/wingify_rest/api/DeleteProduct";
            
            $data = "id=$id";
            
            
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $output = curl_exec($ch);
            curl_close($ch);
            
            print_r($output);
        } 
        else 
        {
            if(isset($_GET['event']) && $_GET['event'] == md5('update')) 
            {
                $id = $_POST['id'];
                $name = $_POST['name'];
                $desc = $_POST['desc'];
                $quantity = $_POST['quantity'];
                $price = $_POST['price'];
                $sl_no = $_POST['sl_no'];
                $category = $_POST['category'];
                $seller= $_POST['seller'];
                $user = $_SESSION['username'];

                $url = "http://localhost/wingify_rest/api/UpdateProduct";
                
                $data = "id=$id&name=$name&desc=$desc&quantity=$quantity&price=$price&sl_no=$sl_no&category=$category&seller=$seller&user=$user";
                
                
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, $url);
                curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $output = curl_exec($ch);
                curl_close($ch);
                
                
                print_r($output);
            } 
            else 
            {
                if(isset($_GET['event']) && $_GET['event'] == md5('search')) 
                {
                    $keyword = $_POST['keyword'];
                    
                    $url = "http://localhost/wingify_rest/api/search";
                    $data = "keyword=$keyword";
                    
                    
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_POST, true);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
                    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    
                    print_r($output);
                } 
                else 
                {
                    if(isset($_GET['event']) && $_GET['event'] == 'update') 
                    {
                        $product_id = $_GET['id'];
                        $fetch_query = "SELECT * FROM products WHERE productId = $product_id";
                        $result_query = mysqli_query($con,$fetch_query);
                        $row = mysqli_fetch_assoc($result_query);
                        $product_name = $row['productName'];
                        $product_desc = $row['productInfo'];
                        $quantity = $row['productQuantity'];
                        $price = $row['productPrice'];
                        $sl_no = $row['serial_no'];
                        $category = $row['productCategory'];
                        $seller = $row['seller'];
                        $user = $_SESSION['username'];
                        $update = md5("update");
                        ?>
                        <div align="center">
                        <h1><u>Update:</u></h1>
                        <form action="routing.php?event=<?=$update;?>" method="post">
                           Product ID(Read-Only): <input type="text" name="id" value="<?=$product_id;?>" readonly="readonly"><br><br>
                           Product Name: <input type="text" name="name" value="<?=$product_name;?>" placeholder="Name"><br><br>
                           Product Description <input type="text" name="desc" placeholder="Description" value="<?=$product_desc;?>"><br><br>
                           Quantity: <input type="text" name="quantity" placeholder="Quantity" value="<?=$quantity;?>"><br><br>
                           Cost: <input type="text" name="price" placeholder="Price" value="<?=$price;?>"><br><br>
                           Serial No.: <input type="text" name="sl_no" placeholder="Serial Number" value="<?=$sl_no;?>"><br><br>
                           Category: <select name="category">
                                <option value="Electronics">Electronics</option>
                                <option value="Men">Men</option>
                                <option value="Women">Women</option>
                                <option value="Baby & Kids">Baby & Kids</option>
                                <option value="Home & Furniture">Home & Furniture</option>
                                <option value="Books & Media">Books & Media</option>
                                <option value="Auto & Sports">Auto & Sports</option>
                            </select><br><br>
                            
                             <?php
                            if ($user=="admin" )    
                            { ?>
                            Seller: <input type="text" name="seller" value="<?=$seller;?>"> <br><br>
                             <?php
                              }
                            else
                            { ?>
                            Seller: <input type="text" name="seller" value="<?=$seller;?>" readonly="readonly"> <br><br>
                            <?php
                            }
                                ?>
                            
                            
                            Username: <input type="text" name="user" value="<?=$user;?>" readonly="readonly"> <br><br>

                            <input type="submit" value="Update"><br><br>
                            </form> </div>
<?php
                    }
                }
            }
        }
    }
} else {
    echo "Signin to continue: <a href='index.php'>SignIn </a>";
}