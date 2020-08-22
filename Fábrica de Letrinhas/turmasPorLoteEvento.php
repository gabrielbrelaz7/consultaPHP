<!-- Seção de Turmas Participantes !-->

{source 0}

<?php

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                
        $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_cod = explode('?', $url_atual);    
        $lote = $url_cod[1];

      $query1 = "
                
                SELECT DISTINCT
                app_projetos.nome_evento,
                
                e_pedidos_itens.quantidade as quantidadeTotalLote,
                app_escolas.nome,
                app_turmas.turmas,
                app_turmas.id as idTurma
                
                FROM e_lotes 
                
                INNER JOIN app_projetos     
                ON e_lotes.idEvento = app_projetos.id

                INNER JOIN app_escolas     
                ON app_projetos.escola_id = app_escolas.id
                
                INNER JOIN app_projetos_repeat_turmas_evento     
                ON app_projetos.id = app_projetos_repeat_turmas_evento.parent_id
                
                INNER JOIN app_turmas     
                ON app_projetos.escola_id = app_turmas.escola_id

                LEFT JOIN e_lote_item
                ON e_lotes.id = e_lote_item.idLote

                LEFT JOIN  e_pedidos_itens     
                ON e_lote_item.idItemPedido = e_pedidos_itens.id

                LEFT JOIN  e_produtos     
                ON e_pedidos_itens.e_produto_id = e_produtos.id

                LEFT JOIN e_pedidos   
                ON e_pedidos_itens.e_pedido_id = e_pedidos.id
                    
                WHERE e_lotes.codigo = '$lote'
                
                AND e_lotes.idTurma = app_turmas.id
               
                GROUP BY app_turmas.turmas
                
            ";
        
            $database->setQuery($query1);
        
        ?>

<div class="Detalhes_Eventos Painel_Grafica">

         <div class="Page Page_Eventos __is-active">

             <div class="Block Block_ProgramacaoEventos">
                 
                 <div class="ListagemAlunos_Button_Voltar_Lotes">
                    <a href="/dashboard">
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
                         Turmas participantes
                     </div>
                     <div class="Block_Title_Description">Escolha abaixo uma turma participante neste lote e evento
                 </div>
                     
                     </div>
                     
                 </div>

                 <?php

                if( $rows = $database->loadObjectList() )
                {
                    foreach( $rows as $row )
                        
                
//                $loteAtual = $row->codigo;
////                $turmaAtual = $row->turmas;     
                                          
                        
                {

                ?>

                 <div class="Block_Content">
                     <div class="Block_ProgramacaoEventos_Lista">
                         <div class="ProgramacaoEventos_Lista_Evento">

                             <div class="Lista_Evento_Chamada">
                                 <div class="Evento_Chamada_Titulo">

                                     <span>ESCOLA</span>
                                     <?php echo $row->nome;?>

                                 </div>
                                 
                                <div class="Evento_Chamada_Titulo">

                                     <span>EVENTO</span>
                                     <?php echo $row->nome_evento;?>

                                 </div>

                                 <div class="Evento_Chamada_Titulo">

                                     <span>TURMA</span>
                                     <?php echo $row->turmas;?>

                                 </div>
                                 
<!--
                                 <div class="Evento_Chamada_Titulo">

                                     <span>QUANTIDADE DE IMPRESSÕES</span>

                                 </div>
-->
      
                                 <div class="Evento_Chamada_Botao">
                                     <a href="/livros-lote?<?php echo $lote;?>?<?php echo $row->idTurma;?>">
                                         <button class="Button Button_Primary Button_Solid">
                                             <div class="Button_Content">
                                                 <div class="Button_Content_Label">
                                                     Ver todos os livros 
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
   

{/source}


