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
                <span>Boral Bridge to Dhaka <small><strong>(<?php echo $target_date ?>)</strong></small></span>
                <small><a href="dhaka-to.php?TargetDate=<?php echo $target_date ?>" class="text-secondary">Dhaka to</a></small>
            </h6>
            <section class="mt-4">
                <div class="row">
                    <!--Chatmohar to Dhaka-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>Chatmohar <small>to Dhaka</small></strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 725, 'Chitra' => 763, 'Drutajan Express' => 758, 'Padma' => 760);
                                $formStation = 'CMO';
                                $toStation = 'DA';
                                require_once __DIR__ . '/class/BD_Rail.php';
                                foreach ($trains as $tran_name => $train_number) {
                                    #get seat availability by train number
                                    $available_seatType_AndNumber = BD_Rail::BORAL_BRIDGE_TO_SEAT_CHECKER($train_number, $formStation, $toStation, $target_date);

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

                    <!--Boral Bridge to Dhaka-->
                    <div class="col-lg-6 mb-4">
                        <ul class="list-group">
                            <li class="list-group-item bg-light text-secondary">
                                <strong>Boral Bridge <small>to Dhaka</small></strong>
                            </li>
                            <?php
                                //Train name and number arr
                                $trains = array('Sundarban Express' => 725, 'Chitra' => 763, 'Lalmoni Express' => 752, 'Padma' => 760);
                                $formStation = 'BRBE';
                                $toStation = 'DA';
                                require_once __DIR__ . '/class/BD_Rail.php';
                                foreach ($trains as $tran_name => $train_number) {
                                    #get seat availability by train number
                                    $available_seatType_AndNumber = BD_Rail::BORAL_BRIDGE_TO_SEAT_CHECKER($train_number, $formStation, $toStation, $target_date);

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










                    <!--M Monusr ALi to Dhaka-->
                    <!--Tongi, Tangail, Gajipur to Dhaka-->
                </div>
            </section>
        </div>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="assets/js/jquery.min.js"></script>
    </body>
</html>