<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class control_katbus extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('m_katbus');
    }

    function view_katbus(){
        $this->load->view('v_datakategori_bus');
    }

    function jsonBus(){
        $fetch_data = $this->m_katbus->useDatatables();  
        $data = array();
        $no = $_POST['start'];  
        foreach($fetch_data as $row){
            $no++;
            $sub_array = array();
            $sub_array[] = $no;                
            $sub_array[] = $row->tipe_unit;  
            $sub_array[] = $row->kategori;
            $sub_array[] = $row->seat;
            $sub_array[] = $row->nopol;
            $data[] = $sub_array;
        }
        $output = array(  
            "draw" => intval($_POST["draw"]),  
            "recordsTotal" => $this->m_katbus->get_all_data(),  
            "recordsFiltered" => $this->m_katbus->get_filtered_data(),  
            "data" => $data
       );  
       echo json_encode($output);
    }

    /*function importDatafromJson(){
        $path 		= 'documents/users/';
		$json 		= [];
		$this->upload_config($path);
		if (!$this->upload->do_upload('file')) {
			$json = [
				'error_message' => showErrorMessage($this->upload->display_errors()),
			];
		} else {
			$file_data 	= $this->upload->data();
			$file_name 	= $path.$file_data['file_name'];
			$arr_file 	= explode('.', $file_name);
			$extension 	= end($arr_file);
			if('csv' == $extension) {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Csv();
			} else {
				$reader 	= new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
			}
			$spreadsheet 	= $reader->load($file_name);
			$sheet_data 	= $spreadsheet->getActiveSheet()->toArray();
			$list 			= [];
			foreach($sheet_data as $key => $val) {
				if($key != 0) {
					$result 	= $this->m_katbus->get(["tipe_unit" => $val[1], "kategori" => $val[2]]);
					if($result) {
					} else {
						$list [] = [
							'tipe_unit'		=> $val[0],
							'kategori'		=> $val[1],
							'seat'			=> $val[2],
							'nopol'			=> $val[3],
						];
					}
				}
			}
			if(file_exists($file_name))
				unlink($file_name);
			if(count($list) > 0) {
				$result 	= $this->m_katbus->add_batch($list);
				if($result) {
					$json = [
						'success_message' => showSuccessMessage("All Entries are imported successfully."),
					];
				} else {
					$json = [
						'error_message' => showErrorMessage("Something went wrong. Please try again.")
					];
				}
			} else {
				$json = [
					'error_message' => showErrorMessage("No new record is found."),
				];
			}
		}
		echo json_encode($json);
    }

	public function upload_config($path){
		if (!is_dir($path)) 
			mkdir($path, 0777, TRUE);		
		$config['upload_path'] 		= './'.$path;		
		$config['allowed_types'] 	= 'csv|CSV|xlsx|XLSX|xls|XLS';
		$config['max_filename']	 	= '255';
		$config['encrypt_name'] 	= TRUE;
		$config['max_size'] 		= 4096; 
		$this->load->library('upload', $config);
	}*/
}   
?>