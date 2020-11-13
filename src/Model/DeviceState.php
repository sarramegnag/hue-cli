<?php

namespace App\Model;

class DeviceState
{
    public const ON = true;
    public const OFF = false;

    private bool $on;

    public function isOn(): bool
    {
        return $this->on;
    }

    public function setOn(bool $on): self
    {
        $this->on = $on;

        return $this;
    }
}
