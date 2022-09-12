<?php

class m_katbus extends CI_Model{
    var $table = "kategori_bus";  //table yang ingin di tampilkan
    var $select_column = array("id_katbus", "tipe_unit", "kategori", "seat", "nopol");  //sesuaikan dengan nama field table
    var $order_column = array(null, "tipe_unit", "kategori", null, "nopol");

    public function getData($postData=null){
        $this->db->select($this->select_column);  
        $this->db->from($this->table);  
        if(isset($_POST["search"]["value"])){  
                $this->db->like("tipe_unit", $_POST["search"]["value"]);  
                $this->db->or_like("kategori", $_POST["search"]["value"]);
                $this->db->or_like("nopol", $_POST["search"]["value"]); 
        }  
        
        if(isset($_POST["order"])){  
                $this->db->order_by($this->order_column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);  
        } 
        else{  
                $this->db->order_by('id_katbus', 'DESC');  
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
          
    public function get_all_data(){  
        $this->db->select("*");  
        $this->db->from($this->table);  
        return $this->db->count_all_results();  
    }

    public function add_batch($data) {
        return $this->db->insert_batch($this->table, $data);
    }

}

?>