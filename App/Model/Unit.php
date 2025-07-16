<?php 
// Unit Model
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Unit extends Connection
{
    public string $table_name = 'unit';
    private int $unit_id;
    private string $unit_unique;
    private int $unit_branch;
    private string $unit_price;
    private string $unit_reg_date;
    public array $field;

    private $database;

    public function __construct(
        int $id = 0, string $unique = '', int $branch = 0,
        string $price = '', string $reg_date = ''
    ) {
        $this->unit_id = $id;
        $this->unit_unique = $unique;
        $this->unit_branch = $branch;
        $this->unit_price = $price;
        $this->unit_reg_date = $reg_date;

        $this->database = parent::connect();

        $this->field = [
            'unit_id', 'unit_unique', 'unit_branch', 
            'unit_price', 'unit_reg_date'
        ];
    }

    // Base functions
    public function insert()
    {
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, [
            'unit_unique' => uniqid(),
            'unit_branch' => $this->unit_branch,
            'unit_price' => $this->unit_price,
            'unit_reg_date' => $now->format('Y-m-d')
        ]);

        if ($this->database->error) return $this->database->errorInfo;
        return true;
    }

    public function update()
    {
        $this->database->update($this->table_name, [
            'unit_branch' => $this->unit_branch,
            'unit_price' => $this->unit_price
        ], [
            'unit_id' => $this->unit_id
        ]);

        if ($this->database->error) return $this->database->errorInfo;
        return true;
    }

    public function delete()
    {
        $this->database->delete($this->table_name, [
            'unit_id' => $this->unit_id
        ]);

        if ($this->database->error) return $this->database->errorInfo;
        return true;
    }

    // Extra functions
    public function selectAll()
    {
        $data = $this->database->select($this->table_name, $this->field);
        if ($this->database->error) return [];
        return $data;
    }

    public function selectWhere($column, $value)
    {
        $data = $this->database->select($this->table_name, $this->field, [$column => $value]);
        if ($this->database->error) return false;
        return $data;
    }

    public function getDatabase()
    {
        return $this->database;
    }
}
