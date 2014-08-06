<script src="./../assets/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function remove_service(ele){
        //alert("work");
        $(ele).parent().parent().remove();		
    };
    
    
    function show_items(id,td){
        var numb = parseInt($("#hid_param").val());
                
        var rec = numb + 1;
        item_details(id,td);
        $.ajax({
            url: "/items_packages/retrieve/ajaxify?id="+rec,
            type: "GET",
            success: function(data) {
                $("#transaction_table").append(data);
                $("#hid_param").val(rec);
            }
        });
    }
    
    function item_details(id,td){
        
        $.ajax({
            url: "/items_packages/retrieveItemPrice/ajaxify?id="+id,
            type: "GET",
            success: function(data) {
                
                $("#price_"+td).val(data);
                $("#t_pr_"+td).val(data);
            }
        });
    }
    
    function quantity(quan,tdi){
        var price = parseFloat($("#price_"+tdi).val());
        var t_price = parseFloat(price * quan);
        $("#t_pr_"+tdi).val(t_price);
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
                                    <td width = "20%">Transaction Type</td>
                                    <td>
                                        <select name="transaction_type">
                                            <option value="SALE">SALE</option>
                                            <option value="PURCHASE">PURCHASE</option>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width = "20%">Users</td>
                                    <td>
                                        <select name="users">
                                            <?php foreach ($html as $v) { ?>
                                                <option value="<?php echo $v["user_id"] ?>"><?php echo $v["user_name"] ?></option>
                                            <?php } ?>
                                        </select><input type='text' id ="hid_param" value = '1'/>
                                    </td>
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






