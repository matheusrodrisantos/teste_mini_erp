<?php
namespace App\Model;

class Inventory
{
    private int $id;

    public function __construct(
        private Variation $variation,
        private int $quantity = 0,
    ) {
        if ($quantity < 0) {
            throw new \InvalidArgumentException('Quantity cannot be negative.');
        }
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getVariation(): Variation
    {
        return $this->variation;
    }

    public function setVariation(Variation $variation): self
    {
        $this->variation = $variation;
        return $this;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        if ($quantity < 0) {
            throw new \InvalidArgumentException('Quantity cannot be negative.');
        }

        $this->quantity = $quantity;
        return $this;
    }
}
