generate:
	protoc --proto_path=proto proto/*.proto --go_out=server/ --go-grpc_out=server/

gen-docker-server:
	@ docker run --rm -v $(PWD):/defs namely/protoc-all -f proto/*.proto -l go -o server/ --grpc-out=pb/
	sudo chown -R 1001:1001 server/pb

gen-docker-client:
	@ docker run -v --rm $(PWD):/defs namely/protoc-all -f proto/*.proto -l php -o client/pb --php-source-relative

build:
	make gen-docker-server
	docker compose up -d --build