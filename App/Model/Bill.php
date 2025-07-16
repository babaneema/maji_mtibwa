<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Bill extends Connection
{
    public string $table_name = 'bill';
    private string $bill_id;
    private string $bill_unique;
    private string $bill_customer;
    private string $bill_meter;
    private string $bill_unit;
    private string $bill_unit_used;
    private string $bill_cost;
    private string $bill_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string  $id='', string $unique='', string $customer = '',
        string  $meter='', string $unit='' , string $used='' ,
        string $cost='', string $date='',
        ) {
        $this->bill_id = $id;
        $this->bill_unique = $unique;
        $this->bill_customer = $customer;
        $this->bill_meter = $meter;
        $this->bill_unit = $unit;
        $this->bill_unit_used = $used;
        $this->bill_cost = $cost;
        $this->bill_reg_date = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'bill_id', 'bill_unique', 'bill_customer', 
            'bill_meter', 'bill_unit', 'bill_unit_used',
            'bill_cost', 'bill_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'bill_unique' => uniqid(),
                'bill_customer' => $this->bill_customer,
                'bill_meter' => $this->bill_meter,
                'bill_unit' => $this->bill_unit,
                'bill_unit_used' => $this->bill_unit_used,
                'bill_cost' => $this->bill_cost,
                'bill_reg_date' => $now->format('Y-m-d')
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

    public function billsReport( $startDate, $finistDate, $street = 'All')
    {
        if(empty($street)){
            $data = $this->database->select(
                $this->table_name,
                [
                    "[><]customer" => ["bill_customer" => "customer_id"],
                    "[><]unit" => ["bill_unit" => "unit_id"],
                ],
                [
                    'bill_id', 'bill_unique', 'bill_customer', 'bill_meter', 'bill_unit',
                    'bill_unit_used', 'bill_cost', 'bill_reg_date', 'customer_name', 'customer_contact',
                    'unit_price',
                ],
                [
                    "bill_reg_date[<>]" => [$startDate, $finistDate]
                ]
            );
        }else{
            $data = $this->database->select(
                $this->table_name,
                [
                    "[><]customer" => ["bill_customer" => "customer_id"],
                    "[><]unit" => ["bill_unit" => "unit_id"],
                ],
                [
                    'bill_id', 'bill_unique', 'bill_customer', 'bill_meter', 'bill_unit',
                    'bill_unit_used', 'bill_cost', 'bill_reg_date', 'customer_name', 'customer_contact',
                    'unit_price',
                ],
                [
                    "customer_address[~]" => $street,
                    "bill_reg_date[<>]" => [$startDate, $finistDate]
                ]
            );
        }
       

        foreach ($data as $key => $dt) {
           $total = $this->database->sum(
               "payments", 
               "pay_amount", 
               ['pay_bill' => $dt['bill_id']]
            );
            if(empty($total)) $total = 0;
            $data[$key]['paid'] = $total;

        }

        // if ($this->database->error) return false;
        if ($this->database->error) return $this->database->errorInfo;
        return  $data;
    }


    public function reportBasedOnDate($startDate, $finishDate)
    {
        $data = $this->database->select(
            'payments', 
            ['pay_amount'],
            [ "pay_reg_date[<>]" => [$startDate, $finishDate] ]
        );

        if ($this->database->error) return $this->database->errorInfo;
        return  $data;
    }

}