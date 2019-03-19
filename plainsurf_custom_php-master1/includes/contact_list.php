<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Contact List </title>
        <style>
            table{

                font-family: sans-serif;
                width: 100%;
                color: #212529;
                font-size: 25px;
                text-align: center;
            }
            th{
                background-color: #212529;
                color: white;
            }
            tr:nth-child(even) {background-color: #f2f2f2}
        </style>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    </head>

    <body>
        <div class="container py-5"> <table>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile No.</th>
                        <th>Message</th>
                        <th>Gender</th>
                        <th width="100px">Action</th>
                    </tr>
                </thead>
                <?php
                $conn = new mysqli("localhost", "root", "12345", "form");
                if ($conn->connect_error) {
                    die("Connection Failed" . $conn->connect_error);
                }
                $query = "SELECT First_Name ,Last_Name ,Email ,Mobile ,Details ,Opt ,id from contact";
                $result = $conn->query($query);
                //if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr id="<?php echo $row['id'] ?>">
                        <td><?php echo $row['First_Name'] ?></td>
                        <td><?php echo $row['Last_Name'] ?></td>
                        <td><?php echo $row['Email'] ?></td>
                        <td><?php echo $row['Mobile'] ?></td>
                        <td><?php echo $row['Details'] ?></td>
                        <td><?php echo $row['Opt'] ?></td>
                        <td><button class="btn btn-danger btn-sm remove">Delete</button></td>
                    </tr>


                <?php } ?>


            </table>

        </div>

    </body>

     <script type="text/javascript">
    $(".remove").click(function(){
        var id = $(this).parents("tr").attr("id");


        if(confirm('Are you sure to remove this record ?'))
        {
            $.ajax({
               url: 'controller/delete.php',
               type: 'GET',
               data: {id: id},
               error: function() {
                  alert('Something is wrong');
               },
               success: function(data) {
                    $("#"+id).remove();
                    alert("Record removed successfully");  
               }
            });
        }
    });


</script>

</html>
