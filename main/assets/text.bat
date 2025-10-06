  document.addEventListener('DOMContentLoaded', () => {
                const buttonsDeletar = document.querySelectorAll('.activeButtonExcluir');

                buttonsDeletar.forEach(button2 => {
                    button2.addEventListener('click', () => {
                        const modalId = button2.getAttribute('data-id');
                        const modal = document.getElementById('modal-' + modalId);
                        console.log(modal)
                        <?php
                            $query = "DELETE FROM estoque WHERE id = $item ";
                        ?>
                    });
                });
            });
