<aside class="right-side">

    <section class="content-header">
        <h1>
            Register Users
            <small>Register Users</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#"> Register Users </a></li>
            <li class="active"> Register Users </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="box box-primary">
                    <div class="box-header">
                        <h3 class="box-title"> Register Users </h3>
                    </div>
                    <!-- form start -->
                    <form role="form" action="" method="post">
                        <div class="box-body">
                            <div class="form-group">
                                <label>Introducer</label>
                                <select name="introducer" class="form-control">
                                    <?php foreach ($html as $v) { ?>
                                        <option value="<?php echo $v["user_id"] ?>"><?php echo $v["user_name"] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>User Name</label>
                                <input type="text" class="form-control" placeholder=" .." name = "username"/>
                            </div>
                            <div class="form-group">
                                <label>User Email</label>
                                <input type="email" class="form-control" placeholder=" .." name = "useremail"/>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" placeholder=" .." name = "password"/>
                            </div>


                        </div>

                        <div class="box-footer">
                            <button type="submit" class="btn btn-primary" name = "SUB"> Ok </button>
                        </div>

                    </form>
                </div> 
            </div>
        </div> 
    </section> 
</aside>

