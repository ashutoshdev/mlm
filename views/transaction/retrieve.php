<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Transation
            <small>Transation Details</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Transation</a></li>
            <li class="active">Transation Details</li>
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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Transaction Date</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result["transaction_master"] as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["transaction_id"] ?></td>
                                        <td><?php echo $value["transaction_date"] ?></td>
                                        <td><?php echo $value["credit"] ?></td>
                                        <td><?php echo $value["debit"] ?></td>
                                        <td><?php echo $value["note"] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
<!--                            <tfoot>

                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </tfoot>-->
                        </table>
                    </div><!-- /.box-body -->
                    
                    
                    <div class="box-body table-responsive">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Transaction ID</th>
                                    <th>Transaction Dtae</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Item Unit Price</th>
                                    <th>Note</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result["transaction_details"] as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["transaction_id"] ?></td>
                                        <td><?php echo $value["transaction_date"] ?></td>
                                        <td><?php echo $value["credit"] ?></td>
                                        <td><?php echo $value["debit"] ?></td>
                                        <td><?php echo $value["item_unit_price"] ?></td>
                                        <td><?php echo $value["note"] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
<!--                            <tfoot>

                                <tr>
                                    <th>Rendering engine</th>
                                    <th>Browser</th>
                                    <th>Platform(s)</th>
                                    <th>Engine version</th>
                                    <th>CSS grade</th>
                                </tr>
                            </tfoot>-->
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
