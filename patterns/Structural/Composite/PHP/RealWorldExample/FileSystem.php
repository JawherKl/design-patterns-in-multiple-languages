<?php

/*
|--------------------------------------------------------------------------
| Composite Design Pattern - File System
|--------------------------------------------------------------------------
| Implement Composite Design Pattern to create a filesystem with files and
| folders, allowing hierarchical structures.
|--------------------------------------------------------------------------
| @category  Design Pattern
| @package   Composite/FilesystemExample
| @author    JawherKl
| @version   1.0.0
| @license   MIT License
| @link      https://github.com/JawherKl/design-patterns-in-php
|--------------------------------------------------------------------------
*/

namespace Structural\Composite\FilesystemExample;

/**
 * The base Component class declares the common interface for both files and folders.
 */
abstract class FilesystemItem
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Each component must implement its size calculation logic.
     */
    abstract public function getSize(): int;

    /**
     * Each component must provide its structure as a string representation.
     */
    abstract public function render(): string;
}

/**
 * The Leaf component represents simple files, which don't have children.
 */
class File extends FilesystemItem
{
    private $size;

    public function __construct(string $name, int $size)
    {
        parent::__construct($name);
        $this->size = $size;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function render(): string
    {
        return "File: {$this->name} ({$this->size} KB)\n";
    }
}

/**
 * The Composite component represents folders, which may contain children
 * (both files and other folders).
 */
class Folder extends FilesystemItem
{
    /**
     * @var FilesystemItem[]
     */
    private $items = [];

    public function add(FilesystemItem $item): void
    {
        $this->items[] = $item;
    }

    public function remove(FilesystemItem $item): void
    {
        $this->items = array_filter($this->items, fn($child) => $child !== $item);
    }

    public function getSize(): int
    {
        $totalSize = 0;
        foreach ($this->items as $item) {
            $totalSize += $item->getSize();
        }
        return $totalSize;
    }

    public function render(): string
    {
        $output = "Folder: {$this->name} (Total: {$this->getSize()} KB)\n";
        foreach ($this->items as $item) {
            $output .= "  " . str_replace("\n", "\n  ", $item->render());
        }
        return $output;
    }
}

/**
 * Client code to build and use the filesystem structure.
 */
function createFilesystem(): FilesystemItem
{
    $root = new Folder('root');

    $documents = new Folder('documents');
    $documents->add(new File('resume.pdf', 120));
    $documents->add(new File('cover_letter.docx', 80));

    $pictures = new Folder('pictures');
    $pictures->add(new File('photo1.jpg', 500));
    $pictures->add(new File('photo2.png', 700));

    $music = new Folder('music');
    $music->add(new File('song1.mp3', 5000));
    $music->add(new File('song2.mp3', 4500));

    $root->add($documents);
    $root->add($pictures);
    $root->add($music);

    return $root;
}

/**
 * The client code can work with any component using the abstract interface.
 */
function renderFilesystem(FilesystemItem $filesystem)
{
    echo $filesystem->render();
}

// Client: Create and render the filesystem
$filesystem = createFilesystem();
renderFilesystem($filesystem);
