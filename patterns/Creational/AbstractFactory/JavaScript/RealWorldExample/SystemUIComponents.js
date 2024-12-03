// UIFactory.js - Abstract Factory for creating UI components
class UIFactory {
    createButton() {
      throw new Error("Method 'createButton()' must be implemented.");
    }
  
    createCheckbox() {
      throw new Error("Method 'createCheckbox()' must be implemented.");
    }
  }
  
  // WindowsFactory.js - Concrete Factory for Windows OS
  class WindowsFactory extends UIFactory {
    createButton() {
      return new WindowsButton();
    }
  
    createCheckbox() {
      return new WindowsCheckbox();
    }
  }
  
  // MacFactory.js - Concrete Factory for Mac OS
  class MacFactory extends UIFactory {
    createButton() {
      return new MacButton();
    }
  
    createCheckbox() {
      return new MacCheckbox();
    }
  }
  
  // Button.js - Abstract product interface for buttons
  class Button {
    render() {
      throw new Error("Method 'render()' must be implemented.");
    }
  }
  
  // WindowsButton.js - Concrete product for Windows button
  class WindowsButton extends Button {
    render() {
      return "Rendering Windows button.";
    }
  }
  
  // MacButton.js - Concrete product for Mac button
  class MacButton extends Button {
    render() {
      return "Rendering Mac button.";
    }
  }
  
  // Checkbox.js - Abstract product interface for checkboxes
  class Checkbox {
    toggle() {
      throw new Error("Method 'toggle()' must be implemented.");
    }
  }
  
  // WindowsCheckbox.js - Concrete product for Windows checkbox
  class WindowsCheckbox extends Checkbox {
    toggle() {
      return "Toggling Windows checkbox.";
    }
  }
  
  // MacCheckbox.js - Concrete product for Mac checkbox
  class MacCheckbox extends Checkbox {
    toggle() {
      return "Toggling Mac checkbox.";
    }
  }
  
  // Client.js - Client code
  function renderUI(factory) {
    const button = factory.createButton();
    console.log(button.render());
  
    const checkbox = factory.createCheckbox();
    console.log(checkbox.toggle());
  }
  
  // Usage
  console.log("Testing Windows UI factory:");
  renderUI(new WindowsFactory());
  console.log("\n");
  
  console.log("Testing Mac UI factory:");
  renderUI(new MacFactory());
  