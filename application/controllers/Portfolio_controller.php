<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Portfolio_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('portfolio_model');
        $this->load->model('client_model');
    }
    
    function PortfolioList(){
        $data['portfolio'] = $this->portfolio_model->getPortfolios();
        //$data['accountsInSystem'] = 4;
        $data['_view'] = 'portfolio/list';        
        
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/list',$data);
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function PortfolioSearchForm(){
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/searchForm');
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function PortfolioCreate(){
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/create');
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function PortfolioUpdate($idPortfolio){
        $data['portfolio'] = $this->portfolio_model->getPortfolioByID($idPortfolio);
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/update',$data);
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function PortfolioDetails($idPortfolio){
        $data['portfolio'] = $this->portfolio_model->getPortfolioByID($idPortfolio);
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/details',$data);
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
    function PortfolioSearch(){
         $idPortfolio = $this->input->post('idPortfolio');
         $number = $this->input->post('number');
	 $source = $this->input->post('source');
	 $dateOfPurchase = $this->input->post('dateOfPurchase');
	
        $data['portfolio'] = $this->portfolio_model->SearchPortfolio($idPortfolio, $number, $source, $dateOfPurchase);
        
        if ($this->session->userdata('logged')) {
        $this->load->view('home/header');
        $this->load->view('home/cobranza');
        $this->load->view('portfolio/list',$data);
        $this->load->view('home/footer');
        }
        else{
            $this->load->view('home/header');
            $this->load->view('home/login');
            $this->load->view('home/footer');
        }
    }
    
//Function to create an portfolio
    public function createPortfolio() {
        $number = $this->input->post('number');
        $data = array(
                                'number' => $number,
				'source' => $this->input->post('source'),
				'dateOfPurchase' => $this->input->post('dateOfPurchase'),
				'amountOfAccounts' => $this->input->post('amountOfAccounts'),			
        );

        if ($this->portfolio_model->checkIfExists($number)) {
            echo '<script language="javascript">alert("';
            echo 'El número de cartera ingresado ya fué registrado anteriormente. Por favor, intente de nuevo con otro número de cartera.';
            echo '");</script>';
            $this->PortfolioList();
        } else {
            if ($this->portfolio_model->createPortfolio($data)) {
                    $this->PortfolioList();
                }
            }
        }
    
     /*
     * Editing a employee
     */
    function update($idPortfolio)
    {   
        // check if the employee exists before trying to edit it
        $data['portfolio'] = $this->portfolio_model->getPortfolioByID($idPortfolio);
        
        if(isset($data['portfolio']['idPortfolio']))
        {
            if(isset($_POST) && count($_POST) > 0)     
            {   
                $params = array(
					
					'idPortfolio' => $this->input->post('idPortfolio'),
					'source' => $this->input->post('source'),
					'dateOfPurchase' => $this->input->post('dateOfPurchase'),
					'amountOfAccounts' => $this->input->post('amountOfAccounts'),
					
                );

                $this->portfolio_model->updatePortfolio($idPortfolio,$params);            
                $this->PortfolioList();
            }
            else
            {
                
                $this->PortfolioList();
            }
        }
        else
        {
            show_error('The employee you are trying to edit does not exist.');
        }
    }
    
    /*
     * Deleting employee
     */
    function delete($idPortfolio)
    {
        $portfolio = $this->portfolio_model->getPortfolioByID($idPortfolio);

        // check if the employee exists before trying to delete it
        if(isset($portfolio['idPortfolio']))
        {
            $this->portfolio_model->deletePortfolio($idPortfolio);
            $this->PortfolioList();
        }
        else
        {
            show_error('The employee you are trying to delete does not exist.');
        }
    }

}
