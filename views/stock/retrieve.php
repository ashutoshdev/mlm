<!-- bootstrap 3.0.2 -->
        <link href="./../assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <!-- font Awesome -->
        <link href="./../assets/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <!-- Ionicons -->
        <link href="./../assets/css/ionicons.min.css" rel="stylesheet" type="text/css" />
        <!-- daterange picker -->
        <link href="./../assets/css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />
        <!-- iCheck for checkboxes and radio inputs -->
        <link href="./../assets/css/iCheck/all.css" rel="stylesheet" type="text/css" />
        <!-- Bootstrap Color Picker -->
        <link href="./../assets/css/colorpicker/bootstrap-colorpicker.min.css" rel="stylesheet"/>
        <!-- Bootstrap time Picker -->
        <link href="./../assets/css/timepicker/bootstrap-timepicker.min.css" rel="stylesheet"/>
        <!-- Theme style -->
        <link href="./../assets/css/AdminLTE.css" rel="stylesheet" type="text/css" />

        <!-- jQuery 2.0.2 -->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.0.2/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="./../assets/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- InputMask -->
        <script src="./../assets/js/plugins/input-mask/jquery.inputmask.js" type="text/javascript"></script>
        <script src="./../assets/js/plugins/input-mask/jquery.inputmask.date.extensions.js" type="text/javascript"></script>
        <script src="./../assets/js/plugins/input-mask/jquery.inputmask.extensions.js" type="text/javascript"></script>
        <!-- date-range-picker -->
        <script src="./../assets/js/plugins/daterangepicker/daterangepicker.js" type="text/javascript"></script>
        <!-- bootstrap color picker -->
        <script src="./../assets/js/plugins/colorpicker/bootstrap-colorpicker.min.js" type="text/javascript"></script>
        <!-- bootstrap time picker -->
        <script src="./../assets/js/plugins/timepicker/bootstrap-timepicker.min.js" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="./../assets/js/AdminLTE/app.js" type="text/javascript"></script>
        <!-- AdminLTE for demo purposes -->
        <script src="./../assets/js/AdminLTE/demo.js" type="text/javascript"></script>
        <!-- Page script -->


<aside class="right-side">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Advanced Form Elements
            <small>Preview</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Forms</a></li>
            <li class="active">Advanced Elements</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title">Date picker</h3>
                    </div>
                    <div class="box-body">
                        <!-- Date range -->
                        <form role="form" method="POST">
                        <div class="form-group">
                            <label>Date range:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control pull-right" id="reservation" name = "date_range"/>
                            </div><!-- /.input group -->
                        </div><!-- /.form group -->
                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name = "SUB"> Ok </button>
                        </div>
                        </form>
                        <b>From Date: </b><?php echo $from_date; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
                        <b>To Date: </b><?php echo $to_date; ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Item Id</th>
                        <th>Item Name</th>
                        <th>Opening</th>
                        <th>Sale</th>
                        <th>Purchase</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($result as $value) {
                        ?>
                        <tr>
                            <td><?php echo $value["item_id"] ?></td>
                            <td><?php echo $value["item_name"] ?></td>
                            <td><?php echo $value["opening"] ?></td>
                            <td><?php echo $value["sale"] ?></td>
                            <td><?php echo $value["purchase"] ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>

                    </div><!-- /.box-body -->
                </div><!-- /.box -->

            </div><!-- /.col (left) -->
        </div><!-- /.row -->
    </section><!-- /.content -->
</aside><!-- /.right-side -->

<script type="text/javascript">
    $(function() {
        //Datemask dd/mm/yyyy
        $("#datemask").inputmask("dd/mm/yyyy", {"placeholder": "dd/mm/yyyy"});
        //Datemask2 mm/dd/yyyy
        $("#datemask2").inputmask("mm/dd/yyyy", {"placeholder": "mm/dd/yyyy"});
        //Money Euro
        $("[data-mask]").inputmask();

        //Date range picker
        $('#reservation').daterangepicker();
        //Date range picker with time picker
        $('#reservationtime').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
        //Date range as a button
        $('#daterange-btn').daterangepicker(
                {
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    startDate: moment().subtract('days', 29),
                    endDate: moment()
                },
        function(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }
        );

        //iCheck for checkbox and radio inputs
        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
            checkboxClass: 'icheckbox_minimal',
            radioClass: 'iradio_minimal'
        });
        //Red color scheme for iCheck
        $('input[type="checkbox"].minimal-red, input[type="radio"].minimal-red').iCheck({
            checkboxClass: 'icheckbox_minimal-red',
            radioClass: 'iradio_minimal-red'
        });
        //Flat red color scheme for iCheck
        $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
            checkboxClass: 'icheckbox_flat-red',
            radioClass: 'iradio_flat-red'
        });

        //Colorpicker
        $(".my-colorpicker1").colorpicker();
        //color picker with addon
        $(".my-colorpicker2").colorpicker();

        //Timepicker
        $(".timepicker").timepicker({
            showInputs: false
        });
    });
</script>