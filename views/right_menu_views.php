<?php
/**
 * Created by PhpStorm.
 * User: New LAptop
 * Date: 24/05/2017
 * Time: 12:47
 */
?>
<div class="sidebar-menu" style="margin-top: -100px;">

    <div class="sidebar-menu-inner">

        <header class="logo-env">

            <!-- logo -->
            <div class="logo">
                <a href="index.php">
                    <img src="../public/assets/images/eschool.png" width="120" alt=""/>
                </a>
            </div>

            <!-- logo collapse icon -->
            <div class="sidebar-collapse">
                <a href="#" class="sidebar-collapse-icon">
                    <!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
                    <i class="entypo-menu"></i>
                </a>
            </div>


            <!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
            <div class="sidebar-mobile-menu visible-xs">
                <a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
                    <i class="entypo-menu"></i>
                </a>
            </div>

        </header>

        <div class="sidebar-user-info">

            <div class="sui-normal">
                <div class="user-link">

                    <i style="color: white; font-size: 3em; display: inline-block;width: 100%;text-align: center;"
                       class="fa fa-graduation-cap"></i>

                    <h2 style="font-size: 1.5em; color: white; text-align: center;">Welcome,<?php echo "user"?></h2>
                    <p style="font-size: 1.2em; color: white; text-align: center;"> Logged in as (<?php echo "admin"; ?>
                        )</p>
                </div>
            </div>


        </div>

        <ul id="main-menu" class="main-menu">
            <!-- add class "multiple-expanded" to allow multiple submenus to open -->
            <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
            <li class="opened active has-sub multiple-expanded">
                <a href="#">
                    <i class="fa fa-plus-square" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 1.8em;">Registration</span>
                </a>
                <ul class="visible">
                    <li>
                        <a href="../views/register_student.php">
                            <i class="fa fa-user-plus" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Register Student</span>
                        </a>
                    </li>
                    <li>
                        <a href="../views/register_teacher.php">
                            <i class="fa fa-user-plus" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Register Teacher</span>
                        </a>
                    </li>
                    <li>
                        <a href="../views/record_drug.php">
                            <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Record Drug</span>
                        </a>
                    </li>
                    <li>
                        <a href="../views/record_product.php">
                            <i class="fa fa-plus-square" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Record Product</span>
                        </a>
                    </li>

                    <li>
                        <a href="../views/patients.php">
                            <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">View Patients</span>
                        </a>
                    </li>



                    <li>
                        <a href="../views/users.php">
                            <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">View users</span>
                        </a>
                    </li>


                </ul>
            </li>


            <li class="has-sub"
            ">
            <a href="../views/patient_visit.php">
                <i class="fa fa-wheelchair" style="font-size: 1.8em;"></i>
                <span class="title" style="font-size: 2em;"> Patient Visit</span>
            </a>

            </li>

            <li class="has-sub">

                <a href="../views/consultation.php">
                    <i class="fa fa-stethoscope" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Consultation</span>
                </a>

            </li>


            <li class="has-sub">

                <a href="#">
                    <i class="fa fa-medkit" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Lab Test</span>
                </a>

                <ul>
                    <li>
                        <a href="../views/perform_tests.php">
                            <i class="fa fa-search" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Perform Test</span>
                        </a>
                    </li>
                    <li>
                        <a href="../views/test_results.php">
                            <i class="fa fa-eye" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">View Lab Test</span>
                        </a>
                    </li>
                    <li>
                        <a href="../views/clinical_tests.php">
                            <i class="fa fa-medkit" style="font-size: 1.5em;"></i>
                            <span class="title" style="font-size: 1.5em;">Add Clinical Test</span>
                        </a>
                    </li>


                </ul>

            </li>
            <li class="has-sub">
                <a href="../views/pos.php">
                    <i class="fa fa-shopping-cart" aria-hidden="true" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Pharmacy</span>
                </a>

            </li>

            <li class="has-sub">

                <a href="../views/drug_sales.php">
                    <i class="fa fa-money" style="font-size: 1.8em;"></i>
                    <span class="title" style="font-size: 2em;"> Drug Sales</span>
                </a>

            </li>

        </ul>


    </div>
</div>