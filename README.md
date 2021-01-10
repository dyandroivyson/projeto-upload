# Projeto Upload

API Laravel para envio de arquivos.

## Configuração

Para executar o projeto é necessário realizar a instalação de um comum de um projeto existente Laravel, seguindo os passos abaixo:

1. Acesse o diretório do projeto e realize a instalação das dependências do composer:

        # cd projeto-upload
	    composer install
	    composer dumpautoload -o
	
2. Crie o arquivo .env:

	    cp .env.example .env
	
3. Gere a chave da aplicação:
	
	    php artisan key:generate
	
4. Crie o link simbólico para a pasta onde ficaram salvas os arquivos:

	    php artisan storage:link
	
5. Crie o banco de dados e gere as migrations e seeds:

	    php artisan migrate --seed
	
## Executando

Utilize o usuário abaixo para autenticar na aplicação:

	user: dada@dada.da
	password: dada@123
	
## Documentação da API

Link para a documentação:

[https://documenter.getpostman.com/view/3107115/TVzREHfv](https://documenter.getpostman.com/view/3107115/TVzREHfv)
