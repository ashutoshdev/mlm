<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Opening Stock
            <small>Show Opening Stock details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Product</a></li>
            <li class="active">Show product details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Product Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <form method="POST">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["item_id"]; ?></td>
                                        <td><?php echo $value["item_name"] ?></td>
                                        <td><?php echo $value['quantity']; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>                                    
                            </tbody>
                            
                        </table>
                        </form>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
