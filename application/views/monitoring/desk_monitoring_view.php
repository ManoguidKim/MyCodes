<div class="content-wrapper">
    <div class="content pt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <h4 class="text-muted">Order Queuing</h4>

                    <table class="table table-bordered table-sm table-striped display nowrap">
                        <thead>
                            <tr class="text-center bg-secondary">
                                <th>Table</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($order_list != NULL) { ?>
                                <?php foreach ($order_list as $order) { ?>
                                    <tr class="text-muted text-center text-uppercase">
                                        <td> <small> <?php echo $order->desk ?> </small> </td>
                                        <td> <a href="<?php echo base_url('transaction/done_table_orders/' . $order->desk_id) ?>" class="btn btn-block btn-sm bg-danger" onclick="return  confirm('Order done? Y / N')">Done</a> </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-10">
                    <?php
                    $numOfCols = 3;
                    $rowCount = 0;
                    $bootstrapColWidth = 12 / $numOfCols;
                    ?>
                    <div class="row">
                        <?php
                        foreach ($desk_details as $desk) {
                        ?>
                            <div class="col-md-<?php echo $bootstrapColWidth; ?> col-6">
                                <div class="small-box border bg-white p-3">
                                    <div class="inner">
                                        <h3 class="text-muted"><?php echo $desk->desk ?></h3>

                                        <br>
                                        <?php if ($desk->status == "Available") { ?>
                                            <p class="text-success"><?php echo $desk->status ?> </p>
                                        <?php } else { ?>

                                            <p class="text-danger"><?php echo $desk->status . ' ( ' ?> <?php echo $retVal = ($this->SalesModel->get_sales_table($desk->desk_id, 'not done') == "") ? "N/A" : $this->SalesModel->get_sales_table($desk->desk_id, 'not done')[0]->transaction_type . ' )' ?> </p>
                                        <?php } ?>
                                    </div>
                                    <div class="icon">
                                        <?php if ($desk->status == "Available") { ?>
                                            <i class="text-success fas fa-table"></i>
                                        <?php } else { ?>
                                            <i class="text-danger fas fa-table"></i>
                                        <?php } ?>
                                    </div>


                                    <?php if ($desk->status == "Available") { ?>
                                        <a href="<?php echo base_url('transaction/bill_out/' . $desk->desk_id) ?>" class="btn btn-outline-success btn-sm disabled">Bill Out</a>
                                        <!-- <a href="" class="btn btn-outline-info btn-sm disabled">Change Table</a> -->
                                        <a href="" class="btn btn-outline-warning btn-sm float-right" data-toggle="modal" data-target="#order_type_<?php echo $desk->desk_id ?>">Order</a>
                                    <?php } else if ($desk->status == "Occupied") { ?>
                                        <a href="<?php echo base_url('transaction/bill_out/' . $desk->desk_id) ?>" class="btn btn-outline-success btn-sm">Bill Out</a>

                                        <?php $invoice_no = $this->SalesModel->get_sales_table($desk->desk_id, 'not done')[0]->invoice_no ?>

                                        <a href="" class="btn btn-outline-info btn-sm" data-toggle="modal" data-target="#order_<?php echo $invoice_no ?>">View Order</a>
                                        <!-- <a href="" class="btn btn-outline-info btn-sm">Change Table</a> -->
                                        <a href="<?php echo base_url('transaction/set_table_add_order/' . $desk->desk_id) ?>" class="btn btn-outline-warning btn-sm float-right">Add Order</a>


                                        <div class="modal fade" id="order_<?php echo $invoice_no ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-secondary">
                                                        <h5 class="modal-title" id="exampleModalLongTitle">Order List in <?php echo $desk->desk ?></h5>
                                                    </div>

                                                    <div class="modal-body">
                                                        <?php $order_details = $this->SalesModel->get_order_invoice($invoice_no) ?>
                                                        <?php $total = 0; ?>

                                                        <table class="table table-bordered table-sm table-striped display nowrap">
                                                            <thead>
                                                                <tr class="text-center bg-secondary">
                                                                    <th>Product Name</th>
                                                                    <th>Quantity</th>
                                                                    <th>Price</th>
                                                                    <th>Total PRice</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php $i = 1;
                                                                if ($order_details != NULL) { ?>
                                                                    <?php foreach ($order_details as $order) { ?>
                                                                        <tr class="text-muted text-center text-uppercase">
                                                                            <td> <small> <?php echo $order->product_name ?> </small> </td>
                                                                            <td> <small> <?php echo $order->quantity ?> </small> </td>
                                                                            <td> <small> <?php echo $order->product_price ?> </small> </td>
                                                                            <td> <small> <?php echo number_format($order->product_price * $order->quantity) ?> </small> </td>
                                                                        </tr>

                                                                        <?php $total += ($order->product_price * $order->quantity) ?>
                                                                    <?php } ?>
                                                                <?php } ?>
                                                                <tr class="text-muted text-center">
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td> </td>
                                                                    <td class="text-danger"> <?php echo "Total: " . number_format($total) ?> </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    <?php } else { ?>

                                    <?php } ?>
                                </div>
                            </div>

                            <div class="modal fade" id="order_type_<?php echo $desk->desk_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header bg-secondary">
                                            <h5 class="modal-title" id="exampleModalLongTitle">Order Type</h5>
                                        </div>
                                        <form action="<?php echo base_url('transaction/set_table_order/' . $desk->desk_id . '/' . $desk->desk) ?>" method="post">
                                            <div class="modal-body">
                                                <select name="text_type" class="form-control">
                                                    <option value="">Select Order Type</option>
                                                    <option value="Dine In">Dine In</option>
                                                    <option value="Take Out">Take Out</option>
                                                </select>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Continue Order</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        <?php
                            $rowCount++;
                            if ($rowCount % $numOfCols == 0) echo '</div><div class="row">';
                        }
                        ?>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>