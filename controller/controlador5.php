<?php
    include_once'../model/ProvaArea.php';
    include_once'../model/Questao.php';
    include_once'../model/Resposta.php';
    include_once'../model/Area.php';
    include_once'../model/Prova.php';
    include_once'../model/Dados.php';

    if (isset($_GET['prova']) AND is_numeric($_GET['prova'])) {
        
        $id_prova = (int) $_GET['prova']; 
        $objArea = new Area();
        $areaProva = $objArea->findArea($id_prova);
        //achei as areas da prova 
  
        if (isset($_GET['area']) AND is_numeric($_GET['area'])){
            
            $id_area = (int) $_GET['area'];
    
            if (isset($_GET['questao']) AND is_numeric($_GET['questao'])) {

                $id_questao = (int) $_GET['questao'];
                $objProva = new Prova();
                $provaCompleta = $objProva->findAll($id_prova, $id_area, $id_questao);
                $provaArea = $objProva->selectProvaArea($id_prova, $id_area);

                //Agora descobre os ids das questões que estão na área selecionada
                $objIdQuestoes = new Prova();
                $idsQuestoes = $objIdQuestoes->criarSequenciaQuestoes($id_prova, $id_area);
              // var_dump($idsQuestoes);die();
             // $proximaQuestao = next($idsQuestoes);
             // $_SESSION['questoesArea'] = $idsQuestoes;
                $objFeed = new Questao();
                $feed = $objFeed->findFeedback($id_questao);
                $feedback = $feed->feedback;
               
            }
        }
    }
    #####################################################################
    #####################################################################
    
   // session_start();
   // $id_usuario = $_SESSION['id_usuario'];
    //$qtd_respondida =$objDados->select($id_usuario);
  //  */
    #####################################################################
    // verificando se resposta esta correta ou errada
    #####################################################################
    if (isset($_GET['flag']) && $_GET['flag'] == 'verificaResposta') {
        $objDados = new Dados();
        session_start();
        $id_usuario = $_SESSION['id_usuario'];
        $id_resposta = $_GET['id_resposta'];
        $id_questao = $_GET['id_questao'];
        $id_area = $_GET['id_area'];
        # Busco o nome da área 
        $objArea = new Area();
        $x = $objArea->select($id_area);
        $nome_area = $x->nome_area;
        # Busco a resposta correta
        $objVerificador = new Prova();
        $respostaCerta = $objVerificador->findRespostaCerta($id_questao);
        
        $retorno = $respostaCerta->id_resposta;

        //$cont = $objDados->select($id_usuario);
        # Faço a verificação
        if ($id_resposta == $respostaCerta->id_resposta) {
            $acerto = 1;
            $qtd_respondida = 1;
           
            $objDados->setAcerto($acerto);
            $objDados->setQtdRespondida($qtd_respondida);
            $objDados->setIdUsuario($id_usuario);
            $objDados->setIdArea($id_area);
            $objDados->setNomeArea($nome_area);
            $objDados->setIdQuestao($_GET['id_questao']);
            $objDados->insertAcerto();

        
        } else {
            $erro = 1;
            $qtd_respondida = 1;
            
            $objDados->setErro($erro);
            $objDados->setQtdRespondida($qtd_respondida);
            $objDados->setIdUsuario($id_usuario);
            $objDados->setIdArea($id_area);
            $objDados->setIdQuestao($_GET['id_questao']);
            $objDados->setNomeArea($nome_area);
            $objDados->insertErro();
             
        } 

        echo $respostaCerta->id_resposta;   
    }   

    

    #########################################################################
    #########################################################################   
    // teste junção de prova e area.
    if (isset($_GET['flag']) && $_GET['flag'] == 'inserirQuestaoCompleta') {
    	$provaArea = new ProvaArea();
        $id_usuario = $_POST['id_usuario'];
        $id_prova = $_POST['id_prova'];
        $id_area = $_POST['id_area'];    
      //  print_r($id_area);print_r($id_prova);die();
    	$provaArea->setId_Prova($id_prova);
    	$provaArea->setId_Area($id_area);
        $provaArea->setIdUsuario($id_usuario);
    	$provaArea->insert();
        $retorno = $provaArea->select($id_prova, $id_area);
        $id_prova_area = $retorno->id_prova_area; // retornando o id em q inseri provaArea e ja insiro de novo na model questao
  
        $objQuestao = new Questao();

        $questao = $_POST['questao'];
        $feedback = $_POST['feedback'];
        $objQuestao->setFeedback($feedback);
        $objQuestao->setIdProvaArea($id_prova_area);
        $objQuestao->setQuestao($questao);
    
        $x = $objQuestao->insert();
        $id_questao1 = $objQuestao->selectLastInsertId();
        $id_questao = $id_questao1->id_questao;

        $objResposta = new Resposta();
        $respostaCERTA = $_POST['status'];

        $status = 0; 
        if($respostaCERTA == 'a'){
            $status = 1; 
        }
        $resposta = $_POST['resposta1'];
        $objResposta->setStatus($status);
        $objResposta->setResposta($resposta);
        $objResposta->setIdQuestao($id_questao);
        $objResposta->insert();

        $status = 0;    
        if($respostaCERTA == 'b'){
            $status = 1; 
        }

        $resposta = $_POST['resposta2'];
        $objResposta->setStatus($status);
        $objResposta->setResposta($resposta);
        $objResposta->setIdQuestao($id_questao);
        $objResposta->insert();

        $status = 0; 
        if($respostaCERTA == 'c'){
            $status = 1;     
        }
        $resposta = $_POST['resposta3'];
        $objResposta->setStatus($status);
        $objResposta->setResposta($resposta);
        $objResposta->setIdQuestao($id_questao);
        $objResposta->insert();

        $status = 0; 
        if($respostaCERTA == 'd'){             
            $status = 1; 
        }
        $resposta = $_POST['resposta4'];
        $objResposta->setStatus($status);
        $objResposta->setResposta($resposta);
        $objResposta->setIdQuestao($id_questao);
        $objResposta->insert();

        $status = 0; 
        

        //header('location: ../view/adminQuestao.php');
    }
    // excluir prova sem uso
    if (isset($_POST['flag']) && $_POST['flag'] == 'excluir') {
        $provaArea = new ProvaArea();
    	$id_prova_area = $_POST['id'];
    	$provaArea->delete($id_prova_area);
    	
    } 
    
    $objDados = new Dados();

