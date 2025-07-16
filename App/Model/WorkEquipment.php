<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class WorkEquipment extends Connection
{
    public string $table_name = 'work_equiment';
    private string $work_equiment_id;
    private string $work_equiment_unique;
    private string $work_equiment_equipment;
    private string $work_equiment_work;
    private string $work_equiment_quatinty;
    private string $work_equiment_other;
    private string $work_equiment_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $name='', string $quantity= '',  string $work = '',
        string $other = '',
        string $date='',
        ) {
        $this->work_equiment_id = $id;
        $this->work_equiment_unique = $unique;
        $this->work_equiment_equipment = $name;
        $this->work_equiment_quatinty = $quantity;
        $this->work_equiment_work = $work;
        $this->work_equiment_other = $other;
        $this->work_equiment_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'work_equiment_id', 'work_equiment_unique', 'work_equiment_equipment',
            'work_equiment_quatinty', 'work_equiment_other', 'work_equiment_work',
            'work_equiment_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'work_equiment_unique' => uniqid(),
                'work_equiment_equipment' => $this->work_equiment_equipment,
                'work_equiment_work' => $this->work_equiment_work,
                'work_equiment_quatinty' => $this->work_equiment_quatinty,
                'work_equiment_other' => $this->work_equiment_other,
                'work_equiment_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'work_equiment_equipment' => $this->work_equiment_equipment,
                'work_equiment_quatinty' => $this->work_equiment_quatinty,
                'work_equiment_other' => $this->work_equiment_other,
            ], 
            ['work_equiment_id' => $this->work_equiment_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['work_equiment_id' => $this->work_equiment_id ]);
    
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