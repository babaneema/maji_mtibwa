<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Payment extends Connection
{
    public string $table_name = 'payments';
    private string $pay_id;
    private string $pay_unique;
    private string $pay_bill;
    private string $pay_customer;
    private string $pay_method;
    private string $pay_type;
    private string $pay_amount;
    private string $pay_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='', string $pay_bill = '',
        string  $pay_customer='', string $pay_method='' , string $pay_type='' ,
        string $pay_amount='', string $date='',
        ) {
        $this->pay_id = $id;
        $this->pay_unique = $unique;
        $this->pay_bill = $pay_bill;
        $this->pay_customer = $pay_customer;
        $this->pay_method = $pay_method;
        $this->pay_type = $pay_type;
        $this->pay_amount = $pay_amount;
        $this->pay_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'pay_id', 'pay_unique', 'pay_bill', 
            'pay_customer', 'pay_method', 'pay_type',
            'pay_amount', 'pay_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'pay_unique' => uniqid(),
                'pay_bill' => $this->pay_bill,
                'pay_customer' => $this->pay_customer,
                'pay_method' => $this->pay_method,
                'pay_type' => $this->pay_type,
                'pay_amount' => $this->pay_amount,
                'pay_reg_date' => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){}

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