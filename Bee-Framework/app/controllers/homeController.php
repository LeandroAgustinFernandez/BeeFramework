<?php

class homeController extends Controller
{
    public function __construct()
    {
    }

    function index()
    {
        /**try {
            $test = new testModel();
            $res = $test->getAll();
            $obj = to_object($res[0]);
            echo $obj->name;
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        die;
         */

        // $token = $_SESSION['csrf_token']['token'];
        // $token = 'da4d56a4d5s6a4d1as6d5a4sdad';
        // if (Csrf::validate($token,true)) {
        // echo 'es valido';
        // }else{
        // echo 'no es valido';
        // }
        // die;

        $data = [
            'title' => 'Home',
            'bg' => 'dark',
        ];
        View::render('bee', $data);
    }
    function test()
    {
        //Insertar nuevo usuario;
        /** 
         * echo 'Probando nuestra base de datos <br><br><br>';
         * echo '<pre>';
         * try {           
         * $sql = 'INSERT INTO test (name,email,created_at) VALUES (:name,:email,:created_at)';
         * $registro = ['name' => 'Leandro Agustin Fernandez', 'email' => 'agustin@gmail.com', 'created_at' => now()];
         * $res = DB::query($sql, $registro);
         * print_r($res);
         * $sql = 'UPDATE test SET name = :name WHERE id = :id';
         * $registroActualizado = ['name' => 'Leandro Fernandez', 'id' => 25];
         * $res = DB::query($sql, $registroActualizado);
         * print_r($res);
         * $sql = 'DELETE FROM test WHERE id = :id LIMIT 1';
         * print_r(DB::query($sql, ['id' => 25]));
         * $sql = 'SELECT * FROM test';
         * $res = DB::query($sql);
         * print_r($res);
         * $sql = 'ALTER TABLE test ADD COLUMN usernam VARCHAR(255) NULL AFTER name';
         * print_r(DB::query($sql));
         * } catch (Exception $e) {
         *     echo 'Hubo un error: ' . $e->getMessage();
         * }
         * echo '</pre>';
         * die;
         */
        $data = [
            'title' => 'Home',
            'bg' => 'dark',
        ];
        View::render('test', $data);
    }
    function flash()
    {
        Flasher::new('Hola', 'success');
        Flasher::new('Chau', 'danger');
        View::render('flash');
    }
}
