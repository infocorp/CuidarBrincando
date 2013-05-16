<?php
    class Edcucador_Model extends CI_Controller
    {
        public function __construct() 
        {
            parent::__construct();
            $this->load->database();
        }
        
        public function saveEducador(array $info)
        {
            $sql = '
                INSERT INTO
                    educador (
                        curso, semestreEntrada, rga, renda, curriculo, bolsita, tipoBolsa
                    ) VALUES (
                        ?, ?, ?, ?, ?, ?, ?
                    )
            ';
            $this->db->query($sql, $info);
            
            if ($this->db->affected_row() == 1) {
                return true;
            }
            
            throw new RuntimeException('Cadastro não efetuado.');
        }
        
        public function getById($id)
        {
            $sql = '
                SELECT
                    curso, semestreEntrada, rga, renda, curriculo, bolsita, tipoBolsa
                FROM
                    educador
                WHERE
                    id = ?
            ';
            $query = $this->db->query($sql, $id);
            if ($query->num_rows() > 0 ){
                return $query->row();
            } else {
                throw new RuntimeException('Dados de educador não encontrados!');
            }
        }
        
            /**
     * Atualiza o cadastro de educador sem pessoa e endereço
     * 
     * @param type $id
     * @param array $dados
     * @return boolean
     * @throws RuntimeException
     */
        public function updateEducador($id, array $dados)
        {
            $sql = '
                UPDATE
                    educador
                SET
                    curso = ?,
                    semestreEntrada = ?,
                    rga = ?,
                    renda = ?,
                    curriculo = ?,
                    bolsista = ?,
                    tipoBolsa = ?
                WHERE
                    id = ?
            ';
            
            array_push($dados, $id);
            $this->db->query($sql, $dados);
            
            if ($this->db->affect_rows() == 1) {
                return true;
            }
            
            throw new RuntimeException('Dados particulares do educador não atualizados!');
        }
        
        /**
         * Deleta o cadastro do educador sem pessoa e endereço
         * 
         * @param type $id
         * @return boolean
         * @throws RuntimeException
         * 
         */
        public function deleteEducador($id)
        {
            $sql = '
                DELETE FROM educador WHERE id = ?
            ';
            $this->db->query($sql, $id);
            
            if ($this->db->affected_rows() == 1){
                return true;
            }
            
            throw new RuntimeException('Erro ao deletar dados de Educador!');
        }
    }
