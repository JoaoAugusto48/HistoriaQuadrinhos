<?php

function nomeUsuario($usuario){
    $usuarioNovo = explode(" ", $usuario);
                                    
    $nomeUsuario = $usuarioNovo[0].' '.$usuarioNovo[1];
    if((strlen($usuarioNovo[1]) == 2) || (strlen($usuarioNovo[1]) == 3)){
        if(isset($usuarioNovo[2])){
            $nomeUsuario .= ' '.$usuarioNovo[2];
        }
    }

    return $nomeUsuario;
}