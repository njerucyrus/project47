<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:43 PM
 */

require_once '../vendor/autoload.php';
require_once 'includes/register_student.inc.php';
?>
<!doctype html>
<html>
<head>
    <title> Student Registration</title>
    <?php include 'head_views.php' ?>
</head>
<body class="page-body skin-facebook">
<div class="page-container">
    <?php include 'right_menu_views.php' ?>
    <div class="main-content">
        <?php include 'header_menu_views.php' ?>

        <div class="panel panel-primary" data-collapsed="0">

            <div class="panel-heading">
                <div class="panel-title col-md-offset-3">
                    <h1>Register New Student</h1>
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
                </div>
            </div>
<!-- Name Section -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" role="form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'])?>">
            <fieldset>

                <!-- Form Name -->
                <legend>Personal Information Details</legend>

                <!-- Text input-->
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="first_name"  class="control-label">First Name</label>
                        <input type="text" name="first_name" id="first_name" placeholder="First Name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="last_name"  class="control-label">Last Name</label>
                        <input type="text" name="last_name" id="last_name" placeholder="Last Name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="other_name"  class="control-label">Other Name</label>
                        <input type="text" name="other_name" id="other_name" placeholder="Other Name" class="form-control">
                    </div>
                </div>

                <!-- Text input-->
                <div class="form-group">

                    <div class="col-sm-4">
                        <label for="reg_no"  class="control-label">Registration Number</label>
                        <input type="text" name="reg_no" id="reg_no" placeholder="Registration Number" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="gender"  class="control-label">Gender</label>
                        <select id="gender" name="gender" class="form-control">
                            <option value="M">Male</option>
                            <option value="F">Female</option>
                           </select>

                         </div>

                </div>




                <legend>Addition  Information</legend>
                <!-- Text input-->
                <div class="form-group">

                    <div class="col-sm-4">
                        <label for="class_joined"  class="control-label">Class Joined</label>
                        <input type="text" name="class_joined" id="class_joined" placeholder="Class Joined" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="profile_image"  class="control-label">Profile Image</label>
                        <input type="file" id="profile_image" name="profile_image" accept="image/*" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="current_class"  class="control-label">Current Class </label>
                        <input type="text" name="current_class" placeholder="Current Class" class="form-control">

                    </div>
                </div>
                <!--                text input-->
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="stream"  class="control-label">Stream</label>
                        <input type="text" name="stream" id="stream" placeholder="Stream" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="kcpe"  class="control-label">KCPE</label>
                        <input type="text" name="kcpe" id="kcpe" placeholder="KCPE" class="form-control">
                    </div>

                    <div class="col-sm-4">
                        <label for="status"  class="control-label">Status</label>
                        <input type="text" name="status" id="status" placeholder="Status" class="form-control">
                    </div>

                </div>

                <div class="form-group">

                    <div class="col-sm-6">
                        <label for="dob"  class="control-label">Date Of Birth</label>
                        <input placeholder="Date Of Birth" name="dob" id="dob"  class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" >
                    </div>
                    <div class="col-sm-6">
                        <label for="date_enrolled"  class="control-label">Date Enrolled</label>
                        <input placeholder="Date Enrolled" name="date_enrolled" id="date_enrolled"  class="form-control" type="text" onfocus="(this.type='date')" onblur="(this.type='text')" >
                    </div>
                </div>

                <legend>Parent Information Details</legend>
                <!-- Text input-->
                <div class="form-group">

                    <div class="col-sm-6">
                        <label for="parent_name"  class="control-label">Parent Name</label>
                        <input type="text" name="parent_name" placeholder="Parent Name" class="form-control">
                    </div>
                    <div class="col-sm-6">
                        <label for="address"  class="control-label">Address</label>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control">
                    </div>

                </div>
                <!-- Text input-->
                <div class="form-group">
                    <div class="col-sm-4">
                        <label for="phone_number"  class="control-label">Phone</label>
                        <input type="text" name="phone_number" id="phone_number" placeholder="Phone" class="form-control">
                    </div>

                    <div class="col-sm-4">
                        <label for="email"  class="control-label">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="occupation"  class="control-label">Occupation</label>
                        <input type="text" name="occupation" id="occupation" placeholder="Occupation" class="form-control">
                    </div>
                </div>






                <!-- Command -->
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="col-md-8 col-md-offset-5">

                            <button type="submit" class="btn btn-lg btn-blue ">Save Student</button>
                        </div>
                    </div>
                </div>
            </fieldset>
        </form>
    </div><!-- /.col-lg-12 -->
</div><!-- /.row -->


        </div>
    </div>
</div>


<!--javascript-->
<?php include 'footer_views.php'; ?>
</body>
</html>

