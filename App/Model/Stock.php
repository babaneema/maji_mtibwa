<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Stock extends Connection
{
    public string $table_name = 'stock';
    private string $stock_id;
    private string $stock_unique;
    private string $stock_equipment;
    private string $stock_amount;
    private string $stock_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $equipment='', string $amount='',
        string $date='',
        ) {
        $this->stock_id = $id;
        $this->stock_unique = $unique;
        $this->stock_equipment = $equipment;
        $this->stock_amount = $amount;
        $this->stock_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'stock_id', 'stock_unique', 'stock_equipment', 'stock_amount',
            'stock_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'stock_unique' => uniqid(),
                'stock_equipment' => $this->stock_equipment,
                'stock_amount' => $this->stock_amount,
                'stock_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'stock_amount' => $this->stock_amount
            ], 
            ['stock_equipment' => $this->stock_equipment ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['stock_id' => $this->stock_id ]);
    
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

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