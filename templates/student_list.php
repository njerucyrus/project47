<?php
/**
 * Created by PhpStorm.
 * User: hudutech
 * Date: 4/8/17
 * Time: 2:31 PM
 */

?>
<div class="container">
<script type="text/javascript">
    jQuery( document ).ready( function( $ ) {
        var $table1 = jQuery( '#table-1' );

        // Initialize DataTable
        $table1.DataTable( {
            "aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
            "bStateSave": true
        });

        // Initalize Select Dropdown after DataTables is created
        $table1.closest( '.dataTables_wrapper' ).find( 'select' ).select2( {
            minimumResultsForSearch: -1
        });
    } );
</script>

<table class="table table-bordered datatable" id="table-1">
    <thead>
    <tr>
        <th>#</th>
        <th>RegNo</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Other Name</th>
        <th>Gender</th>
        <th>Class Joined</th>
        <th>Current Class</th>
        <th>DoB</th>
        <th>Date Enrolled</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $students = \Hudutech\Controller\StudentController::all();
    $count = 0;
    foreach ($students as $student) {
        $count +=1;
    ?>
        <tr class="odd gradeX">
            <td><?echo $count ?></td>
            <td><?echo $student['reg_no']?></td>
            <td><?echo $student['first_name']?></td>
            <td><?echo $student['last_name']?></td>
            <td><?echo $student['other_name']?></td>
            <td><?echo $student['gender']?></td>
            <td><?echo $student['class_joined']?></td>
            <td><?echo $student['current_class']." ".$student['stream']?></td>
            <td><?echo $student['dob']?></td>
            <td><?echo $student['date_enrolled']?></td>
            <td><button>Edit</button>&nbsp;<button>Delete</button></td>
        </tr>
    <?php
    }
    ?>
    </tbody>
    <tfoot>
    <tr>
        <th>#</th>
        <th>RegNo</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Other Name</th>
        <th>Gender</th>
        <th>Class Joined</th>
        <th>Current Class</th>
        <th>DoB</th>
        <th>Date Enrolled</th>
    </tr>
    </tfoot>
</table>
</div>