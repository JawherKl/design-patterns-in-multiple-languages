<?php

/*
|--------------------------------------------------------------------------
| Chain of Responsibility Design Pattern - Customer Support System
|--------------------------------------------------------------------------
| this example simulating a Customer Support System where a customer inquiry 
| goes through different levels of support.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Behavioral/ChainOfResponsibility/CustomerSupportSystem
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace patterns\Behavioral\ChainOfResponsibility\PHP\RealWorldExample;

/**
 * Abstract class defining the base handler for support requests.
 */
abstract class SupportHandler
{
    private $nextHandler;

    /**
     * Sets the next handler in the chain.
     */
    public function setNext(SupportHandler $handler): SupportHandler
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    /**
     * Handles the request or passes it to the next handler.
     */
    public function handleRequest(string $issue): void
    {
        if ($this->nextHandler) {
            $this->nextHandler->handleRequest($issue);
        } else {
            echo "SupportHandler: No further support available.\n";
        }
    }
}

/**
 * First level support handler (Basic Support).
 */
class BasicSupportHandler extends SupportHandler
{
    public function handleRequest(string $issue): void
    {
        if ($issue === 'password_reset') {
            echo "BasicSupportHandler: Resolved the issue (Password reset).\n";
        } else {
            echo "BasicSupportHandler: Escalating the issue to the next level.\n";
            parent::handleRequest($issue);
        }
    }
}

/**
 * Second level support handler (Technical Support).
 */
class TechnicalSupportHandler extends SupportHandler
{
    public function handleRequest(string $issue): void
    {
        if ($issue === 'software_bug') {
            echo "TechnicalSupportHandler: Resolved the issue (Software bug fix).\n";
        } else {
            echo "TechnicalSupportHandler: Escalating the issue to the next level.\n";
            parent::handleRequest($issue);
        }
    }
}

/**
 * Third level support handler (Manager Support).
 */
class ManagerSupportHandler extends SupportHandler
{
    public function handleRequest(string $issue): void
    {
        if ($issue === 'billing_issue') {
            echo "ManagerSupportHandler: Resolved the issue (Billing issue).\n";
        } else {
            echo "ManagerSupportHandler: Unable to resolve the issue. Please contact higher management.\n";
        }
    }
}

/**
 * Client code to test the chain of responsibility.
 */
function clientCode(SupportHandler $handler, string $issue)
{
    $handler->handleRequest($issue);
}

// Build the chain
$basicSupport = new BasicSupportHandler();
$technicalSupport = new TechnicalSupportHandler();
$managerSupport = new ManagerSupportHandler();

$basicSupport
    ->setNext($technicalSupport)
    ->setNext($managerSupport);

// Test the chain with different issues
echo "Case 1: Password reset request:\n";
clientCode($basicSupport, 'password_reset');

echo "\nCase 2: Software bug report:\n";
clientCode($basicSupport, 'software_bug');

echo "\nCase 3: Billing issue:\n";
clientCode($basicSupport, 'billing_issue');

echo "\nCase 4: Unknown issue:\n";
clientCode($basicSupport, 'unknown_issue');
