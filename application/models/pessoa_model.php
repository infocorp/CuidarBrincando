<?php
class Pessoa_Model extends CI_Model
{   
    /**
     * Salva o cadastro de pessoa sem endereço.
     * 
     * @param  array $info
     * @return int last inserted id
     * @throws RuntimeException
     */
    public function save(array $info, $idEndereco)
    {
        $sql = '
            INSERT INTO 
                pessoa (
                    nome, telefone, apelido, cor, dataNascimento, sexo, 
                    escolaridade, foto, cpf, tituloEleitor, identidade, endereco_id
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?
                )
        ';
        $info[] = $idEndereco;
        $this->db->query($sql, $info);
        
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        
        throw new RuntimeException('Cadastro não efetuado!');
    }
    
    /**
     * Pega a pessoa pelo id sem endereco
     * 
     * @param type $id
     * @return object pessoa
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                nome, telefone, apelido, cor, dataNascimento, sexo, escolaridade, foto, cpf, tituloEleitor, identidade
            FROM
                pessoa
            WHERE 
                id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Pessoa não encontrada!');
        }
        
    }
    
    /**
     * Lista todas as pessoas cadastradas sem endereco.
     * 
     * @return type
     * @throws RuntimeException
     */
    public function listAll()
    {
        $sql= '
            SELECT
                id, nome, telefone, apelido, cor, dataNascimento, sexo, escolaridade, foto, cpf, tituloEleitor, identidade
            FROM
                pessoa
        ';
        $query = $this->db->query($sql);
        if ($query->num_rows() > 0 ) {
               return $query->result();
        } else {
            throw new RuntimeException('Não existem pessoas cadastradas.');
        }
    }
    
    /**
     * Atualiza o cadastro de pessoa sem endereco
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
                pessoa
            SET
                nome = ?,
                telefone = ?,
                apelido = ?,
                cor = ?,
                dataNascimento = ?,
                sexo = ?,
                escolaridade = ?,
                foto = ?,
                cpf = ?,
                tituloEleitor = ?,
                identidade = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Pessoa não atualizada!');
    }
    
    /**
     * Deleta o cadastro de pessoa sem endereco
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deletePessoa($id)
    {
        $sql = '
            DELETE FROM pessoa WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar pessoa!');
    }

    /**
     * Retorna pessoas com o nome passado
     * 
     * @param string $name
     * @throws RuntimeException
     * @return ResultSet
     */
    public function getByName($name)
    {
        $query = $this->db->query('
            SELECT
                id, nome, telefone, apelido, cor, dataNascimento, sexo, 
                escolaridade, foto, cpf, tituloEleitor, identidade 
            FROM
                pessoa
            WHERE 
                nome LIKE "%?%"
        ', $name);

        if ($query->num_rows() == 0) {
            throw new RuntimeException('Nenhuma pessoa encontrada');
        }

        return $query->result();
    }
}