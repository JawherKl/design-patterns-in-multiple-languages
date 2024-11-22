<?php

namespace DesignPatterns\Bridge;

/**
 * The Abstraction defines the interface for the "control" part of the two class
 * hierarchies. It maintains a reference to an object of the Implementation
 * hierarchy and delegates the real work to this object.
 */
class DeviceController
{
    /**
     * @var Device
     */
    protected $device;

    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    public function togglePower(): string
    {
        return "Controller: Toggling power...\n" . $this->device->togglePower();
    }

    public function adjustVolume(int $level): string
    {
        return "Controller: Adjusting volume...\n" . $this->device->setVolume($level);
    }
}

/**
 * You can extend the Abstraction without changing the Implementation classes.
 */
class AdvancedDeviceController extends DeviceController
{
    public function setChannel(int $channel): string
    {
        return "Controller: Changing channel...\n" . $this->device->setChannel($channel);
    }
}

/**
 * The Implementation defines the interface for all implementation classes. It
 * doesn't have to match the Abstraction's interface. Typically, the Implementation
 * interface provides only low-level operations.
 */
interface Device
{
    public function togglePower(): string;

    public function setVolume(int $level): string;

    public function setChannel(int $channel): string;
}

/**
 * Each Concrete Implementation corresponds to a specific device and implements
 * the Device interface.
 */
class Television implements Device
{
    private $power = false;
    private $volume = 10;
    private $channel = 1;

    public function togglePower(): string
    {
        $this->power = !$this->power;
        return $this->power ? "Television is now ON.\n" : "Television is now OFF.\n";
    }

    public function setVolume(int $level): string
    {
        $this->volume = $level;
        return "Television volume set to $level.\n";
    }

    public function setChannel(int $channel): string
    {
        $this->channel = $channel;
        return "Television channel set to $channel.\n";
    }
}

class Radio implements Device
{
    private $power = false;
    private $volume = 5;
    private $frequency = 101.5;

    public function togglePower(): string
    {
        $this->power = !$this->power;
        return $this->power ? "Radio is now ON.\n" : "Radio is now OFF.\n";
    }

    public function setVolume(int $level): string
    {
        $this->volume = $level;
        return "Radio volume set to $level.\n";
    }

    public function setChannel(int $frequency): string
    {
        $this->frequency = $frequency;
        return "Radio frequency set to $frequency MHz.\n";
    }
}

/**
 * Client Code
 */
function clientCode(DeviceController $controller)
{
    echo $controller->togglePower();
    echo $controller->adjustVolume(15);

    if ($controller instanceof AdvancedDeviceController) {
        echo $controller->setChannel(7);
    }
}

echo "Client: Testing Television controller:\n";
$tv = new Television();
$controller = new AdvancedDeviceController($tv);
clientCode($controller);

echo "\n\n";

echo "Client: Testing Radio controller:\n";
$radio = new Radio();
$controller = new DeviceController($radio);
clientCode($controller);
