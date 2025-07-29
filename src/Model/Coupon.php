<?php 

namespace App\Model;

use DateTime;

class Coupon
{
    private int $id;

    public function __construct(
        private string $code,
        private float $percentage,
        private DateTime $valid,
    ){}

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCode(): string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getPercentage(): float
    {
        return $this->percentage;
    }

    public function setPercentage(float $percentage): self
    {
        $this->percentage = $percentage;

        return $this;
    }

    public function getValid(): DateTime
    {
        return $this->valid;
    }

    public function setValid(DateTime $valid): self
    {
        $this->valid = $valid;

        return $this;
    }
}
