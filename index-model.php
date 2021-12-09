<?php


if (isset($_POST['action']) == 'registro') {


    (isset($_POST['name'])) ? $name = $_POST['name'] : "";
    (isset($_POST['lastname'])) ? $lastname = $_POST['lastname'] : "";
    (isset($_POST['address'])) ? $address = $_POST['address'] : "";
    (isset($_POST['age'])) ? $age = $_POST['age'] : "";
    (isset($_POST['email'])) ? $email = $_POST['email'] : "";
    (isset($_POST['electrolitos'])) ? $electrolitos = $_POST['electrolitos'] : "";
    (isset($_POST['glucosa'])) ? $glucosa = $_POST['glucosa'] : "";
    (isset($_POST['azucar'])) ? $azucar = $_POST['azucar'] : "";
    (isset($_POST['proteina'])) ? $proteina = $_POST['proteina'] : "";

    include './bd_conexion.php';
    include './functions.php';

    try {

        $stmt = $conn->prepare("INSERT INTO user (name,lastname,address,age,email,electrolitos,glucosa,azucar,proteina) VALUES(?,?,?,?,?,?,?,?,?);");
        $stmt->bind_param('sssssssss', $name, $lastname, $address, $age, $email, $electrolitos, $glucosa, $azucar, $proteina);

        $stmt->execute();

        if ($stmt->affected_rows > 0) {

            $last_id = $stmt->insert_id;

            sendEmail($last_id);

            $response = array(

                'response' => 'correcto',
                'id_insertado' => $stmt->insert_id,
                'tipo' => 'registro'

            );
        } else {

            $response = array(

                'response' => 'error'

            );
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {

        $response = array(

            'error' => $e->getMessage()

        );
    }

    echo json_encode($response);
}
