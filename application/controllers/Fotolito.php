<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Fotolito extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('Fotolito_m');
    }

    public function index() {
        $data['fotolito'] = $this->Fotolito_m->listar();
        $this->load->view('fotolito/lista', $data);
    }

    public function form() {
        $id = $this->uri->segment(3);

        if (empty($id)) {
            $data['acao'] = 'inserir';

            $this->load->view('fotolito/form', $data);
        } else {
            $fotolito = $this->Fotolito_m->listar($id);

            $data['fotolito'] = $fotolito[0]; 
            $data['acao'] = 'editar';
            $data['id'] = $id;

            $this->load->view('fotolito/form', $data);
        }
    }
    
    public function inserir() {
        $fotolito = new Fotolito_m();
        $fotolito->id = null;
        $fotolito->altura = $this->input->post('altura');
        $fotolito->largura = $this->input->post('largura');
        $fotolito->descricao = $this->input->post('descricao');
        $fotolito->valor = $this->input->post('valor');

        $id = $this->Fotolito_m->inserir($fotolito);
        if (!empty($id)) {
            redirect(base_url('fotolito/?msgTipe=sucesso&msg=fotolito inserido com sucesso'), 'location');
        } else {
            redirect(base_url('fotolito/?msgTipe=erro&msg=Erro ao inserir a fotolito'), 'location');
        }
    }
    
    public function editar() {
        $fotolito = new Fotolito_m();
        $fotolito->id = $this->input->post('id');;
        $fotolito->altura = $this->input->post('altura');
        $fotolito->largura = $this->input->post('largura');
        $fotolito->descricao = $this->input->post('descricao');
        $fotolito->valor = $this->input->post('valor');

        if ($this->Fotolito_m->editar($fotolito)) {
            redirect(base_url('fotolito/?msgTipe=sucesso&msg=fotolito alterado com sucesso'), 'location');
        } else {
            sredirect(base_url('fotolito/?msgTipe=erro&msg=Erro ao alterar a fotolito'), 'location');
        }
    }
    
    public function deletar() {
        print $id = $this->uri->segment(3);

        if (!empty($this->Fotolito_m->deletar($id))) {
            redirect(base_url('fotolito/?msgTipe=sucesso&msg=fotolito apagado com sucesso'), 'location');
        } else {
            redirect(base_url('fotolito/?msgTipe=erro&msg=Erro ao apagar a fotolito'), 'location');
        }
    }
}
