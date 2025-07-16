<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Branch extends Connection
{
    public string $table_name = 'branch';
    private string $branch_id;
    private string $branch_unique;
    private string $branch_name;
    private string $branch_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $name='', string $date='',
        ) {
        $this->branch_id = $id;
        $this->branch_unique = $unique;
        $this->branch_name = $name;
        $this->branch_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'branch_id', 'branch_unique', 'branch_name',
            'branch_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'branch_unique' => uniqid(),
                'branch_name' => $this->branch_name,
                'branch_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            ['branch_name' => $this->branch_name], 
            ['branch_id' => $this->branch_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['branch_id' => $this->branch_id ]);
    
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