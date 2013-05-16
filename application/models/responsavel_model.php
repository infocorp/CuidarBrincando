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
     * Recupera todos os responsaveis cadastrados
     * 
     * @throws RuntimeException 
     * @return ResultQuery
     */
    public function getAll()
    {
        $query = $this->db->query('
            SELECT
                responsavel.id, responsavel.ajudaFamilia, responsavel.renda, 
                responsavel.beneficios, responsavel.situacaoPsicologica, 
                responsavel.email, pessoa.nome, pessoa.telefone, pessoa.apelido, 
                pessoa.cor, pessoa.dataNascimento, pessoa.sexo, pessoa.escolaridade, 
                pessoa.foto, pessoa.cpf, pessoa.tituloEleitor, pessoa.identidade, 
                pessoa.endereco_id, endereco.endereco, endereco.cidade, endereco.estado, 
                endereco.pais
            FROM 
                responsavel
            INNER JOIN 
                pessoa ON pessoa.id = responsavel.pessoa_id
            INNER JOIN
                endereco ON endereco.id = pessoa.endereco_id
        ');

        if ($query->num_rows == 0) {
            throw new RuntimeException('Nenhum responsável cadastrado');
        }

        return $query->result();
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
                responsavel.id, responsavel.ajudaFamilia, responsavel.renda, 
                responsavel.beneficios, responsavel.situacaoPsicologica, 
                responsavel.email, pessoa.nome, pessoa.telefone, pessoa.apelido, 
                pessoa.cor, pessoa.dataNascimento, pessoa.sexo, pessoa.escolaridade, 
                pessoa.foto, pessoa.cpf, pessoa.tituloEleitor, pessoa.identidade, 
                pessoa.endereco_id, endereco.endereco, endereco.cidade, endereco.estado, 
                endereco.pais
            FROM 
                responsavel
            INNER JOIN 
                pessoa ON pessoa.id = responsavel.pessoa_id
            INNER JOIN
                endereco ON endereco.id = pessoa.endereco_id
            WHERE 
                responsavel.id = ?
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