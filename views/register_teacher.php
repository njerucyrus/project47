<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 06/05/2017
 * Time: 22:22
 */
require_once '../vendor/autoload.php';
include 'includes/register_teacher.inc.php';
?>
<!DOCTYPE html>
<html>
<?php include 'head_views.php' ?>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <?php include 'header_menu_views.php' ?>
                <div class="panel panel-primary" data-collapsed="0">

                    <div class="panel-heading">
                        <div class="panel-title col-md-offset-3">

                            <?php
                            if (empty($successMsg) && !empty($errorMsg)) {
                                ?>
                                <div class="alert alert-danger alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $errorMsg ?>
                                </div>
                                <?php
                            } elseif (empty($errorMsg) and !empty($successMsg)) {
                                ?>
                                <div class="alert alert-success alert-dismissable">
                                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                    <?php echo $successMsg ?>
                                </div>

                                <?php
                            } else {
                                echo "";
                            }
                            ?>
                            <h1>Register Teacher</h1>
                        </div>


                    </div>

                    <div class="panel-body">

                        <form role="form" class="form-horizontal form-groups-bordered" method="post"
                              action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>">

                            <div class="form-group">
                                <label for="firstName" class="col-sm-3 control-label">First Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="sir_name" placeholder="First Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="middle_name" class="col-sm-3 control-label">Middle Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="middle_name" placeholder="middle Name" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="lastName" class="col-sm-3 control-label">Last Name</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tsc_no" class="col-sm-3 control-label">TSC Number</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="tsc_no" placeholder="TSC No">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nation_id" class="col-sm-3 control-label">National ID</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="national_id" placeholder="National ID"
                                           required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="nation_id" class="col-sm-3 control-label">Speciality</label>

                                <div class="col-sm-5">
                                    <input type="text" class="form-control" name="speciality" placeholder="Speciality">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Select Gender</label>

                                <div class="col-sm-5">
                                    <select name="gender" class="form-control">
                                        <option>M</option>
                                        <option>F</option>

                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="date_registered" class="col-sm-3 control-label">Date Registered</label>

                                <div class="col-sm-5">

                                    <input placeholder="Date Registered" name="date_registered" id="date_registered"  class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" >

                                </div>
                            </div>




                            <div class="form-group">
                                <div class="col-sm-offset-3 col-sm-5">

                                    <input type="submit" name="submit" value="Register Teacher"
                                           class="btn btn-primary btn-lg btn-block "/>
                                </div>
                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>
    <?php include 'footer_views.php'?>
    <script src="../public/assets/js/jquery-1.11.3.min.js"></script>
    <script src="../public/assets/js/bootstrap.min.js"></script>
</body>
</html>
