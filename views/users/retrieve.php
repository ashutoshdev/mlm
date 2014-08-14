<script src="./../assets/jquery-1.10.1.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function ajaxChildUser(user){
        
        $.ajax({
            url: "/users/retrieve_ajaxify?param="+user,
            type: "GET",
            success: function(data) {
                //alert(data);
                var htmls="<ul>";
                var myArray = jQuery.parseJSON(data);
                for (var p in myArray) {
                    if(myArray[p].user_left_right_index%2 == 0){
                        var set = "(L)";
                    }else{
                        var set = "(R)";
                    }
                    htmls += "<li><span onclick = \"return ajaxChildUser('"+myArray[p].user_left_right_index+"');\" style = 'cursor: pointer;'><img src = './../assets/img/Male.png'>"+myArray[p].user_name+set+"</span><span id = 'clild_"+myArray[p].user_left_right_index+"' ></span></li>";
                }
                
                htmls += "</ul>";
                
                //var htmls = "<ul><li>"+myArray[0].user_name+"</li><li>"+myArray[1].user_name+"</li></ul>";
                $("#clild_"+user).html(htmls);
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
                        
                        
                        //var_dump($this->result[0]);
                        
                        echo "<ul>
                                <li><span onclick = \"return ajaxChildUser('".$result[0]["user_left_right_index"]."');\" style = 'cursor: pointer;'>"
                                . "<img src = './../assets/img/Male.png'><br>".$result[0]["user_name"]."</span>"
                                . "<span id = 'clild_".$result[0]["user_left_right_index"]."' ></span></li>"
                                . "</ul>";
                        

                        /*function indent($tier) {

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
                                        echo "<span onclick = \"return ajaxChildUser('".$result[$i - 1]["user_left_right_index"]."');\" >".indent($tier) . $result[$i - 1]["user_name"] . "</span><br/>";
                                    }
                                    
                                    displayUser($result, $i, $tier + 1);
                                }


                            endfor;

                        }

                        displayUser($result, 0, 0); */
                        ?>
<!--                        <span onclick="return ajaxChildUser('4');" >click test</span>-->
                    </div><!-- /.box-body -->                    
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
