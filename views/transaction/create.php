<script src="./../assets/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function remove_service(ele){
        //alert("work");
        $(ele).parent().parent().remove();		
    };
    
    
    function show_items(){
        $.ajax({
            url: "/items_packages/retrieve/ajaxify",
            type: "GET",
            success: function(data) {
                $("#transaction_table").append(data);
            }
        });
    }
</script>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transaction
            <small>Transaction tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Transaction</a></li>
            <li class="active">Transaction - Details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Transaction Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <form method="POST">
                            <table id="transaction_table"  class="table table-bordered table-striped">
                                <tr>
                                    <td>Transaction Type</td>
                                    <td>
                                        <select>
                                            <option value="0">SALE</option>
                                            <option value="1">PURCHASE</option>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <tr>
                                    <td>Users</td>
                                    <td>
                                        <select name="users">
                                            <?php foreach ($html as $v) { ?>
                                                <option value="<?php echo $v["user_id"] ?>"><?php echo $v["user_name"] ?></option>
                                            <?php } ?>
                                        </select>
                                    </td>
                                    <td></td>
                                </tr>
                                <?php echo $items_html; ?>
                            </table>
                            <table>
                                <tr>
                                    <td>
                                        <div class="box-footer">
                                            <button type="submit" class="btn btn-primary" name = "SUB"> Ok </button>
                                        </div>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </table>
                        </form>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->






