<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Professores</title>
	<link href="css/cursos_e_disciplinas.css" rel="stylesheet" type="text/css" />
	<?php require "../conexao.php";?>
</head>
<body>
	<?php require "topo.php"; ?>

<!EXIBIR TABELA DOS PROFESSORES CADASTRADOS>

	<div id="caixa_preta">
	</div><!-- caixa_preta -->

	<?php if(@$_GET['pg'] == 'professor'){ ?>
		<div id="box_curso">
			<br/><br/>
			
			<a class="a2" href="professores.php?pg=cadastra_professor">Cadastrar Professor</a>
			
			<h1>Professores</h1>
			
			<?php $sql_select_professor = "SELECT * FROM professor WHERE nome_professor != ''";
										  
			$consulta_select_professor = mysqli_query($conexao, $sql_select_professor) or die(mysqli_error($conexao));
									  
			if(mysqli_num_rows($consulta_select_professor) == ''){
				echo "No momento não existe professores cadastrados!";
			}else{ ?>
				<table width="900" border="0">
					<tr>
						<td><strong>Código:</strong></td>
						<td><strong>Nome:</strong></td>
						<td><strong>CPF:</strong></td>
						<td><strong>Email:</strong></td>					
				  	</tr>
				  	<?php while($resultado_consulta_select_professor = mysqli_fetch_assoc($consulta_select_professor)){ ?>
				  		<tr>
							<td>
								<h3><?php echo $resultado_consulta_select_professor['id_professor']; ?></h3>
							</td>
							<td>
								<h3><?php echo $resultado_consulta_select_professor['nome_professor']; ?></h3>
							</td>							
							<td>
								<h3><?php echo $resultado_consulta_select_professor['cpf']; ?></h3>
							</td>
							<td>
								<h3><?php echo $resultado_consulta_select_professor['email']; ?></h3>
							</td>
							<td>
							</td>
							<!--<td>
								<a class="a" href="professores.php?pg=professor&func=deleta&id=<?php# echo $res_1['id']; ?>"><img title="Excluir Professor" src="img/deleta.jpg" width="18" height="18" border="0"></a>
								<?php# if($res_1['status'] == 'Inativo'){?>
								<a class="a" href="professores.php?pg=professor&func=ativa&id=<?php# echo $res_1['id']; ?>&code=<?php #echo $res_1['code']; ?>"><img title="Ativar novamente professor" src="../img/correto.jpg" width="20" height="20" border="0"></a>
								<?php# } ?>
								<?php #if($res_1['status'] == 'Ativo'){?>
								<a class="a" href="professores.php?pg=professor&func=inativa&id=<?php# echo $res_1['id']; ?>&code=<?php# echo $res_1['code']; ?>"><img title="Inativar Professor(a)" src="../img/ico_bloqueado.png" width="18" height="18" border="0"></a>
								<?php# } ?>
								<a class="a" href="professores.php?pg=professor&func=edita&id=<?php# echo $res_1['id']; ?>"><img title="Editar Dados Cadastrais" src="../img/ico-editar.png" width="18" height="18" border="0"></a>
								<a class="a" rel="superbox[iframe][930x500]" href="historico_professor.php?id=<#?php echo $res_1['id']; ?>"><img title="Histórico deste professor" src="../img/visualizar16.gif" width="18" height="18" border="0"></a>
							</td>-->
				  		</tr>
					<?php } ?>
				</table>
			<?php }?>
			<br />

			<?php#if(@$_GET['func'] == 'deleta'){
				#$id = $_GET['id'];
				#$sql_del = "DELETE FROM professores WHERE id = '$id'";
				#mysqli_query($conexao, $sql_del);
				#echo "<script language='javascript'>window.location='professores.php?pg=professor';</script>";
			#}?>

			<?php#/* if(@$_GET['func'] == 'ativa'){
				#$id = $_GET['id'];
				#$code = $_GET['code'];
				#$sql_edit1 = "UPDATE professores SET status = 'Ativo' WHERE id = '$id'";
				#$sql_edit2 = "UPDATE login SET status = 'Ativo' WHERE code = '$code'";
				#mysqli_query($conexao, $sql_edit1);
				#mysqli_query($conexao, $sql_edit2);
				#echo "<script language='javascript'>window.location='professores.php?pg=professor';</script>";
			#}?>

			<?php /*if(@$_GET['func'] == 'inativa'){
				$id = $_GET['id'];
				$code = $_GET['code'];
				$sql_edit3 = "UPDATE professores SET status = 'Inativo' WHERE id = '$id'";
				$sql_edit4 = "UPDATE login SET status = 'Inativo' WHERE code = '$code'";
				mysqli_query($conexao, $sql_edit3);
				mysqli_query($conexao, $sql_edit4);
				echo "<script language='javascript'>window.location='professores.php?pg=professor';</script>";
			}*/?>

<!EDITAR OS PROFESSORES>

			<?php# if(@$_GET['func'] == 'edita'){ ?>
				<!--<hr/>
				<h1>Editar professor</h1>
				<?php
				#$id = $_GET['id'];
				#$sql_1 = "SELECT * FROM professores WHERE id = '$id'";
				#$edit = mysqli_query($conexao, $sql_1);
				#	while($res_1 = mysqli_fetch_assoc($edit)){
				?>

				<?php# if(isset($_POST['button'])){
				#$id = $_GET['id'];
				#$nome = $_POST['nome'];
				#$cpf = $_POST['cpf'];
				#$nascimento = $_POST['nascimento'];
				#$formacao = $_POST['formacao'];
				#$graduacao = $_POST['graduacao'];
				#$pos_graduacao = $_POST['pos_graduacao'];
				#$mestrado = $_POST['mestrado'];
				#$doutorado = $_POST['doutorado'];
				#$salario = $_POST['salario'];


				#$sql_2 = "UPDATE professores SET nome = '$nome', cpf = '$cpf', nascimento = '$nascimento', formacao = '$formacao', graduacao = '$graduacao', pos_graduacao = '$pos_graduacao', mestrado = '$mestrado', doutorado = '$doutorado', salario = '$salario' WHERE id = '$id'";
				#$res_editar = mysqli_query($conexao, $sql_2);
				#if($res_editar == ''){
				#	echo "<script language='javascript'>window.alert('Ocorreu um erro tente novamente!');window.location='';</script>";
				#}else{
				#	echo "<script language='javascript'>window.alert('Atualização realizada com sucesso!');window.location='professores.php?pg=professor';</script>";

				#}}?>

				<form name="form1" method="post" action="" enctype="multipart/form-data">
				  <table width="900" border="0">
					<tr>
					  <td>Nome:</td>
					  <td>CPF</td>
					  <td>Salário:</td>
					</tr>
					<tr>
					  <td><label for="textfield2"></label>
					  <input type="text" name="nome" id="textfield2" value="<?php #echo $res_1['nome']; ?>"></td>
					  <td><label for="textfield3"></label>
					  <input type="text" name="cpf" id="textfield3" value="<?php# echo $res_1['cpf']; ?>"></td>
					  <td><input type="text" name="salario" id="textfield8" value="<?php #echo $res_1['salario']; ?>"></td>
					</tr>
					<tr>
					  <td>Data de nascimento:</td>
					  <td>Formação Acadêmica</td>
					  <td>Graduação(ões):</td>
					</tr>
					<tr>
					  <td><label for="textfield4"></label>
					  <input type="text" name="nascimento" id="textfield4" value="<?php #echo $res_1['nascimento']; ?>"></td>
					  <td><label for="select"></label>
						<select name="formacao" size="1" id="select">
						  <option value="<?php# echo $res_1['formacao']; ?>"><?php# echo $res_1['formacao']; ?></option>
						  <option value=""></option>
						  <option value="Ensino Médio Incompleto">Ensino Médio Incompleto</option>
						  <option value="Ensino Médio Completo">Ensino Médio Completo</option>
						  <option value="Superior Incompleto">Superior Incompleto</option>
						  <option value="Superior Completo">Superior Completo</option>
					  </select></td>
					  <td><input type="text" name="graduacao" id="textfield5" value="<?php# echo $res_1['graduacao']; ?>"></td>
					</tr>
					<tr>
					  <td>Pos-graduação(ões):</td>
					  <td>Mestrado(s):</td>
					  <td>Doutorado(s):</td>
					</tr>
					<tr>
					  <td><input type="text" name="pos_graduacao" id="textfield6" value="<?php #echo $res_1['pos_graduacao']; ?>"></td>
					  <td><input type="text" name="mestrado" id="textfield7" value="<?php #echo $res_1['mestrado']; ?>"></td>
					  <td><input type="text" name="doutorado" id="textfield8" value="doutorado"></td>
					</tr>
					<tr>
					  <td><input class="input" type="submit" name="button" id="button" value="Atualizar"></td>
					  <td>&nbsp;</td>
					  <td>&nbsp;</td>
					</tr>
				  </table>
				<?php# } ?>
				</form>
				<#?php } */?>
				<!--<br/>-->
		</div><!-- box_professores -->
	
	<?php } // aqui é o fechamento da PG professor ?>

<!CADASTRO DOS PROFESSORES>

	<?php if(@$_GET['pg'] == 'cadastra_professor'){ ?>
		<div id="box_curso">
			<br/>			
			<a class="a2" href="professores.php?pg=cadastra_professor">Cadastrar Professor</a>
			<br/><br/>
			<h1>Cadastrar um novo professor</h1>
			<?php if(isset($_POST['button'])){
	
				$data_nascimento_professor = $_POST['data_nascimento_professor'];
				$nome_professor = $_POST['nome_professor'];
				$sexo_professor = $_POST['sexo_professor'];
				$cpf_professor = $_POST['cpf_professor'];
				$rg_professor = $_POST['rg_professor'];
				$logradouro_professor = $_POST['logradouro_professor'];
				$bairro_professor = $_POST['bairro_professor'];
				$cidade_professor = $_POST['cidade_professor'];
				$complemento_professor = $_POST['complemento_professor'];
				$cep_professor = $_POST['cep_professor'];
				$telefone_professor = $_POST['telefone_professor'];
				$celular_professor = $_POST['celular_professor'];
				$email_professor = $_POST['email_professor'];
				$formacao_professor = $_POST['formacao_professor'];

				$sql_insert_professor = "INSERT INTO professor (data_nascimento_professor, nome_professor, sexo_professor, cpf, rg_professor, logradouro_professor, bairro_professor, cidade_professor, complemento_professor, cep_professor, telefone_professor, celular_professor, email, formacao) VALUES ('$data_nascimento_professor', '$nome_professor', '$sexo_professor', '$cpf_professor', '$rg_professor', '$logradouro_professor', '$bairro_professor', '$cidade_professor', '$complemento_professor','$cep_professor', '$telefone_professor', '$celular_professor', '$email_professor','$formacao_professor')";
	
				$insert_professor = mysqli_query($conexao, $sql_insert_professor) or die(mysqli_error($conexao));
	
				if($insert_professor == ''){
					
					echo "<script language='javascript'>window.alert('Ocorreu um erro ao cadastrar o professor!');</script>";					
				}
			}?>
			<form name="form1" method="post" action="">
				<table width="900" border="0">
					<tr>
						<td>Código:</td>
						<td>Nome:</td>
						<td>Data de Nascimento:</td>
					</tr>
					<tr>
						<td>
							<?php $sql_select_professor_ultimo_id = "SELECT * FROM professor ORDER BY id_professor DESC LIMIT 1";
							$select_professor_ultimo_id = mysqli_query($conexao, $sql_select_professor_ultimo_id) or die(mysqli_error($conexao));
							if(mysqli_num_rows($select_professor_ultimo_id) == ''){
								$novo_id_professor = 1; ?>
								<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id_professor;  ?>">
								<input type="hidden" name="code" value="<?php echo $novo_id_professor;  ?>" />
						</td>
						<td>
							<?php }else{
								while($resultado_select_professor_ultimo_id = mysqli_fetch_assoc($select_professor_ultimo_id)){
									$novo_id_professor = $resultado_select_professor_ultimo_id['id_professor']+1; ?>
									<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_id_professor;  ?>">
									<input type="hidden" name="code" value="<?php echo $novo_id_professor;  ?>" />
						
								<?php }
							} ?>
						
							<input type="text" name="nome_professor" id="textfield2" maxlength="120">
						</td>
						<td>
							<input type="date" name="data_nascimento_professor" id="textfield3">
						</td>
					</tr>
					<tr>
						<td>Sexo:</td>
						<td>CPF:</td>
						<td>RG:</td>
					</tr>
					<tr>
						<td>
							<select name="sexo_professor" size="1" id="textfield">
								<option value="MASCULINO">Masculino</option>
								<option value="FEMININO">Feminino</option>
								<option value="OUTRO">Outro</option>
							</select>							
						</td>
						<td>
							<input type="text" name="cpf_professor" id="textfield4" maxlength="11">
						</td>
						<td>
							<input type="text" name="rg_professor" id="textfield5" maxlength="14">
						</td>
					</tr>
					<tr>
						<td>Logradouro:</td>
						<td>Bairro:</td>
						<td>Cidade:</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="logradouro_professor" id="textfield6">
						</td>						
						<td>
							<input type="text" name="bairro_professor" id="textfield8">
						</td>
						<td>
							<input type="text" name="cidade_professor" id="textfield6">
						</td>
					</tr>
					<tr>		
						<td>Complemento:</td>
						<td>CEP:</td>
						<td>Telefone:</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="complemento_professor" id="textfield7">
						</td>
						<td>
							<input type="text" name="cep_professor" id="textfield8" maxlength="8">
						</td>
						<td>
							<input type="text" name="telefone_professor" id="textfield6" maxlength="10">
						</td>
					</tr>
					<tr>						
						<td>celular:</td>
						<td>E-mail:</td>
						<td>Formação:</td>
					</tr>
					<tr>
						<td>
							<input type="text" name="celular_professor" id="textfield7" maxlength="11">
						</td>
						<td>
							<input type="email" name="email_professor" id="textfield8">
						</td>
						<td>
							<input type="text" name="formacao_professor" id="textfield6">
						</td>
					</tr>
					<tr>
						
					</tr>
					<tr>
					</tr>
					<tr>
						<td colspan="3"><input class="input" type="submit" name="button" id="button" value="Cadastrar"></td>
					</tr>
				</table>
			</form>
			<br/>
		</div><!-- fim da div cadastra_professores -->
	<?php } // aqui é o fechamento da PG cadastra Professores ?>

<! MATERIAS>

	<div id="caixa_preta">
	</div><!-- caixa_preta -->

	<?php if(@$_GET['pg'] == 'disciplina'){ ?>
		<div id="box_curso">
			
			<br/><br/>
 			<a class="a2" href="professores.php?pg=cadastra_materia">Cadastrar Materia</a>
			
			
<!VISUALIZAR AS MATERIAS CADASTRADAS>

			<?php $sql_resultado_consulta_materia = "SELECT * FROM disciplina";
			$resultado_consulta_materia = mysqli_query($conexao, $sql_resultado_consulta_materia) or die(mysqli_error($conexao));
									  
 			if(mysqli_num_rows($resultado_consulta_materia) == ''){
	 			echo "<br/><br/><br/>No momento não existe nenhuma matéria cadastrada!<br/><br/>";
 			}
			else
			{ ?>
				<br/><br/>
				<h1>Matérias</h1>
				<table width="900" border="0">
					<tr>
						<td><strong>Código da Matéria:</strong></td>
						<td><strong>Nome:</strong></td>
						<td>&nbsp;</td>					
					</tr>
						<?php while($resultado_consulta_materia_valores = mysqli_fetch_assoc($resultado_consulta_materia)){ ?>
							<tr>
								<td>
									<h3><?php echo $resultado_consulta_materia_valores['id_disciplina'];?></h3>
								</td>
								<td>
									<h3><?php echo $resultado_consulta_materia_valores['nome_disciplina']; ?>
									
								<!--<td><h3><#?php $sql_resultado_consulta_turma_2 = "SELECT * FROM turma";
									$result2 = mysqli_query($conexao, $sql_resultado_consulta_turma_2);
									echo mysqli_num_rows($result2); ?></h3>
								</td>
								
								<td><a class="a" href="cursos_e_disciplinas.php?pg=turma&amp;deleta=tur&amp;cod_turma=<?php #echo @$resultado_consulta_turma_1['cod_turma']; ?>"><img title="Excluir turma" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>-->
							</tr>
						<?php } ?>
				</table>	 

			<?php } ?> 		
			<br/>
			</div>
		<?php } ?>
					
<! CADASTRO DE MATERIAS>
			
		<?php if(@$_GET['pg'] == 'cadastra_materia'){?> 
			<div id="box_curso">
				<br/>
 				<a class="a2" href="professores.php?pg=cadastra_materia">Cadastrar Materia</a>
				<br/><br/>
				<h1>Cadastrar Matéria</h1>

				<?php if(isset($_POST['cadastra_materia'])){

					$nome_materia = $_POST['nome_materia'];					

					$sql_insert_materia = "INSERT INTO disciplina (nome_disciplina) VALUES ('$nome_materia')";	

					$insert_materia = mysqli_query($conexao, $sql_insert_materia) or die(mysqli_error($conexao));

					if ($insert_materia == '')
					{
						echo "<script language='javascript'> window.alert('Erro ao Cadastrar, matéria já cadastrada!');</script>";
					}
					else
					{		
						echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
						echo "<script language='javascript'>window.location='professores.php?pg=disciplina';</script>";
					}

				}?>

				<form name="form1" method="post" action="">
					<table width="900" border="0">
						<tr>
							<td width="134">Código da Matéria:</td>
							<td width="134">Nome da Matéria:</td>
						</tr>
						<tr>
							<?php $sql_select_ultimo_cod_materia = "SELECT * FROM disciplina ORDER BY id_disciplina DESC LIMIT 1";

							$select_ultimo_cod_materia = mysqli_query($conexao, $sql_select_ultimo_cod_materia)or die(mysqli_error($conexao));

							if(mysqli_num_rows($select_ultimo_cod_materia) == ''){
								$novo_cod_materia = 1; ?>

								<td>
									<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_materia; ?>">
								</td>
									<input type="hidden" name="code" value="<?php echo $novo_cod_materia; ?>"/>

							<?php }else{

								while($resultado_select_ultimo_cod_materia_valores = mysqli_fetch_assoc($select_ultimo_cod_materia)){
									$novo_cod_materia = $resultado_select_ultimo_cod_materia_valores['cod_materia']+1; ?>
									<td>
										<input type="text" name="code" id="textfield" disabled="disabled" value="<?php echo $novo_cod_materia; ?>">
									</td>
										<input type="hidden" name="code" value="<?php echo $novo_cod_materia; ?>" />
								<?php }
							}?>	
							<td>
								<input type="text" name="nome_materia" id="textfield" maxlength="30">
							</td>							
						</tr>
						<tr>
							<td>
								<input class="input" type="submit" name="cadastra_materia" id="button" value="Cadastrar">
							</td>
						</tr>
					</table>
				</form> 
				<br/>
			</div>
		<?php die;} ?>
			
<! PROFESSORES & MATERIAS>

	<div id="caixa_preta">
	</div><!-- caixa_preta -->

	<?php if(@$_GET['pg'] == 'disciplinas_ministradas'){ ?>
		<div id="box_curso">
			
			<br/><br/>
 			<a class="a2" href="professores.php?pg=cadastra_disciplinas_ministradas">Cadastrar Disciplinas Ministradas</a>
			
			
<!VISUALIZAR OS PROFESSORES & MATERIAS CADASTRADOS>

			<?php $sql_select_consulta_disciplinas_ministradas = 
			"SELECT * FROM disciplina_ministrada dm INNER JOIN disciplina d ON d.id_disciplina = dm.id_disciplina INNER JOIN professor p ON p.id_professor = dm.id_professor";
														
			$select_consulta_disciplinas_ministradas = mysqli_query($conexao, $sql_select_consulta_disciplinas_ministradas)or die(mysqli_error($conexao));
									  
 			if(mysqli_num_rows($select_consulta_disciplinas_ministradas) == ''){
	 			echo "<br/><br/><br/>No momento não existe nenhuma matéria cadastrada!<br/><br/>";
 			}
			else
			{ ?>
				<br/><br/>
				<h1>Disciplina Ministradas</h1>
				<table width="900" border="0">
					<tr>
						<td><strong>Nome do Professor:</strong></td>
						<td><strong>Nome da Matéria:</strong></td>
						<td>&nbsp;</td>					
					</tr>
						<?php while($select_consulta_disciplinas_ministradas_valores = mysqli_fetch_assoc($select_consulta_disciplinas_ministradas)){ ?>
							<tr>
								<td>
									<h3><?php echo $select_consulta_disciplinas_ministradas_valores['nome_professor'];?></h3>
								</td>
								<td>
									<h3><?php echo $select_consulta_disciplinas_ministradas_valores['nome_disciplina']; ?>
									
								<!--<td><h3><#?php $sql_resultado_consulta_turma_2 = "SELECT * FROM turma";
									$result2 = mysqli_query($conexao, $sql_resultado_consulta_turma_2);
									echo mysqli_num_rows($result2); ?></h3>
								</td>
								
								<td><a class="a" href="cursos_e_disciplinas.php?pg=turma&amp;deleta=tur&amp;cod_turma=<?php #echo @$resultado_consulta_turma_1['cod_turma']; ?>"><img title="Excluir turma" src="img/deleta.jpg" width="18" height="18" border="0"></a></td>-->
							</tr>
						<?php } ?>
				</table>	 

			<?php } ?> 		
			<br/>
			</div>
		<?php } ?>
					
<! CADASTRO DE PROFESSORES & MATERIAS>
			
		<?php if(@$_GET['pg'] == 'cadastra_disciplinas_ministradas'){?> 
			<div id="box_curso">
				<br/>
 				<a class="a2" href="professores.php?pg=cadastra_disciplinas_ministradas">Cadastrar Disciplinas Ministradas</a>
				<br/><br/>
				<h1>Cadastrar Disciplinas Ministradas</h1>

				<?php if(isset($_POST['cadastra_professor_materia'])){

					$cod_materia_disciplina_ministrada = $_POST['cod_materia'];
					$cod_professor_disciplina_ministrada = $_POST['cod_professor'];

					$sql_insert_disciplina_ministrada = "INSERT INTO disciplina_ministrada (id_professor, id_disciplina) VALUES ('$cod_professor_disciplina_ministrada', '$cod_materia_disciplina_ministrada')";	

					$insert_disciplina_ministrada = mysqli_query($conexao, $sql_insert_disciplina_ministrada)or die(mysqli_error($conexao));

					if ($insert_disciplina_ministrada == '')
					{
						echo "<script language='javascript'> window.alert('Erro ao Cadastrar!');</script>";
					}
					else
					{		
						echo "<script language='javascript'> window.alert('Cadastro Realizado com sucesso!!');</script>";
						echo "<script language='javascript'>window.location='professores.php?pg=disciplinas_ministradas';</script>";
					}

				}?>

				<form name="form1" method="post" action="">
					<table width="900" border="0">
						<tr>
							<td width="134">Selecione a Matéria:</td>
							<td width="134">Digite o Código do Professor:</td>
						</tr>
						<tr>
							<td>
      							<select name="cod_materia">
      								<?php $sql_select_materias_diferentes = "SELECT * FROM disciplina WHERE nome_disciplina != ''";
		 											  
	  								$select_materias_diferentes = mysqli_query($conexao, $sql_select_materias_diferentes) or die(mysqli_error($conexao));

	  								while($select_materias_diferentes_valores = mysqli_fetch_assoc($select_materias_diferentes)){?>
									
      									<option value="<?php echo $select_materias_diferentes_valores['id_disciplina']; ?>">
											<?php echo $select_materias_diferentes_valores['nome_disciplina']; ?>
										</option>
      								<?php } ?>
      							</select>
      						</td>	
							<td>
								<input type="text" name="cod_professor" id="textfield">
							</td>							
						</tr>
						<tr>
							<td>
								<input class="input" type="submit" name="cadastra_professor_materia" id="button" value="Cadastrar">
							</td>
						</tr>
					</table>
				</form> 
				<br/>
			</div>
		<?php die;} ?>	

	<?php require "rodape.php"; ?>
</body>
</html>