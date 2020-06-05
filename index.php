<?php
$c = $_GET['c'];
try{
            $conexao = new PDO("mysql:host=10.150.150.30;dbname=agendamento_eventos","agendamento_user","Cr3@DF@#2020");
            
        }catch(PDOException $erro){
            echo "Erro na conexao com o banco de dados".$erro->getMessage();

        }catch(Exception $erro){
            echo "Erro".$erro->getMessage();
            
        }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title>Agentamento de eventos</title>
    <style>
    body{
      background-color: #F0E68C;
    }
    .cards{
      display: flex;
      flex-direction: row;
      justify-content: center;
      margin-top: 15px;
      padding: 15px;
    }
    .card{
      margin-left: 10px;
    }
    .form-group{
      padding: 15px;
    }
    .nav{
      background-color: #6495ED;
      justify-content: center;

    }
    h2{
      color: #fff;
    }
    .card-header{
      justify-content: center;
    }
    </style>
</head>
<body>
<div class="nav">
    <h2>Agendar entrega de carteira profissional-CREA/DF</h2>
</div>
<h4 id="relogio" style="color:#E0FFFF"></h4>
<div class="cards">
  <div class="card" style="width: 18rem;">
    <div class="card-header">
      Escolha um dia e horário
    </div>
    <form>
      <div class="form-group">
        <label for="exampleFormControlSelect1">Datas disponiveis</label>
        <select class="form-control" id="select" name='valores'>
        <option>Selecione...</option>
        <option value='2020-06-06'>06/06/2020</option>
        <option value='2020-06-08'>08/06/2020</option>
        </select>
      </div>
      <div id="select06" class="form-group" style="display:none">
        <label for="exampleFormControlSelect1">Horários disponivéis</label>
        <select class="form-control" id="06">
        <option>Selecione...</option>
        <?php
         $dia = 'tete';
          foreach($conexao->query('SELECT id,at_inicial, at_final FROM tb_agendamento where disponivel ="1" and data="2020-06-06" order by id') as $row){
              echo '<option value="'.$row['id'].'">'.$row['at_inicial'].'-'.$row['at_final'].'</option>';
          }       
          ?>
        </select>
      </div>
      <div id="select08" class="form-group" style="display:none">
        <label for="exampleFormControlSelect1">Horários disponivéis</label>
        <select class="form-control" id="08">
        <option>Selecione...</option>
        <?php
         $dia = 'tete';
          foreach($conexao->query('SELECT id,at_inicial, at_final FROM tb_agendamento where disponivel ="1" and data="2020-06-08" order by id') as $row){
              echo '<option value="'.$row['id'].'">'.$row['at_inicial'].'-'.$row['at_final'].'</option>';
          }       
          ?>
        </select>
      </div>
    </form>
    <button id="btnCadastrar" type="button" class="btn btn-info">Agendar</button>
  </div>

</div>

<script src="js/jquery-3.5.1.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script>
var valores='';
$('#select').change(function (){
     valores = ($(this).val());
    if(valores == '2020-06-06'){
      $('#select06').css("display","block")
      $('#select08').css("display","none")
    }else if(valores == '2020-06-08'){
      $('#select08').css("display","block")
      $('#select06').css("display","none")
    }
    
    
 });

 $("#btnCadastrar").on("click", function(){

  if(valores == '2020-06-06'){
      var id = $("#06 option:selected").val();
      $.ajax({
            type: 'POST',
            url: 'http://10.150.150.26/agendamento_eventos/confirma.php',
            async: false,
            data: {id: id, registro: '<?php echo $c; ?>'},
            success: function(response) {
                alert(response)
            },
            error: function(erro){
                alert(erro)
            }
        });
    }else if(valores == '2020-06-08'){
      var id = $("#08 option:selected").val();
      $.ajax({
            type: 'POST',
            url: 'http://10.150.150.26/agendamento_eventos/confirma.php',
            async: false,
            data: {id: id, registro: '<?php echo $c; ?>'},
            success: function(response) {
                alert(response)
            },
            error: function(erro){
                alert(erro)
            }
      });
    }
 
});
</script>

<!--Função mostrar relógio-->
<script>
function relogio(){
    var data = new Date();
    var horas = data.getHours();
    var minutos = data.getMinutes();
    var segundos = data.getSeconds();

    if(horas < 10){
        horas = "0" + horas;
    }
    if(minutos <10){
        minutos = "0" + minutos;
    }
    if(segundos < 10){
        segundos = "0" + segundos;
    }
    document.getElementById("relogio").innerHTML=data.getDate()+"/"+(data.getMonth()+1)+"/"+data.getFullYear()+" "+horas+":"+minutos+":"+segundos;
}
window.setInterval("relogio()",1000)

</script>
</body>
</html>