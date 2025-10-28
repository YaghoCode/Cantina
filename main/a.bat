Tava dentro do modal de editar cliente no estoque
id="nome_editar_clientes_admin"

colocar no cpf bloqueado no modal cliente
<i class="fa-solid fa-ban" style="color: #ff0000;"></i>


$query_cliente = "SELECT nome, cpf, email, turma FROM cliente WHERE cpf = '$cpf'";
$result_cliente = mysqli_query($con, $query_cliente);
$user_data_cliente = mysqli_fetch_assoc($result_cliente);



 // Excluir cliente via AJAX
            document.querySelectorAll('.btn-confirmar-deletar-cliente').forEach(button => {
                button.addEventListener('click', () => {
                    const clienteId = button.getAttribute('data-id');

                    // Enviar requisição AJAX
                    fetch('./deletar_cliente.php', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                            },
                            body: JSON.stringify({
                                cpf: clienteId
                            }),
                        })
                        .then(response => {
                            console.log('Resposta do servidor:', response);
                            if (!response.ok) {
                                throw new Error('Erro na resposta do servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            console.log('Dados recebidos:', data);
                            if (data.success) {
                                alert('Cliente excluído com sucesso!');
                                const overlay = document.getElementById(`overlay-deletar-cliente-${clienteId}`);
                                const modal = document.getElementById(`modal-deletar-cliente-${clienteId}`);
                                if (overlay && modal) {
                                    overlay.classList.remove('active');
                                    modal.classList.remove('active');
                                }
                                document.querySelector(`[data-id="${clienteId}"]`).remove();
                            } else {
                                alert('Erro ao excluir cliente: ' + (data.error || 'Erro desconhecido.'));
                            }
                        })
                        .catch(error => {
                            console.error('Erro:', error);
                            alert('Erro ao excluir cliente. Verifique o console para mais detalhes.');
                        });
                });
            });
        </script>
