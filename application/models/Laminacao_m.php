<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Laminacao_m extends CI_Model {

    var $id;
    var $nome;
    var $descricao;
    var $valor;

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function total_linhas() {
        return $this->db->get('laminacao')->num_rows();
    }

    public function listar($id = '') {

        if (!empty($id)) {
            $result = $this->db->get_where('laminacao', array('id' => $id));
        } else {
            $result = $this->db->get('laminacao');
        }

        return $this->Laminacao_m->_changeToObject($result->result_array());
    }

    public function inserir(Laminacao_m $laminacao) {
        if (!empty($laminacao)) {
            if ($this->db->insert('laminacao', $laminacao)) {
                return $this->db->insert_id();
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public function editar(Laminacao_m $laminacao) {
        if (!empty($laminacao->id)) {
            $this->db->where('id', $laminacao->id);
            if ($this->db->update('laminacao', $laminacao)) {
                return true;
            }
        } else {
            return false;
        }
    }

    public function deletar($id = '') {
        if (!empty($id)) {
            $this->db->where('id', $id);
            if ($this->db->delete('laminacao')) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function _changeToObject($result_db = '') {
        $laminacao_lista = array();


        foreach ($result_db as $key => $value) {
            $laminacao = new Laminacao_m();
            $laminacao->id = $value['id'];
            $laminacao->nome = $value['nome'];
            $laminacao->descricao = $value['descricao'];
            $laminacao->valor = $value['valor'];

            $laminacao_lista[] = $laminacao;
        }

        return $laminacao_lista;
    }

}
