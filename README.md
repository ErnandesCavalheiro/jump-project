**Rotas**

 - /api/users -> GET -> Lista todos os usuarios
 - /api/users -> POST -> Cria um usuario
 - /api/service-orders -> GET -> Lista todas as ordens
 - /api/service-orders/{plate} -> Lista a ordem de uma placa especifica
 - /api/service-orders -> POST -> Cria uma ordem. Deve ser criado um usuário antes para a relação ser feita.

**Middleware**

EnsureJsonRequest: Middleware que está sendo usado nas rotas POST, faz aceitar apenas requisições que enviem dados em JSON.

**Paginação**

Para alterar a pagina basta enviar como parametro na URL o numero da pagina desejada, exemplo: */api/service-orders?page=2*