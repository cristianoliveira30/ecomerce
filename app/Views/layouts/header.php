<header class="shadow-sm bg-dark">
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark py-2">
    <div class="container-fluid">

      <!-- LOGO -->
      <a class="navbar-brand fw-bold text-light text-decoration-none" href="/">DropBrasil</a>

      <!-- Botão hambúrguer -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <!-- Itens da navbar -->
      <div class="collapse navbar-collapse" id="navbarContent">

        <!-- Barra de pesquisa -->
        <form class="d-flex flex-grow-1 mx-lg-3 my-3 my-lg-0">
          <input class="form-control me-2 rounded-pill" type="search" placeholder="Pesquisar produto...">
          <button class="btn btn-outline-light rounded-pill" type="submit">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
              <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
            </svg>
          </button>
        </form>

        <!-- Links e botões -->
        <div class="d-flex align-items-center flex-column flex-lg-row ms-lg-3">
          <a href="/contato" class="nav-link text-light mb-2 mb-lg-0 me-lg-3">Contato</a>
          <a href="#" class="nav-link text-light mb-2 mb-lg-0 me-lg-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
              <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
            </svg>
          </a>

          <?php if ($isLoggedIn): ?>
            <span class="text-light me-lg-3 mb-2 mb-lg-0">Olá, <?= htmlspecialchars($user->name) ?>!</span>
            <a href="/logout" class="btn btn-outline-light rounded-pill px-3 w-100 w-lg-auto mb-2 mb-lg-0">Sair</a>
          <?php else: ?>
            <a href="#" id="openLoginBtn" class="btn btn-outline-light rounded-pill px-3 w-100 w-lg-auto mb-2 me-1 mb-lg-0">Entrar</a>
            <a href="#" id="openCadastroBtn" class="btn btn-light rounded-pill text-dark px-3 w-100 w-lg-auto">Cadastrar</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
</header>
