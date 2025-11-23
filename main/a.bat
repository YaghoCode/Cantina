Estilo dos botões finalizar pedido e finalizar pagamento bugados
função cancelar pedido (modal estoque)
função concluir pedido (modal estoque)
Mostrar pedido de cliente específico na page Meus Pedidos



Modal visualizar pedido diferente
<?php
        $query = "SELECT * from pedido";
        $query_run = mysqli_query($con, $query);
        if (mysqli_num_rows($query_run) > 0) {
            foreach ($query_run as $pedido) {
                // Nova consulta para obter informações do cliente
                $cpf_cliente = $pedido['cpf']; // Supondo que o CPF do cliente está armazenado no pedido
                $cliente_query = "SELECT * FROM cliente WHERE cpf = '$cpf_cliente'";
                $cliente_query_run = mysqli_query($con, $cliente_query);
                $cliente = mysqli_fetch_assoc($cliente_query_run); // Obtém os dados do cliente

                $idPedido = $pedido['id'];
                $produtos_query = "SELECT * FROM pedido_itens WHERE pedido_id = $idPedido";
                $produtos_query_run = mysqli_query($con, $produtos_query);
                ?>

                <div class="modal-overlay-visualizar-pedido" id="overlay_modal_pedido-<?= $pedido['id'] ?>">
                    <div class="modal-visualizar-pedido" id="modal_pedido-<?= $pedido['id'] ?>">
                        <button class="btn-fechar-modal-visualizar" data-id="<?= $pedido['id'] ?>">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                        <div class="content-modal-visualizar-pedido">
                            <div class="content-modal-visualizar-top">
                                <div class="content-modal-visualizar-top-title">
                                    <h1>Detalhes do Pedido:</h1>
                                </div>
                                <div class="content-modal-visualizar-top-tagFiltro">
                                    <?php
                                            switch ($pedido['status']) {
                                                case 'Sendo Preparado':
                                                    echo '<h6 style="background-color: orange">Sendo Preparado</h6>';
                                                    break;
                                                case 'Concluído':
                                                    echo '<h6 style="background-color: #00bf63">Concluído</h6>';
                                                    break;
                                                case 'Cancelado':
                                                    echo '<h6 style="background-color: red">Cancelado</h6>';
                                                    break;
                                                default:
                                                    echo '<td><strong>' . htmlspecialchars($pedido['status']) . '</strong></td>';
                                                    break;
                                            }
                                            ?>
                                    <!--php status pedido-->
                                </div>
                            </div>
                            <div class="content-modal-visualizar-mid">
                                <div class="content-modal-visualizar-mid-row">
                                    <div class="content-modal-visualizar-mid-group">
                                        <div class="mid-group-numero-pedido">
                                            <h1>Número do pedido:</h1>
                                            <span># <?php echo $pedido['id']; ?></span>
                                            <!--php number pedido-->
                                        </div>
                                        <div class="mid-group-data-pedido">
                                            <h1>Data:</h1>
                                            <span><?php echo $pedido['data_pedido']; ?></span>
                                            <!--php data pedido-->
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group">
                                        <div class="mid-group-turno-pedido">
                                            <h1>Turno:</h1>
                                            <span>Manhã</span><!--php turno pedido-->
                                        </div>
                                    </div>
                                </div>
                                <div class="content-modal-visualizar-mid-row">
                                    <div class="content-modal-visualizar-mid-group-user">
                                        <div class="mid-group-info-user">
                                            <h1>Informações do Cliente:</h1>
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group-user">
                                        <div class="mid-group-info">
                                            <h1>Nome:</h1>
                                            <span><?php echo $cliente['nome']; ?></span>
                                        </div>
                                        <div class="mid-group-info">
                                            <h1>Turma: </h1>
                                            <span><?php echo $cliente['turma']; ?></span>
                                        </div>
                                        <div class="mid-group-info">
                                            <h1>CPF: </h1>
                                            <span><?php echo $pedido['cpf']; ?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="content-modal-visualizar-mid-row" style="border: none;">
                                    <div class="content-modal-visualizar-mid-group-pedido" style="margin-bottom: 4vh;">
                                        <div class="mid-group-info-pedido">
                                            <h1>Resumo do pedido:</h1>
                                        </div>
                                    </div>
                                    <div class="content-modal-visualizar-mid-group-pedido">
                                        <div class="mid-group-info-table-pedido">
                                            <div class="tabela-scroll">
                                                <div class="tabela-items-pedido">
                                                     <div class="tabela-items-pedido-produto"></div>
                                                    <?php foreach ($produtos_query_run as $produtos) {
                                                       echo ' <h3> '. $produtos['quantidade' ] . 'x</h4><!--nome do produto-->';
                                                       echo ' <h4> '. $produtos['nome_item' ] . '</h4><!--nome do produto-->';
                                                     }
                                                     ?>             
                                                     </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="content-modal-visualizar-bottom">
                                <div class="visualizar-bottom-preco">
                                    <h1>Total:</h1>
                                    <span>R$<?php echo $pedido['preco_total']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
            }
        }
        ?>