<?php
require "Email/mail.php";
try{
    $conexao = new PDO("mysql:host=10.150.150.30;dbname=agendamento_eventos","agendamento_user","Cr3@DF@#2020");
    $mail = new Email();

    foreach($conexao->query('SELECT nome,registro, email FROM tb_profissional order by id') as $row){
        $mail->enviar($row['email'], $row['nome'],$row['registro']);
    } 
    echo "e-mail enviado!";
    
}catch(PDOException $erro){
    echo "Erro na conexao com o banco de dados".$erro->getMessage();

}catch(Exception $erro){
    echo "Erro".$erro->getMessage();
    
}