<?php
require_once '../dao/conexao.inc.php';

function efetuarLogin($login,$senha){

    $con = new Conexao();
    $conexao = $con->getConexao();

    $sql = $conexao->prepare("select * from usuario where login = :usr and senha = :pass");
    
    $login = strtolower($login);
    $sql->bindvalue(':usr',$login);
    $sql->bindvalue(':pass',$senha);
    $sql->execute();

    $count = $sql->rowCount(); //Verificando quantos registros retornam; caso seja 1, localizou

    if($count == 1){
        return true;
    }
    else{
        return false;
    }    
}

//$tipo = $_REQUEST['pTipo'];
$login = $_REQUEST['pLogin'];
$senha = $_REQUEST['pSenha'];
//if ($tipo == '1')
{
    $logado = efetuarLogin($login, $senha);
    if($logado) // se achou o usuário, a função retorna true
    {
        session_start();
        $_SESSION['logado'] = true;
        //$_SESSION['tipousuario'] = '1';
        header("Location: ../views/index.php");
    }
    else
    {
        header("Location: ../views/LoginUsuario.php?erro=1");
    }
}

?>


