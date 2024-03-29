<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Information</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10" type="text/javascript"></script>
    <script>
        const cancelClick = () => {
            Swal.fire({
                        title: 'Cancel Reservation?',
                        text: "You won't be able to revert this!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        cancelButtonText:"Nope!"
                    }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href="./cancel_reservation.php?id=<?php echo($_GET['id'])?>&tk=<?php echo($_GET['tk'])?>"
                    }
                })
        }
    </script>
    <link rel="stylesheet" href="../../asset/style/style.css">
</head>
<body>
    
</body>
</html>
<?php
    error_reporting(E_ERROR | E_PARSE);
    require('./functions.php');
    include('./dbconfig.php');
    global $customer_info, $table_info, $reservation_detail;
    $validation = intval(hex2bin($_GET['id']));
    $data_details = getOAuth($conn, $customer_info, $reservation_detail, $validation);
    if($data_details['customer_token'] === $_GET['tk'] && $data_details['customer_token'] && $data_details['status'] === "reserved"){
            $res = fetchReserDetails($conn, $reservation_detail, $validation);
            $res2 = fetchCustomerInfo($conn, $customer_info, $res['customer_name']);
            if(isset($_POST['update'])){
                $res2 = updateCustomerInfo($conn, $customer_info, $res2, $res['customer_name']);
            }
            ?>
                <div class="container container-fluid reservation-information">
                    <form action="reservation.php?id=<?php echo($_GET['id'])?>&tk=<?php echo($_GET['tk'])?>" method="post" class="form-control form-info">
                        <center><h1>Reservation Information</h1></center>
                        <table class="table table-striped " style="table-layout:auto;">
                            <tr>
                                <td>Reservation Id</td>
                                <td><?php echo($res['reservation_id'])?></td>
                            </tr>
                            <tr>
                                <td>Table</td>
                                <td><?php echo($res['table_id'])?></td>
                            </tr>
                            <tr>
                                <td>Full Name</td>
                                <td><?php echo($res2['customer_name'])?></td>
                            </tr>
                            <tr>
                                <td>Email Address</td>
                                <td><?php echo($res2['customer_email'])?></td>
                            </tr>
                            <tr>
                                <td>Phone Number</td>
                                <td>
                                    <?php
                                    if($res['status'] === 'reserved'){
                                        ?>
                                        <input type="text" name="phone" class="form-control phone-info" maxlength="15" pattern="[0-9]{10,15}" value=<?php echo($res2['customer_phone'])?>>
                                        <?php
                                    }else{
                                        echo($res2['customer_phone']);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Number Of People</td>
                                <td><?php echo($res2['reservation_people'])?></td>
                            </tr>
                            <tr>
                                <td>Reservation Time</td>
                                <td><?php echo($res2['reservation_time'])?></td>
                            </tr>
                            <tr>
                                <td>Notes</td>
                                <td>
                                    <?php
                                    if($res['status'] === 'reserved'){
                                        ?>
                                        <textarea name="notes" cols="75" rows="3" class="form-control"><?php echo($res2['reservation_note'])?></textarea>
                                        <?php
                                    }else{
                                        echo($res2['reservation_note']);
                                    }
                                    ?>
                                </td>
                            </tr>
                            <tr>
                                <td><button type="submit" class="btn btn-primary" name="update">Confirm</button></td>
                                <td>
                                    <!-- <a href="./cancel_reservation.php?id=<?php echo($_GET['id'])?>&tk=<?php echo($_GET['tk'])?>" class="btn btn-danger" style="float: right;">Cancel</a> -->
                                    <button type="button" class="btn btn-danger" style="float: right;" onclick="cancelClick();">Cancel</button>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            <?php
    }else{
        notAuthorize();
    }
    
    
    /*
    TODO
    1. check reservation dates if passed dont allow update just view (done using status)
    2. using token to cancel and update (done)
    3. Probably use token as well to view reservation information (done)

    */

    mysqli_close($conn);
?>