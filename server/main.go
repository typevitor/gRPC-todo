package main

import (
	"context"
	"log"
	"net"

	"github.com/typevitor/grpc-todo/pb"
	"google.golang.org/grpc"
	"google.golang.org/grpc/reflection"
)

type server struct {
	pb.UnimplementedTervicesServer
}

func (s *server) Add(
	ctx context.Context,
	in *pb.TodoRequest,
) (*pb.TodoResponse, error) {
	return &pb.TodoResponse{
		Status: "Ok",
		Data:   "Todo :" + in.Text,
	}, nil
}

func main() {
	listener, err := net.Listen("tcp", ":8081")
	if err != nil {
		log.Fatalln("Failed to create listener", err)
	}

	s := grpc.NewServer()
	reflection.Register(s)

	pb.RegisterTervicesServer(s, &server{})
	if err := s.Serve(listener); err != nil {
		log.Fatalln("Failed to serve", err)
	}
}
