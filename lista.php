<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="jquery.js"></script>
    <link rel="stylesheet" href="estilos/estilos.css">

 </head>
<body>
    <div class="container">
        <h1>Leitor de arquivos - Shosp</h1>
        <button onclick="gerarGelatorio()">Gerar relatório a partir de CSV</button>
        <table id="pacientes">

        </table>
    </div>

</body>
<script>
    function gerarGelatorio(){
        $.ajax({
            url: 'http://localhost/teste-pratico-dev-estagio-php/cadastra.php',
            sucess: function (response){
                console.log(response)
            }
        }).done(function (msg){
            console.log(msg)
        })
    }
</script>

</html>