<?php

/*
|--------------------------------------------------------------------------
| Flyweight Design Pattern - Cat Features
|--------------------------------------------------------------------------
| Implement Flyweight Design Pattern to create objects without specifying
| the exact class of object that will be created.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Flyweight
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Structural\Flyweight\RealWorldExample;

/**
 * Flyweight objects represent the data shared by multiple Cat objects. This is
 * the combination of breed, color, texture, etc.
 */
class CatVariation
{
    /**
     * The so-called "intrinsic" state.
     */
    public $breed;

    public $image;

    public $color;

    public $texture;

    public $fur;

    public $size;

    public function __construct(
        string $breed,
        string $image,
        string $color,
        string $texture,
        string $fur,
        string $size
    ) {
        $this->breed = $breed;
        $this->image = $image;
        $this->color = $color;
        $this->texture = $texture;
        $this->fur = $fur;
        $this->size = $size;
    }

    /**
     * This method displays the cat information. The method accepts the
     * extrinsic  state as arguments. The rest of the state is stored inside
     * Flyweight's fields.
     *
     * You might be wondering why we had put the primary cat's logic into the
     * CatVariation class instead of keeping it in the Cat class. I agree, it
     * does sound confusing.
     *
     * Keep in mind that in the real world, the Flyweight pattern can either be
     * implemented from the start or forced onto an existing application
     * whenever the developers realize they've hit upon a RAM problem.
     *
     * In the latter case, you end up with such classes as we have here. We kind
     * of "refactored" an ideal app where all the data was initially inside the
     * Cat class. If we had implemented the Flyweight from the start, our class
     * names might be different and less confusing. For example, Cat and
     * CatContext.
     *
     * However, the actual reason why the primary behavior should live in the
     * Flyweight class is that you might not have the Context class declared at
     * all. The context data might be stored in an array or some other more
     * efficient data structure. You won't have another place to put your
     * methods in, except the Flyweight class.
     */
    public function renderProfile(string $name, string  $age, string $owner)
    {
        echo "= $name =\n";
        echo "Age: $age\n";
        echo "Owner: $owner\n";
        echo "Breed: $this->breed\n";
        echo "Image: $this->image\n";
        echo "Color: $this->color\n";
        echo "Texture: $this->texture\n";
    }
}

/**
 * The context stores the data unique for each cat.
 *
 * A designated class for storing context is optional and not always viable. The
 * context may be stored inside a massive data structure within the Client code
 * and passed to the flyweight methods when needed.
 */
class Cat
{
    /**
     * The so-called "extrinsic" state.
     */
    public $name;

    public $age;

    public $owner;

    /**
     * @var CatVariation
     */
    private $variation;

    public function __construct(string $name, string $age, string $owner, CatVariation $variation)
    {
        $this->name = $name;
        $this->age = $age;
        $this->owner = $owner;
        $this->variation = $variation;
    }

    /**
     * Since the Context objects don't own all of their state, sometimes, for
     * the sake of convenience, you may need to implement some helper methods
     * (for example, for comparing several Context objects.)
     */
    public function matches(array $query): bool
    {
        foreach ($query as $key => $value) {
            if (property_exists($this, $key)) {
                if ($this->$key != $value) {
                    return false;
                }
            } elseif (property_exists($this->variation, $key)) {
                if ($this->variation->$key != $value) {
                    return false;
                }
            } else {
                return false;
            }
        }

        return true;
    }

    /**
     * The Context might also define several shortcut methods, that delegate
     * execution to the Flyweight object. These methods might be remnants of
     * real methods, extracted to the Flyweight class during a massive
     * refactoring to the Flyweight pattern.
     */
    public function render()
    {
        $this->variation->renderProfile($this->name, $this->age, $this->owner);
    }
}

/**
 * The Flyweight Factory stores both the Context and Flyweight objects,
 * effectively hiding any notion of the Flyweight pattern from the client.
 */
class CatDataBase
{
    /**
     * The list of cat objects (Contexts).
     */
    private $cats = [];

    /**
     * The list of cat variations (Flyweights).
     */
    private $variations = [];

    /**
     * When adding a cat to the database, we look for an existing cat variation
     * first.
     */
    public function addCat(
        string $name,
        string $age,
        string $owner,
        string $breed,
        string $image,
        string $color,
        string $texture,
        string $fur,
        string $size
    ) {
        $variation =
            $this->getVariation($breed, $image, $color, $texture, $fur, $size);
        $this->cats[] = new Cat($name, $age, $owner, $variation);
        echo "CatDataBase: Added a cat ($name, $breed).\n";
    }

    /**
     * Return an existing variation (Flyweight) by given data or create a new
     * one if it doesn't exist yet.
     */
    public function getVariation(
        string $breed,
        string $image, $color,
        string $texture,
        string $fur,
        string $size
    ): CatVariation {
        $key = $this->getKey(get_defined_vars());

        if (!isset($this->variations[$key])) {
            $this->variations[$key] =
                new CatVariation($breed, $image, $color, $texture, $fur, $size);
        }

        return $this->variations[$key];
    }

    /**
     * This function helps to generate unique array keys.
     */
    private function getKey(array $data): string
    {
        return md5(implode("_", $data));
    }

    /**
     * Look for a cat in the database using the given query parameters.
     */
    public function findCat(array $query)
    {
        foreach ($this->cats as $cat) {
            if ($cat->matches($query)) {
                return $cat;
            }
        }
        echo "CatDataBase: Sorry, your query does not yield any results.";
    }
}

/**
 * The client code.
 */
$db = new CatDataBase();

echo "Client: Let's see what we have in \"cats.csv\".\n";

// To see the real effect of the pattern, you should have a large database with
// several millions of records. Feel free to experiment with code to see the
// real extent of the pattern.
$handle = fopen(__DIR__ . "/cats.csv", "r");
$row = 0;
$columns = [];
while (($data = fgetcsv($handle)) !== false) {
    if ($row == 0) {
        for ($c = 0; $c < count($data); $c++) {
            $columnIndex = $c;
            $columnKey = strtolower($data[$c]);
            $columns[$columnKey] = $columnIndex;
        }
        $row++;
        continue;
    }

    $db->addCat(
        $data[$columns['name']],
        $data[$columns['age']],
        $data[$columns['owner']],
        $data[$columns['breed']],
        $data[$columns['image']],
        $data[$columns['color']],
        $data[$columns['texture']],
        $data[$columns['fur']],
        $data[$columns['size']],
    );
    $row++;
}
fclose($handle);

// ...

echo "\nClient: Let's look for a cat named \"Siri\".\n";
$cat = $db->findCat(['name' => "Siri"]);
if ($cat) {
    $cat->render();
}

echo "\nClient: Let's look for a cat named \"Bob\".\n";
$cat = $db->findCat(['name' => "Bob"]);
if ($cat) {
    $cat->render();
}
