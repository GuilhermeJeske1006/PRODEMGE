# Controle de Usuários e Endereços - PRODEMGE

O projeto consiste em um sistema de controle de usuários e seus endereços, utilizando as tecnologias Vue.js com a biblioteca Vuetify para o front-end, Laravel para o back-end e MySQL para o banco de dados.

## Inicialização

Para iniciar o projeto, siga as instruções abaixo:

### Clonar o repositório

Clone o repositório disponível em: [https://github.com/GuilhermeJeske1006/PRODEMGE.git](https://github.com/GuilhermeJeske1006/PRODEMGE.git).

### Iniciar o Front-end

1. Abra o terminal e navegue até a pasta do front-end:
    ```
    cd front
    ```
2. Instale as dependências do Node.js utilizando o comando:
    ```
    npm install
    ```
3. Inicie o servidor de desenvolvimento com o comando:
    ```
    npm run dev
    ```

### Iniciar o Back-end

1. No terminal, navegue até a pasta do back-end:
    ```
    cd api
    ```
2. Instale as dependências do Laravel utilizando o Composer:
    ```
    composer install
    ```
3. Gere uma chave para a aplicação Laravel:
    ```
    php artisan key:generate
    ```
4. Configure o banco de dados no arquivo `.env` do Laravel. Certifique-se de definir `DB_DATABASE=PRODEMGE`.

5. Execute as migrações e popule o banco de dados utilizando o comando:
    ```
    php artisan migrate --seed
    ```
6. Inicie o servidor Laravel com o comando:
    ```
    php artisan serve
    ```

    ![image](https://github.com/GuilhermeJeske1006/PRODEMGE/assets/97289331/7376d9dd-55fb-4d09-aa10-d945377a5d5c)


## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para enviar pull requests ou relatar problemas.
