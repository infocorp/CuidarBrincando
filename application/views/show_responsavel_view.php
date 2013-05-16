<div class="container">
    <a href="<?php echo site_url('responsavel')?>" class="btn">Voltar à lista</a>
    <div class="row">
        <div class="span3"></div>
        <div class="span9">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#pessoa" data-toggle="tab">Pessoa</a></li>
                <li><a href="#endereco" data-toggle="tab">Endereço</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <!-- INFORMACOES DE PESSOA -->
                <div class="tab-pane active in" id="pessoa">
                    não ta pronto, volte mais tarde, porra                
                </div>
                <!-- INFORMACOES DE ENDERECO -->
                <div class="tab-pane fade" id="endereco">
                    <ul class="nav nav-list">
                        <li>Endereço - <?php echo $responsavel->endereco?></li>
                        <li class="divider"></li>
                        <li>Cidade - <?php echo $responsavel->cidade?></li>
                        <li class="divider"></li>
                        <li>Estado - <?php echo $responsavel->estado?></li>
                        <li class="divider"></li>
                        <li>País - <?php echo $responsavel->pais?></li>
                    </ul>
                </div>
            </div>
    </div>
</div>