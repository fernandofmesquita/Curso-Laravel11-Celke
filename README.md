# Curso de Lavavel 11 - Celke Cursos

## Requisitos

* PHP 8.2 ou superior
* Composer
* Node.js 20 ou superior
* GIT


## Sequencia para criar o projeto

Acesse ou crie uma pasta de sua preferencia, abra o terminal (cmd) nessa pasta e execute os comando para criar o projeto

```
mkdir meu-projeto && cd meu-projeto
```

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

Insatalar as dependências node.JS
```
npm install
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

Executar as dependencias Node.JS
```
npm rum dev
```



## Instalar o Laravel Auditing
Instalar
```
composer require owen-it/laravel-auditing
```

Criar arquivo de Config
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="config"
```

Criar migration da Tabela audits
```
php artisan vendor:publish --provider "OwenIt\Auditing\AuditingServiceProvider" --tag="migrations"
```

Executar o Migrate
```
php artisan migrate
```

Utilize a seguinte configuração nas Models
```
<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class User extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    // ...
}
```

Limpar cache de configuração (Somente se não funcionar)
```
php artisan config:clear
```

## Tradução do Projeto

Utilizando a Tradução [Módulo de linguagem pt-BR (português brasileiro) para Laravel](https://github.com/lucascudo/laravel-pt-BR-localization).

### Instalação

Scaffold do diretório lang
```
php artisan lang:publish
```

Instale o pacote
```
composer require lucascudo/laravel-pt-br-localization --dev
```

Publique as traduções
```
php artisan vendor:publish --tag=laravel-pt-br-localization
```

Configure o Framework para utilizar 'pt_BR' como linguagem padrão
```
// Altere Linha 85 do arquivo config/app.php para:
'locale' => 'pt_BR'

// Para versões 11.x altere a linha 8 do arquivo .env
APP_LOCALE=pt_BR
```

Limpar cache de configuração (Somente se não funcionar)
```
php artisan config:clear
```

## Instalar Bootstrap 5 com o PopperJS

Instala dependencias Node.JS
```
npm install
```

Instala o bootstrap e popper
```
npm i --save bootstrap @popperjs/core
```

Executar as dependencias Node.JS
```
npm rum dev
```

## Instalar Biblioteca de Icones 

Icones [Font Awesome](https://fontawesome.com/icons)

Instalar a Biblioteca de Icones Free

```
npm i --save @fortawesome/fontawesome-free
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

Adicionar uma colulas em um tabela
```
php artisan make:migration alter_courses_add_price_table
```

Executar o Migration

```
php artisan migrate
```

Executar o Rollback, para desfazer o ultimo migrate
```
php artisan migrate:rollback
```

## Criar Controller
```
php artisan make:controller <nome da controller>Controller
```

Utilizar o nome da controller no singular. Nome da tabela no plural e nome da controller no singular.
```
php artisan make:controller CourseController
```
Ou já com os resource
```
php artisan make:controller CourseController --resource
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

## Criar validação do Formulário

Criar um request para validar os dados preenchidos no formulário
```
php artisan make:request CourseRequest
```

## Criar componente 

Criar componente com as mensagens de alerta
```
php artisan make:component <nome> --view
```
```
php artisan make:component alert --view
```