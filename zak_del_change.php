<?
    if (isset($_GET['korzina'])) {
    header("Location: katalog.php");}
    include("bd.php");
    // Заказ товара
    $colvobut = 0;
    $plustovkorz = 0;
    $korzina = 0;
    if (isset($_GET['korzina']) and (isset($_GET['colvo']))) {
        $korzina = $_GET['korzina'];
        $colvo = $_GET['colvo'];
    }
    $id = $_SESSION['id'];
    $nz = $_SESSION['nz'];
    $re = $link->query('SELECT * FROM zakaz');
    while($ro = $re->fetch_assoc()) 
        {
            if (($id == $ro['idpols'])and($nz == $ro['nz'])and($korzina == $ro['idtovara'])){
                $idzak = $ro['id'];
                $colvo = $colvo+$ro['col'];
                        $rec = $link->query('SELECT * FROM Products');
                        while($roc = $rec->fetch_assoc())
                            {
                                if (($korzina == $roc['idtovara'])and($colvo < $roc['coldep'])) {
                                    $plustovkorz = mysqli_query ($link,"UPDATE zakaz SET col = '$colvo' WHERE id = '$idzak'");
                                    header("Location: korzina.php");
                                    }else {
                                            if ($colvo >= $roc['coldep']) {
                                                $colvo = $roc['coldep'];
                                                $plustovkorz = mysqli_query ($link,"UPDATE zakaz SET col = '$colvo' WHERE id = '$idzak'");
                                                header("Location: korzina.php");
                                                }
                                            }
                            }
            }
        }
    if ((!empty($_GET['korzina']))and($plustovkorz <> 1)) {
    $zakaz = mysqli_query ($link,"INSERT INTO zakaz (col,idpols,nz,idtovara) VALUES ('$colvo','$id','$nz','$korzina')");
    }
    unset($_GET['korzina']);
    unset($_GET['colvo']);
    $korzina = "";
    $colvo = "";
    
        //изменение количества
    
    if (isset($_POST['colvobut'])) {
        $colvok = $_POST['colvo'];
        $colvobut = $_POST['colvobut'];
        $colvobut=preg_replace("/<!--.*?-->/", "", $colvobut);
                $update = mysqli_query ($link,"UPDATE zakaz SET col = '$colvok' WHERE nz = '$nz' AND idtovara='$colvobut'");
                unset($_POST['colvobut']);
                echo '<meta http-equiv="Refresh" content="0; korzina.php">';
    }
    
        // удаление
    
    if (isset($_POST['del'])){
            $del = $_POST['del'];
            if (str_word_count($del) == 0) { 
                $del = mysqli_query($link,"DELETE FROM zakaz WHERE  nz = '$nz' AND idtovara='$del'");
                unset($_POST['del']);
                echo '<meta http-equiv="Refresh" content="0; korzina.php">';
            }
    }
    // добавление
    $sch = 0;
    $sch22 = 0;
    $re = $link->query("SELECT * FROM zakaz");
    while($re1 = $re->fetch_assoc()) {
                $img = "";
                $name = "";
                $costs = "";
                $col = "";
                $tovar = $link->query("SELECT * FROM Products");
                $idtovara = $re1['idtovara'];
                if (isset($tovar1['coldep'])) {
                    $coldep = $tovar1['coldep'];
                }
        if (($_SESSION['id'] == $re1['idpols'])and($_SESSION['nz'] == $re1['nz'])) {
            while($tovar1 = $tovar->fetch_assoc()) {
                $img = $tovar1['image'];
                $name = $tovar1['name'];
                $costs = $tovar1['costs'];
                $col = $re1['col'];
                $idtovara = $re1['idtovara'];
                $coldep = $tovar1['coldep'];
                $costs = $costs*$col;
            if ($re1['idtovara'] == $tovar1['idtovara']) {
                $sch22 = $sch22+1;
                include("products/korzinat.php");
                break;
            }}}}
    $link->close();?>