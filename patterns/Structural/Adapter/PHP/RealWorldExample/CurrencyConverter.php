<?php

/*
|--------------------------------------------------------------------------
| Adapter Design Pattern - Currency Converter Example
|--------------------------------------------------------------------------
| Implement Adapter Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Adapter/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Structural\Structural\RealWorldExample;

/**
 * Target Interface representing the standard interface for currency conversion.
 */
interface CurrencyCalculator
{
    public function convert(float $amount, string $fromCurrency, string $toCurrency): float;
}

/**
 * Existing Class that directly implements the interface to perform a simple conversion
 * using a fixed exchange rate for this example.
 */
class SimpleCurrencyConverter implements CurrencyCalculator
{
    private $exchangeRate = 0.85; // Example: EUR to USD

    public function convert(float $amount, string $fromCurrency, string $toCurrency): float
    {
        echo "Converting $amount $fromCurrency to $toCurrency via SimpleCurrencyConverter.\n";
        return $amount * $this->exchangeRate;
    }
}

/**
 * Adaptee: A third-party currency conversion API class incompatible with the standard interface.
 */
class CurrencyConverterAPI
{
    public function getConvertedAmount(float $amount, string $currencyFrom, string $currencyTo): float
    {
        // For this example, we simulate a conversion rate.
        $conversionRates = [
            'USD_EUR' => 0.85,
            'EUR_USD' => 1.18,
        ];
        $conversionKey = $currencyFrom . '_' . $currencyTo;
        
        if (!isset($conversionRates[$conversionKey])) {
            throw new \Exception("Conversion from $currencyFrom to $currencyTo not available.");
        }

        echo "Using the API to convert $amount $currencyFrom to $currencyTo.\n";
        return $amount * $conversionRates[$conversionKey];
    }
}

/**
 * Adapter to make CurrencyConverterAPI compatible with the CurrencyCalculator interface.
 */
class CurrencyConverterAPIAdapter implements CurrencyCalculator
{
    private $api;

    public function __construct(CurrencyConverterAPI $api)
    {
        $this->api = $api;
    }

    public function convert(float $amount, string $fromCurrency, string $toCurrency): float
    {
        return $this->api->getConvertedAmount($amount, $fromCurrency, $toCurrency);
    }
}

/**
 * Client code that can work with any class implementing the CurrencyCalculator interface.
 */
function clientCode(CurrencyCalculator $calculator)
{
    $amountInUSD = 100;
    $convertedAmount = $calculator->convert($amountInUSD, 'USD', 'EUR');
    echo "Converted amount: $convertedAmount EUR\n";
}

echo "Using SimpleCurrencyConverter:\n";
$simpleConverter = new SimpleCurrencyConverter();
clientCode($simpleConverter);

echo "\n\nUsing CurrencyConverterAPI through the Adapter:\n";
$apiConverter = new CurrencyConverterAPI();
$adapter = new CurrencyConverterAPIAdapter($apiConverter);
clientCode($adapter);
