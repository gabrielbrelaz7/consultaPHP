<!--AQUI ESTÁ O CÓDIGO DAS TURMAS PARTICIPANTES DOS EVENTOS NO PAINEL ESCOLA QUE ESTÁ DENTRO DE VISUALIZAÇÕES (VIEWS) DENTRO DO SISTEMA ADMINISTRADOR DO JOOMLA-->


{source 0}

<?php

    setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
                
        $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $url_cod = explode('?', $url_atual);    
        $id = $url_cod[1];


      $query = "SELECT * FROM app_projetos_repeat_turmas_evento  
            INNER JOIN app_turmas 
            ON app_projetos_repeat_turmas_evento.turmas_evento = app_turmas.id 
            WHERE app_projetos_repeat_turmas_evento.parent_id = $id";

      $database->setQuery($query);
                ?>

<div class="Turmas_Participantes">
    <div class="Page Page_Eventos __is-active">

        <div class="Block Block_ProgramacaoEventos">

            <div class="Block_ListagemTurmasParticipantes">

                <div class="ListagemAlunos_Button_Voltar">
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
                </div>

                <div class="Block_Title">
                    <div class="Block_Title_Label">
                        Turmas Participantes
                    </div>
                    <div class="Block_Title_Description">Veja abaixo todas as turmas participantes deste evento.
                    </div>

                </div>

            </div>

            <?php

                if($rows = $database->loadObjectList());
                {
                    foreach( $rows as $row )
                {

                ?>

            <div class="Block_Content">
                <div class="Block_ProgramacaoEventos_Lista">
                    <div class="ProgramacaoEventos_Lista_Evento">


                        <div class="Lista_Evento_Chamada">
                            <div class="Evento_Chamada_Titulo">
                                <span>Turma</span>
                                <?php echo $row->turmas;?>
                            </div>
                            <div class="Evento_Chamada_Botao">


                                <a href="/lista-alunos?<?php echo $row->turmas_evento;?>?<?php echo $id;?>">
                                    <button class="Button Button_Primary Button_Solid">
                                        <div class="Button_Content">
                                            <div class="Button_Content_Label">
                                                Ver alunos participantes
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

                        }
                        }
                        ?>
        </div>
    </div>
</div>

{/source}


<script>
    function printCartas(info) {

        var nome = info.getAttribute('nome');
        var turma = info.getAttribute('turma');
        var cod = info.getAttribute('cod');
        var evento = info.getAttribute('evento');
        var data_evento = info.getAttribute('dt_evento');
        var data_compra = info.getAttribute('dt_compra');
        var professor = info.getAttribute('professor');
        var matricula = info.getAttribute('matricula');
        var chamada = info.getAttribute('chamada');
        var escola = info.getAttribute('escola');



        var logotipo = '/images/logotipo.png';

        //        console.log(nome);
        //        console.log(turma);
        //        console.log(cod);
        //        console.log(data_evento);
        //        console.log(data_compra);
        //        console.log(professor);
        //        console.log(matricula);
        //        console.log(chamada);
        //        console.log(escola); 

        var logo = new Image();
        logo.src = logotipo;
        //        console.log(logo)  

        var texto1 =

            `
        Prezado responsável,

        Informamos que o livro do(a) autor(a) ${nome} está pronto e disponível 
        para compra!

        Para visualizar esta obra de arte, acesse FABRICADELETRINHAS.COM.BR/LIVRO, 
        e informe o código do livro abaixo:

        `;

        var texto2 =

            `

        ${cod}

        `;

        var texto3 =

            `

        O lançamento deste livro será no evento ${evento}, que acontecerá no 
        dia ${data_evento} e por isso você deve garantir o seu exemplar até o dia 
        ${data_compra}.

        Ah, e lembre-se de que os livros comprados serão entregues na nossa escola e 
        você irá levá-los para a casa no dia do evento.

        Contamos com a sua participação!

        Att,
        ${professor}

        ----------------------------------------------------------------------------------------------------------

        ALUNO(A): ${nome}
        MATRÍCULA: ${matricula}
        TURMA: ${turma}
        NÚMERO: ${chamada}
        ESCOLA: ${escola}

        `;


        var doc = new jsPDF({
            orientation: 'portrait',
            unit: 'cm',
            format: 'a4'
        })

        //Logotipo 
        doc.addImage(logo, 'PNG', 4.38, 1.18, 12.2, 7.2);
        doc.setLineHeightFactor(1.2);
        doc.setFont('calibri', 'normal');

        //Parte 1 do texto 
        doc.setFontSize(12);
        doc.text(texto1, 3, 9);

        //Parte 2 do texto     
        doc.setFontStyle('bold');
        doc.setFontSize(14);
        doc.text(texto2, 9, 12.4);

        //Parte 3 do texto 
        doc.setLineHeightFactor(1.5);
        doc.setFontStyle('normal');
        doc.setFontSize(12);
        doc.text(texto3, 3, 13.4);

        // Salvar PDF    
        doc.save(nome + '_Carta.pdf')

    }
</script>