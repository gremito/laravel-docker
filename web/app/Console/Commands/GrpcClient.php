<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Hello\HelloClient;
use Hello\HelloRequest;
use Illuminate\Console\Command;
use OpenSwoole\GRPC\Client;

class GrpcClient extends Command
{
    protected $signature = 'grpc:test';
    protected $description = '[gRPC Test]';

    public function handle()
    {
        $conn    = (new Client('127.0.0.1', 9501))->connect();
        $client  = new HelloClient($conn);
        $message = new HelloRequest();
        $message->setName("taro");
        $out = $client->SayHello($message);
        var_dump($out);
        $conn->close();
        echo "closed\n";
    }
}
