# Passo 1: Instalação do Docker e Docker Compose

Se você ainda não tem o Docker e o Docker Compose instalados, siga estas instruções:

- **Para Windows e macOS:**
  Baixe e instale o Docker Desktop.

- **Para Linux (Ubuntu):**
  - Instale o Docker seguindo as [instruções oficiais do site do Docker](https://docs.docker.com/engine/install/ubuntu/).
  - Instale o Docker Compose seguindo as [instruções oficiais do site do Docker Compose](https://docs.docker.com/compose/install/).

# Passo 2: Crie um diretório para o WordPress

Abra o terminal (ou prompt de comando) e crie um diretório para o projeto do WordPress:

```bash
mkdir wordpress-docker
cd wordpress-docker
```

# Passo 3: Crie um arquivo docker-compose.yml

Dentro do diretório recém-criado, crie um arquivo chamado docker-compose.yml e cole o seguinte conteúdo:

```yml
version: '3.8'

services:
  db:
    image: mysql:5.7
    volumes:
      - db_data:/var/lib/mysql
    restart: always
    environment:
      MYSQL_ROOT_PASSWORD: sua_senha
      MYSQL_DATABASE: wp_j3express
      MYSQL_USER: seu_user
      MYSQL_PASSWORD: sua_senha

  wordpress:
    depends_on:
      - db
    image: wordpress:latest
    ports:
      - "8080:80"
    restart: always
    environment:
      WORDPRESS_DB_HOST: db:3306
      WORDPRESS_DB_USER: seu_user
      WORDPRESS_DB_PASSWORD: sua_senha
      WORDPRESS_DB_NAME: wpseu_user
    volumes:
      - ./wp-content:/var/www/html/wp-content

volumes:
  db_data:
```

Este arquivo docker-compose.yml define dois serviços: um para o banco de dados MySQL e outro para o WordPress.

# Passo 4: Execute o Docker Compose

No terminal, execute o seguinte comando dentro do diretório onde você salvou o arquivo docker-compose.yml:

```bash
docker-compose up 
```

Isso irá baixar as imagens necessárias e iniciar os contêineres do WordPress e do MySQL em segundo plano.

# Passo 5: Acessando o WordPress
Abra o seu navegador e acesse o WordPress através do seguinte endereço:

```bash
http://localhost:8080
```

Você será direcionado para a página de configuração inicial do WordPress, onde pode configurar o seu site, criar um nome de usuário, senha, etc.


# docker
