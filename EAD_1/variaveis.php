<?php

$_UPLOAD['pasta_do_arquivo'] = 'arquivosUpload/';
$_UPLOAD['arquivos_baixados'] = 'pasta_de_arquivos/';
$_UPLOAD['tamanho_do_arquivo_maximo'] = 1024 * 1024 * 1;
$_UPLOAD['tamanho_do_arquivo_minimo'] = 1024 * 10 * 1;
$_UPLOAD['extensoes_baixar'] = array('jpg', 'png', 'gif', 'pdf');
$_UPLOAD['renomeiar_arquivo'] = false;
$tmp = explode('.', $_FILES['arquivo']['name']);
 
// Listagem de varios tipos de erros que pode dar ao baixar os arquivos
$_UPLOAD['erros'][0] = 'Não houve erro';
$_UPLOAD['erros'][1] = 'O arquivo é maior do que o limite do PHP';
$_UPLOAD['erros'][2] = 'Não foi feito o upload do arquivo';