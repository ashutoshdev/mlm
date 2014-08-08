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
                                
                              <!--  
                                <?php  foreach ($result as $value) {   $c++;  ?>
                                
                                    <tr onclick = "return details_show(<?php echo $c; ?>);" <?php if($value["package_id"] != 1){ echo "style = 'cursor: pointer;'"; } ?>>
                                        <td><?php echo $c; ?></td>
                                        <td><?php echo $value["item_name"] ?></td>
                                        <td><?php echo $value["item_price"] ?></td>
                                        <td><a href="/package/edit/?eid=<?php echo $value["item_id"]; ?>">Edit</a> <a href = "/package/delete/?del=<?php echo $value["item_id"]; ?>">Delete</a></td>
                                    </tr>
                                    <?php
                                    if($value["package_id"] != 1){
                                    ?>
                                    <tr><td colspan="4">
                                       <table id = "details_item_<?php echo $c; ?>" style = "display: none;"  class="table table-bordered table-striped">
                                    <?php
                                        foreach ($item_res[$value["package_id"]] as $item){
                                    
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $item["item_name"] ?></td>
                                        <td><?php echo $item["item_price"] ?></td>
                                    </tr>
                                <?php
                                        }
                                        echo "</table>
                                        </td></tr>";
                                    }
                                }
                                ?>
                                 -->
                                 
                                 
                                 <?php foreach ($result as $value) {  ?>
                                 
                                 <tr>
                                    <td><?php echo $value["package_id"] ?></td>
                                    <td><?php echo $value["package_name"] ?></td>
                                    <td><?php echo $value["package_price"] ?></td>
                                    <td></td>
                                 </tr>
                                 <tr><td colspan="4">
                                       <table id = "details_item_<?php echo $c; ?>" style = "display: none;"  class="table table-bordered table-striped">
                                    <?php
                                        foreach ($item_res[$value["package_id"]] as $item){
                                    
                                    ?>
                                    <tr>
                                        <td></td>
                                        <td><?php echo $item["item_name"] ?></td>
                                        <td><?php echo $item["item_price"] ?></td>
                                    </tr>
                                <?php
                                        }
                                ?>
                                       </table>
                                    </td>
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
