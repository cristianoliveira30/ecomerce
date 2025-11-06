# 🧭 Projeto de E-commerce de Cursos em PHP Puro

Este projeto é uma plataforma de venda de cursos desenvolvida **em PHP puro**, utilizando **HTML, CSS, JavaScript e MySQL**, seguindo uma arquitetura limpa e organizada em camadas.

---

## 🚀 Estrutura do Projeto

app/
 ├── Controllers/
 ├── Models/
 ├── Views/
 ├── Services/         # Regras de negócio e integração com o banco
 ├── Repository/       # Consultas SQL e acesso a dados
 ├── Factory/          # Geração de dados fake (ex: cursos)
bootstrap/
config/
database/
 ├── migrations/
public/
 ├── assets/
 ├── index.php
.env

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
| `php comands/make.php [controller|model|view] NomeDoArquivo` | Cria um Controller, Model ou View automaticamente. |
| `php -S localhost:8000 -t public` | Inicia o servidor local, acesse via [http://localhost:8000](http://localhost:8000). |

---

## 🧠 Camada de Negócio (Services & Repository)

Agora o projeto conta com uma camada de **Service** e **Repository**, separando responsabilidades:

- `App\Repository\CourseRepository` → faz consultas SQL diretas ao banco.
- `App\Services\CourseService` → aplica regras de negócio e retorna dados prontos para o Controller.

Exemplo de uso:
```php
use App\Services\CourseService;

$service = new CourseService();
$courses = $service->getAllCourses();
```

---

## 🏭 Factory (Dados Fakes)

Foi adicionado o diretório **`app/Factory`** para gerar dados de teste.

Exemplo de uso:
```php
use App\Factory\CourseFactory;

$factory = new CourseFactory();
$courses = $factory->generate(10); // Gera 10 cursos fictícios
```

Esses dados podem ser usados em desenvolvimento antes de conectar o banco de dados.

---

## 🎡 Carrossel Responsivo (Home)

A página inicial (`home.php`) agora conta com um **carrossel de cursos responsivo**:
- Layout ajustável para **desktop, tablet e mobile**  
- Rolagem lateral suave  
- Setas laterais automáticas em telas grandes  
- Scroll via toque em dispositivos móveis  

As artes do carrossel podem ser exportadas do **Adobe Illustrator** em **SVG**, nas dimensões recomendadas:
> **1920x600 px (desktop)**  
> **1080x720 px (mobile)**  

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

- Sistema de autenticação de usuários  
- Área de administração de cursos  
- Integração com gateway de pagamento  
- Filtros e busca dinâmica  

---

✍️ **Desenvolvido com dedicação em PHP puro**, priorizando organização, aprendizado e boas práticas.
