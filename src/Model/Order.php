<?php
namespace App\Model;

class Order
{
    private int $id;
    private Coupon $coupon;
    private array $itens = [];

    public function __construct(
        private string $customerName
    ) {}

    public function addItem(ItemOrder $itemOrder): self
    {
        $this->itens[] = $itemOrder;
        return $this;
    }

    public function setCoupon(Coupon $coupon): self
    {
        $this->coupon = $coupon;
        return $this;
    }

    public function getCoupon(): Coupon
    {
        return $this->coupon;
    }

    public function setId(int $id): self
    {
        $this->id = $id;
        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setCustomerName(string $customerName): self
    {
        $this->customerName = $customerName;
        return $this;
    }

    public function getCustomer(): string
    {
        return $this->customerName;
    }

}
