<?php

class Responsavel_Model extends CI_Model
{
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Salva o cadastro de responsavel sem pessoa e sem endereço.
     * 
     * @param array $info
     * @param numeric $pessoaId
     * @return int inserted id
     * @throws RuntimeException
     */
    public function saveResponsavel(array $info, $pessoaId)
    {
        $sql = '
            INSERT INTO 
                responsavel (
                    ajudaFamilia, renda, beneficios, 
                    situacaoPsicologica, email, pessoa_id
                ) VALUES (
                    ?, ?, ?, ?, ?, ?
                )
        ';
        $info[] = $pessoaId;
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Cadastro não efetuado!');
    }
    
    /**
     * Pega o responsavel pelo id
     * 
     * @param type $id
     * @return object responsavel
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                ajudaFamilia, renda, beneficios, situacaoPsicologica, email
            FROM
                responsavel
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Dados de responsavel não encontrados!');
        }
        
    }
    
    /**
     * Atualiza o cadastro de responsavel sem pessoa e endereco
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
    public function updatePessoa($id, array $dados)
    {
        $sql= '
            UPDATE
                responsavel
            SET
                ajudaFamilia = ?,
                renda = ?,
                beneficios = ?,
                situacaoPsicologica,
                email = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Dados particulares de responsavel nao atualizados!');
    }
    
    /**
     * Deleta o cadastro de responsavel sem pessoa e sem endereco
     * 
     * @param type $id
     * @return int id deletado
     * @throws RuntimeException
     */
    public function deleteResponsavel($id)
    {
        $sql = '
            DELETE FROM responsavel WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return (int) $id;
        }
        
        throw new RuntimeException('Erro ao deletar dados de Responsavel!');
    }
}