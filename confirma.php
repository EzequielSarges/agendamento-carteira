<?php


try{

    $conexao = new PDO("mysql:host=localhost;dbname=agendamento_eventos","root","");
        
}catch(PDOException $e){
    echo "Erro ao Conectar com o Banco de Dados".$e;
}


if(isset($_POST) && !empty($_POST)){
    $agendamento = $_POST['id'];
    $registro = $_POST['registro'];
    $conexao->query("UPDATE tb_profissional SET id_agendamento = '$agendamento' WHERE  registro ='$registro'");
    echo "Agendamento realizado.";
}else{
    echo "erro ao agendar.";
}


?>