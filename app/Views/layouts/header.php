<header class="shadow-sm bg-dark">
  <nav class="navbar navbar-expand-lg navbar-light bg-dark py-2">
    <div class="container-fluid">
      <a class="navbar-brand fw-bold text-light text-decoration-none me-4" href="/">DropBrasil</a>

      <form class="d-flex flex-grow-1 mx-3">
        <input class="form-control me-2 rounded-pill" type="search" placeholder="Pesquisar produto...">
        <button class="btn btn-outline-light rounded-pill" type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
          </svg>
        </button>
      </form>

      <div class="d-flex align-items-center">
        <a href="/contato" class="nav-link text-decoration-none text-light me-3">Contato</a>
        <a href="#" class="nav-link text-decoration-none text-light me-3"><i class="bi bi-cart fs-5"></i></a>

        <?php if ($isLoggedIn): ?>
          <span class="text-light me-3">Olá, <?= htmlspecialchars($user->name) ?>!</span>
          <a href="/logout" class="text-decoration-none btn btn-outline-light rounded-pill px-3">Sair</a>
        <?php else: ?>
          <a href="#" id="openLoginBtn" class="btn btn-outline-light me-2 rounded-pill px-3">
            Entrar
          </a>

          <a href="#" id="openCadastroBtn" class="btn btn-light rounded-pill text-dark px-3">
            Cadastrar-se
          </a>
        <?php endif; ?>
      </div>
    </div>
  </nav>
</header>