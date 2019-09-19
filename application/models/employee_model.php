<?php

class employee_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //CREATE
    public function createEmployee($data) {
        try {
            if ($this->db->insert("employee", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ
    function getEmployees() {
        try {
              $this->db->order_by('idEmployee', 'asc');
              return $this->db->get('employee')->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ BY ID
    function getEmployeeByID($idEmployee) {
        try {
             return $this->db->get_where('employee',array('idEmployee'=>$idEmployee))->row_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
   
    
    //Read by id, name, last name, second last name or email
    function SearchEmployee($idEmployee, $name, $fLastName, $sLastName, $email) {
        try {          
            $this->db->order_by('idEmployee', 'asc');
            $this->db->where("idEmployee", $idEmployee)->or_where("name",$name)
                    ->or_where("fLastName",$fLastName)
                    ->or_where("sLastName",$sLastName)
                    ->or_where("email",$email);
              return $this->db->get('employee')->result_array();
            
            
            return $query;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    
    

    function checkIfExists($email) {
        try {
            $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('email', $email);
            $query = $this->db->get();
            if ($query->num_rows() > 0) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //UPDATE
    public function updateEmployee($idEmployee,$params) {
        try {
            $this->db->where('idEmployee',$idEmployee);
            return $this->db->update('employee',$params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //DELETE
    public function deleteEmployee($idEmployee) {
        try {
            if ($this->db->delete("employee", "idEmployee = " . $idEmployee)) {
                return true;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //LOGIN
    public function login($email, $password) {
        try {
            $this->db->select('*');
            $this->db->from('employee');
            $this->db->where('email', $email);
            $this->db->where('password', $password);
            $query = $this->db->get();
            $result = $query->row();
            return $result;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 