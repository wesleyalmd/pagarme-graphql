### Referência

Docker local
https://github.com/markshust/docker-magento

Documentação oficial pagarme
https://docs.pagar.me/docs/magento-2-overview

Cartão de crédito para testes
https://docs.pagar.me/docs/simulador-de-cart%C3%A3o-de-cr%C3%A9dito

### História

Implementar interface Pagarme para pagamento com cartão de crédito.

#### Tasks (fase de teste)

- [x] Discovery do pagarme integração e módulo Magento
- [x] Criar conta e integrar com ambiente de desenvolvimento
- [x] Query Graphql com public_key do pagarme
- [x] Obter cardToken com appId pelo Postman

Frontend Luma está com bug para fechar pedidos, realiza o pagamento sandbox dev e produção, testado com cobrança real no cartão, mas não salva os dados na tabela e mantem a quote aberta. Para resolver esse problema precisaria aprofundar em debug. Portando, retornar wallet do usuário não foi realizado.

#### Possível continuação

- Criar query graphql para obter parcelas a partir do cart_id
- Implementar mutation graphql para input do método de pagamento com cardToken e parcelas
- Implementar retorno na query de orders com additional_data do pagamento

---

### Instalação

Adicione o módulo em seu projeto Magento em `app/code/SuperFrete/PagarmeGraphql`
```
mkdir -p src/app/code/SuperFrete
git clone git@github.com:wesleyalmd/pagarme-graphql.git src/app/code/SuperFrete/PagarmeGraphql
```

Rode os comandos abaixo para instalar o módulo:
```
bin/magento module:enable SuperFrete_PagarmeGraphql
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:flush
```

---

## Recurso de consulta de últimos pedidos

![https://raw.githubusercontent.com/wesleyalmd/pagarme-graphql/refs/heads/master/orders-report.png](https://raw.githubusercontent.com/wesleyalmd/pagarme-graphql/refs/heads/master/orders-report.png)

- Verificar se o usuário está logado
- Obter os últimos pedidos a partir de um range de datas
- Calcular o valor total dos pedidos
- Calcular o ticket médio

Query graphql:
```
query {
  getOrdersReport(start_date: "2025-02-01", end_date: "2025-02-10") {
    total_sales
    average_ticket
  }
}
```
Headers
```
Authorization: "Bearer <token>"
```

##### Como obter o token do usuário
```
mutation {
  generateCustomerToken(
    email: "",
    password: ""
  ) {
    token
  }
}
```

Utilize a collection postman com os requests "magento - Signin" e "magento - Get Sales Reports"
