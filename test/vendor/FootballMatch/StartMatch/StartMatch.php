<?php declare(strict_types=1);

namespace ComquerTest\FootballMatch\StartMatch;

use Comquer\Command\Command;

class StartMatch extends Command
{
    private $matchId;

    public function __construct(MatchId $matchId)
    {
        $this->matchId = $matchId;
    }

    public function getMatchId() : MatchId
    {
        return $this->matchId;
    }
}