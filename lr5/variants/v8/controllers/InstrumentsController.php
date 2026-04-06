
<?php
require_once 'classes/Controller.php';
require_once 'models/Instrument.php';

class InstrumentsController extends Controller {
    private $model;

    public function __construct() {
        global $pdo;
        $this->model = new Instrument($pdo);
    }

    public function index() {
        $instruments = $this->model->getAll();
        $this->view->render('instruments/index', ['instruments' => $instruments]);
    }

    public function add() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'brand' => $_POST['brand'],
                'price' => $_POST['price'],
                'condition' => $_POST['condition']
            ];
            $this->model->add($data);
            header('Location: /instruments');
        }
        $this->view->render('instruments/add');
    }

    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'name' => $_POST['name'],
                'type' => $_POST['type'],
                'brand' => $_POST['brand'],
                'price' => $_POST['price'],
                'condition' => $_POST['condition']
            ];
            $this->model->update($id, $data);
            header('Location: /instruments');
        }
        $instrument = $this->model->getById($id);
        $this->view->render('instruments/edit', ['instrument' => $instrument]);
    }

    public function delete($id) {
        $this->model->delete($id);
        header('Location: /instruments');
    }
}