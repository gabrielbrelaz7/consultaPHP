     {source 0}


     <?php

        
        // Pegando URL atual e selecionando somente o domínio da url atual

        $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $elementos = parse_url($url);

        $host = $elementos['host'];
        $porta = $elementos['port']; 

    ?>


     <?php if($user->groups[10]==10) : ?>


     <div class="Page Page_Home __is-active">

         <div class="Block Block_AcessoRapido">
             <div class="Block_Title">
                 <div class="Block_Title_Label">
                     Acesso Rápido
                 </div>
                 <div class="Block_Title_Description">Encontre as principais funcionalidades disponível para gerenciar suas turmas, alunos, eventos e livros.</div>
             </div>
             <div class="Block_Content">
                 <div class="Block_AcessoRapido_Lista">

                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="far fa-object-group"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Nova Turma
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para iniciar o cadastro de uma nova turma.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="/turmas">

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Começar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>
                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-graduation-cap"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Novo Aluno
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para iniciar o cadastro de um novo aluno.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="alunos">
                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Começar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>
                             </a>
                         </div>
                     </div>

                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fas fa-store-alt"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Criar Evento
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para iniciar o cadastro de um novo evento.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="/eventos">
                                 <button class="Button Button_Primary Button_Solid">

                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Começar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>

                                 </button>
                             </a>
                         </div>
                     </div>

                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-book"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Novo Livro
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para iniciar o cadastro de livros de cada aluno.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="/livros">

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Começar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>



                 </div>


                 <!--Linha 2 do menu Acesso Rápido-->


                 <div class="Block_AcessoRapido_Lista">

                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-paste"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Ficha do Livro
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para baixar a ficha de desenhos/textos.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a target="_blank" href="images/Fichas/ficha_livro.pdf" download>

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Baixar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>


                     <!--
                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-book"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Ficha do Modelo Laranja
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para baixar a ficha de desenhos/texto.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="/livros">

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Baixar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>
-->

                     <!--
                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-book"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Ficha do Modelo Rosa
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para baixar a ficha de desenhos/texto.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a href="/livros">

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Baixar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>
-->

                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="fa fa-paste"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Manual de Preenchimento
                         </div>
                         <div class="Lista_Item_Descricao">
                             Acesse esta opção para baixar o manual de preenchimento da ficha.
                         </div>
                         <div class="Lista_Item_Botao">

                             <a target="_blank" href="images/Fichas/ficha_livro.pdf" download>

                                 <button class="Button Button_Primary Button_Solid">
                                     <div class="Button_Content">
                                         <div class="Button_Content_Label">
                                             Baixar agora
                                         </div>
                                         <div class="Button_Content_Icon">
                                             <i class="fas fa-chevron-right"></i>
                                         </div>
                                     </div>
                                 </button>

                             </a>

                         </div>
                     </div>

                 </div>




             </div>
         </div>
     </div>

     <?php endif; ?>


     <?php if($user->groups[8]==8) : ?>

     <div class="Page Page_Home __is-active">

         <div class="Block Block_AcessoRapido">
             <div class="Block_Title">
                 <div class="Block_Title_Label">
                     Acesso Rápido
                 </div>
                 <div class="Block_Title_Description">Encontre as principais funcionalidades disponível para gerenciamento de pedidos e lotes.</div>
             </div>
             <div class="Block_Content">
                 <div class="Block_AcessoRapido_Lista">


                     <!--Tratando links para endpoints dinamicamente-->

                     <?php 
                     
                     
                     if($host == 'fabricadeletrinhas.dev.local.com.br') { 
    
                        $linkGerarRA = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/parceiro/pedido/ra';
                        $linkGerarLotes = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/lote/evento?forceData=true';
                        $linkEnviarLotes = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/parceiro/lote';
                         
                     }
                     
                     
                     if($host == 'painel-fabricadeletrinhas.dev.marlin.net') { 
    
                        $linkGerarRA = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/parceiro/pedido/ra';
                        $linkGerarLotes = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/lote/evento?forceData=true';
                        $linkEnviarLotes = 'http://api-fabricadeletrinhas.dev.marlin.net/api/V1/parceiro/lote';
                         
                     }
                     
                       if($host == 'painel-fabricadeletrinhas.hmg.marlin.com.br') { 
    
                        $linkGerarRA = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/parceiro/pedido/ra';
                        $linkGerarLotes = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/lote/evento?forceData=true';
                        $linkEnviarLotes = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/parceiro/lote';
                         
                     }
                     
                     
                       if($host == 'painel-fabricadeletrinhas.criandohistorias.com') { 
    
                        $linkGerarRA = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/parceiro/pedido/ra';
                        $linkGerarLotes = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/lote/evento?forceData=true';
                        $linkEnviarLotes = 'http://api-fabricadeletrinhas.hmg.marlin.com.br/api/V1/parceiro/lote';
                         
                     }
                              
                            
                    ?>


                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="far fa-calendar-alt"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Gerar RA
                         </div>
                         <div class="Lista_Item_Descricao">
                             Clique nesta opção para iniciar o recebimento antecipado.
                         </div>
                         <div class="Lista_Item_Botao">


                             <a class="Button Button_Primary Button_Solid" target="_blank" href="<?php echo $linkGerarRA ?>">


                                 <div class="Button_Content">
                                     <div class="Button_Content_Label">
                                         Gerar
                                     </div>
                                     <div class="Button_Content_Icon">
                                         <i class="fas fa-chevron-right"></i>
                                     </div>
                                 </div>
                             </a>

                         </div>
                     </div>




                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="far fa-calendar-alt"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Gerar Lotes
                         </div>
                         <div class="Lista_Item_Descricao">
                             Clique nesta opção para separar os lotes dentro de cada pedido.
                         </div>
                         <div class="Lista_Item_Botao">


                             <a class="Button Button_Primary Button_Solid" target="_blank" href="<?php echo $linkGerarLotes ?>">



                                 <div class="Button_Content">
                                     <div class="Button_Content_Label">
                                         Gerar
                                     </div>
                                     <div class="Button_Content_Icon">
                                         <i class="fas fa-chevron-right"></i>
                                     </div>
                                 </div>
                             </a>

                         </div>
                     </div>


                     <div class="AcessoRapido_Lista_Item">
                         <div class="Lista_Item_Icone">
                             <i class="far fa-calendar-alt"></i>
                         </div>
                         <div class="Lista_Item_Titulo">
                             Enviar Lotes
                         </div>
                         <div class="Lista_Item_Descricao">
                             Clique nesta opção para enviar os lotes para o Protheus.
                         </div>
                         <div class="Lista_Item_Botao">


                             <a class="Button Button_Primary Button_Solid" target="_blank" href="<?php echo $linkEnviarLotes ?>">


                                 <div class="Button_Content">
                                     <div class="Button_Content_Label">
                                         Gerar
                                     </div>
                                     <div class="Button_Content_Icon">
                                         <i class="fas fa-chevron-right"></i>
                                     </div>
                                 </div>
                             </a>

                         </div>
                     </div>

                 </div>
             </div>
         </div>
     </div>

     <?php endif; ?>


     <!-- Seção de Detalhes do Evento 
        Acesso da escola e super usuário
    !-->

     <?php

        if($user->groups[10]==10 || $user->groups[8]==8) {

         setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

         $user = JFactory::getUser();

        if ($user->groups[8]==8) {

         $query = "SELECT * FROM `app_projetos`";
         $database->setQuery($query);

        }

        else {

         $query = "SELECT * FROM `app_projetos` WHERE escola_id = (SELECT escola_id FROM `app_usuarios` WHERE user_id = {$user->id})";
         $database->setQuery($query);

        }

     ?>

     <div class="Detalhes_Eventos">


         <div class="Page Page_Eventos __is-active">

             <div class="Block Block_ProgramacaoEventos">
                 <div class="Block_Title">
                     <div class="Block_Title_Label">
                         Detalhes dos Eventos
                     </div>
                     <div class="Block_Title_Description">Imprima as cartas para os alunos participantes de cada evento e turma.</div>
                 </div>

                 <?php

                if( $rows = $database->loadObjectList() )
                {
                    foreach( $rows as $row )
                {

                ?>

                 <div class="Block_Content">
                     <div class="Block_ProgramacaoEventos_Lista">
                         <div class="ProgramacaoEventos_Lista_Evento">

                             <div class="Lista_Evento_Chamada">
                                 <div class="Evento_Chamada_Titulo">

                                     <span><?php echo utf8_encode(strftime('%d de %B de %Y',(strtotime($row->dt_evento))));?></span>
                                     <?php echo $row->nome_evento;?>

                                 </div>
                                 <div class="Evento_Chamada_Botao">
                                     <a href="/turmas-participantes?<?php echo $row->id;?>">
                                         <button class="Button Button_Primary Button_Solid">
                                             <div class="Button_Content">
                                                 <div class="Button_Content_Label">
                                                     Ver turmas participantes
                                                 </div>
                                                 <div class="Button_Content_Icon">
                                                     <i class="fas fa-chevron-right"></i>
                                                 </div>
                                             </div>
                                         </button>
                                     </a>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>

                 <?php }}?>

             </div>
         </div>
     </div>

     <?php } ?>



     <!-- Seção de Lotes para Gráfica
        Acesso da grafica 
    !-->

     <?php

        if($user->groups[6]==6) {

         setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

         $user = JFactory::getUser();

        if ($user->groups[6]==6) {

         $query = "
         
            SELECT codigo,
            app_projetos.nome_evento,
            app_escolas.nome,
            app_projetos.dt_evento
            FROM e_lotes 

            INNER JOIN app_projetos     
            ON e_lotes.idEvento = app_projetos.id

            INNER JOIN app_escolas     
            ON app_projetos.escola_id = app_escolas.id
        
            ";
            
            $database->setQuery($query);
            
        }

        else {

         $query = "SELECT * FROM `app_projetos` WHERE escola_id = (SELECT escola_id FROM `app_usuarios` WHERE user_id = {$user->id})";
         $database->setQuery($query);

        }

     ?>

     <div class="Detalhes_Eventos">

         <div class="Page Page_Eventos __is-active">

             <div class="Block Block_ProgramacaoEventos">
                 <div class="Block_Title">
                     <div class="Block_Title_Label">
                         Lotes para Impressão
                     </div>
                     <div class="Block_Title_Description">Veja abaixo todos os lotes disponíveis por turmas e evento.</div>
                 </div>

                 <?php
            
            

                if( $rows = $database->loadObjectList() )
                {
                    
                   
                    foreach( $rows as $row )
                
                {
                            
                        
                $loteAtual = $row->codigo;       
                        
                        
                $queryQuantidadeLote = "
                
                SELECT 
               	SUM(e_pedidos_itens.quantidade) as quantidadeTotal
                
                FROM e_lotes 

                INNER JOIN e_lote_item
                ON e_lotes.id = e_lote_item.idLote

                INNER JOIN  e_pedidos_itens     
                ON e_lote_item.idItemPedido = e_pedidos_itens.id

                INNER JOIN  e_produtos     
                ON e_pedidos_itens.e_produto_id = e_produtos.id

                INNER JOIN e_pedidos   
                ON e_pedidos_itens.e_pedido_id = e_pedidos.id
                
                WHERE e_lotes.codigo = '$loteAtual'
                
                ";
                    
                $db->setQuery($queryQuantidadeLote);     
                        
                $quantidadeTotalLote = $db->loadResult(); 
                    
                ?>

                 <div class="Block_Content">
                     <div class="Block_ProgramacaoEventos_Lista">
                         <div class="ProgramacaoEventos_Lista_Evento">

                             <div class="Lista_Evento_Chamada">
                                 <div class="Evento_Chamada_Titulo">

                                     <span>LOTE</span>
                                     <?php echo $row->codigo;?>

                                 </div>
                                 
                                <div class="Evento_Chamada_Titulo">

                                     <span>DATA DE ENTREGA</span>
                                     <?php echo utf8_encode(strftime('%d/%m/%y',strtotime('-1 days', (strtotime($row->dt_evento)))));?>

                                 </div>

                                 <div class="Evento_Chamada_Titulo">

                                     <span>ESCOLA</span>
                                     <?php echo $row->nome;?>

                                 </div>


                                 <div class="Evento_Chamada_Titulo">

                                     <span>EVENTO</span>
                                     <?php echo $row->nome_evento;?>

                                 </div>


                                 <div class="Evento_Chamada_Titulo">

                                     <span>QUANTIDADE DE IMPRESSÕES</span>
                                     <?php echo $quantidadeTotalLote;?>

                                 </div>



                                 <div class="Evento_Chamada_Botao">
                                     <a href="/turmas-lote?<?php echo $row->codigo?>">
                                         <button class="Button Button_Primary Button_Solid">
                                             <div class="Button_Content">
                                                 <div class="Button_Content_Label">
                                                     Ver turmas participantes
                                                 </div>
                                                 <div class="Button_Content_Icon">
                                                     <i class="fas fa-chevron-right"></i>
                                                 </div>
                                             </div>
                                         </button>
                                     </a>
                                 </div>
                             </div>

                         </div>
                     </div>
                 </div>

                 <?php
                
                }}?>

             </div>
         </div>
     </div>

     <?php } ?>

     {/source}