<?php

/*
|--------------------------------------------------------------------------
| Builder Design Pattern - Meal Plan Example
|--------------------------------------------------------------------------
| This example demonstrates the Builder Design Pattern to create different
| types of meal plans (Vegetarian, Standard).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/Builder/RealWorldExample
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\Builder\RealWorldExample;

/**
 * The Builder interface specifies methods for creating different parts of the
 * Meal Plan.
 */
interface MealPlanBuilder
{
    public function addMainCourse(): MealPlanBuilder;
    public function addSideDish(): MealPlanBuilder;
    public function addDessert(): MealPlanBuilder;
    public function getMealPlan(): MealPlan;
}

/**
 * Concrete Builder class for creating a Standard Meal Plan.
 */
class StandardMealPlanBuilder implements MealPlanBuilder
{
    private $mealPlan;

    public function __construct()
    {
        $this->mealPlan = new MealPlan();
    }

    public function addMainCourse(): MealPlanBuilder
    {
        $this->mealPlan->mainCourse = "Steak";
        return $this;
    }

    public function addSideDish(): MealPlanBuilder
    {
        $this->mealPlan->sideDish = "French Fries";
        return $this;
    }

    public function addDessert(): MealPlanBuilder
    {
        $this->mealPlan->dessert = "Ice Cream";
        return $this;
    }

    public function getMealPlan(): MealPlan
    {
        return $this->mealPlan;
    }
}

/**
 * Concrete Builder class for creating a Vegetarian Meal Plan.
 */
class VegetarianMealPlanBuilder implements MealPlanBuilder
{
    private $mealPlan;

    public function __construct()
    {
        $this->mealPlan = new MealPlan();
    }

    public function addMainCourse(): MealPlanBuilder
    {
        $this->mealPlan->mainCourse = "Vegetarian Burger";
        return $this;
    }

    public function addSideDish(): MealPlanBuilder
    {
        $this->mealPlan->sideDish = "Salad";
        return $this;
    }

    public function addDessert(): MealPlanBuilder
    {
        $this->mealPlan->dessert = "Fruit Salad";
        return $this;
    }

    public function getMealPlan(): MealPlan
    {
        return $this->mealPlan;
    }
}

/**
 * The Product class represents the complex object under construction, in this
 * case, a Meal Plan.
 */
class MealPlan
{
    public $mainCourse;
    public $sideDish;
    public $dessert;

    public function listItems(): void
    {
        echo "Main Course: {$this->mainCourse}\n";
        echo "Side Dish: {$this->sideDish}\n";
        echo "Dessert: {$this->dessert}\n";
    }
}

/**
 * The Director class defines the order in which the construction steps
 * should be called to build the final meal plan.
 */
class MealPlanDirector
{
    public function buildStandardMeal(MealPlanBuilder $builder): MealPlan
    {
        return $builder->addMainCourse()
                       ->addSideDish()
                       ->addDessert()
                       ->getMealPlan();
    }

    public function buildVegetarianMeal(MealPlanBuilder $builder): MealPlan
    {
        return $builder->addMainCourse()
                       ->addSideDish()
                       ->addDessert()
                       ->getMealPlan();
    }
}

/**
 * Client code to demonstrate the Meal Plan creation process.
 */
function clientCode(MealPlanDirector $director, MealPlanBuilder $builder)
{
    $mealPlan = $director->buildStandardMeal($builder);
    echo "Standard Meal Plan:\n";
    $mealPlan->listItems();

    echo "\n";

    $vegetarianMealPlan = $director->buildVegetarianMeal($builder);
    echo "Vegetarian Meal Plan:\n";
    $vegetarianMealPlan->listItems();
}

// Usage Example:
$director = new MealPlanDirector();

echo "Testing Standard Meal Plan Builder:\n";
clientCode($director, new StandardMealPlanBuilder());

echo "\n\nTesting Vegetarian Meal Plan Builder:\n";
clientCode($director, new VegetarianMealPlanBuilder());
