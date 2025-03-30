<?php

namespace Bizhub\Unleashed\Tests;

use Bizhub\Unleashed\Unleashed;

class UnleashedTest extends TestCase
{
    /** @test */
    public function it_returns_correct_signature()
    {
        $query = ['foo' => 'bar'];

        $signature = base64_encode(
            hash_hmac(
                'sha256',
                http_build_query($query),
                'apiKey',
                true
            )
        );

        $unleashed = new Unleashed('apiId', 'apiKey', 'bizhub');

        $this->assertEquals($signature, $unleashed->getSignature($query));
    }
}