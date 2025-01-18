Este é um projeto simples que cria um servidor gRPC em GO e um cliente em PHP para envio e consumo de uma mensagem fixa.

Para rodar o projeto com o Makefile, execute:

`make build`

---

Caso não tenha o Makefile, rode os containers docker:

```bash
docker run --rm -v $(pwd):/defs namely/protoc-all -f proto/*.proto -l go -o server/ --grpc-out=pb/
docker run -v --rm $(pwd):/defs namely/protoc-all -f proto/*.proto -l php -o client/pb --php-source-relative
docker compose up -d --build
```