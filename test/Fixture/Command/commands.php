<?php

return [
    \CQRSTest\Fixture\Command\DoSomething\DoSomething::class => \CQRSTest\Fixture\Command\DoSomething\DoSomethingHandler::class,
    \CQRSTest\Fixture\Command\DoSomethingElse\DoSomethingElse::class => \CQRSTest\Fixture\Command\DoSomethingElse\DoSomethingElseHandler::class,
];
