<?php

// 12. Namespace dan Autoloading
namespace AnimalAdoption;

spl_autoload_register(function ($class) {
    include __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
});

// 2. Encapsulation: class Animal dengan properties private/protected dan method akses
class Animal {
    // 3. Magic Method
    protected $name;
    protected $age;
    protected $type;
    protected $id;

    const SPECIES = "Animal"; // 5. Class Constant

    public function __construct($id, $name, $age, $type) {
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->type = $type;
    }

    public function getName() { return $this->name; }
    public function setName($name) { $this->name = $name; }

    public function __toString() {
        return "{$this->type} - {$this->name}, Age: {$this->age}";
    }
}

// 1. Scope: public, private, protected
class Dog extends Animal {
    private $breed;

    public function __construct($id, $name, $age, $breed) {
        parent::__construct($id, $name, $age, "Dog");
        $this->breed = $breed;
    }

    // 4. Inheritance & override method
    public function __toString() {
        return parent::__toString() . ", Breed: {$this->breed}";
    }
}

// 10. Trait (Reusable methods)
trait AdoptableTrait {
    private $adopted = false;
    private $adopterName;

    public function adopt($adopterName) {
        if ($this->adopted) {
            throw new \Exception("Animal already adopted.");
        }
        $this->adopted = true;
        $this->adopterName = $adopterName;
    }

    public function isAdopted(): bool {
        return $this->adopted;
    }

    public function getAdopterName() {
        return $this->adopterName;
    }
}

// 6. Late Static Binding Example
class AnimalShelter {
    public static function createAnimal($id, $name, $age) {
        return new static($id, $name, $age);
    }
}

class Cat extends AnimalShelter {
    public static function createAnimal($id, $name, $age) {
        return new CatAnimal($id, $name, $age);
    }
}

class CatAnimal extends Animal {
    use AdoptableTrait;

    public function __construct($id, $name, $age) {
        parent::__construct($id, $name, $age, "Cat");
    }
}

// 11. Polymorphism: Interface dan Abstract class
interface SoundInterface {
    public function makeSound(): string;
}

abstract class AnimalSound extends Animal {
    abstract public function makeSound(): string;
}

class DogSound extends Dog implements SoundInterface {
    public function makeSound(): string {
        return "Woof!";
    }
}

class CatSound extends CatAnimal implements SoundInterface {
    public function makeSound(): string {
        return "Meow!";
    }
}

// 7. Final Keyword and Method - class tidak bisa diturunkan
final class Shelter {
    private $animals = [];

    public function addAnimal(Animal $animal) {
        $this->animals[$animal->getName()] = $animal;
    }

    public function adoptAnimal($name, $adopterName) {
        if (!isset($this->animals[$name])) {
            throw new \Exception("Animal not found");
        }
        if (method_exists($this->animals[$name], 'adopt')) {
            $this->animals[$name]->adopt($adopterName);
        } else {
            throw new \Exception("Animal not adoptable");
        }
    }

    public function listAnimals() {
        foreach($this->animals as $animal) {
            echo $animal . ($animal instanceof AdoptableTrait && $animal->isAdopted() ? " - Adopted by: " . $animal->getAdopterName() : "") . PHP_EOL;
        }
    }
}

// 8. Type Hinting & Union Type (PHP 8+)
function printAnimalInfo(AnimalSound|DogSound $animal): void {
    echo $animal . " Sound: " . $animal->makeSound() . PHP_EOL;
}

// 9. Exception Handling
try {
    $shelter = new Shelter();
    
    $dog = new DogSound(1, "Buddy", 3, "Golden Retriever");
    $cat = new CatSound(2, "Whiskers", 2);

    // Add animals
    $shelter->addAnimal($dog);
    $shelter->addAnimal($cat);

    // 16. Object Iterator (foreach digunakan untuk iterasi di shelter)
    foreach([$dog, $cat] as $animal) {
        printAnimalInfo($animal);
    }

    // Adopt animal
    $shelter->adoptAnimal("Whiskers", "John Doe");
    
    // List animals and adoption status
    $shelter->listAnimals();

    // Try adopting already adopted animal
    $shelter->adoptAnimal("Whiskers", "Jane Smith"); // Akan melempar exception

} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . PHP_EOL;
}

// 14. MVC dan CRUD - Sederhana (hanya konsep, tidak full implementation)
// Model
class AdoptionModel {
    private $data = [];

    public function create($animal) {
        $this->data[$animal->getName()] = $animal;
    }

    public function read($name) {
        return $this->data[$name] ?? null;
    }

    public function update($name, $adopterName) {
        if (isset($this->data[$name]) && method_exists($this->data[$name], 'adopt')) {
            $this->data[$name]->adopt($adopterName);
        }
    }

    public function delete($name) {
        unset($this->data[$name]);
    }
}

// Controller
class AdoptionController {
    private $model;

    public function __construct($model) {
        $this->model = $model;
    }

    public function adopt($name, $adopterName) {
        $this->model->update($name, $adopterName);
    }

    public function show($name) {
        $animal = $this->model->read($name);
        if ($animal) {
            echo $animal . PHP_EOL;
        } else {
            echo "Animal not found." . PHP_EOL;
        }
    }
}

// 15. Object Serialization
$serializedDog = serialize($dog);
$unserializedDog = unserialize($serializedDog);

echo "Serialized Dog: $serializedDog\n";

// 17. Reflection
$reflector = new \ReflectionClass($dog);
echo "Methods in Dog class: " . implode(", ", array_map(fn($m) => $m->name, $reflector->getMethods())) . PHP_EOL;

// 18. Dependency Injection sederhana
class Logger {
    public function log($message) {
        echo "LOG: $message\n";
    }
}

class AdoptionService {
    private $logger;
    public function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    public function processAdoption($animalName) {
        $this->logger->log("Processing adoption for $animalName");
    }
}

$logger = new Logger();
$service = new AdoptionService($logger);
$service->processAdoption("Buddy");

// 19. Cloning object
$catClone = clone $cat;
echo "Cloned cat: $catClone\n";

?>

