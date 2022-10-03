<?php declare(strict_types=1);

namespace CRAGenerator\Domain\Trade\BusinessLogic;

// The trade model

class Trade
{
    public function __construct(
        private string $id,
        private string $username
    ){
        $this->id = (string) $id;
        $this->username = (string) $username;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getId(): string
    {
        return $this->id;
    }


}