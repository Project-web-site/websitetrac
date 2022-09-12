<?php

class control_admin extends CI_Controller{
    function __construct(){
        parent::__construct();
        $this->load->model('m_admin');
        $this->load->helper('url');
    }
    
    public function dashboard(){
        $this->load->view('v_index');
    }

    public function view_billing(){
        $this->load->view('v_billing');
    }

    public function view_sales(){
        $this->load->view('v_sales');
    }

    public function jsonSales(){
        $fetch_data = $this->m_admin->useDatatables();  
        $data = array();
        $no = $_POST['start'];  
        foreach($fetch_data as $row){
            $no++;
            $sub_array = array();
            $sub_array[] = $no;                
            $sub_array[] = $row->no_reservasi;  
            $sub_array[] = $row->pic_sales;
            $sub_array[] = $row->profit_center;
            $sub_array[] = '<a href="'.base_url().'index.php/control_admin/delete_sales/'.$row->id_sales.'" class="btn btn-danger pull-right btn-xs" role="button">Hapus</a>
                            <a href="'.base_url().'index.php/control_admin/edit_sales/'.$row->id_sales.'" class="btn btn-secondary pull-right btn-xs" style="padding-left: 10px; padding-right: 10px;" role="button">Edit</a>'; 
            $data[] = $sub_array;
        }
        $output = array(  
            "draw" => intval($_POST["draw"]),  
            "recordsTotal" => $this->m_admin->get_all_data(),  
            "recordsFiltered" => $this->m_admin->get_filtered_data(),  
            "data" => $data
       );  
       echo json_encode($output);
    }

    public function add_sales(){
        $this->load->view('v_add_sales');
    }

    public function getAddSales(){
        $reservasi = $this->input->post('rsv');
        $picsales = $this->input->post('pic');
        $profit = $this->input->post('prfc');

        $data = array(
			'no_reservasi' => $reservasi,
			'pic_sales' => $picsales,
			'profit_center' => $profit
			);
		$this->m_admin->input_data($data, 'sales');
		redirect ('control_admin/view_sales');
    }

    public function delete_sales($id){
        $where = array('id_sales' => $id);
        $this->m_admin->delete_data($where, 'sales');
        redirect('control_admin/view_sales');
    }

    public function edit_sales($id){
        $where = array('id_sales' => $id);
        $data['sales'] = $this->m_admin->edit_data($where, 'sales')->result();
        $this->load->view('v_edit_sales', $data); 
    }

    public function updateSales(){
        $id = $this->input->post('id');
        $reservasi = $this->input->post('rsv');
        $picsales = $this->input->post('pic');
        $profit = $this->input->post('prfc');

        $data = array(
            'no_reservasi' => $reservasi,
			'pic_sales' => $picsales,
			'profit_center' => $profit);

        $where = array('id_sales' => $id);

        $this->m_admin->update_data($where, $data, 'sales');
        redirect('control_admin/view_sales');

    }
}


?>