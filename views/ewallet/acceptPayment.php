<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">E-Wallet</a></li>
            <li class="active">E-Wallet - Details</li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">E-Wallet Details</h3>
                    </div><!-- /.box-header -->
                    <div class="box-body table-responsive">
                    <form method="POST">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Transaction Id</th>
                                    <th>User Name</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Note</th>
                                    <th>Accept</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["transaction_id"] ?></td>
                                        <td><?php echo $value["user_name"] ?></td>
                                        <td><?php echo $value["debit"] ?></td>
                                        <td><?php echo $value["credit"] ?></td>
                                        <td><?php echo $value["note"] ?></td>
                                        <td><input type="checkbox" value="<?php echo $value["transaction_date"] ?>" name="accept[<?php echo $value["transaction_id"] ?>]" <?php if ($value["status"]) { ?> checked="true" <?php } ?>  /></td>
                                    </tr>
                                    <?php
                                }
                                ?>

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
                        
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name = "SUB">Ok</button>
                        </div>
                    </form>
                    </div><!-- /.box-body -->
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
