<?php

/*
|--------------------------------------------------------------------------
| Flyweight Design Pattern - Forest Simulation
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

namespace Structural\Flyweight\RealWorld;

/**
 * Flyweight class that stores the intrinsic state shared by multiple trees.
 */
class TreeType
{
    public $name;
    public $color;
    public $texture;

    public function __construct(string $name, string $color, string $texture)
    {
        $this->name = $name;
        $this->color = $color;
        $this->texture = $texture;
    }

    public function render(int $x, int $y)
    {
        echo "Rendering a tree of type {$this->name} at ($x, $y) with color {$this->color} and texture {$this->texture}.\n";
    }
}

/**
 * Context class that stores extrinsic state (unique position).
 */
class Tree
{
    private $x;
    private $y;
    private $type; // Reference to shared TreeType (Flyweight)

    public function __construct(int $x, int $y, TreeType $type)
    {
        $this->x = $x;
        $this->y = $y;
        $this->type = $type;
    }

    public function render()
    {
        $this->type->render($this->x, $this->y);
    }
}

/**
 * Flyweight Factory to manage and reuse TreeType objects.
 */
class TreeFactory
{
    private $treeTypes = [];

    public function getTreeType(string $name, string $color, string $texture): TreeType
    {
        $key = md5("$name-$color-$texture");

        if (!isset($this->treeTypes[$key])) {
            $this->treeTypes[$key] = new TreeType($name, $color, $texture);
        }

        return $this->treeTypes[$key];
    }
}

/**
 * The main client class that manages the forest.
 */
class Forest
{
    private $trees = [];
    private $treeFactory;

    public function __construct(TreeFactory $treeFactory)
    {
        $this->treeFactory = $treeFactory;
    }

    public function plantTree(int $x, int $y, string $name, string $color, string $texture)
    {
        $treeType = $this->treeFactory->getTreeType($name, $color, $texture);
        $this->trees[] = new Tree($x, $y, $treeType);
    }

    public function render()
    {
        foreach ($this->trees as $tree) {
            $tree->render();
        }
    }
}

// Client Code
$treeFactory = new TreeFactory();
$forest = new Forest($treeFactory);
$forest->plantTree(0, 0, 'Oak', 'green', 'rough');
$forest->plantTree(1, 1, 'Birch', 'white', 'smooth');
$forest->plantTree(5, 5, 'Oak', 'green', 'rough'); // Reuses Oak tree type
$forest->plantTree(10, 10, 'Pine', 'dark green', 'needle-like');

echo "Rendering forest:\n";
$forest->render();

