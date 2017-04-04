# Laravel Neo4j PHP OGM example project

This is a sample working Laravel 5.4 API project, using [Neo4j PHP OGM](https://github.com/graphaware/neo4j-php-ogm) developed by [Christophe Willemsen](https://github.com/ikwattro).

It is basically configured with a Service Provider injecting the OGM Entity Manager into a Controller.

## Example REST calls

CRUD operations are allowed to manipulate the User entity:
- `GET /user` will retrive all the Users in the database;
- `GET /user/{id}` will retrive a specific User;
- `POST /user` will create a new User by a given response body like `{ "name":"Marco", "born":"27/10/1988" }`;
- `PUT /user/{id}` will update a specific User by a given response body like `{ "name":"Marco", "born":"27/10/1988" }`;
- `DELETE /user/{id}` will "detach delete" a specific User.

## Configuration
As you can see in the [.env](https://github.com/mfalcier/laravel-neo4j-php-ogm-example/blob/master/.env) file, those properties must be set like the following:

- `NEO4J_PROTOCOL=bolt`
- `NEO4J_URL=localhost`
- `NEO4J_PORT=7687`
- `NEO4J_USER=neo4j`
- `NEO4J_PASS=password`
