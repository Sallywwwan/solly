<?
$costzak = 0;
$result = $link->query('SELECT * FROM zakaz'); 
    $tov2 = 'Добрый день, мой заказ:';
    $tov = '';
    while($row = $result->fetch_assoc()) {
        $result2 = $link->query('SELECT * FROM Products');
        if($row['idpols'] == $_SESSION['id']) {
            while($row2 = $result2->fetch_assoc()) {
                if ($row['idtovara'] == $row2['idtovara']) {
                    $tov = '%0A'.$row2['name'].'&#32;'.$row['col'].'шт.';
                    $zvcost = $row2['costs']*$row['col'];
                    $costzak = $costzak+$zvcost;
                }
            }
        }
        $tov2 = $tov2.$tov;
    }

?>