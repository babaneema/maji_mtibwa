<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Work extends Connection
{
    public string $table_name = 'work';
    private string $work_id;
    private string $work_unique;
    private string $work_title;
    private string $work_description;
    private string $work_location;
    private string $work_technicians;
    private string $work_start_time;
    private string $work_finish_time;
    private string $work_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $title='', string $description='', string $location='',
        string $technicians='', string $start_time = '', string $finish_time = '',
        string $date='',
        ) {
        $this->work_id = $id;
        $this->work_unique = $unique;
        $this->work_title = $title;
        $this->work_description = $description;
        $this->work_location = $location;
        $this->work_technicians = $technicians;
        $this->work_start_time = $start_time;
        $this->work_finish_time = $finish_time;
        $this->work_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'work_id', 'work_unique', 'work_title', 'work_description',
            'work_location', 'work_technicians','work_start_time', 'work_finish_time',
            'work_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'work_unique' => uniqid(),
                'work_title' => $this->work_title,
                'work_description' => $this->work_description,
                'work_location' => $this->work_location,
                'work_technicians' => $this->work_technicians,
                'work_start_time' => $this->work_start_time,
                'work_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'work_title' => $this->work_title
            ], 
            ['work_id' => $this->work_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['work_id' => $this->work_id ]);
    
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    // Extral function
    
    public function finishTime(){
        $this->database->update($this->table_name, 
            [
                'work_finish_time' => $this->work_finish_time
            ], 
            ['work_unique' => $this->work_unique ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

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