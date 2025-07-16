<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Equipment extends Connection
{
    public string $table_name = 'equipment';
    private string $equipment_id;
    private string $equipment_unique;
    private string $equipment_name;
    private string $equipment_type;
    private string $equipment_company;
    private string $equipment_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $name='', string $type= '',  
        string $company = '',
        string $date='',
        ) {
        $this->equipment_id = $id;
        $this->equipment_unique = $unique;
        $this->equipment_name = $name;
        $this->equipment_type = $type;
        $this->equipment_company = $company;
        $this->equipment_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'equipment_id', 'equipment_unique', 'equipment_name',
            'equipment_type', 'equipment_company',
            'equipment_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'equipment_unique' => uniqid(),
                'equipment_name' => $this->equipment_name,
                'equipment_type' => $this->equipment_type,
                'equipment_company' => $this->equipment_company,
                'equipment_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'equipment_name' => $this->equipment_name,
                'equipment_type' => $this->equipment_type,
                'equipment_company' => $this->equipment_company,
            ], 
            ['equipment_id' => $this->equipment_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['equipment_id' => $this->equipment_id ]);
    
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