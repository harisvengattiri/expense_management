<?php
require_once ('config.php');

spl_autoload_register(function ($class) {
    require_once "classes/$class.php";
});

// VEHICLE SECTION STARTS
function getVehicles() {
    global $conn;

    $sql = "SELECT * FROM `vehicles` ORDER BY id DESC LIMIT 0,100";
    $result = $conn->query($sql);
    $vehicles = [];
    while ($row = mysqli_fetch_array($result)) {
        $vehicles[] = $row;
    }
    return $vehicles;
}

function getVehicleDetails($id) {
    global $conn;

    $sql = "SELECT * FROM `vehicles` WHERE `id` = $id";
    checkAccountExist('vehicles','id',$id);
    $result = $conn->query($sql);
    $row = mysqli_fetch_assoc($result);
    if(!$row) {
        throw new Exception();
    }
    return $row;
}

function addVehicle($data) {
    global $conn;

    $sql = "INSERT INTO `vehicles` (`name`,`registration`) VALUES ('{$data["name"]}','{$data["registration"]}')";
    $conn->query($sql);
    $logQuery = mysqli_real_escape_string($conn,$sql);
    logActivity('add','VEH',$conn->insert_id,$logQuery);
}

function editVehicle($data) {
    global $conn;
    $vehicle = $data['id'];

    $sql = "UPDATE `vehicles` SET `name`='{$data["name"]}',`registration`='{$data["registration"]}' WHERE `id` = $vehicle";
    checkAccountExist('vehicles','id',$vehicle);
    $conn->query($sql);
    $logQuery = mysqli_real_escape_string($conn,$sql);
    logActivity('edit','ITM',$vehicle,$logQuery);
}

function deleteVehicle($data) {
    global $conn;
    $vehicle = $data["id"];

    $sql = "DELETE FROM `vehicles` WHERE `id` = $vehicle";
    checkAccountExist('vehicles','id',$vehicle);
    $conn->query($sql);
    $logQuery = mysqli_real_escape_string($conn,$sql);
    logActivity('delete','VEH',$vehicle,$logQuery);
}
// VEHICLE SECTION ENDS

// ACTIVITY LOG SECTION STARTS
function logActivity($process,$code,$id,$logQuery) {
    global $conn;
    
    $date1 = date("d/m/Y h:i:s a");
    $username = $_SESSION['username'];
    $code = $code.$id;
    $logSql = "INSERT INTO activity_log (time, process, code, user, query) 
               VALUES ('$date1', '$process', '$code', '$username', '$logQuery')";
    $conn->query($logSql);
}
// ACTIVITY LOG SECTION ENDS

// CHECK EXISTANCE FOR EDIT AND DELETE
function checkAccountExist($table,$column,$id) {
    global $conn;

    $sqlIdCheck = "SELECT * FROM `$table` WHERE `$column` = '$id'";
    $query = $conn->query($sqlIdCheck);
    $num_rows = mysqli_num_rows($query);

    if(!$num_rows) {
        throw new Exception();
    }
}

// SEARCH FILTER SECTION
function getSearchFilters() {
    $period_sql = "";
    $cust_sql = "";
    $mode = 'Recent View';
    $show_date = "";

    if ($_POST) {
        $fdate = $_POST['fdate'];
        $tdate = $_POST['tdate'];
        $customer = $_POST['customer'] ?? '';

        $period_sql = "WHERE STR_TO_DATE(`date`, '%d/%m/%Y') BETWEEN STR_TO_DATE('$fdate', '%d/%m/%Y') AND STR_TO_DATE('$tdate', '%d/%m/%Y')";
        if (!empty($customer)) {
            $cust_sql = "AND `customer` = '$customer'";
        }
        $mode = 'Search Mode';
        $show_date = "[$fdate - $tdate]";
    }
    return [
        'period_sql' => $period_sql,
        'cust_sql' => $cust_sql,
        'mode' => $mode,
        'show_date' => $show_date
    ];
}
