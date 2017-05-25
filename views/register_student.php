<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 5/23/17
 * Time: 3:43 PM
 */
?>
<!DOCTYPE html>
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
                </div>
            </div>
<!-- Name Section -->
<div class="row">
    <div class="col-md-8 col-md-offset-1">
        <form class="form-horizontal" role="form">
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
                        <select id="gender" class="form-control">
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
                        <input type="text" name="class_joined" placeholder="Class Joined" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="profile_pic"  class="control-label">Profile Image</label>
                        <input type="file" name="profile_pic" accept="image/*" class="form-control">
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

                    <div class="col-sm-4">
                        <label for="parent_name"  class="control-label">Parent Name</label>
                        <input type="text" name="parent_name" placeholder="Parent Name" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="address"  class="control-label">Address</label>
                        <input type="text" name="address" id="address" placeholder="Address" class="form-control">
                    </div>
                    <div class="col-sm-4">
                        <label for="email"  class="control-label">Email</label>
                        <input type="text" name="email" id="email" placeholder="Email" class="form-control">
                    </div>
                </div>






                <!-- Command -->
                <div class="form-group">
                    <div class="col-sm-5 col-sm-offset-1">
                        <div class="pull-right">
                            <button type="submit" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
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

