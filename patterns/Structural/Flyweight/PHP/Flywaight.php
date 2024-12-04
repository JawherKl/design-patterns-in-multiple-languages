<?php

/*
|--------------------------------------------------------------------------
| Flyweight Design Pattern - Implementation Example
|--------------------------------------------------------------------------
| This example demonstrates the Flyweight Design Pattern, which is used 
| to reduce memory usage by sharing common data between multiple objects.
| The pattern stores common state (intrinsic state) shared across objects 
| while keeping unique state (extrinsic state) external to the objects.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Structural/Flyweight
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
|
| Key Components:
| 1. **Flyweight Class**: Represents the shared objects that store the common 
|    state (intrinsic state) for all instances. It does not store unique 
|    states, which are passed in as parameters when performing operations.
|
| 2. **FlyweightFactory Class**: Manages the creation and reuse of Flyweight 
|    objects. It ensures that Flyweights are shared correctly and reused 
|    when needed, minimizing memory consumption by avoiding object duplication.
|
| 3. **Client Code**: Interacts with the FlyweightFactory to add extrinsic state 
|    (unique information like plates and owners) and perform operations with 
|    the Flyweight instances. The client does not create Flyweights directly 
|    but requests them from the factory.
|
| Benefits:
| - **Memory Efficiency**: The Flyweight pattern helps save memory by sharing 
|   common data across objects and only storing unique data externally.
| - **Scalability**: Flyweights allow the system to handle a large number of 
|   objects without overwhelming memory resources.
| - **Centralized Control**: The FlyweightFactory ensures the correct reuse 
|   of Flyweights, which is useful for optimizing performance and managing 
|   the life cycle of the shared state.
|
| Drawbacks:
| - **Complexity**: The pattern introduces additional complexity in the code, 
|   as it requires managing both intrinsic and extrinsic state separately.
| - **Limited Flexibility**: Flyweight instances can only be used for data 
|   that is shared across many objects. If each object needs significantly 
|   different data, this pattern may not be the best solution.
*/

namespace Structural\Flyweight;

/**
 * The Flyweight stores a common portion of the state (also called intrinsic
 * state) that belongs to multiple real business entities. The Flyweight accepts
 * the rest of the state (extrinsic state, unique for each entity) via its
 * method parameters.
 */
class Flyweight
{
    private $sharedState;

    public function __construct($sharedState)
    {
        $this->sharedState = $sharedState;
    }

    public function operation($uniqueState): void
    {
        $s = json_encode($this->sharedState);
        $u = json_encode($uniqueState);
        echo "Flyweight: Displaying shared ($s) and unique ($u) state.\n";
    }
}

/**
 * The Flyweight Factory creates and manages the Flyweight objects. It ensures
 * that flyweights are shared correctly. When the client requests a flyweight,
 * the factory either returns an existing instance or creates a new one, if it
 * doesn't exist yet.
 */
class FlyweightFactory
{
    /**
     * @var Flyweight[]
     */
    private $flyweights = [];

    public function __construct(array $initialFlyweights)
    {
        foreach ($initialFlyweights as $state) {
            $this->flyweights[$this->getKey($state)] = new Flyweight($state);
        }
    }

    /**
     * Returns a Flyweight's string hash for a given state.
     */
    private function getKey(array $state): string
    {
        ksort($state);

        return implode("_", $state);
    }

    /**
     * Returns an existing Flyweight with a given state or creates a new one.
     */
    public function getFlyweight(array $sharedState): Flyweight
    {
        $key = $this->getKey($sharedState);

        if (!isset($this->flyweights[$key])) {
            echo "FlyweightFactory: Can't find a flyweight, creating new one.\n";
            $this->flyweights[$key] = new Flyweight($sharedState);
        } else {
            echo "FlyweightFactory: Reusing existing flyweight.\n";
        }

        return $this->flyweights[$key];
    }

    public function listFlyweights(): void
    {
        $count = count($this->flyweights);
        echo "\nFlyweightFactory: I have $count flyweights:\n";
        foreach ($this->flyweights as $key => $flyweight) {
            echo $key . "\n";
        }
    }
}

/**
 * The client code usually creates a bunch of pre-populated flyweights in the
 * initialization stage of the application.
 */
$factory = new FlyweightFactory([
    ["Chevrolet", "Camaro2018", "pink"],
    ["Mercedes Benz", "C300", "black"],
    ["Mercedes Benz", "C500", "red"],
    ["BMW", "M5", "red"],
    ["BMW", "X6", "white"],
    // ...
]);
$factory->listFlyweights();

// ...

function addCarToPoliceDatabase(
    FlyweightFactory $ff, $plates, $owner,
    $brand, $model, $color
) {
    echo "\nClient: Adding a car to database.\n";
    $flyweight = $ff->getFlyweight([$brand, $model, $color]);

    // The client code either stores or calculates extrinsic state and passes it
    // to the flyweight's methods.
    $flyweight->operation([$plates, $owner]);
}

addCarToPoliceDatabase($factory,
    "CL234IR",
    "James Doe",
    "BMW",
    "M5",
    "red",
);

addCarToPoliceDatabase($factory,
    "CL234IR",
    "James Doe",
    "BMW",
    "X1",
    "red",
);

$factory->listFlyweights();