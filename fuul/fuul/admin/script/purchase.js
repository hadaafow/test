// let add_purchase = document.getElementById('add_purchase');

// add_purchase.addEventListener('submit', function(e) {
//     e.preventDefault();
//     add_prucha();
// });

// function add_prucha() {
//     let data = new FormData();
//     data.append('add_prucha', '');
//     data.append('suplier_no', add_purchase.elements['suplier_no'].value);
//     data.append('invoice_no', add_purchase.elements['invoice_no'].value);

//     // Handle dynamic arrays
//     let quantityInputs = add_purchase.elements['quantity[]'];
//     let productInputs = add_purchase.elements['product_name[]'];
//     let costInputs = add_purchase.elements['cost[]'];

//     for (let i = 0; i < quantityInputs.length; i++) {
//         data.append('quantity[]', quantityInputs[i].value);
//         data.append('product_name[]', productInputs[i].value);
//         data.append('cost[]', costInputs[i].value);

        
//     }

//     data.append('status', add_purchase.elements['status'].value);

//     let xhr = new XMLHttpRequest();

//     xhr.open("POST", "ajax/code.php", true);

//     xhr.onload = function() {
//         if (this.responseText == 1) {
//             alert('success', 'Inserted successfully', 'message');
//             add_purchase.reset();
//         } else {
//             alert('error', 'server down!', 'message');
//         }
//     }

//     xhr.send(data);
// }


