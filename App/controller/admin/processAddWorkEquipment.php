<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addWorkEquipment_token']) {
    // Getform form data
    $equipment = htmlentities($_POST['equipment']);
    $quantity = htmlentities($_POST['quantity']);
    $other = htmlentities($_POST['other']);

    $work_id = htmlentities($_POST['work_id']);

    // get the amount of available stocks
    $stock = new \App\Model\Stock();
    $database = $stock->getDatabase();
    $data = $database->select($stock->table_name, "*", ["stock_equipment" => $equipment]);
    
    $available_stock = $data[0]["stock_amount"];
    if((float) $available_stock - (float) $quantity  <= 0){
        $_SESSION['error'] = 'You are spending more than available stock!';
        header('Location: ../../view/admin/addworkEquipment.php?id='.$work_id);
        exit;
    }

    // Check if work data is real 
    $workData = $database->select('work', ["work_id"], ["work_unique" => $work_id]);

    // Get Equipment data
    $equpData = $database->select("equipment", "*", ["equipment_id" => $equipment]);

    if(empty($workData) || empty($equpData)) {
        session_destroy();
        header('Location: ../../view/auth/login.php');
    }
   

    // save work equipment data && update stocks
    $equipment_name =  $equpData[0]['equipment_name'].' | '.$equpData[0]['equipment_type'].' | '.$equpData[0]['equipment_company'];
    $workEpuipment  = new \App\Model\WorkEquipment(
        name: $equipment_name, 
        quantity: $quantity, work: $workData[0]['work_id'], other: $other
    );

    $save = $workEpuipment->insert();
    if(!$save){
        $_SESSION['error'] = 'Could not add new stock. Please try again laber!';
        header('Location: ../../view/admin/addworkEquipment.php?id='.$work_id);
        exit;
    }

    // update stock 
    $new_stock = (float) $available_stock - (float) $quantity;
    $stock = new \App\Model\Stock(equipment: $equipment, amount: $new_stock);
    $stock->update();

    
    // Return to branch 
    $_SESSION['success'] = 'Work Equipment saved successfuly';
    header('Location: ../../view/admin/workView.php?id='.$work_id);
    unset($_SESSION['_addWorkEquipment_token']);
    exit;
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
