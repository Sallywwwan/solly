<? 
        include("bd.php");
        $sch = 0;
        $sch2 = 0;
        $word = $_GET['q'];
        function slov($word) {
            $rw2 = explode(' ',  $word);
                array_shift($rw2);
                return implode(' ', $rw2);;
        }
        $roww2 = preg_split("//u", slov($word), -1, PREG_SPLIT_NO_EMPTY);
        $roww = preg_split("//u", $word , -1, PREG_SPLIT_NO_EMPTY);
        foreach ($roww as $key) {
            $sch = $sch+1;
            $rowsch = $rowsch.$key;
            if ($sch == 3) {
                $sch = 0;
                break;
            }
        }
        foreach ($roww2 as $key) {
            $sch = $sch+1;
            $rowsch2 = $rowsch2.$key;
            if ($sch == 3) {
                $sch = 0;
                if ($rowsch == $rowsch2) {
                    unset($rowsch2);
                }
                break;
            }
        }// $rowsch и $rowsch2 первые три буквы до пробела и 1 три буквы после
           //echo $rowsch;
          // echo $rowsch2;
                function type($prw2) {
                $rw3 = explode(' ',  $prw2);
                array_shift($rw3);
                return implode(' ', $rw3);;
            }
        $col = 0;
        $pr = $link->query('SELECT * FROM Products');
        while($pra = $pr->fetch_assoc()) 
        {
            $rowsch3 = "";
            $ronsch = "";
            $prrow = "";
            $prw2 = $pra['type'];
            $prn = $pra['name'];
            $roww3 = preg_split("//u", type($prw2), -1, PREG_SPLIT_NO_EMPTY);
            foreach ($roww3 as $key) {
            $sch = $sch+1;
            $rowsch3 = $rowsch3.$key;
            if ($sch == 3) {
                $sch = 0;
                break;
                }
            }
            $rown = preg_split("//u", $prn, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($rown as $key) {
            $sch = $sch+1;
            $ronsch = $ronsch.$key;
            if ($sch == 3) {
                $sch = 0;
                break;
                }
            }
            if ((mb_strtolower($rowsch) == mb_strtolower($ronsch))or(mb_strtolower($rowsch2) == mb_strtolower($ronsch))) {
                $idtov = $pra['idtovara'];
                include("products/smallkart.php");
            }else {
            $prw = preg_split("//u",$pra['type'], -1, PREG_SPLIT_NO_EMPTY);
            if (mb_strtolower($rowsch) == mb_strtolower($rowsch3)){
                                    $idtov = $pra['idtovara'];
                                    include("products/smallkart.php");
                        } else {
                foreach ($prw as $key) {
                    $prrow = $prrow.$key;
                       
                            if (mb_strtolower($rowsch) == mb_strtolower($prrow)) {
                                    if (!empty($rowsch2)){
                                        if ($rowsch2 == $rowsch3){
                                        $idtov = $pra['idtovara'];
                                        include("products/smallkart.php");
                                        }
                                    }else {$idtov = $pra['idtovara'];
                                    include("products/smallkart.php");}
                                
                            } 
                                
                        }   
                    }       
                                    
            }
        }
   $link->close(); ?>