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

                        function indent($tier) {

                            $str = "";

                            for ($i = 0; $i <= $tier; $i++) {
                                $str.="----";
                            }

                            return $str;
                        }

                        function displayUser($result, $parent_index, $tier) {
                            
                            
                            //echo pow(2, $tier) .  " to " .pow(2, $tier + 1) . "<br/>";

                            for ($i = pow(2, $tier); $i < pow(2, $tier + 1); $i++):

                                if ($i <= $result[count($result)-1]["user_left_right_index"]) {

                                    
                                    if ($parent_index * 2 == $result[$i - 1]["user_left_right_index"] || (($parent_index * 2) + 1) == $result[$i - 1]["user_left_right_index"]) {
                                        echo indent($tier) . $result[$i - 1]["user_name"] . "<br/>";
                                    }
                                    
                                    displayUser($result, $i, $tier + 1);
                                }


                            endfor;

                        }

                        displayUser($result, 0, 0);
                        ?>

                    </div><!-- /.box-body -->                    
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
