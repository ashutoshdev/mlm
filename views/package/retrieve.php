<script type="text/javascript">
    function details_show(count){
        $("#details_item_"+count).toggle("slow");    
    }    
</script>

<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Package
            <small>Show Package details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Package</a></li>
            <li class="active">Show Package details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Package Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Package Name</th>
                                    <th>Price</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>
                              
                                 <?php foreach ($result as $value) {  ?>
                                 
                                 <tr>
                                    <td><?php echo $value["package_id"] ?></td>
                                    <td><?php echo $value["package_name"] ?></td>
                                    <td><?php echo $value["package_price"] ?></td>
                                    <td><a href="/item/retrieve?packageId=<?php echo $value["package_id"] ?>"> View </a></td>
                                 </tr>
                                 
                                 
                                 
                                 <?php } ?>
                                 
                            </tbody>
                            <tfoot>

<!--                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>-->
                            </tfoot>
                        </table>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
