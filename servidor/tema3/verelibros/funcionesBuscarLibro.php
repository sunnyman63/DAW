<?php 
    function buscarPorAutor($dbh,$autor,$orderby,&$nulo) {
        $stmt = $dbh->prepare("SELECT id FROM autor WHERE nombre=:nombre");
        $stmt->bindParam(":nombre",$autor);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $vacio = false;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $idAut = $row["id"];
            $stmt2 = $dbh->prepare("SELECT isbn FROM escrito WHERE idAutor=:idAutor");
            $stmt2->bindParam(":idAutor",$idAut);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $isbn = $row2["isbn"];
                $stmt3 = $dbh->prepare("SELECT * FROM libro WHERE isbn=:isbn ORDER BY $orderby");
                $stmt3->bindParam(":isbn",$isbn);
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                $stmt3->execute();
                while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    $vacio = true;
                    ?>
                        <tr>
                            <td><?=$row3["titulo"]?></td>
                            <td><?=$autor?></td>
                            <td><?=$row3["isbn"]?></td>
                            <td><?=$row3["anyo_publicacion"]?></td>
                            <td><?=$row3["precio"]?></td>
                        </tr>
                    <?php
                }
            }
        }
        if($vacio == true) {
            $nulo = $vacio;
        }
    }

    function buscarPorTituloOISBN($dbh,$tipoParam,$parametro,$orderby,&$nulo) {
        $stmt = $dbh->prepare("SELECT * FROM libro WHERE $tipoParam=:param ORDER BY $orderby");
        $stmt->bindParam(":param",$parametro);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $vacio = false;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vacio = true;
            $libro = array();
            $libro["titulo"] = $row["titulo"];
            $libro["isbn"] = $row["isbn"];
            $libro["anyo_publicacion"] = $row["anyo_publicacion"];
            $libro["precio"] = $row["precio"];
            $stmt2 = $dbh->prepare("SELECT idAutor FROM escrito WHERE isbn=:isbn");
            $stmt2->bindParam(":isbn",$libro["isbn"]);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $isAut = $row2["idAutor"];
                $stmt3 = $dbh->prepare("SELECT nombre FROM autor WHERE id=:idAutor");
                $stmt3->bindParam(":idAutor",$isAut);
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                $stmt3->execute();
                while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?=$libro["titulo"]?></td>
                            <td><?=$row3["nombre"]?></td>
                            <td><?=$libro["isbn"]?></td>
                            <td><?=$libro["anyo_publicacion"]?></td>
                            <td><?=$libro["precio"]?></td>
                        </tr>
                    <?php
                }
            }
        }
        if($vacio == true) {
            $nulo = $vacio;
        }
    }

    function todosLosLibros($dbh,$orderby,&$nulo) {
        $stmt = $dbh->prepare("SELECT * FROM libro ORDER BY $orderby");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $stmt->execute();
        $vacio = false;
        while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $vacio = true;
            $libro = array();
            $libro["titulo"] = $row["titulo"];
            $libro["isbn"] = $row["isbn"];
            $libro["anyo_publicacion"] = $row["anyo_publicacion"];
            $libro["precio"] = $row["precio"];
            $stmt2 = $dbh->prepare("SELECT idAutor FROM escrito WHERE isbn=:isbn");
            $stmt2->bindParam(":isbn",$libro["isbn"],PDO::PARAM_STR);
            $stmt2->setFetchMode(PDO::FETCH_ASSOC);
            $stmt2->execute();
            while($row2 = $stmt2->fetch(PDO::FETCH_ASSOC)) {
                $isAut = $row2["idAutor"];
                $stmt3 = $dbh->prepare("SELECT nombre FROM autor WHERE id=:idAutor");
                $stmt3->bindParam(":idAutor",$isAut,PDO::PARAM_STR);
                $stmt3->setFetchMode(PDO::FETCH_ASSOC);
                $stmt3->execute();
                while($row3 = $stmt3->fetch(PDO::FETCH_ASSOC)) {
                    ?>
                        <tr>
                            <td><?=$libro["titulo"]?></td>
                            <td><?=$row3["nombre"]?></td>
                            <td><?=$libro["isbn"]?></td>
                            <td><?=$libro["anyo_publicacion"]?></td>
                            <td><?=$libro["precio"]?></td>
                        </tr>
                    <?php
                }
            }
        }
        if($vacio == true) {
            $nulo = $vacio;
        }
    }
?>