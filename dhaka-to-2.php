<?php
    #if date is not set redirect with today date
    date_default_timezone_set('asia/dhaka');
    $today = $date = date('Y-m-d');
    if (!isset($_GET['TargetDate'])) {
        header('Location: ' . $_SERVER['PHP_SELF'] . '?TargetDate=' . $today);
    }

    #update target date
    if (isset($_GET['TargetDate']) and preg_match('/^\d{4}-\d{2}-\d{2}$/', "{$_GET['TargetDate']}") == 1) {
        $target_date = $_GET['TargetDate'];
    } else {
        $target_date = $today;
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.css">

        <title>Bangladesh Rail Way Train Seat Checker</title>
    </head>
    <body>
        <div class="container-xl mt-5">
            <h6 class="text-muted d-flex justify-content-between">
                <span>Dhaka to
                    <small>SH M Monsur Ali, Ullapara, Boral Bridge and Chatmahar <strong>(<?php echo $target_date ?>)</strong>...</small>
                </span>
                <small><a href="boralBridge-to.php?TargetDate=<?php echo $target_date ?>" class="text-secondary">Boral Bridge to</a></small>
            </h6>
            <section class="mt-4">
                <div class="row">
                    <!--Dhaka To SH M Monsur Ali-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>SH M Monsur Ali</strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 726, 'Ekota Express' => 705, 'Chitra' => 764, 'Lalmoni Express' => 751, 'Padma Express' => 759);
                                require_once __DIR__ . '/class/BD_Rail.php';
                                foreach ($trains as $tran_name => $train_number) {
                                    #get seat availability by train number
                                    $available_seatType_AndNumber = BD_Rail::DHAKATO_SeatAvailability_2($train_number, 'SMA', $target_date);

                                    $formatted_date = "";
                                    if (!empty($available_seatType_AndNumber)) {
                                        foreach ($available_seatType_AndNumber as $seatType => $seatNumber) {
                                            #make S_CHAIR bold
                                            $S_CHAIR = '';
                                            if ($seatType == 'S_CHAIR') {
                                                $S_CHAIR = 'text-dark';
                                            }
                                            $formatted_date .= "<span class='badge badge-light $S_CHAIR badge-pill text-secondary'>$seatType-$seatNumber</span>";
                                        }
                                    }
                                    echo <<<HEREDOC
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>$tran_name</div>
                                <div>
                                   $formatted_date
                                </div>
                            </li>
HEREDOC;
                                }
                            ?>
                        </ul>
                    </div>

                    <!--Dhaka To Ullapara-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>Ullapara</strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 726, 'Ekota Express' => 705, 'Chitra' => 764, 'Lalmoni Express' => 751, 'Padma Express' => 759);
                                date_default_timezone_set('asia/dhaka');
                                $date = date('Y-m-d'); //2021-07-18
                                require_once __DIR__ . '/class/BD_Rail.php';
                                #get seat type and availability by train number
                                foreach ($trains as $tran_name => $train_number) {
                                    $available_seatType_AndNumber = BD_Rail::DHAKATO_SeatAvailability_2($train_number, 'ULP', $target_date);

                                    #generate seat type and number formatted html
                                    $formatted_date = "";
                                    if (!empty($available_seatType_AndNumber)) {
                                        foreach ($available_seatType_AndNumber as $seatType => $seatNumber) {
                                            #make S_CHAIR bold
                                            $S_CHAIR = '';
                                            if ($seatType == 'S_CHAIR') {
                                                $S_CHAIR = 'text-dark';
                                            }
                                            $formatted_date .= "<span class='badge badge-light $S_CHAIR badge-pill text-secondary'>$seatType-$seatNumber</span>";
                                        }
                                    }
                                    echo <<<HEREDOC
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>$tran_name</div>
                                <div>
                                   $formatted_date
                                </div>
                            </li>
HEREDOC;
                                }
                            ?>
                        </ul>
                    </div>

                    <!--Dhaka To Boral Bridge-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>Boral Bridge</strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 726, 'Chitra' => 764, 'Lalmoni Express' => 751, 'Padma Express' => 759);
                                require_once __DIR__ . '/class/BD_Rail.php';
                                foreach ($trains as $tran_name => $train_number) {
                                    #get seat availability by train number
                                    $available_seatType_AndNumber = BD_Rail::DHAKATO_SeatAvailability_2($train_number, 'BRBE', $target_date);

                                    $formatted_date = "";
                                    if (!empty($available_seatType_AndNumber)) {
                                        foreach ($available_seatType_AndNumber as $seatType => $seatNumber) {
                                            #make S_CHAIR bold
                                            $S_CHAIR = '';
                                            if ($seatType == 'S_CHAIR') {
                                                $S_CHAIR = 'text-dark';
                                            }
                                            $formatted_date .= "<span class='badge badge-light $S_CHAIR badge-pill text-secondary'>$seatType-$seatNumber</span>";
                                        }
                                    }
                                    echo <<<HEREDOC
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>$tran_name</div>
                                <div>
                                   $formatted_date
                                </div>
                            </li>
HEREDOC;
                                }
                            ?>
                        </ul>
                    </div>

                    <!--Dhaka To Chatmahar-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>Chatmahar</strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 726, 'Rangpur Express' => 771, 'Chitra' => 764, 'Drutajan Express' => 757, 'Padma Express' => 759);
                                require_once __DIR__ . '/class/BD_Rail.php';
                                foreach ($trains as $tran_name => $train_number) {
                                    #get seat availability by train number
                                    $available_seatType_AndNumber = BD_Rail::DHAKATO_SeatAvailability_2($train_number, 'CMO', $target_date);

                                    $formatted_date = "";
                                    if (!empty($available_seatType_AndNumber)) {
                                        foreach ($available_seatType_AndNumber as $seatType => $seatNumber) {
                                            #make S_CHAIR bold
                                            $S_CHAIR = '';
                                            if ($seatType == 'S_CHAIR') {
                                                $S_CHAIR = 'text-dark';
                                            }
                                            $formatted_date .= "<span class='badge badge-light $S_CHAIR badge-pill text-secondary'>$seatType-$seatNumber</span>";
                                        }
                                    }
                                    echo <<<HEREDOC
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div>$tran_name</div>
                                <div>
                                   $formatted_date
                                </div>
                            </li>
HEREDOC;
                                }
                            ?>
                        </ul>
                    </div>
                </div>
            </section>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery.min.js"></script>
    </body>
</html>