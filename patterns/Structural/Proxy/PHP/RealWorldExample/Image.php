<?php

namespace Structural\Proxy\RealWorldExample;

/**
 * The Subject interface defines the common interface for both the RealSubject
 * and the Proxy. In this example, we are simulating an online image loading service.
 */
interface Image
{
    public function display(): void;
}

/**
 * The RealSubject represents the actual image object, which can be a large
 * file that takes time to load. The RealSubject performs the real work of
 * fetching and displaying the image.
 */
class RealImage implements Image
{
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function display(): void
    {
        echo "Displaying image: " . $this->fileName . "\n";
    }
}

/**
 * The Proxy class is used to delay the loading of the real image. It performs
 * a check to determine if the image has already been loaded, and if not, 
 * it fetches it. If the image has already been loaded, it will simply display
 * it without calling the RealSubject.
 */
class ProxyImage implements Image
{
    private $realImage;
    private $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function display(): void
    {
        // Only load the real image if it has not been loaded before
        if ($this->realImage === null) {
            echo "Loading image: " . $this->fileName . "\n";
            $this->realImage = new RealImage($this->fileName);
        }
        $this->realImage->display();
    }
}

/**
 * The client code interacts with the Proxy object, which internally manages
 * the loading and displaying of the image. The client doesn't need to know 
 * if the image is already loaded or not.
 */
function clientCode(Image $image)
{
    $image->display();  // Image will be loaded and displayed
    $image->display();  // Image will be displayed from cache
}

// Client code with RealImage
echo "Executing client code with RealSubject:\n";
$realImage = new RealImage("photo.jpg");
clientCode($realImage);

echo "\n";

// Client code with ProxyImage
echo "Executing client code with Proxy:\n";
$proxyImage = new ProxyImage("photo.jpg");
clientCode($proxyImage);

