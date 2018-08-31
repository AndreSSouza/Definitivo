<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Chamada</title>
    <link rel="stylesheet" type="text/css" href="../professor/css/fazer_chamada.css"/>
    <link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />    
    <?php require '../conexao.php' ; ?>
</head>
<body>	
    <?php require "topo.php"; ?>
    <div id="caixa_preta"></div>

    <div id="box_curso">

        <?php if(!isset($_GET['buscar'])){ ?>

            <h1><center>Chamada: Selecione a Turma o Professor e dÃª "Buscar"</center></h1><br/>

            <form method="GET">		
                    <table>
                            <tr>
                                    <td>Selecione a Turma:</td>
                                    <td>
                                            <select name="turma" style="width:60px">
                                                    <?php $sql_resultado_consulta_turma = "SELECT * FROM turma WHERE nome_turma != '' ORDER BY nome_turma ASC";
                                                    $resultado_consulta_turma = mysqli_query($conexao, $sql_resultado_consulta_turma) or die(mysqli_error($conexao));
                                                    while($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma)){?>
                                                            <option value="<?php echo $valores_turma['id_turma']; ?>">
                                                                    <?php echo $valores_turma['nome_turma']; ?>
                                                            </option>
                                                    <?php } ?>
                                            </select>
                                    </td>
                                    <td>Selecione o Professor:</td>
                                    <td>
                                            <select name="professor">
                                                    <?php $sql_resultado_consulta_professor = "SELECT * FROM professor WHERE nome_professor != '' ORDER BY nome_professor ASC";
                                                    $resultado_consulta_professor = mysqli_query($conexao, $sql_resultado_consulta_professor) or die(mysqli_error($conexao));
                                                    while($valores_professor = mysqli_fetch_assoc($resultado_consulta_professor)){?>
                                                            <option value="<?php echo $valores_professor['id_professor']; ?>">
                                                                    <?php echo $valores_professor['nome_professor']; ?>
                                                            </option>
                                                    <?php } ?>
                                            </select>
                                    </td>
                                    <td>Data de Hoje:</td>
                                    <td>
                                            <input type="disabled" name="data_atual" value="<?php date_default_timezone_set("America/Sao_Paulo"); echo date('d/m/Y'); ?>" style="width:80px">
                                    </td>
                                    <td>						
                                            <input type="submit" name="buscar" value="Buscar" class="input" id="button">
                                    </td>
                            </tr>
                    </table>
            </form>
            <br/><br/>

    <?php }else{ ?>

            <?php $cod_turma = $_GET['turma'];	
            $cod_professor = $_GET['professor'];
            date_default_timezone_set("America/Sao_Paulo");
            $data_hoje_USA = date('Y-m-d');
            $data_hoje_BR = date('d-m-Y');

            $sql_resultado_consulta_nome_turma = "SELECT * FROM turma WHERE id_turma = '$cod_turma'";
            $resultado_consulta_nome_turma = mysqli_query($conexao, $sql_resultado_consulta_nome_turma) or die(mysqli_error($conexao));
            $valores_nome_turma = mysqli_fetch_assoc($resultado_consulta_nome_turma);
            $nome_turma = $valores_nome_turma['nome_turma'];

            $sql_resultado_consulta_nome_professor = "SELECT * FROM professor WHERE id_professor = '$cod_professor'";
            $resultado_consulta_nome_professor = mysqli_query($conexao, $sql_resultado_consulta_nome_professor) or die(mysqli_error($conexao));
            $valores_nome_professor = mysqli_fetch_assoc($resultado_consulta_nome_professor);
            $nome_professor = $valores_nome_professor['nome_professor']; ?>

            <h1><center>Chamada na Turma <strong><?php echo $nome_turma; ?></strong>, com o Professor(a) <strong><?php echo $nome_professor; ?></strong></center></h1><br/>

            <?php $select_nome_id_aluno = "SELECT m.id_aluno, i.nome_aluno FROM matricula m INNER JOIN aluno a ON a.id_aluno = m.id_aluno INNER JOIN inscricao i ON i.id_inscricao = a.id_inscricao INNER JOIN turma t ON t.id_turma = m.id_turma WHERE t.id_turma = '$cod_turma' ORDER BY i.nome_aluno ASC"; 
            $retorno_select_nome_id_aluno = mysqli_query($conexao, $select_nome_id_aluno) or die(mysqli_error($conexao));
            $numRows = mysqli_num_rows($retorno_select_nome_id_aluno);

            if($numRows == ''){
                echo "<h2><font color='#fff' size='2px'>Essa turma ainda nï¿½o possui alunos!</font></h2>";
            }else{
                $alunosId = null;
                $alunosNomes = null;
                while($row = mysqli_fetch_row($retorno_select_nome_id_aluno)){
                    //na row[0] estï¿½o todos os ids dos alunos da turma selecionada
                $alunosId .= $row[0]."|";
                $alunosNomes .= $row[1]."|";
            }
            //func para remover o ultimo caracter que nesse caso ï¿½ um espaï¿½o vazio
            $alunosId = substr($alunosId, 0, -1);
            //func que separa a string em um array apos cada pipe "|";
            $alunosId = explode("|", $alunosId);
            
            $alunosNomes = substr($alunosNomes, 0, -1);           
            $alunosNomes = explode("|", $alunosNomes);
            
            //for ($i = 0; $i < $numRows; $i++) {                            
                
                //while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){
                    //$cod_aluno = $resultado_consulta_matricula_valores['id_aluno'];
                    //$nome_aluno = $resultado_consulta_matricula_valores['nome_aluno'];?>

                    <form name="chamada" method="post" enctype="multipart/form-data" action="">
            <?php for ($i = 0; $i < $numRows; $i++) { ?>
                        <table width="955" border="0">
                            <tr>
                                <td width="94"><strong>Código:</strong></td>
                                <td width="450"><strong>Nome:</strong></td>
                                <td><strong><center>Selecione se este aluno faltou:</center></strong></td>
                            </tr>
                            <tr>
                                <td>
                                    <?php echo $alunosId[$i]; ?>
                                    <input type="hidden" name="" value="<?php echo $alunosId[$i]; ?>" >
                                </td>
                                <td>
                                    <?php echo $alunosNomes[$i]; ?>
                                    <input type="hidden" name="nome" value="<?php echo $alunosNomes[$i]; ?>" >
                                </td>
                                <td>
                                    <center>
                                        <?php echo "<input type='hidden' name='status[$i]' value='1'/>";
                                        echo "<input type='checkbox' name='status[$i]' value='0'/>"; ?>
                                    </center>
                                </td>
                            </tr>
                        </table>
            <?php }// }?>
                        <table width="955" style="background-color: #2C82CE; border-color: #2C82CE">
                                <tr>
                                <td width="62">
                                                <center><input type="submit" name="guardar" id="button" class="input" value="Concluir"/></center>
                                        </td>								
                                </tr>								  							
                        </table>
                    </form>

                    <?php if(isset($_POST['guardar'])){
                        
                        date_default_timezone_set("America/Sao_Paulo");
                        $data_hoje = date('Y-m-d'); 
                        $chamada_completa = "INSERT INTO chamada (id_turma, id_professor, data_chamada, id_aluno, presenca) VALUES";                                $x = 0;                        
                        foreach ($_POST['status'] as $falta){             
                            $chamada_completa .= " ('$cod_turma', '$cod_professor', '$data_hoje', '{$alunosId[$x]}', '{$falta}'),";
                            $x++;                            
                        }                                               
                        $chamada_completa = substr($chamada_completa, 0, -1); 
                        $retorno_chamada = mysqli_query($conexao, $chamada_completa) or die(mysqli_error($conexao));
                        if ($resultado_consulta_nome_professor) {
                            echo "<script language='javascript'>window.alert('Chamada Realizada com sucesso!');</script>";
                        } else {
                            echo "<script language='javascript'>window.alert('Houve um erro chamada não realizada!');</script>";
                        }                    
                    } ?>		
            <?php } ?>
	<?php } ?>
										
	</div>

	<?php require "rodape.php"; ?>
</body>
</html>