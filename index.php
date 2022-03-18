<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <title>CRUD Ops</title>
</head>
<body class="p-4">
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" 
        integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" 
        integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <?php 
        require('./process.php');
    ?>

    <?php
    //display session message each time an CRUD operation is performed.
    if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            <?php 
                echo $_SESSION['message'];
                unset($_SESSION['message']);
            ?>
        </div> 
    <?php endif ?>   

    <div class="row justify-content-center ">
        <form action="process.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
           
            <div class="form-group col-md-6">
                <label for="name">Name</label>
                <input type="text" name="name" placeholder="Enter your name" value="<?php echo $name; ?>" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="age">Age</label>
                <input type="text" name="age" placeholder="Enter your age" value="<?php echo $age; ?>" class="form-control" >
            </div>
            <div class="form-group col-md-6">
                <label for="location">Location</label>
                <input type="text" name="location" placeholder="Enter your location" value="<?php echo $location; ?>" class="form-control">
            </div>
            <div class="form-group col-md-6">
                <label for="profession">Profession</label>
                <input type="text" name="profession" placeholder="Enter your profession" value="<?php echo $profession; ?>" class="form-control">
            </div>
            <div class="form-group">
                <?php 
                    if ($update == true):  
                ?>
                    <button type="submit" name="update" class="btn btn-info">Update</button>
                <?php else: ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php endif ?>
            </div>     
        </form>
    </div>

    <table class="table">
            <thead>
                <tr>
                    <th scope="col">ID#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Location</th>
                    <th scope="col">Profession</th>
                    <th scope="col">Manage</th>
                </tr>
            </thead>
        <tbody>

        <!-- Display Data in Table -->
            <?php 
            //print the each row of records in database
            while ($row = pg_fetch_assoc($get_query)): ?> 
                <tr>
                    <td><?php echo $row['id']; ?></td>
                    <td><?php echo $row['name']; ?></td>
                    <td><?php echo $row['age']; ?></td>
                    <td><?php echo $row['location'] ?></td>
                    <td><?php echo $row['profession'] ?></td>
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>" 
                        class="btn btn-success">
                            Edit
                        </a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                        class="btn btn-danger">
                            Delete
                        </a>
                    </td>
                </tr> 
            <?php endwhile ?>                   
                
        </tbody>
    </table>
            
</body>
</html>