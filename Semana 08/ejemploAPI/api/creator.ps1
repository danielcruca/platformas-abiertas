# Crear la estructura de carpetas
New-Item -ItemType Directory -Path "libreria-api"
New-Item -ItemType Directory -Path "libreria-api/config"
New-Item -ItemType Directory -Path "libreria-api/public"
New-Item -ItemType Directory -Path "libreria-api/src"
New-Item -ItemType Directory -Path "libreria-api/src/controllers"
New-Item -ItemType Directory -Path "libreria-api/src/models"
New-Item -ItemType Directory -Path "libreria-api/src/services"

# Crear y escribir en config.php
@'
<?php
$host = 'localhost';
$db   = 'libreria';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
'@ | Out-File -FilePath "libreria-api/config/config.php" -Encoding UTF8

# Crear y escribir en index.php
@'
<?php
require '../vendor/autoload.php';
require '../src/routes.php';
?>
'@ | Out-File -FilePath "libreria-api/public/index.php" -Encoding UTF8

# Crear y escribir en AutoresController.php
@'
<?php
require_once '../src/models/Autor.php';

class AutoresController {
    private $model;

    public function __construct() {
        $this->model = new Autor();
    }

    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/controllers/AutoresController.php" -Encoding UTF8

# Crear y escribir en LibrosController.php
@'
<?php
require_once '../src/models/Libro.php';

class LibrosController {
    private $model;

    public function __construct() {
        $this->model = new Libro();
    }

    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/controllers/LibrosController.php" -Encoding UTF8

# Crear y escribir en TransaccionesController.php
@'
<?php
require_once '../src/models/Transaccion.php';

class TransaccionesController {
    private $model;

    public function __construct() {
        $this->model = new Transaccion();
    }

    public function get($id = null) {
        if ($id) {
            echo json_encode($this->model->find($id));
        } else {
            echo json_encode($this->model->all());
        }
    }

    public function post() {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->create($data));
    }

    public function put($id) {
        $data = json_decode(file_get_contents('php://input'), true);
        echo json_encode($this->model->update($id, $data));
    }

    public function delete($id) {
        echo json_encode($this->model->delete($id));
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/controllers/TransaccionesController.php" -Encoding UTF8

# Crear y escribir en Autor.php
@'
<?php
require_once '../src/db/Database.php';

class Autor {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM autores");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM autores WHERE id_autor = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO autores (nombre, apellido, nacionalidad) VALUES (?, ?, ?)");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['nacionalidad']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE autores SET nombre = ?, apellido = ?, nacionalidad = ? WHERE id_autor = ?");
        $stmt->execute([$data['nombre'], $data['apellido'], $data['nacionalidad'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM autores WHERE id_autor = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/models/Autor.php" -Encoding UTF8

# Crear y escribir en Libro.php
@'
<?php
require_once '../src/db/Database.php';

class Libro {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM libros");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO libros (titulo, id_autor, precio, cantidad_stock) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE libros SET titulo = ?, id_autor = ?, precio = ?, cantidad_stock = ? WHERE id_libro = ?");
        $stmt->execute([$data['titulo'], $data['id_autor'], $data['precio'], $data['cantidad_stock'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM libros WHERE id_libro = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/models/Libro.php" -Encoding UTF8

# Crear y escribir en Transaccion.php
@'
<?php
require_once '../src/db/Database.php';

class Transaccion {
    private $db;

    public function __construct() {
        $this->db = Database::connect();
    }

    public function all() {
        $stmt = $this->db->query("SELECT * FROM transacciones_ventas");
        return $stmt->fetchAll();
    }

    public function find($id) {
        $stmt = $this->db->prepare("SELECT * FROM transacciones_ventas WHERE id_venta = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO transacciones_ventas (id_libro, fecha_venta, cantidad, total) VALUES (?, ?, ?, ?)");
        $stmt->execute([$data['id_libro'], $data['fecha_venta'], $data['cantidad'], $data['total']]);
        return ['id' => $this->db->lastInsertId()];
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE transacciones_ventas SET id_libro = ?, fecha_venta = ?, cantidad = ?, total = ? WHERE id_venta = ?");
        $stmt->execute([$data['id_libro'], $data['fecha_venta'], $data['cantidad'], $data['total'], $id]);
        return ['success' => true];
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM transacciones_ventas WHERE id_venta = ?");
        $stmt->execute([$id]);
        return ['success' => true];
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/models/Transaccion.php" -Encoding UTF8

# Crear y escribir en Database.php
@'
<?php
require_once '../config/config.php';

class Database {
    public static function connect() {
        global $pdo;
        return $pdo;
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/services/Database.php" -Encoding UTF8

# Crear y escribir en Response.php
@'
<?php
class Response {
    public static function json($data, $status = 200) {
        header("Content-Type: application/json");
        http_response_code($status);
        echo json_encode($data);
    }
}
?>
'@ | Out-File -FilePath "libreria-api/src/services/Response.php" -Encoding UTF8

# Crear y escribir en routes.php
@'
<?php
require_once 'controllers/AutoresController.php';
require_once 'controllers/LibrosController.php';
require_once 'controllers/TransaccionesController.php';

$method = $_SERVER['REQUEST_METHOD'];
$request = explode('/', trim($_SERVER['PATH_INFO'], '/'));

$controller = array_shift($request) . 'Controller';
$id = array_shift($request);

if (class_exists($controller)) {
    $obj = new $controller();
    switch ($method) {
        case 'GET':
            $obj->get($id);
            break;
        case 'POST':
            $obj->post();
            break;
        case 'PUT':
            $obj->put($id);
            break;
        case 'DELETE':
            $obj->delete($id);
            break;
        default:
            Response::json(['error' => 'Method not allowed'], 405);
    }
} else {
    Response::json(['error' => 'Controller not found'], 404);
}
?>
'@ | Out-File -FilePath "libreria-api/src/routes.php" -Encoding UTF8

# Crear composer.json
@'
{
    "require": {
        "php": ">=7.4"
    },
    "autoload": {
        "psr-4": {
            "App\\": "src/"
        }
    }
}
'@ | Out-File -FilePath "libreria-api/composer.json" -Encoding UTF8

Write-Output "Estructura de proyecto creada exitosamente."
