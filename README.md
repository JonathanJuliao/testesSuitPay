
# testesSuitPay
=======
# Projeto Laravel - Sistema de Cursos

Este é um sistema desenvolvido em **Laravel**, com funcionalidades para controle de alunos em cursos, bem como o gerenciamento de perfis de usuários. O sistema também inclui recursos de autenticação, validação de prazos de matrícula e atualização de senhas de usuários.

## Funcionalidades

### CRUD ALUNOS

### CRUD Cursos

### Matrícula de Alunos
- **Matricular aluno em curso**: Permite a matrícula de um aluno em um curso, verificando se ele já está matriculado.
- **Verificação de prazo de matrícula**: Impede a matrícula de alunos fora do prazo especificado para o curso.

### Desmatrícula de Alunos
- **Desmatricular aluno**: Permite a desmatrícula de um aluno, verificando se o aluno está matriculado no curso.
- **Verificação de inscrição do aluno**: Impede a desmatrícula de alunos que não estão matriculados no curso.

### Perfil de Usuário
- **Exibição de perfil**: Exibe informações do perfil do usuário, como nome, e-mail e curso matriculado.
- **Atualização de informações**: Permite a atualização das informações do perfil do usuário.
- **Deleção de conta**: Permite a exclusão da conta do usuário após confirmação de senha.
- **Verificação de e-mail**: Garante que o e-mail não seja alterado sem a devida verificação.

### Autenticação e Registro de Usuário
- **Registro de usuário**: Permite o registro de novos usuários com validação de dados.
- **Login e autenticação**: Sistema de login e autenticação utilizando **Sanctum** para proteger as rotas da API.
- **Atualização de senha**: Permite que o usuário atualize sua senha com a validação de senha atual.
- **Redefinição de senha**: Sistema de redefinição de senha em caso de esquecimento.

## Tecnologias Utilizadas

- **Laravel 10.x**: Framework PHP para o desenvolvimento do backend.
- **PHP 8.1**: Versão do PHP utilizada para o desenvolvimento do backend.
- **MySQL**: Banco de dados utilizado para armazenar as informações dos alunos, cursos e usuários.
- **Sanctum**: Sistema de autenticação API para proteger rotas.
- **Bootstrap**: Framework CSS para o design responsivo da aplicação.
- **Tailwind CSS**: Utilizado para um design moderno e flexível.
- **Docker**: Para containerização e facilitar a execução do ambiente de desenvolvimento.

## Bibliotecas e Ferramentas Utilizadas

- **Datatable**: Facilitar o manuseio de tabelas.
- **Laravel Eloquent**: ORM para interação com o banco de dados.
- **Carbon**: Para manipulação de data.
- **Composer**: Gerenciador de dependências PHP.
- **NPM/Yarn**: Gerenciadores de pacotes JavaScript para dependências frontend.

## Instruções de Instalação e Configuração

### Pré-requisitos

- PHP 8.1 ou superior
- Composer
- MySQL ou outro banco de dados compatível
- Node.js e NPM/Yarn 
- Docker (opcional, caso deseje rodar a aplicação em containers)

### Passo a Passo

1. **Clone o repositório**:
     ```bash
    git clone http://github.com/JonathanJuliao/testesSuitPay.git
    cd repositorio
         ```

3. **Instale as dependências do PHP**:
       ```bash
    composer install
       ```

5. **Crie o arquivo `.env` a partir do arquivo `.env.example`**:
          ```bash
    cp .env.example .env
        ```
   

4. **Configure o banco de dados** no arquivo `.env` com suas credenciais:
    ```env
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=nome_do_banco
    DB_USERNAME=usuario
    DB_PASSWORD=senha
    ```

8. **Gere a chave da aplicação**:
    ```bash
    php artisan key:generate
    ```

9. **Execute as migrações do banco de dados**:
    ```bash
    php artisan migrate
    ```

10. **Instale as dependências do frontend** (se necessário):
    ```bash
    npm install
    ```

11. **Inicie o servidor de desenvolvimento**:
    ```bash
    php artisan serve
    ```

    Caso utilize Docker, você pode iniciar os containers com:
    ```bash
    docker-compose up -d
    ```

### Rodando os Testes

Para rodar os testes da aplicação, utilize o comando:

```bash
php artisan test
>>>>>>> master
