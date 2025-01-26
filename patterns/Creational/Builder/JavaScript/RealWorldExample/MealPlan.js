// Builder Design Pattern - Meal Plan
//
// This example demonstrates the Builder Design Pattern to create different
// types of meal plans (Vegetarian, Standard).

// MealPlanBuilder interface specifies methods for creating different parts of the
// Meal Plan.
class MealPlanBuilder {
    addMainCourse() {}
    addSideDish() {}
    addDessert() {}
    getMealPlan() {}
}

// Concrete Builder class for creating a Standard Meal Plan.
class StandardMealPlanBuilder extends MealPlanBuilder {
    constructor() {
        super();
        this.mealPlan = new MealPlan();
    }

    addMainCourse() {
        this.mealPlan.mainCourse = "Steak";
        return this;
    }

    addSideDish() {
        this.mealPlan.sideDish = "French Fries";
        return this;
    }

    addDessert() {
        this.mealPlan.dessert = "Ice Cream";
        return this;
    }

    getMealPlan() {
        return this.mealPlan;
    }
}

// Concrete Builder class for creating a Vegetarian Meal Plan.
class VegetarianMealPlanBuilder extends MealPlanBuilder {
    constructor() {
        super();
        this.mealPlan = new MealPlan();
    }

    addMainCourse() {
        this.mealPlan.mainCourse = "Vegetarian Burger";
        return this;
    }

    addSideDish() {
        this.mealPlan.sideDish = "Salad";
        return this;
    }

    addDessert() {
        this.mealPlan.dessert = "Fruit Salad";
        return this;
    }

    getMealPlan() {
        return this.mealPlan;
    }
}

// The Product class represents the complex object under construction, in this
// case, a Meal Plan.
class MealPlan {
    constructor() {
        this.mainCourse = "";
        this.sideDish = "";
        this.dessert = "";
    }

    listItems() {
        console.log(`Main Course: ${this.mainCourse}`);
        console.log(`Side Dish: ${this.sideDish}`);
        console.log(`Dessert: ${this.dessert}`);
    }
}

// The Director class defines the order in which the construction steps
// should be called to build the final meal plan.
class MealPlanDirector {
    buildStandardMeal(builder) {
        return builder.addMainCourse()
            .addSideDish()
            .addDessert()
            .getMealPlan();
    }

    buildVegetarianMeal(builder) {
        return builder.addMainCourse()
            .addSideDish()
            .addDessert()
            .getMealPlan();
    }
}

// Client code to demonstrate the Meal Plan creation process.
function clientCode(director, builder) {
    let mealPlan = director.buildStandardMeal(builder);
    console.log("Standard Meal Plan:");
    mealPlan.listItems();

    console.log();

    let vegetarianMealPlan = director.buildVegetarianMeal(builder);
    console.log("Vegetarian Meal Plan:");
    vegetarianMealPlan.listItems();
}

// Usage Example:
const director = new MealPlanDirector();

console.log("Testing Standard Meal Plan Builder:");
clientCode(director, new StandardMealPlanBuilder());

console.log("\n\nTesting Vegetarian Meal Plan Builder:");
clientCode(director, new VegetarianMealPlanBuilder());
