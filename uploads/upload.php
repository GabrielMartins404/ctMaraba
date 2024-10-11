<?php
    // Código de nome unico
    function gerarCodigoUnico(){
        $alfabeto = "123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
        $tamanho = 10;
        $letra = "";
        $res = "";

        for ($i = 1; $i <= $tamanho; $i++){
            $letra = substr($alfabeto, rand(0,10), 1);
            $res .= $letra;
        }
        
        date_default_timezone_set('Brazil/west');
        $agora = getdate();

        $codigo_data = $agora['year'] . "_" . $agora['yday'];
        $codigo_data .= $agora['hours'] . $agora['minutes'] . $agora['seconds'] . "_" . $res;

        return $codigo_data;
    }
    

    //Pegar o tipo de extensão de imagem
    function extensaoNome($arquivo){
        return strrchr($arquivo, ".");
    }



    // Parte de upload

    //Esses parametros serão passados quando a função for chamada
    function uploadImg($local, $imagem){ //Esse imagem é na verdade um array, que tem diversos campos como o numero de erro, psta temporaria e etc
        $array_erro = array(
            UPLOAD_ERR_OK => "Imagem trocada/adicionada com absoluto sucesso",
            UPLOAD_ERR_INI_SIZE => "O arquivo enviado excede o limite definido, por favor, escolha um arquivo meno.",
            UPLOAD_ERR_FORM_SIZE => "O arquivo enviado excede o tamanho máximo de 10MB.",
            UPLOAD_ERR_PARTIAL => "O upload do arquivo foi feito parcialmente.",
            UPLOAD_ERR_NO_FILE => "Nenhum arquivo foi escolhido, escolha um para executar a atualização/inserção.",
            UPLOAD_ERR_CANT_WRITE => "Falha em escrever o arquivo em disco.",
            UPLOAD_ERR_EXTENSION => "Uma extensão do PHP interrompeu o upload do arquivo."
        ); 

        $extensao_valida = array(".jpg", ".jpeg", ".png", ".gif"); // Dita quais os formatos de exetenão válidas


        $nErro = $imagem["error"]; //Aqui pega os possiveis casos que podem acontecer como o previsto no array acima
        $mensagem = $array_erro[$nErro]; //Atribuo a mensagem o valor do array determinado pelo numero acima

        $pasta_tmp = $imagem["tmp_name"]; //Aqui recebe a pasta temporaria que essa item fica armazenado
        $nomeAntigo = basename($imagem["name"]); //Recebe o nome do arquivo que fez o upload
        $novo_nome = gerarCodigoUnico() . extensaoNome($nomeAntigo);  

        // Pega a extensão do arquivo de acorodo com o novo nome
        $extensao = extensaoNome($novo_nome);
        if(in_array($extensao, $extensao_valida)){
            $nomeCompleto = $local . "/" . $novo_nome;
        
            move_uploaded_file($pasta_tmp, "../".$nomeCompleto);
            return array($nomeCompleto, $mensagem);
            //echo $nomeCompleto;
        }else{
            echo "ERRO, extensão de arquivo não permitido!!";
        }

        
    }

    function deletarImg($local){
        $msg = false;
        if( file_exists( "../".$local )){ //Pergunta, caso o arquivo no diret[orio tal já exista, então
            unlink("../".$local ); //Delete o arquivo que se encontra nesse diretório
            $msg = true;

        }else{
            "Erro ao deletar Imagem";
            $msg = true;
        }

        return $msg;
    }

?>


