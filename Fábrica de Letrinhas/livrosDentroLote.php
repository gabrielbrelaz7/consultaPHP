    <!-- AQUI ESTÁ O CÓDIGO DA LISTAGEM E GERAÇÃO DOS LIVROS CAPA DURA, CAPA MOLE E MIOLO DENTRO DE UM LOTE QUE ESTÁ DENTRO DE VISUALIZAÇÕES (VIEWS) DENTRO DO SISTEMA ADMINISTRADOR DO JOOMLA -->

    {source 0}

    <?php


       // Pegando URL atual e selecionando somente o domínio da url atual

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $elementos = parse_url($url);

        $host = $elementos['host'];
        $porta = $elementos['port']; 


        setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

            $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $url_cod = explode('?', $url_atual);    
             $lote = $url_cod[1];
             $idTurma = $url_cod[2];

          $query = "

                SELECT DISTINCT codigo,
				    
                app_escolas.nome AS nomeEscola,
                app_alunos.nome AS nomeAluno,
                app_turmas.professor_turma AS professor,
                app_turmas.modelo AS modeloLivro,
                app_turmas.turmas,
                app_turmas.titulo_dedicatoria AS tituloLivro,
                app_turmas.dedicatoria_livro AS dedicatoriaLivro,
                app_turmas.assinatura_dedicatoria AS assinaturaLivro,
                
                app_livros.*
            
                FROM e_lotes

              	INNER JOIN app_projetos     
           		ON e_lotes.idEvento = app_projetos.id
                
                INNER JOIN app_projetos_repeat_turmas_evento     
                ON app_projetos.id = app_projetos_repeat_turmas_evento.parent_id

                INNER JOIN app_escolas     
                ON app_projetos.escola_id = app_escolas.id

                INNER JOIN app_turmas     
                ON app_projetos.escola_id = app_turmas.escola_id

                INNER JOIN app_alunos     
                ON app_turmas.id = app_alunos.turma_id
 
           		INNER JOIN app_livros     
                ON app_alunos.id = app_livros.aluno_id
                AND app_projetos.id = app_livros.projeto_id
                
         
                LEFT JOIN e_lote_item
                ON e_lotes.id = e_lote_item.idLote

                LEFT JOIN  e_pedidos_itens     
                ON e_lote_item.idItemPedido = e_pedidos_itens.id
                AND app_livros.id = e_pedidos_itens.app_livro_id

                LEFT JOIN  e_produtos     
                ON e_pedidos_itens.e_produto_id = e_produtos.id

                LEFT JOIN e_pedidos   
                ON e_pedidos_itens.e_pedido_id = e_pedidos.id
            
                WHERE e_lotes.codigo = '$lote' 
                AND app_livros.turma_livro = '$idTurma'
                AND e_lotes.idTurma = app_turmas.id
                AND e_pedidos_itens.id IS NOT NULL
                AND app_livros.revisado = 1
                
                
                

                ";


          $database->setQuery($query);

            ?>



    <div class="Detalhes_Eventos Painel_Grafica">

        <div class="Page Page_Eventos __is-active">


            <!--Loading/Carregamento-->
            
            <div class="row loadingGrafica">
                <div class="col-sm-12 col-md-12 offset-md-2 offset-lg-4">
                    <div class="loadingCarregandoArquivoPdfGrafica">
                        <div class="loader"></div>
                        <div class="textLoading">Gerando livro em PDF</div>
                    </div>
                </div>
            </div>
            

            <div class="Block Block_ProgramacaoEventos">
                <div class="ListagemAlunos_Button_Voltar_Lotes">
                    <a href="/turmas-lote?<?php echo $lote;?>">
                        <button class="Button Button_Primary Button_Ghost">
                            <div class="Button_Content">
                                <div class="Button_Content_Icon">
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                                <div class="Button_Content_Label">
                                    Voltar
                                </div>
                            </div>
                        </button>
                    </a>



                    <div class="Block_Title">
                        <div class="Block_Title_Label">
                            Livros para imprimir
                        </div>
                        <div class="Block_Title_Description">Veja abaixo todas as impressões por livro
                        </div>

                    </div>

                </div>

                <?php

                    if( $rows = $database->loadObjectList() )
                    {
                        foreach( $rows as $row )

                    {
                            
                
                $loteAtual = $row->codigo;
                $turmaAtual = $row->turma_livro;  
                $livroAtual = $row->id;
                            
                            
                $quantidadeImpressoes = "
                
                SELECT  codigo,
				    
                SUM(e_pedidos_itens.quantidade) as quantidadeTotalLivro,
                e_pedidos_itens.e_produto_id
                
                FROM e_lotes

                INNER JOIN e_lote_item
                ON e_lotes.id = e_lote_item.idLote

                INNER JOIN  e_pedidos_itens     
                ON e_lote_item.idItemPedido = e_pedidos_itens.id
                
                INNER JOIN app_livros     
                ON app_livros.id = e_pedidos_itens.app_livro_id

                INNER JOIN  e_produtos     
                ON e_pedidos_itens.e_produto_id = e_produtos.id

                INNER JOIN e_pedidos   
                ON e_pedidos_itens.e_pedido_id = e_pedidos.id
            
                WHERE e_lotes.codigo = '$loteAtual' 
                AND app_livros.turma_livro = '$turmaAtual'
                AND app_livros.id = '$livroAtual'
                
                GROUP BY e_pedidos_itens.e_produto_id
                
                ";
                    
                $db->setQuery($quantidadeImpressoes);             
                $quantidadeResultado = $db->loadAssocList(); 
                            
                     
                    $eProdutoIDRow1 = $quantidadeResultado[0]['e_produto_id'];
                    $eProdutoIDRow2 = $quantidadeResultado[1]['e_produto_id']; 
                            
                          
                    
                            
                            
                    if ($eProdutoIDRow1 == '1') {        
                 
                        $quantidadeCapaMole = $quantidadeResultado[0]['quantidadeTotalLivro'];
                        $quantidadeMioloCapaMole = $quantidadeResultado[0]['quantidadeTotalLivro']; 
                        
                    }
                            
                    if ($eProdutoIDRow1 == '2') {
                            
                        $quantidadeCapaDura = $quantidadeResultado[0]['quantidadeTotalLivro'];
                        $quantidadeMioloCapaDura = $quantidadeResultado[0]['quantidadeTotalLivro'];
                        
                    }
                            
                            
                     if ($eProdutoIDRow1 == '1' && $eProdutoIDRow2 == '2') {
                         
                        $quantidadeCapaMole = $quantidadeResultado[0]['quantidadeTotalLivro'];
                        $quantidadeMioloCapaMole = $quantidadeResultado[0]['quantidadeTotalLivro'];             
                        $quantidadeCapaDura = $quantidadeResultado[1]['quantidadeTotalLivro'];
                        $quantidadeMioloCapaDura = $quantidadeResultado[1]['quantidadeTotalLivro'];
                         
                     }
                          
                        
                $quantidadeTotal = $quantidadeCapaDura + $quantidadeCapaMole;
                        
                                 
                            
                //Identificadores únicos para as funções
                            
                $eprodutoID1 = $quantidadeResultado[1]['e_produto_id'];                                        
                $eprodutoID2 = $quantidadeResultado[0]['e_produto_id'];            
                
                         
                $identificadorMiolo = $row->id . $row->cod_livro;                
                $identificadorMioloCapaDura = $row->id . $row->cod_livro . $eprodutoID2 . $eprodutoID2;
                $identificadorMioloCapaMole = $row->id . $row->cod_livro . $eprodutoID1 . $eprodutoID1;               
                                       
                            
                $identificadorCapaDura = $row->id . $row->cod_livro . $eprodutoID2;       
                $identificadorCapaMole = $row->id . $row->cod_livro . $eprodutoID1; 
                            
                            
                 if($host == 'fabricadeletrinhas.dev.local.com.br') {


                 //Código de Barras - Ambiente Local

                 if ($eprodutoID2 == '1') {

                 $codBarraMioloCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);

                 }

                 if ($eprodutoID2 == '2') {


                 $codbarraCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codBarraMioloCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);



                 $numerosCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 }


                 if ($eprodutoID2 == '1' && $eprodutoID1 == '2' ) {

                 $codBarraMioloCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codbarraCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);


                 $codBarraMioloCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);



                 $numerosCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID1);



                 }

                 }
                            
                         
                
                if($host == 'painel-fabricadeletrinhas.dev.marlin.net') { 
                            
                            
                //Código de Barras - Ambiente DEV
                        
                 if ($eprodutoID2 == '1') {

                 $codBarraMioloCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);

                 }

                 if ($eprodutoID2 == '2') {


                 $codbarraCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codBarraMioloCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);



                 $numerosCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 }


                 if ($eprodutoID2 == '1' && $eprodutoID1 == '2' ) {

                 $codBarraMioloCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codbarraCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);


                 $codBarraMioloCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);



                 $numerosCapaDura = file_get_contents('http://api-fabricadeletrinhas.dev.marlin.net/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID1);



                 }  
                    
                }
                            
                            
                if($host == 'painel-fabricadeletrinhas.hmg.marlin.com.br') { 
                            
                            
                //Código de Barras - Ambiente HMG
                            

                 if ($eprodutoID2 == '1') {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);

                 }

                 if ($eprodutoID2 == '2') {


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 }


                 if ($eprodutoID2 == '1' && $eprodutoID1 == '2' ) {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID1);



                 }
                    
                }  
                            
                                        
                    
                if($host == 'painel-fabricadeletrinhas.hmg2.marlin.com.br') { 
                            
                            
                //Código de Barras - Ambiente HMG
                            

                 if ($eprodutoID2 == '1') {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);

                 }

                 if ($eprodutoID2 == '2') {


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 }


                 if ($eprodutoID2 == '1' && $eprodutoID1 == '2' ) {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID1);



                 }
                    
                }  
                            
                            
                if($host == 'painel-fabricadeletrinhas.criandohistorias.com') { 
                            
                            
                //Código de Barras - Ambiente HMG
                            

                 if ($eprodutoID2 == '1') {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);

                 }

                 if ($eprodutoID2 == '2') {


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 }


                 if ($eprodutoID2 == '1' && $eprodutoID1 == '2' ) {

                 $codBarraMioloCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $codbarraCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID2);

                 $numerosCapaMole = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID2);


                 $codbarraCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);


                 $codBarraMioloCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/'. $row->cod_livro.'/'. $eprodutoID1);



                 $numerosCapaDura = file_get_contents('https://api-fabricadeletrinhas.hmg2.marlin.com.br/public/api/V1/codbarras/gerarcod/'. $row->cod_livro.'/'. $eprodutoID1);



                 }
                    
                }            
                            
                            
                            
                     
                            
                    ?>
                
                    
                <div class="Block_Content">
                    <div class="Block_ProgramacaoEventos_Lista">
                        <div class="ProgramacaoEventos_Lista_Evento">

                            <div class="Lista_Evento_Chamada">
                                
                                  
                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>ESCOLA</span>
                                    <?php echo $row->nomeEscola;?>

                                </div>

                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>ALUNO</span>
                                    <?php echo $row->nomeAluno;?>

                                </div>


                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>TÍTULO</span>
                                    <?php echo $row->titulo;?>

                                </div>

                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>CÓDIGO</span>
                                    <?php echo $row->cod_livro;?>

                                </div>


                                <div class="Evento_Chamada_Titulo Tela3">

                                    
                                    
                                    <span>CAPA DURA</span>
                                    <?php 
                                        
                                    if ($quantidadeCapaDura>0){
                                    echo $quantidadeCapaDura;
                                    }
                            
                                    else {
                                       echo '0'; 
                                    }?>

                                </div>


                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>CAPA MOLE</span>
                                    
                                    <?php 
                            
                                    if ($quantidadeCapaMole>0){
                                    echo $quantidadeCapaMole;     
                                    }
                            
                                    else {
                                       echo '0'; 
                                    }?>

                                </div>



                                <div class="Evento_Chamada_Titulo Tela3">

                                    <span>TOTAL DE IMPRESSÕES</span>
                                    <?php echo $quantidadeTotal;?>

                                </div>


                                <?php

                                        if ($quantidadeCapaDura>0 && $quantidadeCapaMole>0 ) {

                                    ?>

                                <div class="fabrik_action dropdownLote  pull-right">

                                    <a class="btn  rounded-pill btn-danger shadow-sm" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fas fa-bars" aria-hidden="true"></i> </a>

                                    <ul class="dropdown-menu lote" x-placement="bottom-start" style="position: absolute; transform: translate3d(-24px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

                                        <li></li>


                                        <li>
                                            <a href="/livros-lote?<?php echo $lote;?>" class="fabrik_edit fabrik__rowlink btn-default buttonAction" onclick="gerarCapaDura('<?php echo $identificadorCapaDura;?>')" title="Gerar capa dura" imgCapaCrop="<?php echo $row->capa_crop;?>" alunoCapaDura="<?php echo $row->nomeAluno;?>" titulo="<?php echo $row->titulo;?>" cor="<?php echo $row->modeloLivro;?>" codBarraCapaDura="<?php echo $codbarraCapaDura?>" numerosCapaDura="<?php echo $numerosCapaDura?>" quantidadeCapaDura="<?php echo $quantidadeCapaDura;?>" id="<?php echo $identificadorCapaDura;?>">

                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar capa dura</a></li>


                                            <li>
                                            <a href="/livros-lote?<?php echo $lote;?>" class="fabrik_edit fabrik__rowlink btn-default buttonAction" onclick="gerarCapaMole('<?php echo $identificadorCapaMole;?>')" title="Gerar capa mole" imgCapaCrop="<?php echo $row->capa_crop;?>" aluno="<?php echo $row->nomeAluno;?>" titulo="<?php echo $row->titulo;?>" cor="<?php echo $row->modeloLivro;?>" codBarraCapaMole="<?php echo $codbarraCapaMole?>" quantidadecapaMole="<?php echo $quantidadeCapaMole;?>" numerosCapaMole="<?php echo $numerosCapaMole?>" id="<?php echo $identificadorCapaMole;?>">

                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar capa mole</a></li>


                                        <li><a href="/livros-lote?<?php echo $lote;?>" onclick="gerarMioloCapaDura('<?php echo $identificadorMioloCapaDura;?>')" class="js-3 listplugin buttonAction" title="Gerar miolo" titulo="<?php echo $row->titulo;?>" aluno="<?php echo $row->nomeAluno;?>" professor="<?php echo $row->professor;?>" codLivro="<?php echo $row->cod_livro;?>" cor="<?php echo $row->modeloLivro;?>" dedicatoriaTitulo="<?php echo $row->tituloLivro;?>" dedicatoriaTexto="<?php echo $row->dedicatoriaLivro;?>" dedicatoriaAssinatura="<?php echo $row->assinaturaLivro;?>" biografiaAluno="<?php echo $row->nomeAluno;?>" biografiaTexto="<?php echo $row->biografia;?>" texto1="<?php echo $row->texto_1;?>" texto2="<?php echo $row->texto_2;?>" texto3="<?php echo $row->texto_3;?>" texto4="<?php echo $row->texto_4;?>" texto5="<?php echo $row->texto_5;?>" texto6="<?php echo $row->texto_6;?>" ilustracao1="<?php echo $row->ilustracao_1_crop;?>" ilustracao2="<?php echo    $row->ilustracao_2_crop;?>" ilustracao3="<?php echo $row->ilustracao_3_crop;?>" ilustracao4="<?php echo $row->ilustracao_4_crop;?>" ilustracao5="<?php echo $row->ilustracao_5_crop;?>" ilustracao6="<?php echo $row->ilustracao_6_crop;?>" alunoImg="<?php echo $row->foto_autor_crop;?>" numerosMioloCapaDura="<?php echo $numerosCapaDura?>" codBarraMioloCapaDura="<?php echo $codBarraMioloCapaDura?>" quantidademiolo="<?php echo $quantidadeMioloCapaDura;?>" id="<?php echo $identificadorMioloCapaDura;;?>">
                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar miolo - Capa Dura</a></li>
                                        
                                        
                                        <li><a href="/livros-lote?<?php echo $lote;?>" onclick="gerarMioloCapaMole('<?php echo $identificadorMioloCapaMole;?>')" class="js-3 listplugin buttonAction" title="Gerar miolo" titulo="<?php echo $row->titulo;?>" aluno="<?php echo $row->nomeAluno;?>" professor="<?php echo $row->professor;?>" codLivro="<?php echo $row->cod_livro;?>" cor="<?php echo $row->modeloLivro;?>" dedicatoriaTitulo="<?php echo $row->tituloLivro;?>" dedicatoriaTexto="<?php echo $row->dedicatoriaLivro;?>" dedicatoriaAssinatura="<?php echo $row->assinaturaLivro;?>" biografiaAluno="<?php echo $row->nomeAluno;?>" biografiaTexto="<?php echo $row->biografia;?>" texto1="<?php echo $row->texto_1;?>" texto2="<?php echo $row->texto_2;?>" texto3="<?php echo $row->texto_3;?>" texto4="<?php echo $row->texto_4;?>" texto5="<?php echo $row->texto_5;?>" texto6="<?php echo $row->texto_6;?>" ilustracao1="<?php echo $row->ilustracao_1_crop;?>" ilustracao2="<?php echo $row->ilustracao_2_crop;?>" ilustracao3="<?php echo $row->ilustracao_3_crop;?>" ilustracao4="<?php echo $row->ilustracao_4_crop;?>" ilustracao5="<?php echo $row->ilustracao_5_crop;?>" ilustracao6="<?php echo $row->ilustracao_6_crop;?>" alunoImg="<?php echo $row->foto_autor_crop;?>" numerosMioloCapaMole="<?php echo $numerosCapaMole?>" codBarraMioloCapaMole="<?php echo $codBarraMioloCapaMole?>" quantidademiolo= "<?php echo $quantidadeMioloCapaMole;?>" id="<?php echo $identificadorMioloCapaMole;?>">
                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar miolo - Capa Mole</a></li>
                                        
                                         <li></li>
                                        
                                    </ul>
                                

                                </div>

                                <?php
                                        }
                                    ?>

                                <?php
                                        if ($quantidadeCapaDura>0 && $quantidadeCapaMole=='') {

                                    ?>

                                <div class="fabrik_action dropdownLote  pull-right">

                                    <a href="/livros-lote?<?php echo $lote;?>" class="btn  rounded-pill btn-danger shadow-sm" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fas fa-bars" aria-hidden="true"></i> </a>

                                    <ul class="dropdown-menu loteCapaDura" x-placement="bottom-start" style="position: absolute; transform: translate3d(-24px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

                                        <li>
                                            <a href="/livros-lote?<?php echo $lote;?>" class="fabrik_edit fabrik__rowlink btn-default buttonAction" onclick="gerarCapaDura('<?php echo $identificadorCapaDura;?>')" title="Gerar capa dura" imgCapaCrop="<?php echo $row->capa_crop;?>" alunoCapaDura="<?php echo $row->nomeAluno;?>" titulo="<?php echo $row->titulo;?>" cor="<?php echo $row->modeloLivro;?>" codBarraCapaDura="<?php echo $codbarraCapaDura?>" numerosCapaDura="<?php echo $numerosCapaDura?>"
                                            quantidadeCapaDura= "<?php echo $quantidadeCapaDura;?>" id="<?php echo $identificadorCapaDura;?>">

                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar capa dura</a></li>



                                        <li><a href="/livros-lote?<?php echo $lote;?>" onclick="gerarMioloCapaDura('<?php echo $identificadorMioloCapaDura;?>')" class="js-3 listplugin buttonAction" title="Gerar miolo" titulo="<?php echo $row->titulo;?>" aluno="<?php echo $row->nomeAluno;?>" professor="<?php echo $row->professor;?>" codLivro="<?php echo $row->cod_livro;?>" cor="<?php echo $row->modeloLivro;?>" dedicatoriaTitulo="<?php echo $row->tituloLivro;?>" dedicatoriaTexto="<?php echo $row->dedicatoriaLivro;?>" dedicatoriaAssinatura="<?php echo $row->assinaturaLivro;?>" biografiaAluno="<?php echo $row->nomeAluno;?>" biografiaTexto="<?php echo $row->biografia;?>" texto1="<?php echo $row->texto_1;?>" texto2="<?php echo $row->texto_2;?>" texto3="<?php echo $row->texto_3;?>" texto4="<?php echo $row->texto_4;?>" texto5="<?php echo $row->texto_5;?>" texto6="<?php echo $row->texto_6;?>" ilustracao1="<?php echo $row->ilustracao_1_crop;?>" ilustracao2="<?php echo $row->ilustracao_2_crop;?>" ilustracao3="<?php echo $row->ilustracao_3_crop;?>" ilustracao4="<?php echo $row->ilustracao_4_crop;?>" ilustracao5="<?php echo $row->ilustracao_5_crop;?>" ilustracao6="<?php echo $row->ilustracao_6_crop;?>" alunoImg="<?php echo $row->foto_autor_crop;?>" codBarraMioloCapaDura="<?php echo $codBarraMioloCapaDura?>" quantidademiolo= "<?php echo $quantidadeMioloCapaDura;?>" numerosMioloCapaDura="<?php echo $numerosCapaDura?>" id="<?php echo $identificadorMioloCapaDura;?>">
                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar miolo</a></li>



                                    </ul>

                                </div>


                                <?php

                                        }

                                    ?>



                                <?php

                                        if ($quantidadeCapaMole>0 && $quantidadeCapaDura=='') {



                                    ?>

                                <div class="fabrik_action dropdownLote  pull-right">

                                    <a href="/livros-lote?<?php echo $lote;?>" class="btn  rounded-pill btn-danger shadow-sm" data-toggle="dropdown" href="#" aria-expanded="false"><i class="fas fa-bars" aria-hidden="true"></i> </a>

                                    <ul class="dropdown-menu loteCapaMole" x-placement="bottom-start" style="position: absolute; transform: translate3d(-24px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">

                                        <li>
                                            <a href="/livros-lote?<?php echo $lote;?>" class="fabrik_edit fabrik__rowlink btn-default buttonAction" onclick="gerarCapaMole('<?php echo $identificadorCapaMole;?>')" title="Gerar capa mole" imgCapaCrop="<?php echo $row->capa_crop;?>" aluno="<?php echo $row->nomeAluno;?>" titulo="<?php echo $row->titulo;?>" cor="<?php echo $row->modeloLivro;?>" codBarraCapaMole="<?php echo $codbarraCapaMole?>" quantidadecapaMole="<?php echo $quantidadeCapaMole;?>" numerosCapaMole="<?php echo $numerosCapaMole?>" id="<?php echo $identificadorCapaMole;?>">

                                                <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar capa mole</a></li>
                                        

                                            
                                            
                                            <li><a href="/livros-lote?<?php echo $lote;?>" onclick="gerarMioloCapaMole('<?php echo $identificadorMioloCapaMole;?>')" class="js-3 listplugin buttonAction" title="Gerar miolo" titulo="<?php echo $row->titulo;?>" aluno="<?php echo $row->nomeAluno;?>" professor="<?php echo $row->professor;?>" codLivro="<?php echo $row->cod_livro;?>" cor="<?php echo $row->modeloLivro;?>" dedicatoriaTitulo="<?php echo $row->tituloLivro;?>" dedicatoriaTexto="<?php echo $row->dedicatoriaLivro;?>" dedicatoriaAssinatura="<?php echo $row->assinaturaLivro;?>" biografiaAluno="<?php echo $row->nomeAluno;?>" biografiaTexto="<?php echo $row->biografia;?>" texto1="<?php echo $row->texto_1;?>" texto2="<?php echo $row->texto_2;?>" texto3="<?php echo $row->texto_3;?>" texto4="<?php echo $row->texto_4;?>" texto5="<?php echo $row->texto_5;?>" texto6="<?php echo $row->texto_6;?>" ilustracao1="<?php echo $row->ilustracao_1_crop;?>" ilustracao2="<?php echo $row->ilustracao_2_crop;?>" ilustracao3="<?php echo $row->ilustracao_3_crop;?>" ilustracao4="<?php echo $row->ilustracao_4_crop;?>" ilustracao5="<?php echo $row->ilustracao_5_crop;?>" ilustracao6="<?php echo $row->ilustracao_6_crop;?>" alunoImg="<?php echo $row->foto_autor_crop;?>" codBarraMioloCapaMole="<?php echo $codBarraMioloCapaMole?>" quantidademiolo= "<?php echo $quantidadeMioloCapaMole;?>" numerosMioloCapaMole="<?php echo $numerosCapaMole?>" id="<?php echo $identificadorMioloCapaMole;?>">
                                                
                                            <span data-isicon="true" class="fa fa-book"></span>
                                                Gerar miolo</a></li>

                                    </ul>

                                </div>


                                <?php
                                        }
                                    ?>

                            </div>

                        </div>
                    </div>
                </div>

                <?php }}?>
            </div>
        </div>
    </div>


    {/source}


    <script type="text/javascript" src="/templates/fabricadeletrinhas/js/gerarCapaDuraGrafica.js"></script>
    <script type="text/javascript" src="/templates/fabricadeletrinhas/js/gerarCapaMoleGrafica.js"></script>
    <script type="text/javascript" src="/templates/fabricadeletrinhas/js/gerarMioloCapaDuraGrafica.js"></script>
    <script type="text/javascript" src="/templates/fabricadeletrinhas/js/gerarMioloCapaMoleGrafica.js"></script>