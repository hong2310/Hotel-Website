<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Users</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php require("header.php");
        require("../connection.php");
        $a = 0;
        $sql = "select * from TAIKHOAN where isAdmin='" . $a . "'";
        $run = mysqli_query($connection, $sql);

?>

<div class="conteiner-fluid" >

        <div class="row">
        
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">
            <h3 class="mb-4">USERS</h3>
            <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">#</th>
                <th scope="col">ID CUSTOMER</th>
                <th scope="col">NAME</th>
                <th scope="col">USERNAME</th>
                <th scope="col">ACTIVATED</th>
                <!-- <th scope="col">ACTIVITY</th> -->
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php 
                        $i = 1;
                        while($row = mysqli_fetch_array($run)){
                            $s = "SELECT * FROM DS_KHACHHANG WHERE USERNAME ='" . $row['USERNAME'] . "'";
                            $ex = mysqli_query($connection, $s);
                            $n = mysqli_num_rows($ex);
                            $r = mysqli_fetch_array($ex);
                            
                            ?>
                        <td><?php echo $i ?></td>
                        <td><?php echo $r['ID_KHACHHANG'] ?></td>
                        <td><?php echo $r['TEN_KHACHHANG'] ?></td>
                        <td><?php echo $row['USERNAME'] ?></td>
                        <td>
                            <div class="form-check form-switch">
                                <form action="">
                                    <input onchange="user_shutdown(this.value)"class="form-check-input" type="checkbox" id="shut">

                                </form>
                            </div>
                        </td>
                </tr>
                    <?php
                        $i = $i+1;
                            }

                    ?>
                
            </tbody>
        </table>
    </div>
</div>
<script>
        let data;
        function get_user(){
            let shutdown = document.getElementById("shut");
            xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting.php", true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onload = function(){
                // console.log(this.responseText);
                data = JSON.parse(this.responseText);

                if(data.isActivated == 0){
                    shutdown.checked = false;
                    shutdown.value = 0;
                }
                else{
                    shutdown.checked = true;
                    shutdown.value = 1;
                }
            }
            xhr.send('get_user');
        }

        function user_shutdown(value){
            xhr = new XMLHttpRequest();
            xhr.open("POST", "ajax/setting.php", true);
            xhr.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
            xhr.onload = function(){
                if (this.responseText == 1 && data.isActivated == 0){
                    alert("Shutdown Success");
                }
                else{
                    alert("Shutdown is off");
                }
                get_user();
            }
            xhr.send('user_shutdown=' + value);
    

        }

        window.onload = function(){
            get_user();

        }
</script>

</body>
</html>