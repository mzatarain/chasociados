<?php

class agreement_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//CREATE
    public function createAgreement($data) {
        try {
            if ($this->db->insert("agreement", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ
    function getAgreements() {
        try {
            $this->db->order_by('idAgreement', 'asc');
            return $this->db->get('agreement')->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ BY ID
    function getAgreementByID($idAgreement) {
        try {
            return $this->db->get_where('agreement', array('idAgreement' => $idAgreement))->row_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //READ BY ID client
    function getAgreementByClient($idClient) {
        try {
            return $this->db->get_where('agreement', array('idClient' => $idClient))->row_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function getDelinquentAgreements() {
        try {
            $today = date("Y/m/d");

            $day1 = strtotime('-28 days', strtotime($today));
            $before28Days = date('Y-m-d', $day1);

            $where = "lastPaymentDate<'" . $before28Days;
            $this->db->select('agreement.idAgreement as agreement,'
                    . 'agreement.idClient,'
                    . 'client.idClient as client, client.name as clientName');
            $this->db->from('agreement', 'agreement.idAgreement=payment.idAgreement');
            $this->db->join('client', 'agreement.idClient=client.idClient');
            $this->db->where($where);
            $query = $this->db->get();
            $data = $query->result_array();
            return $data;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function countSundays($startDate,$endDate){
            //$startDate = new DateTime('2019-07-15');
            //$endDate = new DateTime('2019-08-17');
            $noSundays = array();

            while ($startDate <= $endDate) {
                if ($startDate->format('w') == 0) {
                    $noSundays[] = $startDate->format('Y-m-d');
                }

                $startDate->modify('+1 day');
            }
            return count($noSundays);
//            //print_r($sundays);
//            $x=0;
//            $length = count($sundays);
//            for($x=0;$x<$length;$x++){
//                echo $sundays[$x];
//                echo '<br>';
//            }
    }
    
    function getLastAgreement() {
        try {
            $row = $this->db->select("idAgreement")->limit(1)->order_by('idAgreement', "DESC")->get("agreement")->row();
            $lastRow = $row->idAgreement;
            return $lastRow;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //UPDATE
    public function updateAgreement($idAgreement, $params) {
        try {
            $this->db->where('idAgreement', $idAgreement);
            return $this->db->update('agreement', $params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 