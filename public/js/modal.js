// modal.js — versão funcional para login e cadastro
(function () {
  function openModal(modal) {
    if (!modal) return;
    modal.classList.add("show");
    modal.style.display = "flex";
    modal.setAttribute("aria-hidden", "false");
    document.body.classList.add("manual-modal-open");
    document.body.style.overflow = "hidden";

    // guarda elemento que abriu pra retornar foco depois
    modal._trigger = document.activeElement;

    // foco no primeiro input
    const first = modal.querySelector(
      'input, button, select, textarea, [tabindex]:not([tabindex="-1"])'
    );
    if (first) first.focus();

    // trap focus (simples)
    modal.addEventListener("keydown", trapFocus);
  }

  function closeModal(modal) {
    if (!modal) return;
    modal.classList.remove("show");
    modal.style.display = "none";
    modal.setAttribute("aria-hidden", "true");
    document.body.classList.remove("manual-modal-open");
    document.body.style.overflow = "";

    modal.removeEventListener("keydown", trapFocus);

    // retorna foco para trigger
    if (modal._trigger) modal._trigger.focus();
  }

  function trapFocus(e) {
    if (e.key !== "Tab") return;
    const modal = e.currentTarget;
    const focusables = modal.querySelectorAll(
      'a[href], button:not([disabled]), textarea, input, select, [tabindex]:not([tabindex="-1"])'
    );
    if (!focusables.length) return;
    const first = focusables[0];
    const last = focusables[focusables.length - 1];

    if (e.shiftKey && document.activeElement === first) {
      e.preventDefault();
      last.focus();
    } else if (!e.shiftKey && document.activeElement === last) {
      e.preventDefault();
      first.focus();
    }
  }

  // 🔹 Handlers globais
  document.addEventListener("click", function (e) {
    // Abrir manualmente (Cadastro ou Login)
    const openCadastro = e.target.closest("#openCadastroBtn");
    const openLogin = e.target.closest("#openLoginBtn");

    if (openCadastro) {
      e.preventDefault();
      const modal = document.getElementById("cadastroModal");
      openModal(modal);
      return;
    }

    if (openLogin) {
      e.preventDefault();
      const modal = document.getElementById("loginModal");
      openModal(modal);
      return;
    }

    // Fechar manualmente
    if (e.target.closest("[data-modal-close]")) {
      const modal = e.target.closest(".manual-modal");
      closeModal(modal);
      return;
    }

    // Fechar ao clicar fora (backdrop)
    if (
      e.target.classList &&
      e.target.classList.contains("manual-modal-backdrop")
    ) {
      const modal = e.target.closest(".manual-modal");
      closeModal(modal);
      return;
    }
  });

  // Fechar com ESC
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      const modal = document.querySelector(".manual-modal.show");
      if (modal) closeModal(modal);
    }
  });

  // 🔹 Acesso global (para uso direto em onclick)
  window.manualModal = {
    openModal(id) {
      const modal = document.getElementById(id);
      if (!modal) return;
      openModal(modal);
    },
    closeModal(id) {
      const modal = document.getElementById(id);
      if (!modal) return;
      closeModal(modal);
    },
    switchModal(fromId, toId) {
      this.closeModal(fromId);
      this.openModal(toId);
    },
  };
})();
