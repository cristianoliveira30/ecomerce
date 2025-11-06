# 🧭 Projeto de E-commerce de Cursos em PHP Puro

Este projeto é uma plataforma de venda de cursos desenvolvida **em PHP puro**, utilizando **HTML, CSS, JavaScript e MySQL**, seguindo uma arquitetura limpa e organizada em camadas.

---

## ⚙️ Iniciar

1. Instale o **PHP (versão 8.3.14 ou superior)** e **MySQL** na sua máquina.  
2. Crie um arquivo **.env** na raiz do projeto conforme o exemplo no código, e preencha com suas credenciais de banco de dados.  
3. Crie um banco de dados compatível com as credenciais do `.env`.  
4. Rode as migrations para criar as tabelas do sistema.  

---

## 🧩 Comandos Disponíveis

| Comando | Descrição |
|----------|------------|
| `php comands/make_migration.php nome_da_migration` | Cria uma nova migration. |
| `php comands/migrate.php` | Executa as migrations e cria as tabelas no banco. |
| `php comands/migrate_rollback.php` | Desfaz a última execução das migrations. |
| `php comands/make.php [controller/model/view] NomeDoArquivo` | Cria um Controller, Model ou View automaticamente. |
| `php -S localhost:8000 -t public` | Inicia o servidor local, acesse via [http://localhost:8000](http://localhost:8000). |

---

## 🧰 Tecnologias Utilizadas

- **PHP 8.3+**
- **MySQL**
- **HTML5 / CSS3 / JavaScript**
- **Arquitetura MVC**
- **Factory Pattern**
- **Repository Pattern**
- **Service Layer Pattern**

---

## 💻 Acesso Local

Após iniciar o servidor:
```
php -S localhost:8000 -t public
```

Acesse no navegador:  
👉 [http://localhost:8000](http://localhost:8000)

---

## 📂 Em Desenvolvimento

- Área de administração de produtos
- Integração com gateway de pagamento  
- Filtros e busca dinâmica  

---

✍️ **Desenvolvido com dedicação em PHP puro**, priorizando organização, aprendizado e boas práticas.
