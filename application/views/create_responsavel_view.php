<div class="container">
  <div class="row">
    <div class="span3">
      <script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.file-input.js"></script>
      <script src="<?php echo base_url()?>public/jcrop/js/jquery.Jcrop.min.js"></script>
      <script src="<?php echo base_url()?>public/js/crop.js"></script>
      <script>
        $(document).ready(function(){
            var crop = new ImageCrop(
                document.getElementById('foto-handler'),
                document.getElementById('img-foto')
            );
            crop.setCropListener();
        });
      </script>
      <em>Tamanho ideal: 200x200</em>
      <img src="<?php echo base_url()?>public/images/avatar_default.png" class="img-polaroid" id="img-foto" style="width:200px;height:200px;>
      <form action="" enctype="multipart/form-data">
        <input type="file" name="foto" id="foto-handler" title="Editar Foto">
      </form>
    </div>
    <div class="span9">
      <form class="form-horizontal" action="<?php echo site_url('responsavel/cadastrarResponsavel')?>" method="POST" enctype="multipar/form-data">
        <div class="control-group">
          <label class="control-label" for="nome">Nome</label>
          <div class="controls">
            <input type="text" name="nome" placeholder="Nome">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="telefone">Telefone</label>
          <div class="controls">
            <input type="text" name="telefone" placeholder="Telefone">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="apelido">Apelido</label>
          <div class="controls">
            <input type="text" name="apelido" placeholder="Apelido">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="dataNascimento">Data de Nascimento</label>
          <div class="controls">
            <input type="text" name="dataNascimento" placeholder="Data de Nascimento">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="sexo">Sexo</label>
          <div class="controls">
            <select name="sexo">
              <option value="M">Masculino</option>
              <option value="F">Feminino</option>
              <option value="I">Indefinido</option>
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
            <input type="text" name="identidade" placeholder="Identidade">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="cpf">CPF</label>
          <div class="controls">
            <input type="text" name="cpf" placeholder="CPF">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="tituloEleitor">Titulo de Eleitor</label>
          <div class="controls">
            <input type="text" name="tituloEleitor" placeholder="Titulo de Eleitor">
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
            <input type="text" name="renda" placeholder="Renda">
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
            <input type="text" name="email" placeholder="Email">
          </div>
        </div>
        <div class="control-group">
          <div class="controls">
            <button type="submit" class="btn">Cadastrar</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>