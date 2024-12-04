<?php

namespace WeatherApp\Observer;

/**
 * The WeatherStation class represents the Subject in the Observer pattern.
 */
class WeatherStation implements \SplSubject
{
    /**
     * @var array Observers subscribed to weather updates.
     */
    private $observers = [];

    /**
     * @var float Temperature reading
     */
    private $temperature;

    /**
     * @var float Humidity reading
     */
    private $humidity;

    /**
     * Register an observer
     */
    public function attach(\SplObserver $observer): void
    {
        $this->observers[] = $observer;
    }

    /**
     * Unregister an observer
     */
    public function detach(\SplObserver $observer): void
    {
        $key = array_search($observer, $this->observers, true);
        if ($key !== false) {
            unset($this->observers[$key]);
        }
    }

    /**
     * Notify all observers about the weather changes
     */
    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update($this);
        }
    }

    /**
     * Set new weather data and notify observers
     */
    public function setWeatherData(float $temperature, float $humidity): void
    {
        $this->temperature = $temperature;
        $this->humidity = $humidity;
        $this->notify(); // Notify all observers that the weather data has changed
    }

    /**
     * Get current temperature
     */
    public function getTemperature(): float
    {
        return $this->temperature;
    }

    /**
     * Get current humidity
     */
    public function getHumidity(): float
    {
        return $this->humidity;
    }
}

/**
 * The DisplayInterface ensures that all displays implement the update method
 */
interface DisplayInterface
{
    public function update(\SplSubject $subject): void;
}

/**
 * A concrete display that shows the current weather conditions.
 */
class CurrentConditionsDisplay implements \SplObserver, DisplayInterface
{
    private $temperature;
    private $humidity;

    public function update(\SplSubject $subject): void
    {
        $this->temperature = $subject->getTemperature();
        $this->humidity = $subject->getHumidity();
        $this->display();
    }

    public function display(): void
    {
        echo "Current Conditions: Temperature: {$this->temperature}°C, Humidity: {$this->humidity}%\n";
    }
}

/**
 * A forecast display that shows an example forecast (dummy).
 */
class ForecastDisplay implements \SplObserver, DisplayInterface
{
    private $temperature;

    public function update(\SplSubject $subject): void
    {
        $this->temperature = $subject->getTemperature();
        $this->display();
    }

    public function display(): void
    {
        echo "Forecast: The temperature is expected to be " . ($this->temperature + 1) . "°C tomorrow.\n";
    }
}

/**
 * A client code that simulates a weather station
 */

// Create the weather station (subject)
$weatherStation = new WeatherStation();

// Create the display units (observers)
$currentDisplay = new CurrentConditionsDisplay();
$forecastDisplay = new ForecastDisplay();

// Attach the displays to the weather station
$weatherStation->attach($currentDisplay);
$weatherStation->attach($forecastDisplay);

// Simulate new weather data
echo "Setting new weather data:\n";
$weatherStation->setWeatherData(25.5, 60);

// Simulate another update
echo "\nSetting new weather data:\n";
$weatherStation->setWeatherData(28.0, 55);

