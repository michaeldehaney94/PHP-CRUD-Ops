<?php 

session_start();

//variables with default values used to set record data when editing/updating
$id = 0;
$update = false;
$name = " ";
$age = " ";
$location = " ";
$profession = " ";

//connecting database
$db = pg_pconnect("host=localhost port=5432 dbname=census-db user=postgres password=Qwerty+1");
try {
    if (!$db) {
        echo "Error: Unable to connect to database!";
        pg_close($db);
    }
} catch (\Throwable $th) {
    echo $th;
    die();
}


//Check if save button has been press to POST data
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $profession = $_POST['profession'];

    //print session message on index
    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    $db_query = pg_query($db, "INSERT INTO data (name, age, location, profession) VALUES ('$name', '$age', '$location', '$profession');");
    //redirect 
    header("Location: index.php");
    exit;
}

//GET all existing data
$get_query = pg_query($db, "SELECT * FROM data;");
exit;

//DELETE selected record
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    //print session message on index
    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    $del_query = pg_query($db, "DELETE FROM data WHERE id=$id");
    //redirect 
    header("Location: index.php");
    exit;
}

 //UPDATE selected data, check if edit button is clicked
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $edit_query = pg_query($db, "SELECT * FROM data WHERE id=$id");
    $update = true;
    //check if record exist
    if (pg_num_rows($edit_query) == 1) {
        $row = pg_fetch_array($edit_query);
        $name = $row['name'];
        $age = $row['age'];
        $location = $row['location'];
        $profession = $row['profession'];
    }
    header("Location: index.php");
    exit;
}

//check if the update button has been clicked and update selected record fields
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $age = $_POST['age'];
    $location = $_POST['location'];
    $profession =$_POST['profession'];
    $update_query = pg_query($db, "UPDATE data SET name='$name', age='$age', location='$location, profession='$profession' WHERE id='$id';");
   
    //print session message on index
    $_SESSION['message'] = "Record has been updated!";
    $_SESSION['msg_type'] = "warning";
   
    header("Location: index.php");
    exit;
}
    
?>