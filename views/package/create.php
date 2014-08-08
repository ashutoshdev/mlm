<script src="./../assets/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
//    $(document).ready(function(){
//        $("#another").click(function(){
//            $.ajax({
//                type: "POST",
//                data: "1",
//                url: "/package/items/retieve/ajaxify",
//                success: function(result)
//                {
//                    $(".another_select").append(result);
//                }
//            });
//
//        });
//
//
//
//    });
</script>
<aside class="right-side">

    <section class="content-header">
        <h1>
            Package
            <small>Add Item for Package </small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Package </a></li>
            <li class="active"> Add Item for Package </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Add Package</h3>
                    </div><!-- /.box-header -->
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Package Name</label>
                                <input type="text" class="form-control" placeholder="Package Name .." name = "package_name"/>
                            </div>
                            <div class="form-group">
                                <label>Package Price</label>
                                <input type="text" class="form-control" placeholder="Package Price .." name = "package_price"/>
                            </div>
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>Item</th>
                                    <th>Quantity</th>
                                    <th></th>
                                </tr>
                                
                                    
                                    
                            <?php
                                $td = 0;
                                    foreach ($product as $pro) {
                                        echo "<tr><td>".$pro['item_name']."</td>"
                                                . "<td><input type='text' value ='1' name = 'quantity[".$pro['item_id']."]' size = 2 /></td>"
                                                . "<td><input type='checkbox' name = 'item[".$pro['item_id']."]' size = 2 /></td></tr>";
                                    
                                   
                                    }
                                        ?>
                                    
                              
                            </table>
                            
                            
                        </div><!-- /.box-body -->

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name = "SUB">Insert</button>
                        </div>
                    </form>
                </div><!-- /.box -->
            </div><!--/.col (left) -->
        </div>   <!-- /.row -->
    </section>
</aside>
