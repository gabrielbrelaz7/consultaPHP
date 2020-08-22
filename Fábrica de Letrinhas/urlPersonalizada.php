    {source 0}

    <?php

        //Pegando o valor passado pela ULR

            $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_cod = explode('?', $url_atual);    
            $cod = $url_cod[1];

             $query = "SELECT * 
             FROM `app_livros`
             WHERE cod_livro = '$cod'";

            $database->setQuery($query);

        // Criando um array com todos os valores da consulta MySQL

            $rows =[];

        // Pegando objeto do documento

            $document =& JFactory::getDocument();

        // Definindo o tipo de saída JSON 

            $document->setMimeEncoding('application/json');

        // Alterando nome do arquivo

            JResponse::setHeader('Content-Disposition','attachment;filename="'. $cod .'.json"');
       

        // Associando valores MySQL

            if($row = $database->loadObjectList()) {
                
                array_push($rows,$row);
                
            }

        // Criando arquivo JSON a partir do Array 

            $json = json_encode($rows);

            echo $json;
        ?>

    {/source}