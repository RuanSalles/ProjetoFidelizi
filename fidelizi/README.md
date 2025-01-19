# Programa de Fidelidade Fidelizi
<img src="docs/fidelizi-logo.png" width="70px">

## Tecnologias e ferramentas

![Docker](https://img.shields.io/badge/docker-%230db7ed.svg?style=for-the-badge&logo=docker&logoColor=white)
![PHP](https://img.shields.io/badge/php-%23777BB4.svg?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/laravel-%23FF2D20.svg?style=for-the-badge&logo=laravel&logoColor=white)
![MySQL](https://img.shields.io/badge/mysql-4479A1.svg?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/bootstrap-%238511FA.svg?style=for-the-badge&logo=bootstrap&logoColor=white)
![PhpStorm](https://img.shields.io/badge/phpstorm-143?style=for-the-badge&logo=phpstorm&logoColor=black&color=black&labelColor=darkorchid)

## Objetivo

Desenvolver sistema de gestão de programa de fidelidade, com possibilidade de cadastro de usuários / clientes, produtos e prêmios que, ao realizar compras, gerem pontuações e possibilitem posteriormente o resgate dos mesmos.

### Entidades

- **User (usuário)**
- **Customer (cliente)**
- **Award (prêmio / resgatável)**
- **Transaction (transação)**
- **RescueAward (resgate de prêmios / resgatáveis)**

### História do usuário (Storytelling)

Um cliente chega ao estabelecimento X, que atua no ramo de varejo, desejando realizar a compra de 2 (dois) celulares, no valor de R\$ 1.800,00 reais, onde prontamente o atendente indica que ao realizar o cadastro e adquirir o cartão da loja, o mesmo poderá usufruir do programa de fidelidade. Onde tem como benefício que em suas compras realizadas será gerado 1 (um) ponto para cada R\$ 5,00 reais gastos, totalizando um valor de R\$ 3.600,00 reais. No momento da efetivação da compra, deverá ser pontuado e enviado ao mesmo através de email relatório que conste a transação, quantidade de pontos conquistados, além de demonstrativo onde conste o total de pontos atuais após a nova compra.

O cliente, ao adquirir e começar a usufruir do programa em questão, pontuou o total de 720 pontos, que posteriormente foram gastos para adquirir o prêmio de 10% de desconto na próxima compra.

Onde, por fim, o cliente receberá diariamente lembretes com indicações de premiações que podem ser resgatadas com seus pontos restantes.


### Problema

1. Cadastrar cliente
2. Pontuar através das compras
3. Enviar relatórios de transações por email
4. Resgatar premiações com débito dos pontos acumulados
5. Receber extrato do resgate informando pontos gastos e atuais
6. Receber lembrete diário para resgate de premiações com seus pontos restantes

### Solução

O projeto realizado em questão, trata-se de teste técnico para processo seletivo da empresa Fidelizi, onde foi desenvolvido sistema de gestão de programa de fidelidade, afim de facilitar a interação entre cliente / loja. Criando um sistema de pontuações que beneficie o cliente gerando pontuações em cada compra.

A técnologia utilizada no projeto foi PHP para criação de APIRest utilizando Framework Laravel 11, com MySQL para persistência dos dados.
Utilizando-se dos seguintes recursos:

- Autenticação JWT - Sanctum
- Eloquent Model
- Resources
- Request Validation
- Collections
- Mail
- Schedule
- Seeders
- Factory
