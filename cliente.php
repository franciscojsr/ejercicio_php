<?php

require_once('dbconection/db_conn.php');

class Cliente extends Db_conn{

    private $na;
    private $ape;
    private $fna;
    private $pai;

    private $array_values;

    /**
     * Función que mostrará valores en la tabla bootstrap con simbolo delete glyphicon.
    */
    function showValue() {

        $sql = 'SELECT * FROM clientes';


        foreach($this->conexio->query($sql) as $row){

            $id = $row['id'];
            $name = $row['nombre'];
            $apellidos = $row['apellidos'];
            $fnaci = $row['fnacimiento'];
            $pais = $row['pais'];

            // Se da formato europeo a fecha nacimiento. DD-MM-YYYY
            $patrons = array ('/(19|20)(\d{2})-(\d{1,2})-(\d{1,2})/');
            $sustit = array ('\4-\3-\1\2');
            $fna_format = preg_replace($patrons, $sustit, $fnaci);

            $this->array_values = [$id, $name, $apellidos, $fna_format, $pais];

            $var_id_form = "document.getElementById('id_form')";

            echo '
                <tr>
                    <td>
                        <form id="id_form" action="javascript:void(0);" method="GET">
                            <a id="id'.$id.'" href="" onclick="'.$var_id_form.'.submit();" class="trash_id glyphicon glyphicon-trash"></a>
                            <input type="submit" value="" class="" hidden>
                        </form>
                    </td>
                    <td>'.$this->array_values[0].'</td>
                    <td>'.$this->array_values[1].'</td>
                    <td>'.$this->array_values[2].'</td>
                    <td>'.$this->array_values[3].'</td>
                    <td>'.$this->array_values[4].'</td>
                </tr>
            ';

        }

    }

    function insertValue() {

        $this->na = $_POST['name'];
        $this->ape = $_POST['ape'];
        $this->fna = $_POST['fna'];
        $this->pai = $_POST['pai'];

        // Cambiar formato a la fecha nacimiento para la db. YYYY-MM-DD. Se controla que es introduce formato compatible
        if(!preg_match('/(\d{1,2})-(\d{1,2})-(19|20)(\d{2})/', $this->fna)){
            echo "Error! Formato incorrecto fecha!";
        }else{
            $partes_fecha = preg_split("/[-]+/", $this->fna); // Divide la fecha en 3 partes.
            $fna_format = $partes_fecha[2]."-".$partes_fecha[1]."-".$partes_fecha[0];

            // Se controla si se introduce una fecha correcta. Y se procede si es necesario.
            if($partes_fecha[2] > date('Y') || $partes_fecha[1] < 1 || $partes_fecha[1] > 12 || $partes_fecha[0] < 1 || $partes_fecha[0] > 31){
                echo "Error fecha incorrecta.";
            }else{

                $sql = 'INSERT INTO clientes (nombre, apellidos, fnacimiento, pais) VALUES ( "'.$this->na.'",
                                                                                     "'.$this->ape.'",
                                                                                     "'.$fna_format.'",
                                                                                     "'.$this->pai.'")';


                if( $this->conexio->query($sql) ){
//            echo '* Register success!';
                }else{
//            echo '* Error de registro. Algo fue mal!';
                }

            }

        }




    }

    function removeValue($id) {

        $sql = 'DELETE FROM clientes WHERE id = '.$id.' ';

        if($this->conexio->query($sql)){
//            echo '* Delete success!';
        }else{
//            echo '* Eliminar imcompleto. Algo fue mal!';
        }

    }

}