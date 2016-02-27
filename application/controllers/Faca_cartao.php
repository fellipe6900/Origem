<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Faca_cartao extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Faca_cartao_m');
    }

    public function index() {
        $data['faca_cartao'] = $this->Faca_cartao_m->listar();
        $this->load->view('faca_cartao/lista', $data);
    }

    public function form() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $data['acao'] = 'inserir';

            $this->load->view('faca_cartao/form', $data);
        } else {
            $faca_cartao = $this->Faca_cartao_m->listar($id);

            $data['faca_cartao'] = $faca_cartao[0]; 
            $data['acao'] = 'editar';
            $data['id'] = $id;

            $this->load->view('faca_cartao/form', $data);
        }
    }
    
    public function inserir() {
        $faca_cartao = new Faca_cartao_m();
        $faca_cartao->id = null;
        $faca_cartao->nome = $this->input->post('nome');
        $faca_cartao->descricao = $this->input->post('descricao');
        $faca_cartao->valor = $this->input->post('valor');

        $id = $this->Faca_cartao_m->inserir($faca_cartao);
        if (!empty($id)) {
            redirect(base_url('faca_cartao/?msgTipe=sucesso&msg=faca_cartao inserido com sucesso'), 'location');
        } else {
            redirect(base_url('faca_cartao/?msgTipe=erro&msg=Erro ao inserir a faca_cartao'), 'location');
        }
    }
    
    public function editar() {
        $faca_cartao = new Faca_cartao_m();
        $faca_cartao->id = $this->input->post('id');;
        $faca_cartao->nome = $this->input->post('nome');
        $faca_cartao->descricao = $this->input->post('descricao');
        $faca_cartao->valor = $this->input->post('valor');

        if ($this->Faca_cartao_m->editar($faca_cartao)) {
            redirect(base_url('faca_cartao/?msgTipe=sucesso&msg=faca_cartao alterado com sucesso'), 'location');
        } else {
            sredirect(base_url('faca_cartao/?msgTipe=erro&msg=Erro ao alterar a faca_cartao'), 'location');
        }
    }
    
    public function deletar() {
        print $id = $this->uri->segment(3);

        if (!empty($this->Faca_cartao_m->deletar($id))) {
            redirect(base_url('faca_cartao/?msgTipe=sucesso&msg=faca_cartao apagado com sucesso'), 'location');
        } else {
            redirect(base_url('faca_cartao/?msgTipe=erro&msg=Erro ao apagar a faca_cartao'), 'location');
        }
    }
}
