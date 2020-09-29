<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArquivoController extends Controller
{
    // Classe responsável pelo gerenciamento de arquivos que o sistema usará

    public static function caminho_storage(){
        return env('APP_URL').'/storage/';
        // retornando o modo feito para armazenar os arquivos do projeto em storage
    }

    // Função para fazer o upload dos arquivos pelo administrador do sistema
    public static function caminho_imagem($arquivoImagem, $imagem){
        if(Storage::disk('public')->exists($arquivoImagem)){
            // $nomeImagem = hash('sha512',uniqid((time())));
            return $imagem->store($arquivoImagem);
            // return $arquivoImagem.'/'. $nomeImagem .'.png';
        }
    }

    // para recuperar o nome do folder
    public static function folder_name($hqId, $user){
        return 'users/'.$user.'/hq_'.$hqId;
        // o nome do diretório que o usuário se encontra
    }

    // para recuperar o caminho do falder e o criar
    public static function folder_path($hqId, $user_id = null){
        // Teste de existencia do Diretório
        $folder_path = ArquivoController::folder_name($hqId, $user_id);
        if(!Storage::disk('public')->exists($folder_path)){ // se o diretório não existe
            Storage::disk('public')->makeDirectory($folder_path);
        }
        return $folder_path;
    }

    // para recuperar o nome do arquivo
    public static function file_name($hqId,$user_id = 'user'){
        $folder_name = ArquivoController::folder_name($hqId, $user_id);
        // para gerar o arquivo de nome unico
        $file_hash = hash('sha512',uniqid((time())));
        return $folder_name.'/'. $file_hash.'.png';
    }
}
