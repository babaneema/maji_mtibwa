<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Meter extends Connection
{
    public string $table_name = 'meter';
    private string $meter_id;
    private string $meter_unique;
    private string $meter_customer;
    private string $meter_owner;
    private string $meter_number;
    private string $meter_intital_unit;
    private string $meter_joinging_price;
    private string $meter_lock;
    private string $meter_in_service;
    private string $meter_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='', string $customer = '',
        string  $owner='', string $number='' , string $initial_unit='' ,
        string $joining_price='', string $lock = '', string $service = '', 
        string $date='',
        ) {
        $this->meter_id = $id;
        $this->meter_unique = $unique;
        $this->meter_customer = $customer;
        $this->meter_owner = $owner;
        $this->meter_number = $number;
        $this->meter_intital_unit = $initial_unit;
        $this->meter_joinging_price = $joining_price;
        $this->meter_lock = $lock;
        $this->meter_in_service = $service;
        $this->meter_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'meter_id', 'meter_unique', 'meter_customer', 
            'meter_owner', 'meter_number', 'meter_intital_unit',
            'meter_joinging_price', 'meter_lock', 'meter_in_service',
             'meter_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'meter_unique' => uniqid(),
                'meter_customer' => $this->meter_customer,
                'meter_owner' => $this->meter_owner,
                'meter_number' => $this->meter_number,
                'meter_intital_unit' => $this->meter_intital_unit,
                'meter_joinging_price' => $this->meter_joinging_price,
                'meter_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'meter_owner' => $this->meter_owner,
                'meter_number' => $this->meter_number,
                'meter_intital_unit' => $this->meter_intital_unit,
                'meter_joinging_price' => $this->meter_joinging_price
            ], 
            ['meter_id' => $this->meter_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

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
    public function lockMeter(){
        $this->database->update($this->table_name, 
            ['meter_lock' => $this->meter_lock], 
            ['meter_unique' => $this->meter_unique ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    // Other fuction
    public function getDatabase(){
        return $this->database;
    }
}