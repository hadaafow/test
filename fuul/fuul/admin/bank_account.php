<?php
require  'ajax/config.php';
// require  '../includes/dbcon.php';
// require  'includes/checklogin.php';
require  'includes/codeGener.php';
?>


<?php require("includes/header.php");

?>



<div class="main-wrapper">

    <?php require("includes/navbar.php") ?>


    <?php require("includes/sidbar.php")  ?>

    <div class="page-wrapper">
        <div class="content">
            <div class="page-header">
                <div class="page-title">
                    <h4>Account List</h4>
                    <h6>Manage your Accounts</h6>
                </div>
                <div class="page-btn">
                    <a href="" class="btn btn-added" data-bs-toggle="modal" data-bs-target="#add_acc"><img src="assets/img/icons/plus.svg" alt="img" class="me-1">Add New Account</a>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="table-top">
                        <div class="search-set">
                            <div class="search-path">
                                <a class="btn btn-filter" id="filter_search">
                                    <img src="assets/img/icons/filter.svg" alt="img">
                                    <span><img src="assets/img/icons/closes.svg" alt="img"></span>
                                </a>
                            </div>
                            <div class="search-input">
                                <a class="btn btn-searchset"><img src="assets/img/icons/search-white.svg" alt="img"></a>
                            </div>
                        </div>
                        <div class="wordset">
                            <ul>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="assets/img/icons/pdf.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="assets/img/icons/excel.svg" alt="img"></a>
                                </li>
                                <li>
                                    <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="assets/img/icons/printer.svg" alt="img"></a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="card mb-0" id="filter_inputs">
                        <div class="card-body pb-0">
                            <div class="row">
                                <div class="col-lg-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Choose Product</option>
                                                    <option>Macbook pro</option>
                                                    <option>Orange</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Choose Category</option>
                                                    <option>Computers</option>
                                                    <option>Fruits</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Choose Sub Category</option>
                                                    <option>Computer</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Brand</option>
                                                    <option>N/D</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg col-sm-6 col-12 ">
                                            <div class="form-group">
                                                <select class="select">
                                                    <option>Price</option>
                                                    <option>150.00</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-1 col-sm-6 col-12">
                                            <div class="form-group">
                                                <a class="btn btn-filters ms-auto"><img src="assets/img/icons/search-whites.svg" alt="img"></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <!-- table here -->

                    <div class="table-responsive">
                        <div id="message"></div>
                        <table id="basic-datatable" class="table  datanew">
                            <thead>
                                <tr>


                                    <th>id</th>
                                    <th>account_name</th>
                                    <th>holder_name</th>
                                    <th>account_number</th>
                                    <th>balance</th>
                                    <th>date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="account_table">



                            </tbody>
                        </table>


                    </div>
                </div>
            </div>

        </div>

        <!-- end page-warpper -->
    </div>



    <div class="modal fade" id="add_acc" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form id="add_account" autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">add account</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">account_name</label>
                                <input type="text" name="account_name" class="form-control shadow-none" required>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">holder_name</label>
                                <input type="text" name="holder_name" class="form-control shadow-none" required>

                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">account_number</label>
                                <input type="number" name="account_number" class="form-control shadow-none" required>


                            </div>


                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">balance</label>
                                <input type="number" name="balance" class="form-control shadow-none" required>


                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>



<div class="modal fade" id="edit_account" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form id="update_account" autocomplete="off">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">add account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">account_name</label>
                            <input type="text" name="account_name" id="account_name" class="form-control shadow-none" required>
                            <input type="hidden" name="account_no" id="account_no">

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">holder_name</label>
                            <input type="text" name="holder_name" id="holder_name" class="form-control shadow-none" required>

                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">account_number</label>
                            <input type="number" name="account_number" id="account_number" class="form-control shadow-none" required>


                        </div>


                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">balance</label>
                            <input type="number" name="balance" id="balance" class="form-control shadow-none" required>


                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn custom-bg text-white shadow-none" data-bs-dismiss="modal">submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>


<script src="script/account.js"></script>

<?php
require('includes/scripts.php');



require('includes/footer.php');
?>