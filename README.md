# ✅ To-Do List com Login - PHP + MySQL

Projeto simples e funcional de **lista de tarefas com autenticação**, feito para praticar os fundamentos do desenvolvimento back-end com **PHP** e **MySQL**.

---

## 🚀 Funcionalidades

- 🔐 Cadastro de usuários com e-mail e senha segura (`password_hash`)
- 🔑 Login com validação e proteção por sessões
- 🗒️ Criação de tarefas
- ✏️ Edição de tarefas (título, descrição, status: pendente/concluída)
- ❌ Exclusão de tarefas
- 🧑‍💻 Dashboard individual por usuário (tarefas privadas)
- 🔒 Acesso restrito apenas para usuários autenticados

---

## 🛠️ Tecnologias Utilizadas

- HTML
- CSS
- PHP
- MySQL
- phpMyAdmin
- XAMPP (como ambiente local)
- Git e GitHub

---

## ⚙️ Como Rodar o Projeto

1. Clone o repositório:
   ```bash
   git clone https://github.com/RTeixe0/todo-list.git
   ```

2. Mova a pasta para o diretório do **XAMPP** (geralmente `htdocs`):
   ```bash
   mv todo-list/ C:/xampp/htdocs/
   ```

3. Inicie o Apache e MySQL no XAMPP.

4. Importe o banco de dados:
   - Acesse `phpMyAdmin`
   - Importe o arquivo `sql/banco.sql`

5. Acesse o sistema via navegador:
   ```
   http://localhost/todo-list/
   ```

---

## 📌 Objetivo do Projeto

Este projeto foi criado com fins educacionais, focando em:

- Prática com CRUD (Create, Read, Update, Delete)
- Manipulação de sessões e autenticação
- Conexão segura com MySQL usando `mysqli`
- Organização de código para projetos reais

---

## 💡 Possíveis Melhorias Futuras

- [ ] Implementar recuperação de senha por e-mail
- [ ] Adicionar responsividade com CSS ou frameworks como Bootstrap

---

## 🤝 Contribuições

Contribuições são bem-vindas! Fique à vontade para abrir uma issue ou fazer um pull request.

---