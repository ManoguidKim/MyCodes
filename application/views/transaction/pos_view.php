<div class="content-wrapper bg-white">
    <div class="content pt-3">
        <div class="container-fluid">
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
                    <table id="mytable" class="table table-striped display nowrap">
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
                                                <div class="modal-body">
                                                    <input type="number" name="text_quantity" class="form-control" placeholder="Enter Quantity">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-primary">Select</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>
