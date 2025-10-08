.modal-editar-top-option, .modal-editar-top-title{
    display: flex;
    align-items: center;
    justify-content: center;
    width: 50%;
    height: 100%;
}

.modal-editar-top-title{
    justify-content: flex-start !important;
}

.modal-editar-top-title h1{
    font-family: var(--font-titulo);
    font-size: 1.4rem !important;
    font-weight: 500;
}

.modal-editar-top-option{
    border-radius: 0.3rem;
    overflow: hidden;
}

.modal-editar-top-option button{
    border: none;
    height: 95%;
    width: 50%;
    background-color: white;
    transition: 0.3s ease;
    border-radius: 0.3rem;
    cursor: pointer;
    font-family: var(--font-titulod);
    font-size: 1rem;
    font-weight: 600;
    border: 1px solid rgba(0, 0, 0, 0.278);
}

.btn-nao-trocar-imagem{
    border-bottom-right-radius: 0rem !important;
    border-top-right-radius: 0rem !important;
}

.btn-nao-trocar-imagem.active{
    background-color: var(--cor-primaria);
    color: white;
    cursor: default;
}

.btn-trocar-imagem{
    border-bottom-left-radius: 0rem !important;
    border-top-left-radius: 0rem !important;
}

.btn-trocar-imagem.active{
    background-color: var(--cor-primaria);
    color: white;
    cursor: default;
}

