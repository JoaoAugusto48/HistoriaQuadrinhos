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

    // para recuperar o nome do folder
    public static function folder_name($hqId, $user = 'user'){
        return 'users/'.$user.'/hq_'.$hqId;
        // o nome do diretório que o usuário se encontra
    }

    // para recuperar o caminho do falder e o criar
    public static function folder_path($hqId){
        // Teste de existencia do Diretório
        $folder_path = ArquivoController::folder_name($hqId);
        if(!Storage::disk('public')->exists($folder_path)){ // se o diretório não existe
            Storage::disk('public')->makeDirectory($folder_path);
        }
        return $folder_path;
    }

    // para recuperar o nome do arquivo
    public static function file_name($hqId){
        $folder_name = ArquivoController::folder_name($hqId);
        // para gerar o arquivo de nome unico
        $file_hash = hash('sha512',uniqid((time())));
        return $folder_name.'/'. $file_hash.'.png';
    }
}
