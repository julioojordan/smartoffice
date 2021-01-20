<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Microcontroller extends CI_Controller {

    public function read()
    {   
        $this->load->model('m_microcontroller');

        $user_id = $this->input->get('user_id');
        $room_id = $this->input->get('room_id');
        $status_user = $this->input->get('status_user');// for checking if owner is in the room or not

        if ($status_user == "1"){ // user in the room
            $this->m_microcontroller->setUserStatus($user_id, "In The Room");
        }

        $data = $this->m_microcontroller->getDevicesStatus($room_id);
        echo json_encode($data);

    }

    public function read_lock()
    {
        $this->load->model('m_microcontroller');

        $user_id = $this->input->get('user_id'); // check if the owner has done the registration or not

        //check user email
        $user_info = $this->m_microcontroller->getUserInfo($user_id)->row_array();
        if ($user_info['email'] != NULL ){
            $user = $this->m_microcontroller->getUserDevices($user_id);
            $room_id = $user['room_id'];

            //set lock status to zero
            $this->m_microcontroller->setLockStatus($room_id);

            //get lock status
            $data = $this->m_microcontroller->getLockStatus($room_id)->result();


        }else{ // user haven't registered
            $data = $this->m_microcontroller->getUserInfo($user_id)->result();
        }
        echo json_encode($data);
    }
}
