<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <title>Cuidar Brincando</title>
        <link rel="stylesheet" href="<?php echo base_url()?>public/bootstrap/css/bootstrap.min.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="<?php echo base_url()?>public/bootstrap/js/bootstrap.min.js"></script>
    </head>
    <body>
        <div class="navbar">
            <div class="navbar-inner">
                <a class="brand" href="<?php echo site_url('/')?>">Cuidar Brincando</a>
                <ul class="nav">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            Cadastro de pessoas
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo site_url('painel/professor')?>">Professor</a></li>
                            <li><a href="<?php echo site_url('painel/educador')?>">Educador</a></li>
                            <li><a href="<?php echo site_url('painel/responsavel')?>">Responsavel</a></li>
                            <li><a href="<?php echo site_url('painel/crianca')?>">Crianca</a></li>
                        </ul>
                    </li>
                    <li><a href="<?php echo site_url('painel/relatorio')?>">Relatorios</a></li>
                </ul>
                <div class="pull-right">
                    <a class="btn btn-danger" href="<?php echo site_url('auth/logout')?>">Sair</a>
                </div>
            </div>
        </div>