<?php

/*
|--------------------------------------------------------------------------
| Abstract Factory Design Pattern - SystemUI Components
|--------------------------------------------------------------------------
| This example demonstrates the Factory Method Design Pattern to send various
| types of notifications (Email, SMS).
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Creational/AbstractFactory/RealWorldExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Creational\AbstractFactory\RealWorldExample;

/**
 * Abstract Factory for creating UI components.
 */

interface UIFactory
{
    public function createButton(): Button;
    public function createCheckbox(): Checkbox;
}

/**
 * Concrete Factory for Windows OS.
 */
class WindowsFactory implements UIFactory
{
    public function createButton(): Button
    {
        return new WindowsButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new WindowsCheckbox();
    }
}

/**
 * Concrete Factory for Mac OS.
 */
class MacFactory implements UIFactory
{
    public function createButton(): Button
    {
        return new MacButton();
    }

    public function createCheckbox(): Checkbox
    {
        return new MacCheckbox();
    }
}

/**
 * Abstract product interface for buttons.
 */
interface Button
{
    public function render(): string;
}

/**
 * Concrete product for Windows buttons.
 */
class WindowsButton implements Button
{
    public function render(): string
    {
        return "Rendering Windows button.";
    }
}

/**
 * Concrete product for Mac buttons.
 */
class MacButton implements Button
{
    public function render(): string
    {
        return "Rendering Mac button.";
    }
}

/**
 * Abstract product interface for checkboxes.
 */
interface Checkbox
{
    public function toggle(): string;
}

/**
 * Concrete product for Windows checkboxes.
 */
class WindowsCheckbox implements Checkbox
{
    public function toggle(): string
    {
        return "Toggling Windows checkbox.";
    }
}

/**
 * Concrete product for Mac checkboxes.
 */
class MacCheckbox implements Checkbox
{
    public function toggle(): string
    {
        return "Toggling Mac checkbox.";
    }
}

/**
 * Client code.
 */
function renderUI(UIFactory $factory)
{
    $button = $factory->createButton();
    echo $button->render();

    $checkbox = $factory->createCheckbox();
    echo $checkbox->toggle();
}

echo "Testing Windows UI factory:\n";
renderUI(new WindowsFactory());
echo "\n\n";

echo "Testing Mac UI factory:\n";
renderUI(new MacFactory());