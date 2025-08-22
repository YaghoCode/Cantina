<div class="btn-cadastrar-se">
                                  <h1>
                                      Cadastrar-se
                                  </h1>
                              </div>
                                <div class="btn-login">
                                    <button>
                                        Login
                                    </button>
                                </div>

.nav-buttons{
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 40%;
    height: 3vh;
    gap: 2vh;
}

.btn-cadastrar-se{
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
}

.btn-cadastrar-se h1{
    cursor: pointer;
    color: #e3261b;
    font-size: 1.4rem;
    font-family: var(--font-titulo);
    font-weight: 600;
}

.btn-login{
    display: flex;
    align-items: center;
    justify-content: center;
    padding-bottom: 1vh;
}

.nav-buttons button{
    font-size: 1.2rem;
    height: 3.2vh;
    width: 4vw;
    font-family: var(--font-titulo);
    font-weight: 800;
    background-color: var(--cor-primaria);
    color: white;
    border-radius: 0.4em;
    cursor: pointer;
}