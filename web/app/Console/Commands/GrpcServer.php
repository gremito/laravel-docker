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
    const PORT = 9501;

    public function handle()
    {
        // co::set(['hook_flags' => OpenSwoole\Runtime::HOOK_ALL]);

        $server = new Server("0.0.0.0", self::PORT);
        $server
            ->addMiddleware(new LoggingMiddleware())
            ->addMiddleware(new TraceMiddleware());
        $server
            ->set([
                'open_http2_protocol' => true,
                // 'reactor_num' => 1,
                // 'worker_num' => 1,
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

        $this->info("gRPC server started");

        $server->start();
    }
}
