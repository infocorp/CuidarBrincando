<div class="container">
  <form class="form-horizontal" action="<?php echo site_url('responsavel/cadastrarResponsavel');?>" method="POST" enctype="multipar/form-data">
  <div class="row">
    <div class="span3">
      <link rel="stylesheet" href="<?php echo base_url()?>public/jcrop/css/jquery.Jcrop.min.css">
      <script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.file-input.js"></script>
      <script src="<?php echo base_url()?>public/jcrop/js/jquery.Jcrop.min.js"></script>
      <script src="<?php echo base_url()?>public/js/ImageCrop.js"></script>
      <script>
        $(document).ready(function(){
            var crop = new ImageCrop(
                document.getElementById('foto-handler'),
                document.getElementById('img-foto'),
                document.getElementById('crop-modal')
            );
        });
      </script>
      <em>Tamanho ideal: 200x200</em>
      <img src="
        <?php echo isset($foto) ? base_url() . 'public/fotos/' . $foto : base_url() . 'public/images/avatar_default.png';?>
      " class="img-polaroid" id="img-foto" style="width:200px;height:200px;">
      <input type="file" name="foto" id="foto-handler" title="Editar Foto">
    </div>
    <div class="span9">
        <input type="hidden" name="x" id="x">
        <input type="hidden" name="y" id="y">
        <input type="hidden" name="x2" id="x2">
        <input type="hidden" name="y2" id="y2">
        <input type="hidden" name="w" id="w">
        <input type="hidden" name="h" id="h">
        <div class="control-group">
          <label class="control-label" for="nome">Nome</label>
          <div class="controls">
            <input type="text" name="nome" placeholder="Nome" value="<?php echo isset($responsavel->nome) ? $responsavel->nome : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="telefone">Telefone</label>
          <div class="controls">
            <input type="text" name="telefone" placeholder="Telefone" value="<?php echo isset($responsavel->telefone) ? $responsavel->telefone : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="apelido">Apelido</label>
          <div class="controls">
            <input type="text" name="apelido" placeholder="Apelido" value="<?php echo isset($responsavel->apelido) ? $responsavel->apelido : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="dataNascimento">Data de Nascimento</label>
          <div class="controls">
            <input type="text" name="dataNascimento" placeholder="Data de Nascimento" value="<?php echo isset($responsavel->dataNascimento) ? $responsavel->dataNascimento : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="sexo">Sexo</label>
          <div class="controls">
            <select name="sexo">
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
              <option value="I">Outro</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cor">Cor</label>
          <div class="controls">
            <select name="cor">
              <option value="PR">Preto</option>
              <option value="PA">Pardo</option>
              <option value="AM">Amarelo</option>
              <option value="BR">Branco</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="escolaridade">Escolaridade</label>
          <div class="controls">
            <select name="escolaridade">
              <option value="N">Nenhuma</option>
              <option value="FI">Fundamental Incompleto</option>
              <option value="F">Fundamental Completo</option>
              <option value="MI">Medio Incompleto</option>
              <option value="M">Medio Completo</option>
              <option value="SI">Superior Incompleto</option>
              <option value="S">Superior Completo</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="identidade">Identidade</label>
          <div class="controls">
            <input type="text" name="identidade" placeholder="Identidade" value="<?php echo isset($responsavel->identidade) ? $responsavel->identidade : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cpf">CPF</label>
          <div class="controls">
            <input type="text" name="cpf" placeholder="CPF" value="<?php echo isset($responsavel->cpf) ? $responsavel->cpf : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="tituloEleitor">Titulo de Eleitor</label>
          <div class="controls">
            <input type="text" name="tituloEleitor" placeholder="Titulo de Eleitor" value="<?php echo isset($responsavel->tituloEleitor) ? $responsavel->tituloEleitor : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="ajudaFamilia">Ajuda da familia</label>
          <div class="controls">
            <select name="ajudaFamilia">
              <option value="N">Nunca</option>
              <option value="A">As vezes</option>
              <option value="S">Sempre</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="renda">Renda</label>
          <div class="controls">
            <input type="text" name="renda" placeholder="Renda" value="<?php echo isset($responsavel->renda) ? $responsavel->renda : ''?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="situacaoPsicologica">Situacao Psicologica</label>
          <div class="controls">
            <textarea name="situacaoPsicologica" cols="30" rows="10"></textarea>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="email">Email</label>
          <div class="controls">
            <input type="text" name="email" placeholder="Email" value="<?php echo isset($responsavel->email) ? $responsavel->email : ''?>">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Cadastrar</button>
          </div>
        </div>
    </div>
  </div>
  </form>
</div>

<!-- Modal -->
<div class="modal hide fade" id="crop-modal">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>Cortar Imagem</h3>
  </div>
  <div class="modal-body" id="modalBody">
    <img class="img-polaroid">
  </div>
  <div class="modal-footer">
    <button data-dismiss="modal" class="btn">Nao cortar</button>
    <a href="#" class="btn btn-primary">Cortar</a>
  </div>
</div>