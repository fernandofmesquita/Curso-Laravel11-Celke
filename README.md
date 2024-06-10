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

Criar tabelas no Banco de Dados
```
php artisan migrate
```

Executar as Seed
```
php artisan db:seed 
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

## Criar Controller
```
php artisan make:controller <nome da controller>Controller
```

Utilizar o nome da controller no singular. Nome da tabela no plural e nome da controller no singular.
```
php artisan make:controller CourseController
```

## Criar uma View
```
php artisan make:view <nome da pasta>/<nome da view>
```

Utilize a Pasta com o Nome da Tabela do DB e crie todas as Views referente a essa tabela na mesma pasta. EX index, create, edit e show.
```
php artisan make:view courses/index
```

## Criar uma Model

Utilize o nome da model sempre do singular referente a tabela do banco de dados e utilize o seguinte comando para criar a model

```
php artisan make:model Course
```

## Criar uma Seed

Utilize o nome da seed sempre do singular referente a tabela do banco de dados, juntamente com a palavra Seeder e utilize o seguinte comando para criar a seed

```
php artisan make:seeder CourseSeeder
```

Executar as Seed
```
php artisan db:seed 
```