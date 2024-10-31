<?php declare(strict_types=1);

namespace Hello;

use App\Models\User;
use OpenSwoole\GRPC;

class HelloService implements HelloInterface
{
    /**
    * @param GRPC\ContextInterface $ctx
    * @param HelloRequest $request
    * @return HelloResponse
    *
    * @throws GRPC\Exception\InvokeException
    */
    public function SayHello(GRPC\ContextInterface $ctx, HelloRequest $request): HelloResponse
    {
        $response = new HelloResponse();

        $user = User::firstWhere("name", "LIKE", $request->getName());

        if ($user) {
            $response->setMessage("Hello {$user->name}");
        }
        else {
            $response->setMessage("not found {$request->getName()}");
        }

        return $response;
    }
}
