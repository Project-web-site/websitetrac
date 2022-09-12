<?php

class m_admin extends CI_Model{

    var $table = "sales";  //table yang ingin di tampilkan
    var $select_column = array("id_sales", "no_reservasi", "pic_sales", "profit_center");  //sesuaikan dengan nama field table
    var $order_column = array(null, "no_reservasi", "pic_sales", 'profit_center');

    public function getData($postData=null){
        $this->db->select($this->select_column);  
        $this->db->from($this->table);  
        if(isset($_POST["search"]["value"])){  
                $this->db->like("no_reservasi", $_POST["search"]["value"]);  
                $this->db->or_like("pic_sales", $_POST["search"]["value"]);
                $this->db->or_like("profit_center", $_POST["search"]["value"]);  
        }  
        
        if(isset($_POST["order"])){  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        } 
        else{  
                $this->db->order_by('id_sales', 'DESC');  
        }  
    }

    public function useDatatables(){  
        $this->getData();  
        if($_POST["length"] != -1)  
        {  
             $this->db->limit($_POST['length'], $_POST['start']);  
        }  
        $query = $this->db->get();  
        return $query->result();  
   }  
    public function get_filtered_data(){  
        $this->getData();  
        $query = $this->db->get();  
        return $query->num_rows();  
   }
          
    public function get_all_data()  
   {  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
   }

    public function input_data($data, $table){
        $this->db->insert($table, $data);
    }

    public function delete_data($where, $table){
        $this->db->where($where);
        $this->db->delete($table);
    }

    public function edit_data($where,$table){		
        return $this->db->get_where($table,$where);
    }

    public function update_data($where, $data, $table){
		$this->db->where($where);
		$this->db->update($table, $data);
	}
}
