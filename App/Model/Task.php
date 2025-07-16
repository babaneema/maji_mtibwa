<?php
// Initial
namespace App\Model;

use App\Model\Connection;
use DateTime;
use DateTimeZone;

class Task extends Connection
{
    public string $table_name = 'Task';
    private string $task_id;
    private string $task_unique;
    private string $task_employee;
    private string $task_item;
    private float  $task_amount;
    private string $task_start;
    private string $task_end;
    private string $task_reg_date;
    public array $field;

    private $database;

    public function __construct(
        string $id = '', string $unique = '', string $employee = '',
        string $item = '', float $amount = 0.0,
        string $start = '', string $end = '', string $reg_date = ''
    ) {
        $this->task_id = $id;
        $this->task_unique = $unique;
        $this->task_employee = $employee;
        $this->task_item = $item;
        $this->task_amount = $amount;
        $this->task_start = $start;
        $this->task_end = $end;
        $this->task_reg_date = $reg_date;

        $this->database = parent::connect();

        $this->field = [
            'task_id', 'task_unique', 'task_employee', 'task_item', 
            'task_amount', 'task_start', 'task_end', 'task_reg_date'
        ];
    }

    // Base functions
    public function insert()
    {
        $now = new DateTime('now', new DateTimeZone('Africa/Dar_es_Salaam'));
        $this->database->insert($this->table_name, [
            'task_unique' => uniqid(),
            'task_employee' => $this->task_employee,
            'task_item' => $this->task_item,
            'task_amount' => empty($this->task_amount) ? $now->format('Y-m-d') : $this->task_amount,
            'task_start' => empty($this->task_start) ? $now->format('Y-m-d') : $this->task_start,
            'task_end' => $this->task_end,
            'task_reg_date' => $now->format('Y-m-d')
        ]);
        if ($this->database->error) return $this->database->errorInfo();
        return true;
    }

    public function update()
    {
        $this->database->update($this->table_name, [
            'task_employee' => $this->task_employee,
            'task_item' => $this->task_item,
            'task_amount' => $this->task_amount,
            'task_start' => $this->task_start,
            'task_end' => $this->task_end,
        ], [
            'task_id' => $this->task_id
        ]);

        if ($this->database->error) return $this->database->errorInfo();
        return true;
    }

    public function delete()
    {
        $this->database->delete($this->table_name, ['task_id' => $this->task_id]);

        if ($this->database->error) return $this->database->errorInfo();
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

    // Other functions
    public function getDatabase()
    {
        return $this->database;
    }
}
