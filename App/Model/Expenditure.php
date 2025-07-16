<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Expenditure extends Connection
{
    public string $table_name = 'expenditure';
    private string $expenditure_id;
    private string $expenditure_unique;
    private string $expenditure_title;
    private string $expenditure_description;
    private string $expenditure_item_cost;
    private string $expenditure_items_number;
    private string $expenditure_amount;
    private string $expenditure_authorized;
    private string $expenditure_supplier_name;
    private string $expenditure_supplier_contact;
    private string $expenditure_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='',
        string  $title='', string $description = '' , string $item_cost ='',
        string $item_number = '', string $expend_amount = '', string $authorized = '',
        string $supplier = '', string $contact = '',
        string $date='',
        ) {
        $this->expenditure_id = $id;
        $this->expenditure_unique = $unique;
        $this->expenditure_title = $title;
        $this->expenditure_description = $description;
        $this->expenditure_item_cost = $item_cost;
        $this->expenditure_items_number = $item_number;
        $this->expenditure_amount = $expend_amount;
        $this->expenditure_authorized = $authorized;
        $this->expenditure_supplier_name = $supplier;
        $this->expenditure_supplier_contact = $contact;
        $this->expenditure_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'expenditure_id', 'expenditure_unique', 'expenditure_title',
            'expenditure_description', 'expenditure_item_cost', 'expenditure_items_number',
            'expenditure_amount','expenditure_authorized', 'expenditure_supplier_name',
            'expenditure_supplier_contact', 'expenditure_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $amount = (float) $this->expenditure_item_cost * (float) $this->expenditure_items_number;
        $this->database->insert($this->table_name, 
            [
                'expenditure_unique' => uniqid(),
                'expenditure_title' => $this->expenditure_title,
                'expenditure_description' => $this->expenditure_description,
                'expenditure_item_cost' => $this->expenditure_item_cost,
                'expenditure_items_number' => $this->expenditure_items_number,
                'expenditure_amount' => $amount,
                'expenditure_authorized' => $this->expenditure_authorized,
                'expenditure_supplier_name' => $this->expenditure_supplier_name,
                'expenditure_supplier_contact' => $this->expenditure_supplier_contact,
                'expenditure_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            ['expenditure_title' => $this->expenditure_title], 
            ['expenditure_id' => $this->expenditure_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['expenditure_id' => $this->expenditure_id ]);
    
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