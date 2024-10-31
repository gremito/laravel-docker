<?php

declare(strict_types=1);

namespace App\Console\Commands;

use Hello\HelloInterface;
use Hello\HelloService;
use Illuminate\Console\Command;
use OpenSwoole\GRPC\Middleware\LoggingMiddleware;
use OpenSwoole\GRPC\Middleware\TraceMiddleware;
use OpenSwoole\GRPC\Server;

class GrpcServer extends Command
{
    protected $signature = 'grpc:serve';
    protected $description = 'Start the gRPC server';

    public function handle()
    {
        $this->info('Starting Swoole gRPC Server...');

        // co::set(['hook_flags' => OpenSwoole\Runtime::HOOK_ALL]);

        $server = new Server("0.0.0.0", 50051, SWOOLE_BASE, SWOOLE_SOCK_TCP);
        $server
            ->addMiddleware(new LoggingMiddleware())
            ->addMiddleware(new TraceMiddleware());
        $server
            ->set([
                'open_http2_protocol' => true,
                'log_level' => \OpenSwoole\Constant::LOG_INFO,
                'log_file' => storage_path('logs/grpc_server.log'),
            ]);

        // $server->register(HelloInterface::class, function (Request $request, Response $response) {
        //     $responseMessage = App::make(HelloService::class)->SayHello(, $request);
        //     $helloResponse = new HelloResponse();
        //     $helloResponse->setMessage($responseMessage);
        //     $response->end($helloResponse);
        // });
        $server->register(HelloService::class);

        $server->withWorkerContext('worker_start_time', function () {
            return time();
        });

        $this->info('gRPC server started on 0.0.0.0:50051');

        $server->start();
    }
}
