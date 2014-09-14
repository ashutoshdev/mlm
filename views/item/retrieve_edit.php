<aside class="right-side">

    <section class="content-header">
        <h1>
            Product
            <small>Edit for product item </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Product </a></li>
            <li class="active"> Edit Item product </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Edit Product </h3>
                    </div>
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Product Type</label>
                                <select name="item_type" class="form-control">
                                <?php
                                    $item_type = $result[0]['item_category'];
                                ?>
                                    <option value="PRODUCT" <?php if($item_type == "PRODUCT"){ echo selected; } ?> >PRODUCT</option>
                                    <option value="PIN" <?php if($item_type == "PIN"){ echo selected; } ?>>PIN</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Product Name</label>
                                <input type="text" class="form-control" value ="<?php echo $result[0]['item_name']; ?>" name = "product_name"/>
                            </div>
                            <div class="form-group">
                                <label>Product Price</label>
                                <input type="text" class="form-control" placeholder="Price .." name = "price"/>
                            </div>

                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name = "SUB"> Ok </button>
                        </div>
                    </form>
                </div> 
            </div>
        </div> 
    </section> 
</aside>
