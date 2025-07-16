<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Address extends Connection
{
    public string $table_name = 'address';
    private string $address_id;
    private string $address_unique;
    private string $address_branch;
    private string $address_name;
    private string $address_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string $branch = '', string  $name='', string $date='',
        ) {
        $this->address_id = $id;
        $this->address_unique = $unique;
        $this->address_branch = $branch;
        $this->address_name = $name;
        $this->address_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'address_id', 'address_unique', 'address_branch', 
            'address_name', 'address_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'address_unique' => uniqid(),
                'address_branch' => $this->address_branch,
                'address_name' => $this->address_name,
                'address_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'address_name' => $this->address_name,
                'address_branch' => $this->address_branch
            ], 
            ['address_id' => $this->address_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['address_id' => $this->address_id ]);
    
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