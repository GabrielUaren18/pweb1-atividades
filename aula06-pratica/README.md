# Aula 06: Laravel na prática

Aplicação de estudo da Feira Digital para praticar rotas, respostas HTTP/JSON, controllers, views Blade, redirecionamentos e validação de formulários.

## Requisitos

- PHP 8.3 ou superior
- Composer

## Executar localmente

No PowerShell, a partir desta pasta:

```powershell
composer install
Copy-Item .env.example .env
New-Item -ItemType File -Path database/database.sqlite -Force
php artisan key:generate
php artisan migrate
php artisan serve
```

Abra `http://127.0.0.1:8000`. O formulário de inscrição usa sessão e proteção CSRF; por isso, mantenha a configuração SQLite e rode as migrations.

## Rotas principais

- `/meu-nome`, `/cartao`, `/perfil-json` e `/perfil-criado`
- `/tabuada/{numero}`, `/idade/{ano}` e `/boas-vindas-turma/{turma?}`
- `/cardapio`, `/produtos` e `/produtos/{id}`
- `/produtos/categoria/{categoria}` e `/produtos/{id}/json`
- `/inscricao` (GET para exibir e POST para validar)

Consulte `respostas.md` para os caminhos das requisições, resultados observados e respostas das atividades. Para conferir as rotas e executar os testes:

```powershell
php artisan route:list
php artisan test
```
