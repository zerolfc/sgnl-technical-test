<?php

namespace Inc;

use function _\map;


class Api {

    protected $db;

    protected $cardId;

    public function __construct(string $cardId = null)
    {

         $this->db = new \Nette\Database\Connection(
            'mysql:host=mysql;dbname=sgnl', 
            'root', 
            'root'
        );

        $this->cardId = $cardId;
        
    }

    public function setCardId(string $cardId)
    {

        $this->cardId = $cardId;

    }


    public function result()
    {

        try {

            $card = $this->_getEmployeeByCard($this->cardId);

            if (!$card) {

                return [
                    'code' => 404,
                    'full_name' => '',
                    'department' => []
                ];
            }

            $deps = $this->_getDepartmentByEmployee($card->employee_id);

            return [
                'code' => 200,
                'full_name' => $card->full_name,
                'department' => map($deps, 'name')
            ];

        } catch ( \Exception $e ) {

            return [
                'code' => 400
            ];

        }

        

    }

    private function _getEmployeeByCard(string $cardId) : ?object
    {

        return $this->db->fetch(
            'select c.*, e.full_name from cards c 
            left join employees e on e.id = c.employee_id where c.id = ?',
            $cardId
        );


    }

    private function _getDepartmentByEmployee(int $employeeId)
    {

        return $this->db->fetchAll(
            'select d.name from employee_departments ed 
            left join departments d on d.id = ed.department_id
            where ed.employee_id = ?',
            $employeeId
        );

    }


}
