<?php
// require  'config.php';
// require  'new_conn.php';

 require 'function.php';



$host = "localhost";
$username = "root";
$password = "";
$database = "inventory";
// session_start();
$con = mysqli_connect("$host","$username","$password","$database");

if(!$con)

{
    header("location: ../errors/db.php");
    die();
}





if(isset($_POST['set']))

{

    $shop_name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $address = $_POST['address'];
   $images = $_FILES['images']['name'];
   
  
    if(file_exists("upload/" .$_FILES["images"]["name"]))
  {
    $store = $_FILES["images"]["name"];
    $_SESSION['status']= "Image already exists. '.$store.'";
    header('location: Setting_system.php');
  }
  else
  {


    $query = "INSERT INTO system_settings VALUES (NULL,'$shop_name','$email','$contact','$address','$images')";

 $query_run = mysqli_query($con, $query);

 if( $query_run)
 {
    move_uploaded_file($_FILES["images"]["tmp_name"], "upload/".$_FILES["images"]["name"]);
     $_SESSION['status'] = "user added successfully";
     header("location: Setting_system.php");
 }
 else
 {
    $_SESSION['status'] = "user failed";
    header("location: Setting_system.php");
 }
    

 }


}




// if(isset($_POST['save']))
// {
//     $supler = $_POST['supler'];
//     $invoice = $_POST['invoice'];
//     $barcode = $_POST['barcode'];
//     $product = $_POST['product'];
//     $quantty = $_POST['quantty'];
//     $cost_out = $_POST['cost_out'];
//     $price_in = $_POST['price_in'];
//     $status = $_POST['status'];
//     $Date = $_POST['Date'];
//     $RefNo = $_POST['RefNo'];

//     // Add this section to check values
//     echo "supler: $supler<br>";
//     echo "invoice: $invoice<br>";
//     echo "barcode: $barcode<br>";
//     echo "status: $status<br>";
//     echo "Date: $Date<br>";
//     echo "RefNo: $RefNo<br>";

//     foreach ($quantty as $index => $quanttys) {
//         $s_product_name = $product[$index];
//         $s_quantity = $quanttys;
//         $s_cost = $cost_out[$index];
//         $s_price = $price_in[$index];

   
//         $oper_value = 'insert';
//         $query = "CALL order_pro('$supler','$invoice','$barcode','$s_product_name','$s_quantity','$s_cost','$s_price','$status','$Date','$RefNo','$oper_value')";
//         $query_run = mysqli_query($con, $query);

      
//         if (!$query_run) {
//             echo "Data Not Inserted<br>";
//             echo "Error: " . mysqli_error($con) . "<br>";
//         }
    
     
//         mysqli_free_result($query_run);
//     }

   
// }


// echo "s_product_name: $s_product_name<br>";
// echo "s_quantity: $s_quantity<br>";
// echo "s_cost: $s_cost<br>";
// echo "s_price: $s_price<br>";


















// if(isset($_POST['save']))
// {
//     $supler = $_POST['supler'];
//     $invoice = $_POST['invoice'];
//     $barcode = $_POST['barcode'];
//     $product = $_POST['product'];
//     $quantty = $_POST['quantty'];
//     $cost_out = $_POST['cost_out'];
//     $price_in = $_POST['price_in'];
//     $status = $_POST['status'];
//     $Date = $_POST['Date'];
//     $RefNo = $_POST['RefNo'];


//     foreach($quantty as $index => $quanttys)
//     {
//         $s_product_name = $product[$index];
//         $s_quantity = $quanttys;
//         $s_cost = $cost_out[$index];
//         $s_price = $price_in[$index];
       
//         // $s_otherfiled = $empid[$index];
//         $oper_value = 'insert';
//         $query = "CALL 	order_pro('$supler','$invoice','$barcode','$s_product_name','$s_quantity','$s_cost','$s_price','$status','$Date','$RefNo','$oper_value')";
//         $query_run = mysqli_query($con, $query);
//     }


//     if($query_run)
//     {
//         $_SESSION['status'] = "Multiple Data Inserted Successfully";
//         header("Location: purchase.php");
//         exit(0);
//     }
//     else
//     {
//         $_SESSION['status'] = "Data Not Inserted";
//         header("Location: purchas.php");
//         exit(0);
//     }
// }






// if(isset($_POST['add_prucha']))
// {
//     $db = new Database();

//     $suplier_no = $db->escapeString($_POST['suplier_no']);
//     $status = $db->escapeString($_POST['status']);

//     // Ensure that the arrays are set before using array_map
//     $quantity = isset($_POST['quantity']) ? array_map([$db, 'escapeString'], $_POST['quantity']) : [];
//     $product_name = isset($_POST['product_name']) ? array_map([$db, 'escapeString'], $_POST['product_name']) : [];
//     $cost = isset($_POST['cost']) ? array_map([$db, 'escapeString'], $_POST['cost']) : [];

//     foreach ($quantity as $index => $quantitys) {
//         $s_quantity = $quantitys;
//         $s_product_name = $product_name[$index] ?? null;
//         $s_cost = $cost[$index] ?? null;

//         $params = [
//             'suplier_no' => $suplier_no,
//             'quantity' => $s_quantity,
//             'product_name' => $s_product_name,
//             'cost' => $s_cost,
//             'status' => $status,
//         ];

//         $db->insert('purchase', $params);
//     }

//     // $response = $db->getResult();

//     print_r($db->getResult());

//     echo 1;
// }


?>