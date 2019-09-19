<?php

class portfolio_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

//CREATE
    public function createPortfolio($data) {
        try {
            if ($this->db->insert("portfolio", $data)) {
                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//READ
    function getPortfolios() {
        try {
            $select = array(
                'portfolio.idPortfolio',
                'portfolio.number',
                'portfolio.source',
                'portfolio.dateOfPurchase',
                'portfolio.amountOfAccounts',
                'count(client.idPortfolio) as clientCount'
            );
            return $query = $this->db
                    ->select($select)
                    ->from('portfolio')
                    ->join('client', 'client.idPortfolio = portfolio.idPortfolio', 'left')
                    ->group_by('portfolio.idPortfolio')
                    ->get()
                    ->result_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//READ BY ID
    function getPortfolioByID($idPortfolio) {
        try {
            return $this->db->get_where('portfolio', array('idPortfolio' => $idPortfolio))->row_array();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//Read by id
    function SearchPortfolio($idPortfolio, $source, $dateOfPurchase) {
        try {            
            $select = array(
                'portfolio.idPortfolio',
                'portfolio.number',
                'portfolio.source',
                'portfolio.dateOfPurchase',
                'portfolio.amountOfAccounts',
                'count(client.idPortfolio) as clientCount'
            );
            return $query = $this->db
                    ->select($select)
                    ->from('portfolio')
                    ->join('client', 'client.idPortfolio = portfolio.idPortfolio', 'left')
                    ->group_by('portfolio.idPortfolio')
                    ->order_by('idPortfolio', 'asc')
                    ->where("portfolio.idPortfolio", $idPortfolio)
                    ->or_where("portfolio.source", $source)
                    ->or_where("portfolio.dateOfPurchase", $dateOfPurchase)
                    ->get()
                    ->result_array();
            
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function checkIfExists($number) {
        try {
            $this->db->select('*');
            $this->db->from('portfolio');
            $this->db->where('number', $number);
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

    function getHighestIdPortfolio() {
        try {
            $this->db->select_max('idPortfolio');
            $result = $this->db->get('portfolio')->row();
            return $result->idPortfolio;
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//UPDATE
    public function updatePortfolio($idPortfolio, $params) {
        try {
            $this->db->where('idPortfolio', $idPortfolio);
            return $this->db->update('portfolio', $params);
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//DELETE
    public function deletePortfolio($idPortfolio) {
        try {
            if ($this->db->delete("portfolio", "idPortfolio = " . $idPortfolio)) {
                return true;
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}

?> 