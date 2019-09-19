<?php

class collectioncostpayment_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    //CREATE
    public function createPayment($data) {
        try {
            if ($this->db->insert("collectioncostpayment", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function getPaymentsByidAgreement($idAgreement) {
        try {
            return $this->db->get_where('collectioncostpayment', array('idAgreement' => $idAgreement))->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }



    //UPDATE
    public function updatePayment($idAgreement, $params) {
        try {
            $this->db->where('idAgreement', $idAgreement);
            return $this->db->update('collectioncostpayment', $params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 