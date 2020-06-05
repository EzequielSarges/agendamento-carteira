<?php


try{

    $conexao = new PDO("mysql:host=10.150.150.30;dbname=agendamento_eventos","agendamento_user","Cr3@DF@#2020");
        
}catch(PDOException $e){
    echo "Erro ao Conectar com o Banco de Dados".$e;
}


if(isset($_POST) && !empty($_POST)){
    $agendamento = $_POST['id'];
    $registro = $_POST['registro'];
    $conexao->query("UPDATE tb_profissional SET id_agendamento = '$agendamento' WHERE  registro ='$registro'");
    $conexao->query("UPDATE tb_agendamento SET disponivel = '0' WHERE  id ='$agendamento'");
    echo "Agendamento realizado.";
}else{
    echo "erro ao agendar.";
}


?>