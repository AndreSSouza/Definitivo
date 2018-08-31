<!doctype html>
<html>
<head>
<<<<<<< HEAD
    <meta charset="utf-8">
    <title>Chamada</title>
</head>
<body>		
    <form method='post'>
        Qual desses alunos faltou hj?<br>        
        <?php $host = "localhost";
        $user = "root";
        $pass = "";
        $db = "testechamada";

        $con = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($con));

        $buscaAlunos = "SELECT nome, ID FROM alunos";

        $query = mysqli_query($con, $buscaAlunos);

        $total = mysqli_num_rows($query);        
        $alunos = null;
        echo $total;
        var_dump($total);

            while($row = mysqli_fetch_row($query)){
                $alunos .= $row[0]."|";
                echo $row[1]."|";
            }	            
            echo "<br>";
            $alunos = substr($alunos, 0, -1);	
            $alunos = explode("|", $alunos);           

            for($i=0; $i<$total; $i++){
                echo $alunos[$i];
                //echo $alunos;
                echo "<input type='hidden' name='valor[$i]' value='0'/>";
                echo "<input type='checkbox' name='valor[$i]' value='1'/>";						
                echo "<br>";			    									                
            } ?>						
            <br><br><input type='submit' class='buttons' name="" value="Mostrar"> 
        </form><br><br>	

        <?php if (isset($_POST['valor'])) {  
            
            //$qt = count($_POST['valor']) - 1;            
            //$comp = null;
            $sql = "INSERT INTO chamada (presente, cod_aluno) VALUES";
            $x = 0;
            foreach ($_POST['valor'] as $treinamento){             
                $sql .= " ($treinamento , '$alunos[$x]'),";
                //$v = "";
                //if($x < $qt) {
                  //  $v = ", ";
               // }
               // $comp .= $treinamento.$v;                
                $x++;
            }
            //echo "<center> $comp </center>";
            $sql = substr($sql, 0, -1);
            mysqli_query($con, $sql);
            echo $sql;                             
        //} else {
            //$comp = null;
        } ?>
=======
<meta charset="utf-8">
<title>Chamada</title>
</head>
<body>
	<center>		
		<form method='post'>
			Qual desses alunos faltou hj?<br>
			<?php
		$host = "localhost";
		$user = "root";
		$pass = "";
		$db = "testechamada";
		
		$con = mysqli_connect($host, $user, $pass, $db) or die(mysqli_error($con));
	
		$buscaAlunos = "SELECT nome FROM alunos";
			
		$query = mysqli_query($con, $buscaAlunos);
			
		$total = mysqli_num_rows($query);			
		
			for($i=0; $i<$total; $i++){
				
				while($obj = mysqli_fetch_row($query)){
					
					echo $obj[0];
					echo "<input type='hidden' name='valor[$i]' value='0'/>";
					echo "<input type='checkbox' name='valor[$i]' value='1'/>";						
					echo "<br>";													
				}
			} ?>						
			<br><br><input type='submit' class='buttons' name="" value="Mostrar"> 
		</form><br><br>	
	</center>
		<?php
	
			 if (isset($_POST['valor'])) {   				
					$qt = count($_POST['valor']);
					$k = 1; 
					$comp = null;
					$sql = "INSERT INTO chamada (presente) VALUES";
				 
					foreach ($_POST['valor'] as $treinamento){             
						
						$sql .= " ($treinamento),";
						
						$v = "";
						
						if($k < $qt) {
							
							$v = ", ";
							
						}
						
						$comp .= $treinamento.$v;
						$k++;
					}
				
					echo "<center> $comp </center>";
				 	$sql = substr($sql, 0, -1);
			
					mysqli_query($con, $sql);

					//echo $sql;
				
				} else {
				
					$comp = null;
				
				} 
	
			/* $sql = "INSERT INTO chamada (presente) VALUES"; 
			
			foreach($arrayCHK_values as $final_value){
				$sql .= " ($final_value),";
			}
			$sql = substr($sql, 0, -1);
			
			//mysqli_query($con, $sql);
			
			echo $sql; */
	
			?>
	<?php
			/* $sql = "INSERT INTO chamada (presente) VALUES ('$final_value1')";
			
			mysqli_query($con, $sql); */
			
			
			/* <?php $sql_insere_chamada_array = "INSERT INTO chamada (id_turma, id_professor, data_chamada, id_aluno, presenca) VALUES";								
				
				
						foreach ($_POST['alunos']  as $cod_aluno => $atributo) {
							
   							$cod_aluno = $atributo['codigo'];
							$presente = $atributo['status'];
							
						
						// Para cada elemento de $usuários, faça:
						/*foreach($alunos as $aluno => $status) {
							$cod_aluno = $aluno;
							$presente = $status;*/							
						  
							// Monta a parte consulta de cada usuário
							/* $sql_insere_chamada_array .= " ('$cod_turma', '$cod_professor', '$data_hoje', '{$cod_aluno}', '{$presente}'),";						  
						}
				
						// Tira o último caractere (vírgula extra)					
						$sql_insere_chamada_array = substr($sql_insere_chamada_array, 0, -1);
				
						// Executa a consulta
						mysqli_query($conexao, $sql_insere_chamada_array) or die(mysqli_error($conexao));
	?> */
	
		?>
>>>>>>> 6e584ed3afdd418c507a5875e5ac78976f497131
</body>
</html>