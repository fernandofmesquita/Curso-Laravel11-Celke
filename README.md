# Curso de Lavavel 11 - Celke Cursos

## Requisitos

* PHP 8.2+ | Apache 2.4+ | phpMyAdmin 5.2+ ( [XAMPP](https://www.apachefriends.org) )
* Composer [Download](https://getcomposer.org) 
* Node.js 20 ou superior [Download](https://nodejs.org) 
* GIT [Download](https://www.git-scm.com) 


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

Duplicar o arquivo ".env.exemplo" e renomear para ".env" e realizar as alterações.

Realizar o cadastro do site [Mailtrap.io](https://mailtrap.io) 

Pegar as credenciais da conta para o Laravel e realizar alterações no .env

```
EXEMPLO

MAIL_MAILER=smtp
MAIL_HOST=sandbox.smtp.mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=7a236985532b32
MAIL_PASSWORD=********ea1f
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS="sac@cursolaravel.com"
MAIL_FROM_NAME="${APP_NAME}"
```

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

## LARAVEL-PERMISSION

Associar usuários a funções e permissões. [Instalação em Laravel](https://spatie.be/docs/laravel-permission/v6/installation-laravel)

### Instalação
Você pode instalar o pacote via composer :
```
composer require spatie/laravel-permission
```

Você deve publicar a migração e o config/permission.php
```
php artisan vendor:publish --provider="Spatie\Permission\PermissionServiceProvider"
```

Limpe seu cache de configuração . Este pacote requer acesso às permissionconfigurações para executar migrações. Se você estiver armazenando configurações em cache localmente, limpe o cache de configuração com um destes comandos:
```
php artisan config:clear
```

Execute as migrações : após a configuração e a migração terem sido publicadas e configuradas, você pode criar as tabelas para este pacote executando:
```
php artisan migrate
```

Adicione a característica necessária na Model User
```
use HasRoles;
```

### Será criado 5 tabelas no banco de dados
* roles – Esta tabela armazenará o nome de todos os Papeis. 
EX: Super Admin, Admin, Professor, Aluno...

* permissions – Esta tabela armazenará o nome de todas as permissões do aplicativo. 
Ex: 'index-course', 'show-course', 'create-course', 'edit-course', 'destroy-course'...

* role_has_permissions  – Esta tabela armazenará todas as permissões atribuídas a cada Papel. 
Ex: Papel 'Professor' tem Permissão a 'create-course'

* model_has_roles  – Esta tabela armazenará Papéis atribuídos a cada usuário da Model User.
Ex: Papel 'Professor' está atribuido ao Model User 'user_id = 1'

* model_has_permissions  – Esta tabela armazenará as permissões atribuídas a cada modelo. Por exemplo, um modelo de usuário.

### Criando usuário atraves da Seed e atribuindo o papel
Exemplo de Criação da Seed
```
if (!User::where('email', 'admin@admin.com')->first()){
            $admin = User::create([
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'password' => Hash::make('123456', ['rounds' => 12])
            ]);

            // Atribuir papel para o usuário
            $admin->assignRole('Super Admin');

        }
```

### Criando Permissões através da seed
Criar a Seed
```
php artisan make:seeder PermissionSeeder
```

Exemplo de Criação da Seed
```
$permissions = [
    'index-course',
    'show-course',
    'create-course',
    'edit-course',
    'destroy-course',
];

foreach($permissions as $permission){
    $existingPermission = Permission::where('name', $permission)->first();

    if(!$existingPermission){
        Permission::create([
            'name' => $permission,
            'guard_name' => 'web',
        ]);
    }
}
```

### Criando Papel através da seed e atribuir as permissões
Criar a Seed
```
php artisan make:seeder RoleSeeder
```

```
// Verifica se existe e senão existir, cadastra na tabela Roles o nome do papel
if(!Role::where('name', 'Admin')->first()){
    $admin = Role::create([
        'name' => 'Admin',
    ]);

    // Dar permissão para o papel e salva o relacionamento na tabela role_has_permissions
    $admin->givePermissionTo([
        'index-course',
        'show-course',
        'create-course',
        'edit-course',
        'destroy-course',
    ]);
}
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

## Personalizar e-mail de recuperação de senha

Publicar os arquivos na pasta resources\views\vendor
```
php artisan vendor:publish --tag=laravel-mail
```