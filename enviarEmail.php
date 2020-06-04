<?php
require "./Email/mail.php";
try{
    $conexao = new PDO("mysql:host=localhost;dbname=agendamento_eventos","root","");
    $mail = new Email();

    foreach($conexao->query('SELECT nome,registro, email FROM tb_profissional order by id') as $row){
        $mail->enviar($row['email'], $row['nome'],$row['registro']);
    } 
    
}catch(PDOException $erro){
    echo "Erro na conexao com o banco de dados".$erro->getMessage();

}catch(Exception $erro){
    echo "Erro".$erro->getMessage();
    
}