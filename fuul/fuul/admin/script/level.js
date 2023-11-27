let add_level_form = document.getElementById('add_level_form');


add_level_form.addEventListener('submit', function(e) {
    e.preventDefault();
    add_level();
});

function add_level() {
    let data = new FormData();
    data.append('add_level', '');
    data.append('lavels', add_level_form.elements['lavels'].value);
    data.append('price', add_level_form.elements['price'].value);
    data.append('user_id', add_level_form.elements['user_id'].value);



    let xhr = new XMLHttpRequest();

    xhr.open("POST", "php_files/lavel.php", true);


    xhr.onload = function() {
        var myModal = document.getElementById('levels-model');
        var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();
        modal.hide();

    


        if (this.responseText == 1) {
           
            alert('success', 'inserted sussefully','message');
        } else {
           
            alert('error', 'server down!', 'message');
        }
    }


    xhr.send(data);
}

function get_all_level() {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php_files/lavel.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');



    xhr.onload = function() {
        document.getElementById('level_table').innerHTML = this.responseText;


    }


    xhr.send('get_all_level');
}

let updatelevel = document.getElementById('updatelevel');

function edit_lavel(l_no) {

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php_files/lavel.php", true);
    xhr.setRequestHeader('content-type', 'application/x-www-form-urlencoded');


    xhr.onload = function() {
        let data = JSON.parse(this.responseText);
        updatelevel.elements['lavels'].value = data.leveldata.lavels;
        updatelevel.elements['price'].value = data.leveldata.price;
        updatelevel.elements['l_no'].value = data.leveldata.l_no;

    }


    xhr.send('get_level=' + l_no);
}


updatelevel.addEventListener('submit', function(e) {
    e.preventDefault();
    submit_edit_level();
});

function submit_edit_level() {
    let data = new FormData();
    data.append('edit_level', '');
    data.append('l_no', updatelevel.elements['l_no'].value);
    data.append('lavels', updatelevel.elements['lavels'].value);
    data.append('price', updatelevel.elements['price'].value);



    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php_files/lavel.php", true);


    xhr.onload = function() {

        var myModal = document.getElementById('editlevel');
        var modal = bootstrap.Modal.getInstance(myModal);
        // modal.hide();
        modal.hide();



        if (this.responseText == 1) {
           
            Swal.fire({
                icon: "success",
                title: "Success",
                text: "Successfully Updated.",
                timer: 2000, 
                showConfirmButton: false
            }).then(function() {
                updatelevel.reset();
               get_all_level();
            });
        } else {
           
            Swal.fire({
                icon: "error",
                title: "Error",
                text: "Server error! updated failed.",
                timer: 2000,
                showConfirmButton: false
            });
        }

      
    }


    xhr.send(data);
}


function remove_level(l_no) {
    if (confirm("mahub taa inaa delete deyso lavel kan?")) {
        let data = new FormData();
        data.append('l_no', l_no);
        data.append('remove_level', '');

        let xhr = new XMLHttpRequest();
        xhr.open("POST", "php_files/lavel.php", true);

        xhr.onload = function() {
            if (this.responseText == 1) {
                alert('success', 'level removed!');
                get_all_level();

            } else {
                alert('error', 'level removed failed');


            }
        }
        xhr.send(data);
    }

}

window.onload = function() {
    get_all_level();
}