<?php
require  'config.php';
require  'new_conn.php';
// require  '../../includes/dbcon.php';
//  session_start();



// if (isset($_POST['get_all_products'])) {
//     $i = 1;

//     $data = "";
//     $db = new Database();

//     $db->select('product', '*', null, 'product_no DESC', null);
//     $result = $db->getResult();

//     foreach ($result as $row) {


//         $data .= "
// <tr>
//     <td class='product_no'>$i</td>
//     <td> $row[product_name]</td>
//     <td> $row[borcode]</td>
//     <td> $row[order_level]</td>
//     <td> $row[minimum_level]</td>

//     <td>

//     <button type='button' onclick='edit_product($row[product_no])' class='btn btn-warning shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#add'>
//     <i class='bi bi-pencil-square'></i>
//     </button>
//     <button type='button' onclick='remove_delete($row[product_no])' class='btn btn-danger shadow-none btn-sm'>
//         <i class='bi bi-trash'></i>
//         </button>

//     </td>
// </tr>
// ";
//         $i++;
//     }
//     echo $data;
// }




if (isset($_POST['get_all_products'])) {
    $res = selectAll('product');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<query
           <tr>
           <td class='product_no'>$i</td>
          <td> $row[product_name]</td>
            <td> $row[borcode]</td>
            <td> $row[order_level]</td>
             <td> $row[minimum_level]</td>
             <td> $row[status]</td>
             <td> $row[date]</td>
           <td>
           <button type='button' onclick='edit_product($row[product_no])' class='btn btn-warning shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit'>
             <i class='bi bi-pencil-square'></i>
             </button>
          <button type='button' onclick='remove_delete($row[product_no])' class='btn btn-danger shadow-none btn-sm'>
           <i class='bi bi-trash'></i>
            </button>
           </td>
           </tr>
          query;
        $i++;
    }
}



if (isset($_POST['add_products'])) {
    $db = new Database();

    $params = [
        'product_name' => $db->escapeString($_POST['product_name']),
        'borcode' => $db->escapeString($_POST['borcode']),
        'order_level' => $db->escapeString($_POST['order_level']),
        'minimum_level' => $db->escapeString($_POST['minimum_level']),

    ];


    $db->insert('product', $params);
    $res = $db->getResult();
    echo 1;
}



if (isset($_POST['get_products'])) {
    $frm_data = filteration($_POST);
    $res1 = select("SELECT * FROM `product` WHERE `product_no`=?", [$frm_data['get_products']], 'i');

    $classdata = mysqli_fetch_assoc($res1);

    $data = ["classdata" => $classdata];
    $data = json_encode($data);

    echo $data;
}





if (isset($_POST['edit_product'])) {

    $db = new Database();

    $product_no = $db->escapeString($_POST['product_no']);
    $product_name = $db->escapeString($_POST['product_name']);
    $borcode = $db->escapeString($_POST['borcode']);
    $order_level = $db->escapeString($_POST['order_level']);
    $minimum_level = $db->escapeString($_POST['minimum_level']);

    $db->update('product', array('product_name' => $product_name, 'borcode' => $borcode, 'order_level' => $order_level, 'minimum_level' => $minimum_level), "product_no= '{$product_no}'");
    $res = $db->getResult();

    echo 1;
}
