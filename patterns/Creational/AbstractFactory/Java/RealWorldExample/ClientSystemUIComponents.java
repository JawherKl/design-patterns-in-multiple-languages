package patterns.Creational.AbstractFactory.Java.RealWorldExample;

// Abstract Factory for creating UI components
interface UIFactory {
    Button createButton();
    Checkbox createCheckbox();
}

// Concrete Factory for Windows OS
class WindowsFactory implements UIFactory {
    @Override
    public Button createButton() {
        return new WindowsButton();
    }

    @Override
    public Checkbox createCheckbox() {
        return new WindowsCheckbox();
    }
}

// Concrete Factory for Mac OS
class MacFactory implements UIFactory {
    @Override
    public Button createButton() {
        return new MacButton();
    }

    @Override
    public Checkbox createCheckbox() {
        return new MacCheckbox();
    }
}

// Abstract product interface for buttons
interface Button {
    String render();
}

// Concrete product for Windows button
class WindowsButton implements Button {
    @Override
    public String render() {
        return "Rendering Windows button.";
    }
}

// Concrete product for Mac button
class MacButton implements Button {
    @Override
    public String render() {
        return "Rendering Mac button.";
    }
}

// Abstract product interface for checkboxes
interface Checkbox {
    String toggle();
}

// Concrete product for Windows checkbox
class WindowsCheckbox implements Checkbox {
    @Override
    public String toggle() {
        return "Toggling Windows checkbox.";
    }
}

// Concrete product for Mac checkbox
class MacCheckbox implements Checkbox {
    @Override
    public String toggle() {
        return "Toggling Mac checkbox.";
    }
}

// Client code
public class ClientSystemUIComponents {
    public static void renderUI(UIFactory factory) {
        Button button = factory.createButton();
        System.out.println(button.render());

        Checkbox checkbox = factory.createCheckbox();
        System.out.println(checkbox.toggle());
    }

    public static void main(String[] args) {
        System.out.println("Testing Windows UI factory:");
        renderUI(new WindowsFactory());
        System.out.println();

        System.out.println("Testing Mac UI factory:");
        renderUI(new MacFactory());
    }
}
