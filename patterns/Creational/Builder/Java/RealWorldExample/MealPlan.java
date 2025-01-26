package patterns.Creational.Builder.Java.RealWorldExample;

// Builder Design Pattern - Meal Plan
//
// This example demonstrates the Builder Design Pattern to create different
// types of meal plans (Vegetarian, Standard).

// The Builder interface specifies methods for creating different parts of the
// Meal Plan.
interface MealPlanBuilder {
    MealPlanBuilder addMainCourse();
    MealPlanBuilder addSideDish();
    MealPlanBuilder addDessert();
    MealPlan getMealPlan();
}

// Concrete Builder class for creating a Standard Meal Plan.
class StandardMealPlanBuilder implements MealPlanBuilder {
    private MealPlan mealPlan;

    public StandardMealPlanBuilder() {
        this.mealPlan = new MealPlan();
    }

    @Override
    public MealPlanBuilder addMainCourse() {
        mealPlan.setMainCourse("Steak");
        return this;
    }

    @Override
    public MealPlanBuilder addSideDish() {
        mealPlan.setSideDish("French Fries");
        return this;
    }

    @Override
    public MealPlanBuilder addDessert() {
        mealPlan.setDessert("Ice Cream");
        return this;
    }

    @Override
    public MealPlan getMealPlan() {
        return mealPlan;
    }
}

// Concrete Builder class for creating a Vegetarian Meal Plan.
class VegetarianMealPlanBuilder implements MealPlanBuilder {
    private MealPlan mealPlan;

    public VegetarianMealPlanBuilder() {
        this.mealPlan = new MealPlan();
    }

    @Override
    public MealPlanBuilder addMainCourse() {
        mealPlan.setMainCourse("Vegetarian Burger");
        return this;
    }

    @Override
    public MealPlanBuilder addSideDish() {
        mealPlan.setSideDish("Salad");
        return this;
    }

    @Override
    public MealPlanBuilder addDessert() {
        mealPlan.setDessert("Fruit Salad");
        return this;
    }

    @Override
    public MealPlan getMealPlan() {
        return mealPlan;
    }
}

// The Product class represents the complex object under construction, in this
// case, a Meal Plan.
class MealPlan {
    private String mainCourse;
    private String sideDish;
    private String dessert;

    public void setMainCourse(String mainCourse) {
        this.mainCourse = mainCourse;
    }

    public void setSideDish(String sideDish) {
        this.sideDish = sideDish;
    }

    public void setDessert(String dessert) {
        this.dessert = dessert;
    }

    public void listItems() {
        System.out.println("Main Course: " + mainCourse);
        System.out.println("Side Dish: " + sideDish);
        System.out.println("Dessert: " + dessert);
    }
}

// The Director class defines the order in which the construction steps
// should be called to build the final meal plan.
class MealPlanDirector {
    public MealPlan buildStandardMeal(MealPlanBuilder builder) {
        return builder.addMainCourse()
                .addSideDish()
                .addDessert()
                .getMealPlan();
    }

    public MealPlan buildVegetarianMeal(MealPlanBuilder builder) {
        return builder.addMainCourse()
                .addSideDish()
                .addDessert()
                .getMealPlan();
    }
}

// Client code to demonstrate the Meal Plan creation process.
public class Main {
    public static void main(String[] args) {
        MealPlanDirector director = new MealPlanDirector();

        System.out.println("Testing Standard Meal Plan Builder:");
        MealPlan standardMealPlan = director.buildStandardMeal(new StandardMealPlanBuilder());
        standardMealPlan.listItems();

        System.out.println("\nTesting Vegetarian Meal Plan Builder:");
        MealPlan vegetarianMealPlan = director.buildVegetarianMeal(new VegetarianMealPlanBuilder());
        vegetarianMealPlan.listItems();
    }
}
