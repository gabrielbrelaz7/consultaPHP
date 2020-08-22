<!--AQUI ESTÁ O CÓDIGO DA CARTA PARA O RESPONSÁVEL QUE ESTÁ DENTRO DE VISUALIZAÇÕES (VIEWS) DENTRO DO SISTEMA ADMINISTRADOR DO JOOMLA-->

{source 0}

<?php       

                setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');

                    $url_atual = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
                    $url_turma = explode('?', $url_atual);    
                    $decode = $url_turma[1];
                    $id = $url_turma[2];

                    $turma = rawurldecode($decode);

                    $query = "SELECT *
                                FROM app_livros 
                                INNER JOIN app_turmas 
                                ON app_livros.turma_livro = app_turmas.id
                                INNER JOIN app_projetos 
                                ON  app_livros.projeto_id = app_projetos.id
                                INNER JOIN app_escolas
                                ON app_livros.escola_id = app_escolas.id
                                INNER JOIN app_alunos
                                ON app_livros.cod_aluno_livro = app_alunos.cod
                                WHERE turma_livro = '$turma'
                                AND app_livros.projeto_id = '$id'";

                    $database->setQuery($query);


                    ?>

<div class="Lista_Alunos">

    <div class="Page Page_ListagemAlunos __is-active">
        <div class="Page_Content">
            <div class="Block Block_ListagemAlunos">
                <div class="Block_ListagemAlunos_Header">
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
                    <div class="ListagemAlunos_Title_Item">
                        Alunos e Livros cadastrados por turma e evento
                    </div>

                    <button onclick="printCartas()" nome="<?php echo $row->nome;?>" turma="<?php echo $row->turmas;?>" cod="<?php echo $row->cod_livro;?>" evento="<?php echo $row->nome_evento;?>" dt_evento="<?php echo $evento;?>" dt_compra="<?php echo $data_compra;?>" professor="<?php echo $row->professor_livros;?>" matricula="<?php echo $row->matricula;?>" chamada="<?php echo $row->chamada;?>" escola="<?php echo $row->nome;?>" class="Button Button_Positive Button_Solid gerarCartas">
                        <div class="Button_Content">
                            <div class="Button_Content_Label">
                                Gerar todas as cartas
                            </div>
                        </div>
                    </button>
                </div>

                <div class="ResumoLista">

                    <?php

                    if( $rows = $database->loadObjectList() )
                    {
                        foreach( $rows as $row )
                    {

                        $nome = $row->nome;      
                        $inicial = substr($nome,0,1);
                        $identificador = $row->cod_livro;    
                            
                        
                        // Tratando encoding de caracteres 
                            
                        $eventoData = strftime('%d de %B de %Y', strtotime($row->dt_evento));
                        $evento = utf8_encode($eventoData);         
                            
                            
                        $dataCompra = strftime('%d de %B de %Y', strtotime('-38 days',strtotime($row->dt_evento)));
                        $data_compra = utf8_encode($dataCompra);         
                
                    ?>

                    <div class="ResumoLista_Item">
                        <div class="ResumoLista_Item_Content">
                            <div class="Item_Content_Titulo __is-name">
                                <div class="Content_Titulo_Letra">
                                    <?php echo $inicial ?>
                                </div>
                                <?php echo $row->nome;?>
                            </div>
                            <div class="Item_Content_Padrao">
                                Turma: <span><?php echo $row->turmas;?></span>
                            </div>
                            <div class="Item_Content_Padrao">
                                CÓD do Livro:<span> <?php echo $row->cod_livro;?></span>
                            </div>
                        </div>
                        <div class="ResumoLista_Item_Action">
                            <button onclick="printCarta(<?php echo $identificador;?>)" nome="<?php echo $row->nome;?>" turma="<?php echo $row->turmas;?>" cod="<?php echo $row->cod_livro;?>" evento="<?php echo $row->nome_evento;?>" dt_evento="<?php echo $evento?>" dt_compra="<?php echo $data_compra;?>" professor="<?php echo $row->professor_livros;?>" matricula="<?php echo $row->matricula;?>" chamada="<?php echo $row->chamada;?>" escola="<?php echo $row->nome;?>" id="<?php echo $identificador;?>" name="printCarta" class="Button Button_Positive Button_Solid">
                                <div class="Button_Content">
                                    <div class="Button_Content_Label">
                                        Gerar carta individual
                                    </div>
                                </div>
                            </button>

                        </div>
                    </div>

                    <?php
                            }
                            }
                            ?>
                </div>
            </div>
        </div>
    </div>
</div>

{/source}

<script>
    function printCarta(info) {

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


        //            console.log(nome);
        //            console.log(turma);
        //            console.log(cod);
        //            console.log(data_compra);
        //            console.log(professor);
        //            console.log(matricula);
        //            console.log(chamada);
        //            console.log(escola);
        //            console.log(data_evento);
        //        

        var logo = new Image();
        logo.src = logotipo;
        //            console.log(logo)

        var texto1 =

            `
    Prezado responsável,

    Informamos que o livro do(a) autor(a) ${nome} está pronto e disponível 
    para compra!

    Para visualizar esta obra de arte, acesse: 
    
    FABRICADELETRINHAS.CRIANDOHISTORIAS.COM  
    
    E informe o código do livro abaixo:

    `;

        var texto2 =

            `

    ${cod}

    `;

        var texto3 =

            `

    O lançamento deste livro será no evento ${evento}, 
    que acontecerá no dia ${data_evento} e por isso você deve garantir o seu exemplar  
    até o dia ${data_compra}.

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
            format: 'a5'
        })

        //Logotipo 
        doc.addImage(logo, 'PNG', 4.90, 1.4, 5, 3);
        doc.setLineHeightFactor(1.2);
        doc.setFont('calibri', 'normal');

        //Parte 1 do texto 
        doc.setFontSize(8.92);
        doc.text(texto1, 1.55, 5.0);

        //Parte 2 do texto     
        doc.setFontStyle('bold');
        doc.setFontSize(10.4);
        doc.text(texto2, 6.05, 8.82);

        //Parte 3 do texto 
        doc.setLineHeightFactor(1.5);
        doc.setFontStyle('normal');
        doc.setFontSize(8.92);
        doc.text(texto3, 1.55, 9.62);

        // Salvar PDF    
        doc.save(nome + '_Carta.pdf')


    }

    function printCartas() {

        var elemento = document.getElementsByName("printCarta");
        var contador = elemento.length;

        var doc = new jsPDF({
            orientation: 'portrait',
            unit: 'cm',
            format: 'a5'
        })


        for (var i = 0; i < contador; i++) {

            var info = elemento.item(i);


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

            //                console.log(nome);
            //                console.log(turma);
            //                console.log(cod);
            //                console.log(data_evento);
            //                console.log(data_compra);
            //                console.log(professor);
            //                console.log(matricula);
            //                console.log(chamada);
            //                console.log(escola);

            var logo = new Image();
            logo.src = logotipo;
            //                console.log(logo)

            var texto1 =

                `
    Prezado responsável,

    Informamos que o livro do(a) autor(a) ${nome} está pronto e disponível 
    para compra!

    Para visualizar esta obra de arte, acesse: 

    FABRICADELETRINHAS.CRIANDOHISTORIAS.COM, 
    
    E informe o código do livro abaixo:

    `;

            var texto2 =

                `

    ${cod}

    `;

            var texto3 =

                `

    O lançamento deste livro será no evento ${evento}, 
    que acontecerá no dia ${data_evento} e por isso você deve garantir o seu exemplar  
    até o dia ${data_compra}.

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

            //Logotipo 
            doc.addImage(logo, 'PNG', 4.90, 1.4, 5, 3);
            doc.setLineHeightFactor(1.2);
            doc.setFont('calibri', 'normal');


            //Parte 1 do texto 
            doc.setFontSize(8.92);
            doc.text(texto1, 1.55, 5.0);

            //Parte 2 do texto     
            doc.setFontStyle('bold');
            doc.setFontSize(10.4);
            doc.text(texto2, 6.05, 8.82);

            //Parte 3 do texto 
            doc.setLineHeightFactor(1.5);
            doc.setFontStyle('normal');
            doc.setFontSize(8.92);
            doc.text(texto3, 1.55, 9.62);


            doc.addPage()

        }

        // Salvar PDF    
        doc.save('Turma' + turma + '_Cartas.pdf')

    }
</script>