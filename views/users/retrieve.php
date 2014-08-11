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
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Joining Date</th>
                                    <th>Joined By</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($result as $value) {
                                    ?>
                                    <tr>
                                        <td><?php echo $value["user_name"] ?></td>
                                        <td><?php echo $value["user_email"] ?></td>
                                        <td><?php echo $value["joining_date"] ?></td>
                                        <td><?php echo $value["name"] ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>

                            </tbody>
                        </table>
                    </div><!-- /.box-body -->
                    
                </div>
            </div>
        </div>
    </section>
</aside><!-- /.right-side -->
