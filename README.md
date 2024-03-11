Instruction to use:

Clonar o Repositório: https://github.com/4d4m0r/Buzzvel-.git
Instalar Dependências: composer install
Configurar o Ambiente: cp .env.example .env e preencher com as credenciais do banco de dados
Gerar Chave de Aplicativo: php artisan key:generate
Executar as Migrações do Banco de Dados: php artisan migrate
Executar Servidor de Desenvolvimento: php artisan serve
Testar a API: Eu utilizei o Insomnia para testar os endpoint e disponibilizei um json com meus testes. 
              Ao realizar um registro de usuário, deve-se fazer o login e recupear o accessToken
              Após isso deve adicionar o Auth BearerToken nas rotas.