<?php 
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Employee extends Connection
{
    public  string $table_name = 'employees';
    private string $employee_branch;
    private string $employee_id;
    private string $employee_unique;
    private string $employee_name;
    private string $employee_gender;
    private string $employee_contact;
    private string $employee_address;
    private string $employee_department;
    private string $employee_authority;
    private string $employee_password ;
    private string $employee_reg_date;
    public array $field;
    
    private $database;

    public function __construct(
        string $branch='1',
        string  $id='', string $unique='',
        string  $name='', string $gender = '', string $contact = '',
        string $address = '', string $department = '', string $authority = '',
        string $password = '',  string $date='',
        ) {

        $this->employee_branch      = $branch;
        $this->employee_id          = $id;
        $this->employee_unique      = $unique;
        $this->employee_name        = $name;
        $this->employee_gender      = $gender;
        $this->employee_contact     = $contact;
        $this->employee_address     = $address;
        $this->employee_department  = $department;
        $this->employee_authority   = $authority;
        $this->employee_password    = $password;
        $this->employee_reg_date    = $date;
        
        $this->database = parent::connect();

        $this->field = [
            'employee_branch','employee_id', 'employee_unique', 'employee_name', 'employee_gender',
            'employee_contact', 'employee_address', 'employee_department', 'employee_authority',
            ' employee_password ', 'employee_reg_date'
        ];
    }

    // Base functions
    public function insert(){
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, 
            [
                'employee_branch'       => $this->employee_branch,
                'employee_unique'       => uniqid(),
                'employee_name'         => $this->employee_name,
                'employee_gender'       => $this->employee_gender,
                'employee_contact'      => $this->employee_contact,
                'employee_address'      => $this->employee_address,
                'employee_department'   => $this->employee_department,
                'employee_authority'    => $this->employee_authority,
                'employee_password'     => $this->employee_password,
                'employee_reg_date'     => $now->format('Y-m-d')
            ]
        );
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }
    
    public function update(){
        $this->database->update($this->table_name, 
            [
                'employee_branch'       => $this->employee_branch,
                'employee_name'         => $this->employee_name,
                'employee_gender'       => $this->employee_gender,
                'employee_contact'      => $this->employee_contact,
                'employee_address'      => $this->employee_address,
                'employee_department'   => $this->employee_department,
                'employee_authority'    => $this->employee_authority,
                'employee_password'     => $this->employee_password,
            ], 
            ['employee_id' => $this->employee_id ]
        );
        
        if ($this->database->error) return $this->database->errorInfo;
        return  true;
    }

    public function delete(){
        $this->database->delete($this->table_name, ['employee_id' => $this->employee_id ]);
    
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