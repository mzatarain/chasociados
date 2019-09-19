<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Employee_controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('employee_model');
        
    }

    function EmployeeList() {
        try {
            $data['employee'] = $this->employee_model->getEmployees();
            $data['_view'] = 'employee/list';

            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/list', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function EmployeeSearchForm() {
        try {
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/searchForm');
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function EmployeeCreate() {
        try {
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/create');
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function EmployeeUpdate($idEmployee) {
        try {
            $data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/update', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function EmployeeDetails($idEmployee) {
        try {
            $data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);
            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/details', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function EmployeeSearch() {
        try {
            $idEmployee = $this->input->post('idEmployee');
            $name = $this->input->post('name');
            $fLastName = $this->input->post('fLastName');
            $sLastName = $this->input->post('sLastName');
            $email = $this->input->post('email');

            $data['employee'] = $this->employee_model->SearchEmployee($idEmployee, $name, $fLastName, $sLastName, $email);

            if ($this->session->userdata('logged')) {
                $this->load->view('home/header');
                $this->load->view('home/cobranza');
                $this->load->view('employee/list', $data);
                $this->load->view('home/footer');
            } else {
                $this->load->view('home/header');
                $this->load->view('home/login');
                $this->load->view('home/footer');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //Function to create an employee account
    public function createEmployee() {
        try {
            $email = $this->input->post('email');
            $data = array(
                'name' => $this->input->post('name'),
                'fLastName' => $this->input->post('fLastName'),
                'sLastName' => $this->input->post('sLastName'),
                'jobPosition' => $this->input->post('jobPosition'),
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
                'workPhone' => $this->input->post('workPhone'),
                'personalPhone' => $this->input->post('personalPhone'),
            );

            if ($this->employee_model->checkIfExists($email)) {
                echo '<script language="javascript">alert("';
                echo 'That account already exists in our database. Please try again with a different email.';
                echo '");</script>';
                $this->EmployeeList();
            } else {
                if ($this->employee_model->createEmployee($data)) {
                    $this->EmployeeList();
                }
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //Editing a employee
    function update($idEmployee) {
        try {
            // check if the employee exists before trying to edit it
            $data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);

            if (isset($data['employee']['idEmployee'])) {
                if (isset($_POST) && count($_POST) > 0) {
                    $params = array(
                        'name' => $this->input->post('name'),
                        'fLastName' => $this->input->post('fLastName'),
                        'sLastName' => $this->input->post('sLastName'),
                        'jobPosition' => $this->input->post('jobPosition'),
                        'email' => $this->input->post('email'),
                        'workPhone' => $this->input->post('workPhone'),
                        'personalPhone' => $this->input->post('personalPhone'),
                    );

                    $this->employee_model->updateEmployee($idEmployee, $params);
                    $this->EmployeeList();
                } else {

                    $this->EmployeeList();
                }
            } else {
                show_error('The employee you are trying to edit does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    function disableAccount($idEmployee){
        try {
            $password='SA&q9"yhe.q63K';
            // check if the employee exists before trying to edit it
            $data['employee'] = $this->employee_model->getEmployeeByID($idEmployee);
            
            if (isset($data['employee']['idEmployee'])) {
                    $params = array(
                        'password' => $password,
                    );

                    $this->employee_model->updateEmployee($idEmployee, $params);
                    $this->EmployeeList();
                
            } else {
                show_error('The employee you are trying to edit does not exist.');
                $this->EmployeeList();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }
    //Deleting employee     
    function delete($idEmployee) {
        try {
            $employee = $this->employee_model->getEmployeeByID($idEmployee);

            // check if the employee exists before trying to delete it
            if (isset($employee['idEmployee'])) {
                $this->employee_model->deleteEmployee($idEmployee);
                $this->EmployeeList();
            } else {
                show_error('The employee you are trying to delete does not exist.');
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

    //Function to login
    public function login_post() {
        try {
            if ($this->input->post()) {
                $email = $this->input->post('email');
                $password = $this->input->post('password');
                $employee = $this->employee_model->login($email, $password);
                if ($employee) {
                    $user_data = array(
                        'idEmployee' => $employee->idEmployee,
                        'name' => $employee->name,
                        'fLastName' => $employee->fLastName,
                        'sLastName' => $employee->sLastName,
                        'jobPosition' => $employee->jobPosition,
                        'email' => $employee->email,
                        'password' => $employee->password,
                        'workPhone' => $employee->workPhone,
                        'personalPhone' => $employee->personalPhone,
                        'logged' => TRUE
                    );
                    $this->session->set_userdata($user_data);
                    $this->index();
                } else {
                    echo '<script language="javascript">alert("';
                    echo 'El usuario no está registrado o la contraseña es incorrecta, por favor revisa tus datos';
                    echo '");</script>';
                    $this->index();
                }
            } else {
                echo '<script language="javascript">alert("';
                echo 'data was not received';
                echo '");</script>';
                $this->index();
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

//Function to end session
    public function end_session() {
        try {
            $user_data = array(
                'logged' => FALSE
            );
            $this->session->set_userdata($user_data);
            $this->index();
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
        }
    }

}
