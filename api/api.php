<?php

session_start();

require_once 'rest.php';


class API extends REST {
    const hostname = "localhost";
    const username = "root";
    const password = "";
    const db_name = "wingify";
    private $db_result = null;
    
    
    public function __construct() 
    {
        parent::__construct();
        $this->db_connect();
    }
    
    private function db_connect() 
    {
        $this->db_result = mysqli_connect(self::hostname,self::username,self::password,self::db_name);
    }
    
    
    public function processApi() 
    {
        $return_fun = strtolower(trim(str_replace("/","",$_REQUEST['request'])));
        if(method_exists($this,$return_fun) > 0) 
        {
            $this->$return_fun();
        } 
        else 
        {
            $response = array("msg" => "Invalid Call!!");
            $this->response(json_encode($response));
        }
    }
    

                   
    
    public function AddProduct() 
    {
        if($this->get_request() != "POST") 
        {
            $response = array("msg" => $this->get_request()." : Operation Couldn't be performed.");
            $this->response(json_encode($response));
        } 
        else 
        {
            $product_name = $this->request['name'];
            $product_desc = $this->request['desc'];
            $product_quantity = $this->request['quantity'];
            $product_price = $this->request['price'];
            $product_slno = $this->request['sl_no'];
            $product_category = $this->request['category'];
            $product_seller = $this->request['seller'];
            
            
            if (!empty($product_name) && !empty($product_category) && !empty($product_desc) && !empty($product_quantity) && !empty($product_price) && !empty($product_slno) && !empty($product_seller)) 
            {
                if (is_numeric($product_quantity) && is_numeric($product_price)) 
                {
                     
                     $query = "SELECT * FROM products WHERE serial_no = '$product_slno'";
                     $result = mysqli_query($this->db_result,$query);
                     if(mysqli_num_rows($result) >= 1) 
                     {
                         $response = array("msg" => "Product With Same Serial Number Exists!!"); 
                         $this->response(json_encode($response));
                     }
                    
                    
                    else
                    {
                     $query = "INSERT INTO products VALUES (null,'$product_slno','$product_name',$product_price,'$product_desc','$product_category','$product_quantity','$product_seller')"; 
                    
                    $result = mysqli_query($this->db_result, $query) or die(mysqli_error($this->db_result));
                    if ($result) 
                    {
                        $response = array("msg" => "Product Insertion Successful!!"); 
                        $this->response(json_encode($response));
                    } 
                    else 
                    {
                        $response = array("msg" => "Product $product_name Insertion Unsuccessful!!");
                        $this->response(json_encode($response));
                    }
                }
                } 
                else 
                {
                    $response = array("msg" => "Product Quantity & Product Price should be numberic!");
                    $this->response(json_encode($response));
                }
            } 
            else 
            {
                $response = array("msg" => "Invalid!! Empty Values.");
                $this->response(json_encode($response));
            }
        }
        }
    
    
    
    
    
   
    
    public function DeleteProduct() 
    {
        if($this->get_request() != "POST") 
        {
            $response = array("msg" => $this->get_request()." Operation Couldn't be performed.");
            $this->response(json_encode($response));
        } 
        else 
        {
          
            $id = trim($this->request['id']);
            
            if(is_numeric($id)) 
            {
                $query = "DELETE FROM products WHERE productId = $id";
                $result = mysqli_query($this->db_result,$query);
                if($result) {
                    $response = array("msg" => "Product Deletion Successful!!");
                    $this->response(json_encode($response));
                } 
                else 
                {
                    $response = array("msg" => "Product Not Found");
                    $this->response(json_encode($response));
                }
            } 
            else 
            {
                $response = array("msg" => "Id must be Numeric");
            }
            }
            

        }
    
    
    
    
    
    public function UpdateProduct() 
    {
        if($this->get_request() != "PUT") 
        {
            $response = array("msg" => $this->get_request()." : Operation Couldn't be performed.");
            $this->response(json_encode($response));
        } 
        else 
        {
            $id = $this->request['id'];
            $product_name = $this->request['name'];
            $product_desc = $this->request['desc'];
            $product_quantity = $this->request['quantity'];
            $product_price = $this->request['price'];
            $product_slno = $this->request['sl_no'];
            $product_category = $this->request['category'];
            $product_seller = $this->request['seller'];
            $user = $this->request['user']; 


            
            if($user=="admin" || $user==$product_seller)
            {
                
            
            if (!empty($id) && !empty($product_name) && !empty($product_category) && !empty($product_desc) && !empty($product_quantity) && !empty($product_price) && !empty($product_slno) && !empty($product_seller)) 
            
            {
                if (is_numeric($product_quantity) && is_numeric($product_price)) 
                {
                    
                    
                    $query = "SELECT * FROM products WHERE serial_no = '$product_slno' AND productId != '$id' ";
                     $result = mysqli_query($this->db_result,$query);
                     if(mysqli_num_rows($result) >= 1) 
                     {
                         $response = array("msg" => "Product With Same Serial Number Exists!!"); 
                         $this->response(json_encode($response));
                     }
                    
                    
                    else
                    {
                    $check_query = "SELECT * FROM products WHERE productId = $id";
                    $check_Result = mysqli_query($this->db_result,$check_query);
                    if(mysqli_num_rows($check_Result) == 1) 
                    {
                        
                    $query = "UPDATE products SET productName = '$product_name', productInfo = '$product_desc', productQuantity = $product_quantity, productPrice = $product_price, serial_no = '$product_slno', productCategory = '$product_category', seller = '$product_seller' WHERE productId = $id";
                        
                    $result = mysqli_query($this->db_result,$query);
                    if($result) 
                    {
                        $response = array("msg" => "Product Update Successful!! ");
                        $this->response(json_encode($response));
                    } 
                    else 
                    {
                        $response = array("msg" => "Product Update Unsuccessful");
                        $this->response(json_encode($response));
                    }
                    } 
                    else 
                    {
                        $response = array("msg" => "Product Not Found");
                        $this->response(json_encode($response));
                    }
                }

                } 
                else 
                {
                    $response = array("msg" => "Product Qunatity & Price should be numeric.");
                    $this->response(json_encode($response));
                }
            } 
            else 
            {
                $response = array("msg" => "Invalid!! Empty Field");
                $this->response(json_encode($response));
            }
            }
            else
            {
                $response = array("msg" => "Permission Denied!! Data not created by you.");
                $this->response(json_encode($response));
                
            }
            
            
            
            
            
        }
    }
    
    
    
    
    
    public function search() 
    {
        if($this->get_request() != "POST") 
        {
            $this->response("Invalid Request!!");
        }
        $keyword = $this->request['keyword'];
        if(!empty($keyword)) 
        {
            $query = "SELECT * FROM products WHERE productName LIKE '%$keyword%'";
            $result = mysqli_query($this->db_result,$query) or die(mysqli_error($this->db_result)) ;
            $sum_result = array();
            if($result) 
            {
                while($row = mysqli_fetch_assoc($result)) 
                {
                    $sum_result[] = $row;
                }
                $this->response(json_encode($sum_result));
            } 
            else 
            {
                
                
                $tempp = array(array("Status" => "Error", "Msg" => "Searched product could not Found"));
                $this->response(json_encode($tempp));
                
            }
        } 
        else 
        {
           

            $response = array("msg" => "Invalid! Blank Keyword.");
            $this->response(json_encode($response));
        }
    }

}
$api_obj = new API();
$api_obj->processApi();