# 🚀 FastSearchEngineAPI

Uma API de alta performance para **armazenamento e consulta de dados otimizados para autocomplete e busca rápida**.

O objetivo do projeto é fornecer uma base eficiente para:

- sugestões em tempo real (autocomplete)
- busca textual rápida
- indexação otimizada de dados
- aplicações que exigem baixa latência

---

## 🧠 Visão geral

A **FastSearchEngineAPI** foi projetada para cenários onde velocidade é crítica, como:

- campos de busca com sugestões dinâmicas
- sistemas de recomendação simples
- lookup de dados em grande volume
- pré-processamento para motores de busca mais complexos

---

## ⚙️ Stack utilizada

- **Laravel** → API REST
- **MySQL** → armazenamento relacional
- **Redis** → cache e performance
- **Redis Stack** → busca avançada (RediSearch)
- **Docker + Docker Compose** → ambiente isolado

---

## 🔍 Casos de uso

- Autocomplete de nomes, produtos ou cidades
- Sugestão de termos de busca
- Indexação de textos curtos
- APIs de lookup rápido

---

## 📦 Instalação

### 1. Clonar o repositório

```bash
git clone https://github.com/JonasMoria/FastSearchEngineAPI.git
cd FastSearchEngineAPI
```

### 2. Subir o ambiente Docker

```bash
docker compose up -d --build
```

### 3. Instalar o Laravel

```bash
docker exec -it fastsearch_app bash
composer install
cp .env.example .env
php artisan key:generate
```

### 4. Rodar Migrations

```bash
php artisan migrate
```

### 🌐 Acessos
- API: http://localhost:8000
- RedisInsight (Redis Stack): http://localhost:8001

### 📄 Documentação da API (Swagger)

A documentação interativa da API está disponível via Swagger UI:

- http://localhost:8000/docs

Por lá você pode:

- visualizar todos os endpoints
- testar requisições diretamente no navegador
- validar payloads e respostas
- entender rapidamente o funcionamento da API

O arquivo OpenAPI (YAML) também pode ser acessado diretamente:

- http://localhost:8000/docs/api.yaml

### ⚠️ Observações

- O MySQL é usado para persistência
- O Redis para performance
- O Redis Stack será responsável pela busca avançada

### 📌 Objetivo do projeto

Criar uma base sólida para construção de um motor de busca leve e escalável, focado em:

- velocidade
- simplicidade
- extensibilidade