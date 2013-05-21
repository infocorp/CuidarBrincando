<?php
class Professor_Model extends CI_Model
{
    /**
     * Cadastra os dados do professor
     * 
     * @param array $info
     * @return int inserted id
     * @throws RuntimeException
     */
    public function save(array $info)
    {
        $sql = '
            INSERT INTO
                professor (
                    graduacao, mestrado, doutorado, phd
                ) VALUES (
                    ?, ?, ?, ?
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
     * busca dados de professor sem pessoa e endereço
     * 
     * @param type $id
     * @return object professor
     * @throws RuntimeException
     */
    public function getById($id)
    {
        $sql= '
            SELECT
                professor.id, professor.graduacao, professor.mestrado, professor.doutorado,
                professor.phd, pessoa.nome, pessoa.telefone, pessoa.apelido, 
                pessoa.cor, pessoa.dataNascimento, pessoa.sexo, pessoa.escolaridade, 
                pessoa.foto, pessoa.cpf, pessoa.tituloEleitor, pessoa.identidade, 
                pessoa.endereco_id, endereco.endereco, endereco.cidade, endereco.estado, 
                endereco.pais
            FROM 
                professor
            INNER JOIN 
                pessoa ON pessoa.id = professor.pessoa_id
            INNER JOIN
                endereco ON endereco.id = pessoa.endereco_id
            WHERE 
                professor.id = ?
        ';
        $query = $this->db->query($sql, $id); 
        if ($query->num_rows() > 0 ){
            return $query->row();
        } else {
            throw new RuntimeException('Dados de professor não encontrados!');
        }
         
    }
    
    /**
     * Recupera todos os professores cadastrados
     * 
     * @throws RuntimeException 
     * @return ResultQuery
     */
    public function getAll()
    {
        $query = $this->db->query('
            SELECT
                professor.id, professor.graduacao, professor.mestrado, professor.doutorado,
                professor.phd, pessoa.nome, pessoa.telefone, pessoa.apelido, 
                pessoa.cor, pessoa.dataNascimento, pessoa.sexo, pessoa.escolaridade, 
                pessoa.foto, pessoa.cpf, pessoa.tituloEleitor, pessoa.identidade, 
                pessoa.endereco_id, endereco.endereco, endereco.cidade, endereco.estado, 
                endereco.pais
            FROM 
                professor
            INNER JOIN 
                pessoa ON pessoa.id = professor.pessoa_id
            INNER JOIN
                endereco ON endereco.id = pessoa.endereco_id
        ');

        if ($query->num_rows == 0) {
            throw new RuntimeException('Nenhum professor cadastrado');
        }

        return $query->result();
    }
    
    /**
     * Atualiza dados do professor
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
     public function updateProfessor($id, array $dados)
    {
        $sql= '
            UPDATE
                professor
            SET
                mestrado = ?,
                phd = ?,
                graduacao = ?,
                doutorado = ?
            WHERE
                id = ?
        ';
        
        array_push($dados, $id);
        $this->db->query($sql, $dados);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Dados não atualizados!');
    }
    
    /**
     * Apaga os dados do professor
     * 
     * @param type $id
     * @return boolean
     * @throws RuntimeException
     */
    public function deletePessoa($id)
    {
        $sql = '
            DELETE FROM professor WHERE id = ?
        ';
        $this->db->query($sql, $id);
        
        if ($this->db->affected_rows() == 1) {
            return true;
        }
        
        throw new RuntimeException('Erro ao deletar professor!');
    }
    
}
