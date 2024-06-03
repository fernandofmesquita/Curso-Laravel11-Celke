## Requisitos

* PHP 8.2 ou superior
* Composer


## Sequencia para criar o projeto

Criar o projeto com o Laravel
```
composer create-project laravel/laravel .
```

Inciar o projeto criado com Laravel
```
php artisan serve
```

Acessar o conteúdo padra do Laravel
```
http://127.0.0.1:8000
```


## Baixar projeto do GitHub
Criar a pasta do Projeto e abra dentro do VSCode

```
git clone --branch dev-master https://github.com/fernandofmesquita/Curso-Laravel11-Celke.git .
```


## Como rodar o projeto baixado

Duplicar o arquivo ".env.exemplo" e renomear para ".env" e realizar as alterações. <br>

Insatalar as dependências do PHP
```
composer install
```

Gerar a chave
```
php artisan key:generate
```

```
php artisan migrate
```

Inciar o Projeto criado com Laravel
```
php artisan serve
```

## Como usar o GitHub

Baixar arquivos do Git
```
git clone --branch <branch_name> <repository_url> .
```

Verificar em qual branch vc está
```
git branch
```

Baixar as Atualizações
```
git pull
```

## Criar Migrations

```
php artisan make:migration create_<nome da tabela>_table
```

É aconcelhavel utilizar o nome da tabela em inglês e no plural pois o laravel utiliza a regra de pluralidade em suas regras

```
php artisan make:migration create_courses_table
```

Executar o Migration

```
php artisan migrate
```
