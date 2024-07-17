# bookshelf
Trabalho realizado na disciplina de projeto e sistemas de software.
Tal trabalho é um protótipo de sistema para uma biblioteca onde há três níveis de acesso: Sócios, funcionários e administradores. O sistema foi implementado usando laravel(php), HTML5, CSS3 e javascript. O projeto conta com o cadastro, edição e listagem de livros, exemplares, sócios, fornecedores, funcionários e administradores, além de permitir o aluguel de exemplares.

# Instalação

Dentro do repositório, rodar os seguintes comandos:

<ul>
  <li>composer install</li>
  <li>cp .env.example .env</li>
</ul>

Configure o .env de acordo com suas configurações de banco de dados, depois siga com os comandos:

<ul>
  <li>php artisan key:generate</li>
  <li>php artisan migrate</li>
  <li>php artisan db:seed</li>
  <li>php artisan storage:link</li>
  <li>php artisan serve</li>
</ul>

Agora basta acessar o navegador no endereço localhost:8000, para entrar como administrador é só usar senha = cpf = admin.

# Funcionamento

Seguem algumas imagens do software funcionando:


