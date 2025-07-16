<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Customer extends Connection
{
    public string $table_name = 'customer';
    private string $customer_id;
    private string $customer_unique;
    private string $customer_name;
    private string $customer_branch;
    private string $customer_gender;
    private string $customer_contact;
    private string $customer_address;
    private string $customer_house_number;
    private string $customer_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='', string $branch = '',
        string  $name='', string $gender='' , string $contact='' , string $house= '',
        string $address='', string $date='',
        ) {
        $this->customer_id = $id;
        $this->customer_unique = $unique;  
        $this->customer_branch = $branch;
        $this->customer_name = $name;
        $this->customer_gender = $gender;
        $this->customer_contact = $contact;
        $this->customer_address = $address;
        $this->customer_house_number = $house;
        $this->customer_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'customer_id', 'customer_unique', 'customer_branch', 
            'customer_name', 'customer_gender', 'customer_contact',
            'customer_address', 'customer_house_number', 'customer_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'customer_unique' => uniqid(),
                'customer_branch' => $this->customer_branch,
                'customer_name' => $this->customer_name,
                'customer_gender' => $this->customer_gender,
                'customer_contact' => $this->customer_contact,
                'customer_address' => $this->customer_address,
                'customer_address' => $this->customer_address,
                'customer_house_number' => $this->customer_house_number,
                'customer_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'customer_branch' => $this->customer_branch,
                'customer_name' => $this->customer_name,
                'customer_gender' => $this->customer_gender,
                'customer_contact' => $this->customer_contact,
                'customer_address' => $this->customer_address,
                'customer_address' => $this->customer_address,
                'customer_house_number' => $this->customer_house_number,
            ], 
            ['customer_id' => $this->customer_id ]
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

    // Other fuction
    public function getDatabase(){
        return $this->database;
    }
}