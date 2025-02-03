### Referência

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

#### Possível continuação

- Criar query graphql para obter parcelas a partir do cart_id
- Implementar mutation graphql para input do método de pagamento com cardToken e parcelas
- Implementar retorno na query de orders com additional_data do pagamento

---

### Instalação

Adicione o módulo em seu projeto Magento em `app/code/SuperFrete/PagarmeGraphql`
```
git clone git@github.com:wesleyalmd/magento-pagarme-graphql.git app/code/SuperFrete/PagarmeGraphql
```

Rode os comandos abaixo para instalar o módulo:
```
bin/magento module:enable SuperFrete_PagarmeGraphql
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento setup:static-content:deploy -f
bin/magento cache:flush
```
