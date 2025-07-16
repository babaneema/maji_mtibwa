<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Category extends Connection
{
    public string $table_name = 'category';
    private string $catgory_id;
    private string $category_unique;
    private string $category_name;
    private string $category_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $name='', string $date='',
        ) {
        $this->catgory_id = $id;
        $this->category_unique = $unique;
        $this->category_name = $name;
        $this->category_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'catgory_id', 'category_unique', 'category_name',
            'category_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'category_unique' => uniqid(),
                'category_name' => $this->category_name,
                'category_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            ['category_name' => $this->category_name], 
            ['catgory_id' => $this->catgory_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['catgory_id' => $this->catgory_id ]);
    
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