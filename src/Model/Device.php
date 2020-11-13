<?php

namespace App\Model;

class Device
{
    public string $name;

    private DeviceState $state;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getState(): DeviceState
    {
        return $this->state;
    }

    public function setState(DeviceState $state): self
    {
        $this->state = $state;

        return $this;
    }
}
