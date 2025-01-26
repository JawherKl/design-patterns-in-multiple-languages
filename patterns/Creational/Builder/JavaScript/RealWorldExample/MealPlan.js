package main

import "fmt"

// Builder Design Pattern - Meal Plan
//
// This example demonstrates the Builder Design Pattern to create different
// types of meal plans (Vegetarian, Standard).

// MealPlanBuilder interface specifies methods for creating different parts of the
// Meal Plan.
type MealPlanBuilder interface {
    AddMainCourse() MealPlanBuilder
    AddSideDish() MealPlanBuilder
    AddDessert() MealPlanBuilder
    GetMealPlan() MealPlan
}

// Concrete Builder class for creating a Standard Meal Plan.
type StandardMealPlanBuilder struct {
    mealPlan MealPlan
}

func (b *StandardMealPlanBuilder) AddMainCourse() MealPlanBuilder {
    b.mealPlan.MainCourse = "Steak"
    return b
}

func (b *StandardMealPlanBuilder) AddSideDish() MealPlanBuilder {
    b.mealPlan.SideDish = "French Fries"
    return b
}

func (b *StandardMealPlanBuilder) AddDessert() MealPlanBuilder {
    b.mealPlan.Dessert = "Ice Cream"
    return b
}

func (b *StandardMealPlanBuilder) GetMealPlan() MealPlan {
    return b.mealPlan
}

// Concrete Builder class for creating a Vegetarian Meal Plan.
type VegetarianMealPlanBuilder struct {
    mealPlan MealPlan
}

func (b *VegetarianMealPlanBuilder) AddMainCourse() MealPlanBuilder {
    b.mealPlan.MainCourse = "Vegetarian Burger"
    return b
}

func (b *VegetarianMealPlanBuilder) AddSideDish() MealPlanBuilder {
    b.mealPlan.SideDish = "Salad"
    return b
}

func (b *VegetarianMealPlanBuilder) AddDessert() MealPlanBuilder {
    b.mealPlan.Dessert = "Fruit Salad"
    return b
}

func (b *VegetarianMealPlanBuilder) GetMealPlan() MealPlan {
    return b.mealPlan
}

// The Product class represents the complex object under construction, in this
// case, a Meal Plan.
type MealPlan struct {
    MainCourse string
    SideDish   string
    Dessert    string
}

func (m *MealPlan) ListItems() {
    fmt.Printf("Main Course: %s\n", m.MainCourse)
    fmt.Printf("Side Dish: %s\n", m.SideDish)
    fmt.Printf("Dessert: %s\n", m.Dessert)
}

// The Director class defines the order in which the construction steps
// should be called to build the final meal plan.
type MealPlanDirector struct{}

func (d *MealPlanDirector) BuildStandardMeal(builder MealPlanBuilder) MealPlan {
    return builder.AddMainCourse().
        AddSideDish().
        AddDessert().
        GetMealPlan()
}

func (d *MealPlanDirector) BuildVegetarianMeal(builder MealPlanBuilder) MealPlan {
    return builder.AddMainCourse().
        AddSideDish().
        AddDessert().
        GetMealPlan()
}

// Client code to demonstrate the Meal Plan creation process.
func clientCode(director MealPlanDirector, builder MealPlanBuilder) {
    mealPlan := director.BuildStandardMeal(builder)
    fmt.Println("Standard Meal Plan:")
    mealPlan.ListItems()

    fmt.Println()

    vegetarianMealPlan := director.BuildVegetarianMeal(builder)
    fmt.Println("Vegetarian Meal Plan:")
    vegetarianMealPlan.ListItems()
}

// Usage Example:
func main() {
    director := MealPlanDirector{}

    fmt.Println("Testing Standard Meal Plan Builder:")
    clientCode(director, &StandardMealPlanBuilder{})

    fmt.Println("\n\nTesting Vegetarian Meal Plan Builder:")
    clientCode(director, &VegetarianMealPlanBuilder{})
}
