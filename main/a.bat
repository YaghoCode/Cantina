Tava dentro do modal de editar cliente no estoque
id="nome_editar_clientes_admin"

colocar no cpf bloqueado no modal cliente
<i class="fa-solid fa-ban" style="color: #ff0000;"></i>


$query_cliente = "SELECT nome, cpf, email, turma FROM cliente WHERE cpf = '$cpf'";
$result_cliente = mysqli_query($con, $query_cliente);
$user_data_cliente = mysqli_fetch_assoc($result_cliente);

