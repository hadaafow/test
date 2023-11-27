<!-- Main Sidebar Container -->
<?php require_once('../config.php'); ?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Invertory purchase</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">Kobac</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="#" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>
          <li class="nav-item">
            <a href="Product.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Products
              
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="customer.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Customers
              
              </p>
            </a>
          </li>


          <li class="nav-item">
            <a href="supplier.php" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>
                supplier
              
              </p>
            </a>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Sales
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">6</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Cash_Sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="creadit_sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Credit Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Refund.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Refund Sales</p>
                </a>
              </li>
             
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Purchase
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>purchase</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="refund_purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>purchase Retrunt</p>
                </a>
              </li>
            
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
               Receipts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Customer_receipt.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>customer Receipt</p>
                </a>
              </li>
             
            
              
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Payments
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="supplier_peymeny.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Payment for Suppliers</p>
                </a>
              </li>
            
            </ul>
          </li>

             
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Shop Setting
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Setting_system.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Setting</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Sales_profit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Good_sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Emolayee</p>
                </a>
              </li>
            </ul>
          </li>

          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Sales Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Summary_tran.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Summary Transactions</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Sales_profit.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Profit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Good_sales.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Good Sales</p>
                </a>
              </li>
            </ul>
          </li>
        
         
          
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Customers Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="Customer_balan_rep.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Balance</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Customer_statemtn.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Statement</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="customer_an_finish.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer AN Finished</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Products Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="Product_stock.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product IN Stock</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Product_finish.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product To Fishing</p>
                </a>
              </li>
          
            </ul>
          </li>
         
        </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<!-- <script>
    $(document).ready(function(){
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'index' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';
      page = page.split('/');
      page = page[0];
      if(s!='')
        page = page+'_'+s;

      if($('.nav-link.nav-'+page).length > 0){
             $('.nav-link.nav-'+page).addClass('active')
        if($('.nav-link.nav-'+page).hasClass('tree-item') == true){
            $('.nav-link.nav-'+page).closest('.nav-treeview').siblings('a').addClass('active')
          $('.nav-link.nav-'+page).closest('.nav-treeview').parent().addClass('menu-open')
        }
        if($('.nav-link.nav-'+page).hasClass('nav-is-tree') == true){
          $('.nav-link.nav-'+page).parent().addClass('menu-open')
        }

      }
     
    })
  </script> -->