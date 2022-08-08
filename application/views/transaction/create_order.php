<div class="content-wrapper">
    <div class="content pt-3">
        <div class="container-fluid">

            <div class="row">
                <div class="col-md-4">
                    <h2 class="text-muted">Invoice Number: <?php echo $this->session->invoice_no ?></h2>
                </div>
                <div class="col-md-4">
                    <?php if (isset($this->session->table_no)) { ?>
                        <h2 class="text-muted">Table Number: <?php echo $this->session->table_no ?></h2>
                    <?php } else { ?>
                        <h2 class="text-muted">Takeout Order</h2>
                    <?php } ?>
                </div>
                <div class="col-md-4">
                    <h2 class="text-muted">Order Type: <?php echo $this->session->order_type ?> </h2>
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-md-7">
                    <h5 class="text-muted">Ordering</h5>
                </div>
                <div class="col-md-5">
                    <h5 class="text-muted">Customer Order List</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-7">
                    <table id="mytable" class="table table-striped table-bordered table-sm nowrap">
                        <thead>
                            <tr class="text-center bg-secondary">
                                <th>#</th>
                                <th>Name</th>
                                <th>Description</th>
                                <th>Category</th>
                                <th>Price</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($product_details != NULL) { ?>
                                <?php foreach ($product_details as $product) { ?>
                                    <tr class="text-muted text-center text-uppercase">
                                        <td> <?php echo $i++ ?> </td>
                                        <td> <small> <?php echo $product->product_name ?> </small> </td>
                                        <td> <small> <?php echo $product->product_description ?> </small> </td>
                                        <td> <small> <?php echo $product->product_category ?> </small> </td>
                                        <td> <small> <?php echo number_format($product->product_price) ?> </small> </td>
                                        <td> <a href="" class="btn btn-sm btn-outline-primary" data-toggle="modal" data-target="#quantity_<?php echo $product->product_id ?>">Select</a> </td>
                                    </tr>

                                    <div class="modal fade" id="quantity_<?php echo $product->product_id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header bg-info">
                                                    <h6 class="modal-title" id="exampleModalLongTitle">Enter Quantity</h6>
                                                </div>
                                                <?php echo form_open('transaction/create_order/' . $product->product_id) ?>
                                                <div class="modal-body">
                                                    <input type="number" name="text_quantity" class="form-control" placeholder="Enter Quantity">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-primary">Select</button>
                                                </div>
                                                <?php echo form_close() ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>

                <div class="col-md-5">
                    <table id="mytable2" class="table table-striped table-bordered table-sm nowrap">
                        <thead>
                            <tr class="text-center bg-info">
                                <th>#</th>
                                <th>Name</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th width="10%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1;
                            if ($temp_order_details != NULL) { ?>
                                <?php foreach ($temp_order_details as $temp_order) { ?>
                                    <tr class="text-muted text-center text-uppercase">
                                        <td> <?php echo $i++ ?> </td>
                                        <td> <small> <?php echo $temp_order->product_name ?> </small> </td>
                                        <td> <small> <?php echo $temp_order->quantity ?> </small> </td>
                                        <td> <small> <?php echo $temp_order->total_sales ?> </small> </td>
                                        <td>
                                            <a href="" class="btn btn-outline-success btn-sm">Edit</a>
                                            <a href="" class="btn btn-outline-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>

                    <br>

                    <a href="<?php echo base_url('transaction/create_order_transaction') ?>" class="btn btn-outline-success btn-block" onclick="return  confirm('Do you want to proceed ordering? Yes / No')">Create Order</a>
                </div>
            </div>
        </div>
    </div>
</div>