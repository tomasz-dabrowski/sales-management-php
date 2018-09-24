<?php 
require_once 'controller/core.php';
include_once 'includes/head.php';
include_once 'includes/navbar.php';

if ($_GET['order'] == 'add') {
	echo "<div class='div-request div-hide'>add</div>";
} else if($_GET['order'] == 'manage') {
	echo "<div class='div-request div-hide'>manage</div>";
} else if($_GET['order'] == 'edit') {
	echo "<div class='div-request div-hide'>edit</div>";
}
?>

<div id="page-top">
<div id="wrapper">

    <?php include_once 'includes/sidebar.php'; ?>

    <div id="content-wrapper">

        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="dashboard.php">Dashboard</a>
                </li>

                <li class="breadcrumb-item">
                    <a href="orders.php?order=manage">Orders</a>
                </li>
                <li class="breadcrumb-item active">
                    <?php if($_GET['order'] == 'add') { ?>
                        Add Order
                    <?php } else if($_GET['order'] == 'manage') { ?>
                        Manage Order
                    <?php } else if($_GET['order'] == 'edit') { ?>
                        Edit Order
                    <?php } ?>
                </li>
            </ol>
            <br>

    <div class="row">
        <div class="col-md-12">
        <div class="panel panel-default">
	    <div class="panel-heading">

            <div class="row">
                <div class="col-md-6">
                    <h3>
                        <?php if($_GET['order'] == 'add') { ?>
                            <i class="fas fa-cart-plus fa-fw"></i> Add Order
                        <?php } else if($_GET['order'] == 'manage') { ?>
                            <i class="fas fa-shopping-cart fa-fw"></i> Manage Order
                        <?php } else if($_GET['order'] == 'edit') { ?>
                            <i class="fas fa-cart-arrow-down fa-fw"></i> Edit Order
                        <?php } ?>
                    </h3>
                </div>

                <?php if($_GET['order'] == 'manage') { ?>
                <div class="col-md-6" >
                    <a href="orders.php?order=add">
                    <button class="btn btn-primary float-right button1"> <i class="fas fa-plus-circle"></i> Add Order </button>
                    </a>
                </div>
                <?php } ?>

            </div> <!-- row -->
            <br />
	    </div> <!--/panel heading -->

    <div class="panel-body">

        <?php if($_GET['order'] == 'add') { ?>

        <div class="success-messages"> </div> <!--/success-messages-->

        <form class="form-horizontal" method="post" action="controller/createOrder.php" id="createOrderForm">

        <div class="row">
        <div class="col-md-4">
            <div class="form-group"> <!-- Order date -->
                <label for="orderDate" class="control-label">Order Date: </label>
                <input type="date" id="orderDate" name="orderDate" class="form-control" placeholder="Choose date" autocomplete="off" />
            </div> <!-- /form-group -->
        </div>
        <div class="col-md-4">

            <div class="form-group">
            <label for="customerId" class="control-label">Customer: </label>
            <select class="form-control" id="customerId" name="customerId">
                <option value="">- select -</option>

                <?php
                $sql = "SELECT customer_id, first_name, last_name, company FROM customers";
                $result = $connect->query($sql);

                while($row = $result->fetch_array()) {
                    echo "<option value='".$row[0]."'>".$row[3].' - '. $row[1].' '. $row[2]."</option>";
                }
                ?>
            </select>
            </div>

        </div>

        </div> <!-- row -->
        <br />

        <div class="row">
        <div class="col-md-12">
        <table class="table table-sm" id="productTable">
        <thead class="thead-light">
            <tr>
                <th style="width:40%;">Product</th>
                <th style="width:20%;">Price</th>
                <th style="width:15%;">Qty.</th>
                <th style="width:15%;">Total</th>
                <th style="width:10%;"></th>
            </tr>
        </thead>
        <tbody>
        <?php
        $arrayNumber = 0;
        $x = 1;
        for ($x = 1; $x <= 3; $x++) { ?>
            <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                <td> <!-- product -->
                    <div class="form-group">
                    <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                        <option value="">- select -</option>
                        <?php
                        $productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
                        $productData = $connect->query($productSql);

                        while($row = $productData->fetch_array()) {
                            echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."'>".$row['product_name']."</option>";
                            }
                        ?>
                    </select>
                    </div> <!-- form group -->
                </td>
                <td> <!-- price -->
                    <input type="text" name="price[]" id="price<?php echo $x; ?>" autocomplete="off" disabled class="form-control" />
                    <input type="hidden" name="priceValue[]" id="priceValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                </td>
                <td> <!-- Quantity -->
                    <div class="form-group">
                    <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" />
                    </div>
                </td>
                <td> <!-- total -->
                    <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" />
                    <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" />
                </td>
                <td>
                    <button class="btn btn-outline-primary removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        <?php
        $arrayNumber++;
        } // /for
        ?>
        </tbody>
        </table>
        </div>
        </div>

        <div class="row">

        <div class="col-md-3">
        <div class="form-group">
            <label for="subTotal" class="control-label">Sub Total</label>
            <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" />
            <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            <label for="vat" class="control-label">VAT 23%</label>
            <input type="text" class="form-control" id="vat" name="vat" disabled="true" />
            <input type="hidden" class="form-control" id="vatValue" name="vatValue" />
        </div>
        </div>

        <div class="col-md-3">
        <div class="form-group">
            <label for="totalAmount" class="control-label">Total Amount</label>
            <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true"/>
            <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" />
        </div>
        </div>

            <div class="col-md-3">
                <div class="form-group">
                    <label for="paymentType" class="control-label">Payment Type</label>
                    <select class="form-control" name="paymentType" id="paymentType">
                        <option value="">- select -</option>
                        <option value="1">Cash</option>
                        <option value="2">Credit Card</option>
                        <option value="3">Online Transfer</option>
                    </select>
                </div>
            </div> <!--/form-group-->
        </div><!-- row -->

        <br>
        <div class="row">
            <div class="col-md-12">
                <div class="form-group submitButtonFooter">
                <button type="button" class="btn btn-outline-primary" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Product </button>
                <button type="reset" class="btn btn-secondary" onclick="resetOrderForm()"><i class="fas fa-eraser"></i> Reset </button>
                <button type="submit" class="btn btn-primary" id="createOrderBtn" data-loading-text="Loading..."><i class="fas fa-save"></i> Save </button>
                </div>
            </div>
        </div> <!-- /row -->

        </form>

        <?php } else if($_GET['order'] == 'manage') { ?>

        <div id="success-messages"></div>

        <table class="table table-sm" id="manageOrderTable">
            <thead class="thead-light">
                <tr>
                    <th>#</th>
                    <th>ID</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Products</th>
                    <th>Items</th>
                    <th>Total (net)</th>
                    <th>Payment</th>
                    <th>Actions</th>
                </tr>
            </thead>
        </table>

        <?php
        } else if($_GET['order'] == 'edit') { ?>

        <div class="success-messages"></div>

        <form class="form-horizontal" method="post" action="controller/editOrder.php" id="editOrderForm">

        <?php $orderId = $_GET['id'];

        $sql = "SELECT orders.order_id, orders.order_date, orders.customer_id, orders.sub_total, orders.vat, orders.total_amount, orders.payment_type 
                FROM orders
                WHERE orders.order_id = {$orderId}";

            $result = $connect->query($sql);
            $data = $result->fetch_row();
        ?>
            <div class="row">

            <div class="col-md-4">
                <div class="form-group"> <!-- Order date -->
                    <label for="orderDate" class="control-label">Order Date: </label>
                    <input type="date" id="orderDate" name="orderDate" class="form-control" placeholder="Order date" autocomplete="off" value="<?php echo $data[1] ?>" />
                </div> <!-- /form-group -->
            </div>

            <div class="col-md-4">

                <div class="form-group">
                    <label for="customerId" class="control-label">Customer: </label>
                    <select class="form-control" id="customerId" name="customerId">
                        <?php
                        $sql = "SELECT customer_id, first_name, last_name, company FROM customers";
                        $result = $connect->query($sql);

                        while($row = $result->fetch_array()) {
                            $selected = "";
                            if ($data[2] == $row['customer_id']) {
                                $selected = "selected";
                            } else {
                                $selected = "";
                            }
                            echo "<option value='".$row[0]."' ".$selected." >".$row[3].' - '. $row[1].' '. $row[2]."</option>";
                        }

                        ?>
                    </select>
                </div>

            </div>
            </div>

            <br />

            <div class="row">
            <div class="col-md-12">
                <table class="table table-sm" id="productTable">
                    <thead class="thead-light">
                    <tr>
                        <th style="width:40%;">Product</th>
                        <th style="width:20%;">Price</th>
                        <th style="width:15%;">Qty.</th>
                        <th style="width:15%;">Total</th>
                        <th style="width:10%;"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $orderItemSql = "SELECT order_item.order_item_id, order_item.order_id, order_item.product_id, order_item.quantity, order_item.total
                                     FROM order_item 
                                     WHERE order_item.order_id = {$orderId}";

                    $orderItemResult = $connect->query($orderItemSql);
                    $arrayNumber = 0;
                    $x = 1;

                    while ($orderItemData = $orderItemResult->fetch_array()) { ?>
                        <tr id="row<?php echo $x; ?>" class="<?php echo $arrayNumber; ?>">
                            <td>
                                <div class="form-group">
                                <select class="form-control" name="productName[]" id="productName<?php echo $x; ?>" onchange="getProductData(<?php echo $x; ?>)" >
                                    <?php
                                    $productSql = "SELECT * FROM product WHERE active = 1 AND status = 1 AND quantity != 0";
                                    $productData = $connect->query($productSql);

                                    while ($row = $productData->fetch_array()) {
                                        $selected = "";
                                        if ($row['product_id'] == $orderItemData['product_id']) {
                                            $selected = "selected";
                                        } else {
                                            $selected = "";
                                        }

                                        echo "<option value='".$row['product_id']."' id='changeProduct".$row['product_id']."' ".$selected." >".$row['product_name']."</option>";
                                    }

                                    ?>
                                </select>
                                </div>
                            </td>
                            <td>
                                <input type="text" name="price[]" id="price<?php echo $x; ?>" autocomplete="off" disabled="true" class="form-control" value="<?php echo $orderItemData['total']; ?>" />
                                <input type="hidden" name="priceValue[]" id="priceValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>" />
                            </td>
                            <td>
                                <div class="form-group">
                                <input type="number" name="quantity[]" id="quantity<?php echo $x; ?>" onkeyup="getTotal(<?php echo $x ?>)" autocomplete="off" class="form-control" min="1" value="<?php echo $orderItemData['quantity']; ?>" />
                                </div>
                            </td>
                            <td>
                                <input type="text" name="total[]" id="total<?php echo $x; ?>" autocomplete="off" class="form-control" disabled="true" value="<?php echo $orderItemData['total']; ?>"/>
                                <input type="hidden" name="totalValue[]" id="totalValue<?php echo $x; ?>" autocomplete="off" class="form-control" value="<?php echo $orderItemData['total']; ?>"/>
                            </td>
                            <td>
                                <button class="btn btn-outline-primary removeProductRowBtn" type="button" id="removeProductRowBtn" onclick="removeProductRow(<?php echo $x; ?>)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                        <?php
                        $arrayNumber++;
                        $x++;
                        } // /for
                        ?>
                    </tbody>
                </table>
            </div>
            </div> <!-- row -->

            <div class="row">

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="subTotal" class="control-label">Sub Total</label>
                        <input type="text" class="form-control" id="subTotal" name="subTotal" disabled="true" value="<?php echo $data[3] ?>" />
                        <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" value="<?php echo $data[3] ?>" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="vat" class="control-label">VAT 23%</label>
                        <input type="text" class="form-control" id="vat" name="vat" disabled="true" value="<?php echo $data[4] ?>" />
                        <input type="hidden" class="form-control" id="vatValue" name="vatValue" value="<?php echo $data[4] ?>" />
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="totalAmount" class="control-label">Total Amount</label>
                        <input type="text" class="form-control" id="totalAmount" name="totalAmount" disabled="true" value="<?php echo $data[5] ?>" />
                        <input type="hidden" class="form-control" id="totalAmountValue" name="totalAmountValue" value="<?php echo $data[5] ?>" />
                    </div>
                </div>


                <div class="col-md-3">
                    <div class="form-group">
                        <label for="paymentType" class="control-label">Payment Type</label>
                        <select class="form-control" name="paymentType" id="paymentType">
                            <option value="1" <?php if($data[6] == 1) {echo "selected";} ?> >Cash</option>
                            <option value="2" <?php if($data[6] == 2) {echo "selected";} ?> >Credit Card</option>
                            <option value="3" <?php if($data[6] == 3) {echo "selected";} ?> >Online Transfer</option>
                        </select>
                    </div>
                </div> <!--/form-group-->

            </div><!-- /row -->

<br />

            <div class="row">
                <div class="col-md-12">
                    <div class="form-group editButtonFooter">
                        <button type="button" class="btn btn-outline-primary" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="fas fa-plus-circle"></i> Add Product </button>
                        <input type="hidden" name="orderId" id="orderId" value="<?php echo $_GET['id']; ?>" />
                        <button type="submit" class="btn btn-primary" id="editOrderBtn" data-loading-text="Loading..."><i class="fas fa-save"></i> Save </button>
                    </div>
                </div>
            </div> <!-- /row -->

        </form> <!-- form editOrder -->

    <?php } ?>


    </div> <!-- /panel-body -->
    </div> <!--/panel-->
</div> <!--/panel-->
</div> <!-- /row -->
</div>
</div> <!-- /content-wrapper -->
</div> <!-- /wrapper -->
</div> <!-- /#page-top -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="logoutModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-sign-out-alt"></i> Ready to leave?</h4>
            </div>
            <div class="modal-body">Select "Logout" below if you will end your current session.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal"><i class="fa fa-times-circle"></i> Cancel</button>
                <a class="btn btn-primary" href="logout.php"><i class="fa fa-sign-out-alt"></i> Logout</a>
            </div>
        </div>
    </div>
</div>

<!-- remove order modal -->
<div class="modal fade" tabindex="-1" role="dialog" id="removeOrderModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <h4 class="modal-title"><i class="fas fa-trash"></i> Remove Order </h4>
      </div>
      <div class="modal-body">
      	<div class="removeOrderMessages"></div>
        <p>Do you really want to remove ?</p>
      </div>
      <div class="modal-footer removeProductFooter">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        <button type="button" class="btn btn-danger" id="removeOrderBtn" data-loading-text="Loading..."> <i class="fas fa-trash"></i> Remove </button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- /remove order-->

<?php require_once 'includes/footer.php'; ?>
<script src="custom/js/orders.js"></script>

</body>
</html>
