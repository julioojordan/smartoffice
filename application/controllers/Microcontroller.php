<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Microcontroller extends CI_Controller {

    public function read_lamp()
    {   
        $this->load->model('m_devices');


        $lamp = $this->m_devices->getLampStatus(1);
        $status = $lamp['status'];
        if ($status == 0){
            echo "LAMP_OFF";
        }else{
            echo "LAMP_ON";
        }
    }
}
