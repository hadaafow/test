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




if (isset($_POST['get_all_accounts'])) {
    $res = selectAll('account');
    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<query
           <tr>
           <td class='account_no'>$i</td>
          <td> $row[account_name]</td>
            <td> $row[holder_name]</td>
            <td> $row[account_number]</td>
             <td> $row[balance]</td>
             <td> $row[date]</td>
           <td>
           <button type='button' onclick='edit_account($row[account_no])' class='btn btn-warning shadow-none btn-sm' data-bs-toggle='modal' data-bs-target='#edit_account'>
             <i class='bi bi-pencil-square'></i>
             </button>

           </td>
           </tr>
          query;
        $i++;
    }
}



if (isset($_POST['add_accounts'])) {
    $db = new Database();

    $params = [
        'account_name' => $db->escapeString($_POST['account_name']),
        'holder_name' => $db->escapeString($_POST['holder_name']),
        'account_number' => $db->escapeString($_POST['account_number']),
        'balance' => $db->escapeString($_POST['balance']),

    ];


    $db->insert('account', $params);
    $res = $db->getResult();
    echo 1;
}



// if (isset($_POST['get_all_accounts'])) {
//     $frm_data = filteration($_POST);
//     $res1 = select("SELECT * FROM `account` WHERE `account_no`=?", [$frm_data['get_all_accounts']], 'i');

//     $classdata = mysqli_fetch_assoc($res1);

//     $data = ["classdata" => $classdata];
//     $data = json_encode($data);

//     echo $data;
// }





if (isset($_POST['edit_account'])) {

    $db = new Database();

    $account_no = $db->escapeString($_POST['account_no']);
    $account_name = $db->escapeString($_POST['account_name']);
    $holder_name = $db->escapeString($_POST['holder_name']);
    $account_number = $db->escapeString($_POST['account_number']);
    $balance = $db->escapeString($_POST['balance']);

    $db->update('account', array('account_name' => $account_name, 'holder_name' => $holder_name, 'account_number' => $account_number, 'balance' => $balance), "account_no= '{$account_no}'");
    $res = $db->getResult();

    echo 1;
}
