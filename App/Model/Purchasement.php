<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Purchasement extends Connection
{
    public string $table_name = 'purchasement';
    private string $purchasement_id;
    private string $purchasement_unique;
    private string $purchasement_equipment;
    private string $purchasement_category;
    private string $purchasement_measurement;
    private string $purchasement_price;
    private string $purchasement_quantity;
    private string $purchasement_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='', string $equipment = '',
        string  $category='', string $measurement= '' , string $price='' , string $quantity='', 
        string $date='',
        ) {
        $this->purchasement_id = $id;
        $this->purchasement_unique = $unique;
        $this->purchasement_equipment = $equipment;
        $this->purchasement_category = $category;
        $this->purchasement_measurement = $measurement;
        $this->purchasement_price = $price;
        $this->purchasement_quantity = $quantity;

        $this->purchasement_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'purchasement_id', 'purchasement_unique', 'purchasement_equipment', 
            'purchasement_category', 'purchasement_measurement', 'purchasement_price', 
            'purchasement_quantity', 'pay_amount', 'purchasement_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'purchasement_unique' => uniqid(),
                'purchasement_equipment' => $this->purchasement_equipment,
                'purchasement_category' => $this->purchasement_category,
                'purchasement_measurement' => $this->purchasement_measurement,
                'purchasement_price' => $this->purchasement_price,
                'purchasement_quantity' => $this->purchasement_quantity,
                'purchasement_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){}

    public function delete(){}

    // Extral function
    public function selectAll(){
        $data = $this->database->select($this->table_name, $this->field);
        if ($this->database->error) return [];
        return  $data;
    }
    
    public function selectWhere($column, $value){
        $data = $this->database->select($this->table_name, $this->field, [$column => $value]);
        if ($this->database->error) return false;
        return  $data;
    }

    // Join With other table

    // Other fuction
    public function getDatabase(){
        return $this->database;
    }
}