<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE-edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Categories Room</title>
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
<?php require("header.php"); ?>
    <div class="conteiner-fluid" >
        <div class="row">
        <div class="col-lg-10 ms-auto p-4 overflow-hidden">
        <div class="row">
        <h3 class="mb-4">CATEGORIES ROOM</h3>
            <?php
            if (!function_exists('currency_format')) {

                function currency_format($number, $suffix = ' VND') {
                    if (!empty($number)) {
                        return number_format($number, 0, ',', ',') . "{$suffix}";
                    }
                }
            
            }
            require("../connection.php");
            $i = 0;
            $s = "select * from DS_LOAIPHONG";
            $n = $connection->query($s);
            // $rowcount=mysqli_num_rows($n);
            $rowcount = $n->num_rows;
            for ($i = 1; $i <= $rowcount; $i++) {
                $id = 'L0' . '' . $i;
                $sql = "SELECT * FROM DS_LOAIPHONG where ID_LOAIPHONG = '$id'";
                $result = mysqli_query($connection, $sql);
                $row = mysqli_fetch_array($result, MYSQLI_BOTH);
                echo "<div class='col-lg-3 col-md-6 p-3' id=$id onclick='goToRoomDetail(\"$id\")'>       
                            <a href='' style='text-decoration: none; color: black'>
                                <div class='card shadow' style='max-width: 400px'>
                                    <img src='./upload/categories/" . $row['HINHANH'] . "' class='card-img-top' style='height: 200px;'>
                                    <div class='card-body'>
                                        <h5 class=\"card-title fw-bold\">" . $row['TEN_LOAIPHONG'] . "</h5>
                                        <h5 class='text-danger'> " . currency_format($row['GIA']) . "/Day</h5>
                                        <div class='features mb-4'>
                                            <h6 class='mb-1 fw-bold'>Features</h6>
                                                <p class=\"badge rounded-pill bg-light text-dark text-wrap\">" . $row['FEATURES'] . "</p>
                                        </div>
                                        <div class='facilities mb-4'>
                                            <h6 class='mb-1 fw-bold'>Facilities</h6>
                                                <p class=\"badge rounded-pill bg-light text-dark text-wrap\">" . $row['FACILITIES'] . "</p>
                                        </div>
                                    </div>
                                </div>
                            </a>     
                        </div>";
            }
            ?>

        </div>
    </div>
    </div>
    </div>
</body>
</html>