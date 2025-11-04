<div id="homeCarousel" class="carousel slide mb-5" data-bs-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img src="/img/svg/Camada 1.svg" class="d-block w-100" alt="Banner 1">
      <div class="carousel-caption text-start d-none d-md-block">
        <a href="#" class="btn btn-primary rounded-pill px-4">Ver cursos</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="/img/svg/Camada 2.svg" class="d-block w-100" alt="Banner 2">
      <div class="carousel-caption text-start d-none d-md-block">
        <a href="#" class="btn btn-light rounded-pill px-4">Saiba mais</a>
      </div>
    </div>
    <div class="carousel-item">
      <img src="/img/svg/Camada 3.svg" class="d-block w-100" alt="Banner 3">
      <div class="carousel-caption text-start d-none d-md-block">
        <a href="#" class="btn btn-light rounded-pill px-4">Começar agora</a>
      </div>
    </div>
  </div>

  <!-- Controles -->
  <button class="carousel-control-prev" type="button" data-bs-target="#homeCarousel" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Anterior</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#homeCarousel" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Próximo</span>
  </button>
</div>

<!-- 🎓 Seção de cursos -->
<section class="container mb-5">
  <h3 class="fw-bold mb-3 text-dark">Cursos em destaque</h3>
  <p class="text-muted mb-4">Explore os cursos mais procurados pelos alunos!</p>

  <div class="row g-4">
    <?php for ($i = 1; $i <= 6; $i++): ?>
      <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
          <img src="/public/images/course<?= $i ?>.jpg" class="card-img-top" alt="Curso <?= $i ?>">
          <div class="card-body">
            <h5 class="card-title fw-bold">Curso <?= $i ?></h5>
            <p class="card-text text-muted">Aprenda algo novo e avance na sua carreira.</p>
          </div>
          <div class="card-footer bg-transparent border-0">
            <a href="#" class="btn btn-primary w-100 rounded-pill">Ver detalhes</a>
          </div>
        </div>
      </div>
    <?php endfor; ?>
  </div>
</section>