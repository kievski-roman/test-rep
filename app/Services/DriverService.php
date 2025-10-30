<?php

namespace App\Services;

use App\Models\Driver;

class DriverService
{
    public function createDriver(array $data): Driver
    {
        $data['photo'] = $this->processPhoto($data['photo'] ?? null);
        return Driver::create($data);
    }

    public function updateDriver(Driver $driver, array $data): Driver
    {
        $data['photo'] = $this->processPhoto($data['photo'] ?? null);
        $driver->update($data);
        return $driver;
    }

    private function processPhoto($photo): ?array
    {
        if (!$photo || !is_array($photo)) return null;

        return array_values(
            array_filter($photo, fn($p) => !empty($p['text']) || !empty($p['src']))
        );
    }
}
