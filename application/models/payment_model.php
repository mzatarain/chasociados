<?php

class payment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //CREATE
    public function createPayment($data) {
        try {
            if ($this->db->insert("payment", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ
    function getPayments() {
        try {
            $this->db->order_by('idPayment', 'asc');
            return $this->db->get('payment')->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    
    

    function getNextDuePayments() {
        try {
            $today=date("Y/m/d");
            
            //$dayAfter=date("d-m-Y",strtotime($today."+1 days"));
            
            $day1 = strtotime('+1 days', strtotime($today));
            $dayAfter = date('Y-m-d', $day1);
            
            //$where= "paymentDueDate='".$today."'or paymentDueDate='".$dayAfter."'and alreadyPaid='0'";
            $where= "paymentDueDate='".$today."'or paymentDueDate='".$dayAfter."'and alreadyPaid='0'";
            $this->db->select('payment.idPayment,payment.paymentName,'
                    . 'payment.amountToPay,payment.paymentDueDate,payment.alreadyPaid,payment.collectionCost,payment.idAgreement,'
                    . 'agreement.idAgreement as agreement,'
                    . 'agreement.idClient,'
                    . 'client.idClient as client, client.name as clientName');
            $this->db->from('payment');
            $this->db->join('agreement', 'agreement.idAgreement=payment.idAgreement');
            $this->db->join('client', 'agreement.idClient=client.idClient');
            //$this->db->where('paymentDueDate=',$today.'or paymentDueDate=',$dayBefore.'and alreadyPaid=',0);
            $this->db->where($where);
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;           
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function pastDuePayments() {
        try {
            $today=date("Y/m/d");
            
            //$where = "name='Joe' AND status='boss' OR status='active'";
            $where = "paymentDueDate<'".$today."' and alreadyPaid='0'";
            
            $this->db->select('payment.idPayment,payment.paymentName,'
                    . 'payment.amountToPay,payment.paymentDueDate,payment.alreadyPaid,payment.collectionCost,payment.idAgreement,'
                    . 'agreement.idAgreement as agreement,'
                    . 'agreement.idClient,'
                    . 'client.idClient as client, client.name as clientName');
            $this->db->from('payment');
            $this->db->join('agreement', 'agreement.idAgreement=payment.idAgreement');
            $this->db->join('client', 'agreement.idClient=client.idClient');
            //$this->db->where('paymentDueDate<',$today.' and alreadyPaid==',0);
            $this->db->where($where);
            //$this->db->where('alreadyPaid',0);
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;            
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    
    function getPastDue28DaysPayments() {
        try {            
            $today=date("Y/m/d");
            $day1 = strtotime('-28 days', strtotime($today));
            $DaysBefore = date('Y-m-d', $day1);
            $where= "paymentDueDate<'".$DaysBefore."'and alreadyPaid='0'";
            $this->db->select('payment.idPayment,payment.paymentName,'
                    . 'payment.amountToPay,payment.paymentDueDate,payment.alreadyPaid,payment.collectionCost,payment.idAgreement,'
                    . 'agreement.idAgreement as agreement,'
                    . 'agreement.idClient,'
                    . 'client.idClient as client, client.name as clientName');
            $this->db->from('payment');
            $this->db->join('agreement', 'agreement.idAgreement=payment.idAgreement');
            $this->db->join('client', 'agreement.idClient=client.idClient');
            //$this->db->where('paymentDueDate=',$today.'or paymentDueDate=',$dayBefore.'and alreadyPaid=',0);
            $this->db->where($where);
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;           
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ BY ID
    function getPaymentByID($idPayment) {
        try {
            return $this->db->get_where('payment', array('idPayment' => $idPayment))->row_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function getPaymentsByidAgreement($idAgreement) {
        try {
            return $this->db->order_by('idPayment', 'ASC')->get_where('payment', array('idAgreement' => $idAgreement))->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //Read by id, name, last name, second last name or email
    function SearchPayment($idPayment, $name, $fLastName, $sLastName, $email) {
        try {
            $this->db->order_by('idPayment', 'asc');
            $this->db->where("idPayment", $idPayment)->or_where("name", $name)
                    ->or_where("fLastName", $fLastName)
                    ->or_where("sLastName", $sLastName)
                    ->or_where("email", $email);
            return $this->db->get('payment')->result_array();


            return $query;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //UPDATE
    public function updatePayment($idPayment, $params) {
        try {
            $this->db->where('idPayment', $idPayment);
            return $this->db->update('payment', $params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //DELETE
    public function deletePayment($idPayment) {
        try {
            if ($this->db->delete("payment", "idPayment = " . $idPayment)) {
                return true;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 