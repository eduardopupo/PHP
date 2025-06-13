Funcionalidades:
- Cadastro de usuários (com login, senha e e-mail)
- Login com validação
- Cadastro de filmes (após login)
- Listagem dos filmes cadastrados pelo usuário logado
- Edição dos filmes
- Logout
- Interface básica com CSS

Estrutura:
- /includes/ => arquivos auxiliares
- /sql/ => script SQL para criar o banco
- /css/ => estilos
- index.php => tela de login
- cadastro.php => cadastro de usuário
- dashboard.php => menu inicial
- novo_item.php => cadastro de filmes
- itens.php => listagem
- editar_item.php => edição
- logout.php => finaliza a sessão

Tecnologias: PHP + MySQL + CSS

|   ===================================     |
|   Sistema de Cadastro de Filmes - PHP     |
|   ===================================     |

📌 Tema escolhido:
Cadastro de Filmes (CRUD simples com autenticação)

🧾 Resumo do funcionamento:
Este sistema permite que usuários se cadastrem e acessem sua área restrita, onde podem adicionar, visualizar e editar uma lista de filmes cadastrados por eles. Os dados são armazenados em um banco de dados MySQL e o controle de login é feito com sessões PHP.

👤 Usuário de teste:

 - Cadastrar um usuário e testar
        Login: teste
        senha: teste
        E-mail: teste@outlook.com

💾 Passos para instalação e execução:

1. Instale o XAMPP ou outro ambiente com suporte a PHP e MySQL.
2. Copie a pasta do projeto para o diretório `htdocs/` do XAMPP. Exemplo:
   `C:\xampp\htdocs\Projeto`
3. Inicie o Apache e o MySQL pelo painel do XAMPP.
4. Acesse o phpMyAdmin: http://localhost/phpmyadmin
5. Clique em "Importar" e selecione o arquivo `sql/criar_banco.sql`.
6. Aguarde a mensagem de sucesso da importação.
7. Acesse o sistema em: http://localhost/Projeto
8. Cadastre um novo usuário ou utilize o usuário de teste.

📁 Estrutura de arquivos:
- index.php – Tela de login
- cadastro.php – Cadastro de novo usuário
- dashboard.php – Tela principal após login
- novo_item.php – Cadastro de filmes
- itens.php – Listagem dos filmes
- editar_item.php – Edição de filmes
- logout.php – Finaliza a sessão
- includes/conexao.php – Conexão com banco de dados
- css/estilo.css – Estilização visual
- sql/criar_banco.sql – Script de criação do banco e tabelas

🛠️ Requisitos atendidos:
✅ Cadastro de usuário
✅ Validação de login/senha
✅ Cadastro de itens (filmes)
✅ Edição de itens
✅ Validação de campos obrigatórios
✅ Sessões para autenticação
✅ Logout funcional
✅ Interface com CSS
✅ Uso de prepared statements (mysqli)
✅ Instruções de instalação no README


Importar o arquivo .sql:
No phpMyAdmin, clique em “Novo” e crie o banco de dados com o nome:

projeto_php
Clique no banco recém-criado e depois na aba Importar.

Escolha o arquivo sql/criar_banco.sql do projeto.

Clique em Executar. A query executada será:

CREATE TABLE IF NOT EXISTS usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    login VARCHAR(50) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS filmes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES usuarios(id) ON DELETE CASCADE
);
