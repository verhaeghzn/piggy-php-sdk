<?php


namespace Piggy\Api\Tests;

class MockHandlerAdapter
{
    private $results = [];
    private $idx = 0;

    public function append($res)
    {
        $this->results[] = $res;
    }

    public function reset()
    {
        $this->results = [];
        $this->idx = 0;
    }

    public function __invoke(array $request)
    {
        $response = $this->results[$this->idx];
        $this->idx++;

        return new \GuzzleHttp\Ring\Future\CompletedFutureArray([
            'status'        => $response->getStatusCode(),
            'body'          => $response->getBody(),
            'headers'       => $response->getHeaders(),
            'reason'        => $response->getReasonPhrase(),
            'effective_url' => $response->getEffectiveUrl(),
        ]);
    }
}
