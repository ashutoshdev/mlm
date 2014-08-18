<script src="./../assets/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function ajaxChildUser(user) {

        $.ajax({
            url: "/users/retrieve_ajaxify?param=" + user,
            type: "GET",
            success: function(data) {
                //alert(data);
                var htmls = "<ul>";
                var myArray = jQuery.parseJSON(data);
                for (var p in myArray) {
                    if (myArray[p].user_left_right_index % 2 == 0) {
                        var set = "(L)";
                    } else {
                        var set = "(R)";
                    }
                    htmls += "<li><span onclick = \"return ajaxChildUser('" + myArray[p].user_left_right_index + "');\" style = 'cursor: pointer;'><img src = './../assets/img/Male.png'>" + myArray[p].user_name + set + "</span><span id = 'clild_" + myArray[p].user_left_right_index + "' ></span></li>";
                }

                htmls += "</ul>";

                //var htmls = "<ul><li>"+myArray[0].user_name+"</li><li>"+myArray[1].user_name+"</li></ul>";
                $("#clild_" + user).html(htmls);
                //alert(htmls);
            }
        });
    }

</script>
<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Users
            <small>User Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">User</a></li>
            <li class="active">users Details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Users Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <?php
                        echo "<ul>
                                <li><span onclick = \"return ajaxChildUser('" . $result[0]["user_left_right_index"] . "');\" style = 'cursor: pointer;'>"
                        . "<img src = './../assets/img/Male.png'><br>" . $result[0]["user_name"] . "</span>"
                        . "<span id = 'clild_" . $result[0]["user_left_right_index"] . "' ></span></li>"
                        . "</ul>";
                        ?>
                    </div><!-- /.box-body -->                    
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Binary commission </h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">

                        <?php
                        echo $binary_commission;
                        ?>
                    </div><!-- /.box-body -->                    
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
