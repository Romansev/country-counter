<?php

namespace App\Services;

use App\Exceptions\CountryNotFoundException;
use App\Exceptions\IncException;
use App\Services\Dto\CountryCounterDto;
use App\Services\Dto\CountryDto;
use Illuminate\Support\Facades\Redis;

class CounterService
{
    private const COUNTRIES_KEY = 'country';

    private const COUNTRIES = [
        'ru',
        'us',
        'cy',
        'fr'
    ];

    /**
     * @param string|null $country
     * @return bool
     * @throws CountryNotFoundException
     * @throws IncException
     */
    public function increment(?string $country): bool
    {
        $this->checkCountry($country);

        $result = Redis::hincrby(self::COUNTRIES_KEY, $country, 1);

        if (!($result > 0)) {
            throw new IncException($country);
        }

        return true;
    }

    /**
     * @return CountryCounterDto
     */
    public function getAllVisitsCount(): CountryCounterDto
    {
        $values = Redis::hVals(self::COUNTRIES_KEY);
        $keys = Redis::hKeys(self::COUNTRIES_KEY);

        $countryCounterDto = new CountryCounterDto();
        foreach ($keys as $k => $key) {
            $countryDto = new CountryDto();
            $countryDto->code = $key;
            $countryDto->count = $values[$k];

            $countryCounterDto->countries[] = $countryDto;
        }

        return $countryCounterDto;
    }

    /**
     * @param $country
     * @return void
     * @throws CountryNotFoundException
     */
    protected function checkCountry($country): void
    {
        if (!in_array($country, self::COUNTRIES)) {
            throw new CountryNotFoundException($country);
        }
    }

}