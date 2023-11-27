
let add_product = document.getElementById('add_product');


add_product.addEventListener('submit', function(e) {
    e.preventDefault();
    add_products();
});

function add_products() {
    let data = new FormData();
    data.append('add_products', '');
    data.append('product_name', add_product.elements['product_name'].value);
    data.append('borcode', add_product.elements['borcode'].value);
    data.append('order_level', add_product.elements['order_level'].value);
    data.append('minimum_level', add_product.elements['minimum_level'].value);

    let xhr = new XMLHttpRequest();

    xhr.open("POST", "ajax/products.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('add');

        if (myModal) {
            var bootstrapModal = new bootstrap.Modal(myModal);
            bootstrapModal.hide();
        }

        if (this.responseText == 1) {
           
            alert('success', 'Inserted successfully', 'message');
            setTimeout(function() {
                location.reload();
            }, 1 * 1000);
    
            add_product.reset();
            get_all_products();
        } else {
            alert('error', 'server down!', 'message');
        }
    }


    xhr.send(data);
}


function get_all_products() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/products.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');



    xhr.onload = function() {
        document.getElementById('product_table').innerHTML = this.responseText;


    }

    xhr.send('get_all_products');
}



let update_product = document.getElementById('update_product');

function edit_product(product_no) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/products.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        update_product.elements['product_no'].value = data.classdata.product_no;
        update_product.elements['product_name'].value = data.classdata.product_name;
        update_product.elements['borcode'].value = data.classdata.borcode;
        update_product.elements['order_level'].value = data.classdata.order_level;
        update_product.elements['minimum_level'].value = data.classdata.minimum_level;

    }



    xhr.send('get_products=' + product_no);
}






update_product.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_product();
});


function submit_edit_product() {
    let data = new FormData();
    data.append('edit_product', '');
    data.append('product_no', update_product.elements['product_no'].value);
    data.append('product_name', update_product.elements['product_name'].value);
    data.append('borcode', update_product.elements['borcode'].value);
    data.append('order_level', update_product.elements['order_level'].value);
    data.append('minimum_level', update_product.elements['minimum_level'].value);



    let xhr = new XMLHttpRequest();
    xhr.open("POST", "ajax/products.php", true);


    xhr.onload = function() {

        var myModal = document.getElementById('edit');
        var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();
        modal.hide();



        if (this.responseText == 1) {
            // Display SweetAlert success message
            alert('success', 'updated successfully', 'message');
            update_product.reset();
            get_all_products();
        } else {
            // Display SweetAlert error message
            alert('error', 'server down!', 'message');
        }
    }


    xhr.send(data);
}






window.onload = function() {
    get_all_products();
}







