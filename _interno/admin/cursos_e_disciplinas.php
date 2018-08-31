<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Adminstração</title>
	<link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />
	<?php require "../conexao.php";?>
</head>

<body>
	<?php require "topo.php"; ?>
	
<!CADASTRAR TURMAS>

	<div id="caixa_preta">
	</div><!-- caixa_preta -->

	<?php if(@$_GET['pg'] == 'turma'){ ?>
		<div id="box_curso">
			
<!VISUALIZAR ALUNOS DA TURMA ESCOLHIDA>
		
			<?php if(@$_GET['visualizar'] == 'sim'){?>
				
				<?php $cod_turma = $_GET['turma'];
				$select_atribs_turma = "SELECT * FROM turma WHERE id_turma = '$cod_turma'";
				$sql_select_atribs_turma = mysqli_query($conexao, $select_atribs_turma)or die(mysqli_error($conexao));
				$select_atribs_turma_valores = mysqli_fetch_assoc($sql_select_atribs_turma);
				$nome_turma = $select_atribs_turma_valores['nome_turma'];
				$quantidade_alunos = $select_atribs_turma_valores['quantidade_alunos'];
				$disponivel = $select_atribs_turma_valores['disponivel']; ?>			
			
 				<br/>
				<table width="900">
					<tr>						
						<td>
							<center>Turma:
								<input type="text" style="width:30px" disabled value="<?php echo $nome_turma;?>"></input>
							</center>
						</td>
						<td>
							<center>Quantidade de Alunos:
								<input type="text" style="width:30px" disabled value="<?php echo $quantidade_alunos;?>"></input>
							</center>
						</td>
						<td>
							<center>Status da Turma:
								<input type="text" style="width:85px" disabled value="<?php echo $disponivel ? 'Disponível' : 'Indisponível';?>"></input>
							</center>
						</td>
					</tr>
				</table>
 				<br/> 

				<table width="900" border="0">
					<tr>
						<td width="710"><strong>Nome do Aluno</strong></td>
						<td><strong>Quantidade de Faltas</strong></td>
					</tr>
					<?php
					$select_nome_alunos = "SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao INNER JOIN matricula m ON m.id_aluno = a.id_aluno WHERE m.id_turma = '$cod_turma'";	
													
					$sql_select_nome_alunos = mysqli_query($conexao, $select_nome_alunos)or die(mysqli_error($conexao));
																										
					while($select_nome_alunos_valores = mysqli_fetch_assoc($sql_select_nome_alunos)){ ?>
						<tr>
							<td width="710"><?php echo $nome_aluno = $select_nome_alunos_valores['nome_aluno']; ?></td>
							<td>
								<center><?php $cod_aluno = $select_nome_alunos_valores['id_aluno'];
								$select_total_faltas = "SELECT COUNT(presenca) AS faltas FROM chamada WHERE id_aluno = '$cod_aluno' AND presenca = 0";
								$sql_select_total_faltas = mysqli_query($conexao, $select_total_faltas)or die(mysqli_error($conexao));
								$select_total_faltas_valores = mysqli_fetch_assoc($sql_select_total_faltas);
								echo $faltas = $select_total_faltas_valores['faltas']; ?></center>
							</td>	
						</tr>
					<?php } ?>
			</table>				
				<br/>				
			<?php die;} ?>

<!>

			<br/><br/>
 			<a class="a2" href="cursos_e_disciplinas.php?pg=turma&amp;cadastra=sim">Cadastrar Turma</a>

<! CADASTRANDO NOVAS TURMAS >

			<?php if(@$_GET['cadastra'] == 'sim'){?> 
 				<br/><br/>
 				<h1>Cadastrar Turma</h1>
			
				<?php if(isset($_POST['cadastra_turma'])){

					$nome_turma = $_POST['nome_turma'];
					$qtde_alunos = $_POST['qtde_alunos'];

					$cadastrando_turma = "INSERT INTO turma (nome_turma, quantidade_alunos) VALUES ('$nome_turma', '$qtde_alunos')";	
	
					$cadastrar_turma = mysqli_query($conexao, $cadastrando_turma) or die(mysqli_error($conexao));

					if ($cadastrar_turma == '')
					{
						echo "<script language='javascript'> window.alert('Erro ao Cadastrar, Turma já Cadastrada!');</script>";
					}
					else
					{		
						echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
						echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=turma';</script>";
					}

				}?> 
				<form name="form1" method="post" action="">
  					<table width="900" border="0">
    					<tr>
      						<td width="134">
								Nome da Turma
							</td>
    					</tr>
    					<tr>
      						<td>
								<input type="text" name="nome_turma" id="textfield">
							</td>
						</tr>
						<tr>
      						<td width="134">
								Quantidade de Alunos
							</td>
    					</tr>
    					<tr>
      						<td>
								<input type="number" name="qtde_alunos" id="textfield" min="1">
							</td>
						</tr>
						<td>
      						<td>
								<input class="input" type="submit" name="cadastra_turma" id="button" value="Cadastrar">
							</td>
    					</tr>
  					</table>
				</form> 
 				<br/>
			<?php die; } ?>

<!>	

<!VISUALIZAR AS TURMAS CADASTRADAS>

			<?php
			$sql_resultado_consulta_turma = "SELECT * FROM turma";
			$resultado_consulta_turma = mysqli_query($conexao, $sql_resultado_consulta_turma) or die(mysqli_error($conexao));
									  
 			if(mysqli_num_rows($resultado_consulta_turma) <= 0){
	 			echo "<br><br>No momento não existe nenhuma turma cadastrada!<br><br>";
 			}
			else
			{ ?>
				<br/><br/>
				<center><h1>Turmas</h1></center>
				<table width="600" border="0">
					<tr>
						<td><center><strong>Turma</strong></center></td>
						<td><center><strong>Total de Alunos nesta Turma</strong></center></td>
						<td><center><strong>Visualizar</strong></center></td>
					</tr>
						<?php while($resultado_consulta_turma_1 = mysqli_fetch_assoc($resultado_consulta_turma)){ ?>
							<tr>
								<td style="color: #A70A0C"><center><?php echo $nome_turma = $resultado_consulta_turma_1['nome_turma']; ?></center></td>
								<td style="color: #A70A0C"><center><?php $qtde_alunos = $resultado_consulta_turma_1['quantidade_alunos'];

									$cod_turma = $resultado_consulta_turma_1['id_turma'];

									$sql_resultado_consulta_qtde_matricula = "SELECT * FROM matricula WHERE id_turma = '$cod_turma'";

									$resultado_consulta_qtde_alunos_matriculados = mysqli_query($conexao, $sql_resultado_consulta_qtde_matricula) or die(mysqli_error($conexao));

									$qtde_alunos_matriculados = mysqli_num_rows($resultado_consulta_qtde_alunos_matriculados);																											 
									echo $qtde_alunos_matriculados . " | " . $qtde_alunos;?></center></td>
								<td>
									<center><a href="cursos_e_disciplinas.php?pg=turma&amp;visualizar=sim&turma=<?php echo $cod_turma; ?>" ><img title="Turma <?php echo $nome_turma; ?>" src="img/lupa_turma.png" width="18" height="18" border="0"><strong></strong></a></center>
								</td>
								<!--
								<td><h3><#?php $sql_resultado_consulta_turma_2 = "SELECT * FROM turma";
									$result2 = mysqli_query($conexao, $sql_resultado_consulta_turma_2);
									echo mysqli_num_rows($result2); ?></h3>
								</td>
								
								<td><a class="a" href="cursos_e_disciplinas.php?pg=turma&amp;deleta=tur&amp;cod_turma=<?php# echo @$resultado_consulta_turma_1['cod_turma']; ?>"><img title="Excluir turma" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>-->
							</tr>
						<?php } ?>
				</table>	 

			<?php } ?> 
			<br/>

	<!DELEÇÃO DAS TURMAS>

			<?php/* if(@$_GET['deleta'] == 'tur'){

				$cod_turma = $_GET['cod_turma'];

				$sql_deleta_turma = "DELETE FROM turma WHERE cod_turma = '$cod_turma'";
				mysqli_query($conexao, $sql_deleta_turma);
			}*/?>
	
		</div><!-- box_curso -->
	<?php  }?>

	<!>
<!>


<!CADASTRAR MATRICULAS>

	<?php if(@$_GET['pg'] == 'matricula'){ ?>

		<div id="box_disciplinas">
			<a class="a2" href="cursos_e_disciplinas.php?pg=matricula&amp;cadastra=sim">Matricular Alunos</a>
			<?php if(@$_GET['cadastra'] == 'sim'){ ?>
				<h1>Nova matricula</h1>

				<?php if(isset($_POST['cadastra'])){
				
					$cod_aluno = $_POST['nome_aluno'];
					$cod_turma = $_POST['turma'];
	
						
					/*$professor = $_POST['professor'];	
					$sala = $_POST['sala'];	
					$turno = $_POST['turno'];
					
 					$data_formato_mysql = date("Y-m-d");	
					"INSERT INTO matricula (cod_turma, cod_aluno, data_matricula) VALUES ('$cod_turma', '$cod_aluno','$data_formato_mysql')" 
					$data_sem_formatacao_recuperada_mysql = "SELECT data_matricula FROM matricula WHERE cod_turma = '$cod_turma'";
					date("d-m-Y", $data_sem_formatacao_recuperada_mysql); */
						
					if($cod_aluno == '')
					{
						echo "<script language='javascript'>window.alert('Digite o nome ou codigo do aluno ');</script>";
					}
					else if($cod_turma == '')
					{
						echo "<script language='javascript'>window.alert('Digite o nome da turma');</script>";
					}
					else
					{	
						/*$sql_consulta_aluno_matriculado = ("SELECT * FROM preetec.aluno_cadastrado INNER JOIN preetec.aluno_matriculado ON preetec.aluno_cadastrado.cod_inscricao = preetec.aluno_matriculado.cod_inscricao WHERE preetec.aluno_cadastrado.nome = '$cod_aluno' OR preetec.aluno_matriculado.cod_aluno = '$cod_aluno'"); 
							$cod_aluno = "SELECT preetec.aluno_matriculado.cod_aluno FROM preetec.aluno_cadastrado INNER JOIN preetec.aluno_matriculado ON preetec.aluno_cadastrado.cod_inscricao = preetec.aluno_matriculado.cod_inscricao WHERE preetec.aluno_cadastrado.nome OR preetec.aluno_matriculado.cod_aluno = '$cod_aluno'";*/
						
						$sql_consulta_aluno_matriculado = ("SELECT * FROM inscricao i INNER JOIN aluno a ON i.id_inscricao = a.id_inscricao WHERE i.nome_aluno = '$cod_aluno' OR a.id_aluno = '$cod_aluno'");
						//$cod_aluno_format = $sql_consulta_aluno_matriculado;  
						
						$resultado_consulta_aluno_matriculado = mysqli_query($conexao, $sql_consulta_aluno_matriculado) or die(mysqli_error($conexao));
						$resultado_consulta_aluno_format = mysqli_fetch_assoc($resultado_consulta_aluno_matriculado);
						$cod_aluno_format = $resultado_consulta_aluno_format['id_aluno'];
							
						if(mysqli_num_rows($resultado_consulta_aluno_matriculado) <= 0)
						{
							echo "<script language='javascript'>window.alert('Aluno não Encontrado!');</script>";	
						}
						else
						{
							$data_formato_mysql = date("Y-m-d");
							$sql_cadastrar_matricula = "INSERT INTO matricula (id_turma, id_aluno, data_matricula) VALUES ('$cod_turma', '$cod_aluno_format','$data_formato_mysql')";
							$cadastrar_matricula = mysqli_query($conexao, $sql_cadastrar_matricula) or die(mysqli_error($conexao));
						
							if($cadastrar_matricula == '')
							{
								echo "<script language='javascript'>window.alert('Ocorreu um erro!');</script>";
							}
							else
							{
								echo "<script language='javascript'>window.alert('Matricula cadastrada com sucesso!');window.location='cursos_e_disciplinas.php?pg=matricula';</script>";
								echo "<script language='javascript'>window.location='cursos_e_disciplinas.php?pg=matricula';</script>";
  							}
						}
 					}
				}?>

				<form name="form1" method="post" action="">
  					<table width="900" border="0">
    					<tr>
					 		<td width="134">
								Nome Completo ou Código do Aluno:
							</td>
					  		<td width="213">
								Turmas:
							</td>
					  		<!--<td>Professor:</td>
							<td width="128">Sala: <em>Apenas o número</em></td>
							<td width="128">Turno:</td>
							<td width="126">&nbsp;</td>
							<td width="0" colspan="2"></td>-->
						</tr>
						<tr>
					  		<td>
      							<input type="text" name="nome_aluno" id="textfield" maxlength="120">
	  						</td>
      						<td>
      							<select name="turma">
      								<?php $sql_resultado_consulta_turma_3 = "SELECT * FROM turma WHERE nome_turma != ''";
		 											  
	  								$resultado_consulta_turma_3 = mysqli_query($conexao, $sql_resultado_consulta_turma_3) or die(mysqli_error($conexao));

	  								while($valores_turma = mysqli_fetch_assoc($resultado_consulta_turma_3)){?>
									
      									<option value="<?php echo $valores_turma['id_turma']; ?>">
											<?php echo $valores_turma['nome_turma']; ?>
										</option>
      								<?php } ?>
      							</select>
      						</td>
      
						  	<!--<td width="2">
						  		<select name="professor">
						  			</?php $sql_result_prof = "SELECT * FROM professores WHERE nome != ''";
						  			$result_rec_prof = mysqli_query($conexao,  $sql_result_prof );
									while($r3 = mysqli_fetch_assoc($result_rec_prof)){?>
						   				<option value="</?php echo $r3['code']; ?>">
											</?php echo $r3['nome']; ?>
										</option>
									</?php } ?>
						  		</select>
						  	</td>
						  	<td>
						  		<input type="text" name="sala" id="textfield"></td>
						  	<td>
								<select name="turno" size="1" id="turno">
							  		<option value="Manhã">Manhã</option>
							  		<option value="Tarde">Tarde</option>
							  		<option value="Noite">Noite</option>
						  		</select>
							</td>-->
		
      						<td width="126">
								<input class="input" type="submit" name="cadastra" id="button" value="Matricular">
							</td>
    					</tr>    
  					</table>
				</form>

			<?php die;  } ?>

<!MOSTRAR AS MATRICULAS NA TABELA>

			<br/><br/>
			
			<h1>
				MATRICULAS
			</h1>
			
			<?php $sql_consulta_matriculas = "SELECT * FROM matricula m INNER JOIN aluno a ON a.id_aluno = m.id_aluno INNER JOIN inscricao i ON i.id_inscricao = a.id_inscricao INNER JOIN turma t ON t.id_turma = m.id_turma ORDER BY t.nome_turma ASC";
			
			$resultado_consulta_matricula = mysqli_query($conexao, $sql_consulta_matriculas) or die(mysqli_error($conexao));
										  
			if(mysqli_num_rows($resultado_consulta_matricula) == ''){
				echo "<h2>No momento não existe nenhuma matricula!</h2><br><br>";
			}else{?> 
    			<table width="900" border="0">
      			<tr>
        			<td>
						<strong>Turma:</strong>
					</td>
        			<td>
						<strong>Aluno:</strong>
					</td>        			
      			</tr>
      			<?php while($resultado_consulta_matricula_valores = mysqli_fetch_assoc($resultado_consulta_matricula)){ ?>
      				<tr>
        				<td>
							<h3><?php echo $resultado_consulta_matricula_valores['nome_turma']; ?></h3>
						</td>
        				<td>
							<h3><?php echo $resultado_consulta_matricula_valores['nome_aluno']; ?></h3>
						</td>        				
        				<!--<td>
							<a class="a" href="cursos_e_disciplinas.php?pg=matricula&amp;deleta=sim&amp;id=<?php# echo $resultado_consulta_matricula_valores['id_matricula']; ?>">
								<img title="Excluir Matricula" src="img/deleta.jpg" width="18" height="18" border="0">
							</a>
						</td>-->
      				</tr>
      			<?php } ?>
    			</table>
			<?php } ?>

<!EXCLUSÃO DAS MATRICULAS>

			<?php# if(@$_GET['deleta'] == 'sim'){

				#$id_matricula = $_GET['id_matricula'];

				#$sql_deleta_matricula = "DELETE FROM matricula WHERE id_matricula = '$id_matricula'";
				#mysqli_query($conexao, $sql_deleta_matricula);

			#}?> 
		</div><!-- box_disciplinas -->
	<?php } ?>


<!REALIZAR CHAMADA>


	<?php if(@$_GET['pg'] == 'chamada'){ ?>
		<div id="box_curso_e_disciplinas">
			<h1>Chamada</h1>

			<?php $sql_ced = "SELECT * FROM cursos";
			$result_ced = mysqli_query($conexao,  $sql_ced);
			if(mysqli_num_rows($result_ced) == ''){
				echo "Não existe nenhum curso cadastrado no momento!";
			}else{?>
				<table width="620" border="0">
					<?php while($rs_ced = mysqli_fetch_assoc($result_ced)){ ?>
						<tr>
							<td width="614">
								Curso: <?php echo $curso = $rs_ced['curso']; ?>
							</td>
						</tr>
						<tr>
							<td>
								<textarea disabled="disabled" name="textarea" id="textarea" cols="100" rows="5">
									<?php $sql_ced_prof = "SELECT * FROM disciplinas WHERE curso = '$curso'";
									$result_ced_prof = mysqli_query($conexao,  $sql_ced_prof);
									while($rs_ced2 = mysqli_fetch_assoc($result_ced_prof)){

										$professor = $rs_ced2['professor'];

										echo $rs_ced2['disciplina']; 
										echo " - ";
										$sql_ced_cod = "SELECT * FROM professores WHERE code = '$professor'";
										$result_ced_cod = mysqli_query($conexao,  $sql_ced_cod);
										while($rs_ced3 = mysqli_fetch_assoc($result_ced_cod)){
											echo $rs_ced3['nome'];
											echo " - ";
											echo $rs_ced3['code'];
										} ?>

									<?php } ?>
								</textarea>
							</td>
						</tr>
					<?php } ?>
				</table>
				<br/>	
			<?php } ?>

		</div><!-- box_curso_e_disciplinas -->
	<?php } ?>

	<?php require "rodape.php"; ?>
</body>
</html>