<h1>Marks Entry</h1>
<form action="" method="post">
    <div class="form-group">
        <label for="">Name</label>
        <input type="text" name="name" id="name" class="form-control " placeholder="Input name">
    </div>
    <div class="form-group">
        <label for="">Email</label>
        <input type="email" name="email" id="email" class="form-control " placeholder="Input email">
    </div>
    <div class="form-group">
        <label for="">Attendance</label>
        <input type="number" name="attendance" id="attendance" class="form-control " placeholder="Attendance out of 10">
    </div>
    <div class="form-group">
        <label for="">Project</label>
        <input type="number" name="project" id="project" class="form-control " placeholder="Marks out of 10">
    </div>

    <div class="row justify-content-center">
        <div class="col-xs-4 col-sm-4 col-md-4">
            <input type="submit" name="btnsubmit1" value="Submit">
        </div>
    </div>
</form>

<h2>View Marks</h2>
<?php 
    global $wpdb;
    $table_name = $wpdb->prefix.'marks';
    $trainees = $wpdb->get_results("SELECT * FROM $table_name");
?>
<table class="table table-striped" border>
    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Attendance Marks</th>
            <th>Project Marks</th>
            <th>Action</th>
        </tr>
    </thead>
    <?php 
        foreach($trainees as $key => $trainee){ ?>
            <tr>
                <td><?php echo $trainee->name ?></td>
                <td><?php echo $trainee->email ?></td>
                <td><?php echo $trainee->attendance ?></td>
                <td><?php echo $trainee->project ?></td>
                <?php $emailout = $trainees[$key]->email ?>
                <td>
                    <form action="" method="post">
                        <button type="submit" name="btndelete">Delete</button>
                    </form>
                </td>
                <?php 
                    if(isset($_POST['btndelete'])){
                        global $wpdb;
                        $table_name = $wpdb->prefix.'marks';
                        $wpdb->show_errors();

                        $result = $wpdb->delete($table_name, ['email'=> $emailout]);

                        if($result == true){
                            echo "<script>alert('Trainee deleted successfully');</script>";
                            exit;
                        }else{
                            echo "<script>alert('Deletion failed');</script>";
                        }
                    }
                ?>
            </tr>

    <?php } ?>
</table>
