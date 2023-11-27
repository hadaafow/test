
let add_account = document.getElementById('add_account');


add_account.addEventListener('submit', function(e) {
    e.preventDefault();
    add_accounts();
});

function add_accounts() {
    let data = new FormData();
    data.append('add_accounts', '');
    data.append('account_name', add_account.elements['account_name'].value);
    data.append('holder_name', add_account.elements['holder_name'].value);
    data.append('account_number', add_account.elements['account_number'].value);
    data.append('balance', add_account.elements['balance'].value);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/account.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('add_acc');
        var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();
   modal.hide();

        if (this.responseText == 1) {
           
            alert('success', 'Inserted successfully', 'message');
            add_account.reset();
            get_all_accounts();
        } else {
            alert('error', 'server down!', 'message');
        }
    }


    xhr.send(data);
}


function get_all_accounts() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/account.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');



    xhr.onload = function() {
        document.getElementById('account_table').innerHTML = this.responseText;


    }

    xhr.send('get_all_accounts');
}



// let update_account = document.getElementById('update_account');

// function edit_account(account_no) {

//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/account.php", true);
//     xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


//     xhr.onload = function() {
//         let data = JSON.parse(this.responseText);
//         update_account.elements['account_no'].value = data.classdata.product_no;
//         update_account.elements['account_name'].value = data.classdata.account_name;
//         update_account.elements['holder_name'].value = data.classdata.holder_name;
//         update_account.elements['account_number'].value = data.classdata.account_number;
//         update_account.elements['balance'].value = data.classdata.balance;

//     }



//     xhr.send('get_all_accounts=' + account_no);
// }






// update_account.addEventListener('submit', function(e) {
//     e.preventDefault();
//     submit_edit_account();
// });


// function submit_edit_product() {
//     let data = new FormData();
//     data.append('edit_account', '');
//     data.append('account_no', update_product.elements['account_no'].value);
//     data.append('account_name', update_product.elements['account_name'].value);
//     data.append('holder_name', update_product.elements['holder_name'].value);
//     data.append('account_number', update_product.elements['account_number'].value);
//     data.append('balance', update_product.elements['balance'].value);



//     let xhr = new XMLHttpRequest();
//     xhr.open("POST", "ajax/account.php", true);


//     xhr.onload = function() {

//         var myModal = document.getElementById('edit_account');
//         var modal = bootstrap.Modal.getInstance(myModal);
//         // modal.hide();
//         modal.hide();



//         if (this.responseText == 1) {
//             // Display SweetAlert success message
//             alert('success', 'updated successfully', 'message');
//             update_account.reset();
//             get_all_accounts();
//         } else {
//             // Display SweetAlert error message
//             alert('error', 'server down!', 'message');
//         }
//     }


//     xhr.send(data);
// }






window.onload = function() {
    get_all_accounts();
}







