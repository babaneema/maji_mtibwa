<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Checkin extends Connection
{
    public string $table_name = 'checkin';
    private string $checkin_id;
    private string $checkin_unique;
    private string $checkin_employee;
    private string $checkin_in;
    private string $checkin_out;
    private string $checkin_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $employee='', string $in = '', string $out = '',
        string $date='',
        ) {
        $this->checkin_id = $id;
        $this->checkin_unique = $unique;
        $this->checkin_employee = $employee;
        $this->checkin_in = $in;
        $this->checkin_out = $out;
        $this->checkin_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'checkin_id', 'checkin_unique', 'checkin_employee',
            'checkin_in', 'checkin_out', 'checkin_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'checkin_unique' => uniqid(),
                'checkin_employee' => $this->checkin_employee,
                'checkin_in' => $this->checkin_in,
                'checkin_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function checkout(){
        $this->database->update($this->table_name, 
            ['checkin_out' => $this->checkin_out], 
            ['checkin_unique' => $this->checkin_unique ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['checkin_id' => $this->checkin_id ]);
    
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