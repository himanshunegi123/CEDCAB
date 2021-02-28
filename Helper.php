<?php
// session_start();
if (isset($_POST['action']) != "") {
    include_once 'CLASS/User.php';
    include_once 'CLASS/Location.php';
    include_once 'CLASS/Ride.php';

    $action = $_POST['action'];

    switch ($action) {


        case ('signup'):
            $inputEmail = $_POST['inputEmail'];
            $inputName = $_POST['inputName'];
            $inputNumber = $_POST['inputNumber'];
            $inputPassword = $_POST['inputPassword'];
            $filename = $_FILES['file']['name'];
            $file_extension = pathinfo($filename, PATHINFO_EXTENSION);
            $f_extension = strtolower($file_extension);
            $image_ext = array("jpg", "png", "jpeg", "gif");
            $response = 0;
            if (in_array($f_extension, $image_ext)) {
                $newfilename = $filename . "_" . $inputName . "." . $f_extension;
                $location = 'upload/' . $newfilename;
                move_uploaded_file($_FILES['file']['tmp_name'], $location);
            }
            $obj = new User();
            $status = $obj->Register_User($inputEmail, $inputName, $inputNumber, $inputPassword, $location);
            echo json_encode(array("status" => $status));
            break;

        case ('CheckUser'):
            $inputEmail = $_POST['inputEmail'];
            $inputPassword = $_POST['inputPassword'];
            $obj = new User();
            $status = $obj->CheckUser($inputEmail, $inputPassword);
            echo $status;
            break;

        case ('CheckUserEmail'):
            $inputEmail = $_POST['inputEmail'];
            $obj = new User();
            $status = $obj->CheckUserEmail($inputEmail);
            echo json_encode(array("status" => $status));
            break;

        case ("SendOtp"):
            $email = $_POST['inputEmail'];
            $obj = new User();
            $status = $obj->SendOtp($email);
            echo json_encode(array("status" => $status));
            break;

        case ("CheckOtp"):
            $otp = $_POST['inputotp'];
            $obj = new User();
            $status = $obj->VerifyOtp($otp);
            echo json_encode(array("status" => $status));
            break;

        case ("getData"):
            $obj = new Locations();
            $status = $obj->locationGet();
            echo json_encode($status);
            break;

        case ("CalculateFare"):
            $pickUpPoint = $_POST['pickUpPoint'];
            $dropPoint = $_POST['dropPoint'];
            $carType = $_POST['carType'];
            $luggage = $_POST['luggage'];
            $obj = new Locationss();
            $final = $obj->CalculateFare($pickUpPoint, $dropPoint, $carType, $luggage);
            echo json_encode($final);
            break;

        case ('logouT'):
            $obj = new User();
            $status = $obj->Logout();
            echo $status;
            break;

        case ('RideConfirm'):
            $carType = $_POST['carType'];
            $luggage = $_POST['luggage'];

            $obj = new Locationss();
            $result = $obj->RideConfirm($carType, $luggage);
            echo ($result);
            break;

        case ('PRides'):
            $obj = new Locationss();
            $result = $obj->PRides();
            echo json_encode($result);
            break;
        case ('CRides'):
            $obj = new Locationss();
            $result = $obj->CRides();
            echo json_encode($result);
            break;

        case ('TRides'):
            $obj = new Locationss();
            $result = $obj->TRides();
            echo json_encode($result);
            break;
        case ('TARides'):
            $obj = new Locationss();
            $result = $obj->TARides();
            echo json_encode($result);
            break;

        case ('viewDetails'):
            $ride_id = $_POST['ride_id'];
            $obj = new Locationss();
            $result = $obj->viewDetails($ride_id);
            echo json_encode($result);
            break;

        case ('cancel'):
            $cancel = $_POST['cancel'];
            $obj = new Locationss();
            $result = $obj->cancel($cancel);
            echo ($result);
            break;

        case ('info'):
            $obj = new Locationss();
            $result = $obj->info();
            echo json_encode($result);
            break;
        case ('CPassword'):
            $CPassword = $_POST['CPassword'];
            $obj = new User();
            $result = $obj->CPassword($CPassword);
            echo $result;
            break;
        case ('update'):
            $password = $_POST['password'];
            $name = $_POST['name'];
            $number = $_POST['number'];
            $obj = new User();
            $result = $obj->update($password, $name, $number);
            echo $result;
            break;

        case ('ARides'):
            $obj = new Locationss();
            $result = $obj->ARides();
            echo json_encode($result);
            break;

        case ('AUsers'):
            $obj = new Locationss();
            $result = $obj->AUsers();
            echo json_encode($result);
            break;

        case ('TEarnings'):
            $obj = new Locationss();
            $result = $obj->TEarnings();
            echo json_encode($result);
            break;
        case ('ACaRides'):
            $obj = new Locationss();
            $result = $obj->ACaRides();
            echo json_encode($result);
            break;

        case ('APRides'):
            $obj = new Locationss();
            $result = $obj->APRides();
            echo json_encode($result);
            break;

        case ('approve'):
            $e = $_POST['e'];
            $obj = new Locationss();
            $result = $obj->approve($e);
            echo json_encode($result);
            break;

        case ('cancell'):
            $e = $_POST['e'];
            $obj = new Locationss();
            $result = $obj->cancell($e);
            echo json_encode($result);
            break;

        case ('block'):
            $e = $_POST['ew'];
            $obj = new user();
            $result = $obj->block($e);
            echo json_encode($result);
            break;

        case ('unblock'):
            $e = $_POST['e'];
            $obj = new user();
            $result = $obj->unblock($e);
            echo json_encode($result);
            break;
    }
} else {
    echo "Oops !! can't access !!";
}
