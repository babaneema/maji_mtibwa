<?php
require_once '../../../vendor/autoload.php';
if (session_status() === PHP_SESSION_NONE) session_start();

if ($_POST['token'] == $_SESSION['_addPurchase_token']) {
    // Getform form data
    $equipment = htmlentities($_POST['equipment']);
    $category = htmlentities($_POST['category']);
    $measurement = htmlentities($_POST['measurement']);
    $price = htmlentities($_POST['price']);
    $quantity = htmlentities($_POST['quantity']);


    // Save data
    $purchasement = new \App\Model\Purchasement(
        equipment: $equipment, category: $category, 
        measurement: $measurement, price: $price, quantity: $quantity
    );

    $database = $purchasement->getDatabase();

    $save = $purchasement->insert();
  
    if($save){
        $data = $database->sum("stock", "stock_amount", ["stock_equipment" => $equipment ]);
       if(!empty($data)){
            $current_stock = (float) $data + (float)$quantity;
            $stock = new \App\Model\Stock(equipment: $equipment, amount: $current_stock);
            $stock->update();
       }
       else{
        $stock = new \App\Model\Stock(equipment: $equipment, amount: $quantity);
        $sv = $stock->insert();
       }

        // Return to branch 
        $_SESSION['success'] = 'Purchasement saved successfuly';
        header('Location: ../../view/admin/purchasement.php');
        unset($_SESSION['_addPurchase_token']);
        exit;
       
    }else{
        // Handle Errors
        $_SESSION['error'] = 'Could not add Purchasement.';
        header('Location: ../../view/admin/addPurchasement.php');
        exit;
    }
}

// form does not have token
session_destroy();
header('Location: ../../view/auth/login.php');
