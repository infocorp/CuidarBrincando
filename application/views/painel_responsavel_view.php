<div class="container">
    <div class="control-group">
        <a href="<?php echo site_url('responsavel/create')?>" class="btn btn-primary">
            Novo responsavel
        </a>
    </div>
    <?php if (isset($erro)):?>
        <div class="alert alert-error"><?php echo $erro?></div>
    <?php endif?>
    <?php if (isset($responsaveis)):?>
    <table class="table">
        <thead>
            <th>Nome</th>
            <th>Ações</th>
        </thead>
        <tbody>
            <?php foreach ($responsaveis as $responsavel):?>
                <tr>
                    <td>
                        <a href="<?php echo site_url('responsavel/show/'.$responsavel->id);?>">
                            <?php echo $responsavel->nome?>
                        </a>
                    </td>
                    <td>
                        <a class="btn btn-action" href="<?php echo site_url('responsavel/edit/'.$responsavel->id);?>">
                            <i class="icon-edit"></i>
                            Alterar
                        </a>
                        <a class="btn btn-danger" href="<?php echo site_url('responsavel/delete/'.$responsavel->id);?>">
                            <i class="icon-remove"></i>
                            Remover
                        </a>
                    </td>
                </tr>
            <?php endforeach?>
        </tbody>
    </table>
    <?php endif;?>
</div>