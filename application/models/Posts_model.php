<?php

class Posts_model extends CI_Model {
    public function __construct() {
        //$this->load->database();
    }
    
    public function create($data) {
        return $this->db->insert('Posts', $data);
    }

    public function getPost($id) {
        $this->db->select('Posts.id, title, description, img_url, created_at, author as author_id, Users.name as author_name');
        $this->db->from('Posts');
        $this->db->join('Users', 'Users.id = Posts.author');
        $this->db->where('Posts.id', $id);
        //$query = $this->db->get_where(array('Posts.id' => $id));
        $query = $this->db->get();
        return $query->row_array();
    }

    public function getPosts() {
        $this->db->select('Posts.id, title, description, img_url, created_at, author as author_id, Users.name as author_name');
        $this->db->from('Posts');
        $this->db->join('Users', 'Users.id = Posts.author');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function edit($id, $data = array()) {
        //só alterar os dados passados
        if(empty($data)) {
           $data = array(
               'title' => $this->input->post('title'),
               'description' => $this->input->post('description'),
               'img_url' => $this->input->post('img_url')
           ); 
        }

       $where = "id = $id";

       return $this->db->query($this->db->update_string('Posts', $data, $where));
    }

    public function delete($id) {
       return $this->db->delete('Posts', array('id' => $id)); 
    }
    
}