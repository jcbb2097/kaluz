<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" href="libs/css/chat.css" >
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
		<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		
		<script src="https://use.fontawesome.com/779a643cc8.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
</head>
<body>
	<style>
		
        table.fTable th {
            /*border: none;*/
            font-family: 'Muli', sans-serif;
            /*padding: 0.2rem;*/
            white-space: nowrap;
            word-break: keep-all;
            border: 1px solid #ddd;
        
            font-size: 10px;
            color: #ffffff;
            background-color: #4D4D57;
            min-height: 20px;
            /*max-width: 80px;*/
            border: none;
            text-align: left;
        }

        table.fTable td {
            /*border: none;*/
            font-family: 'Muli', sans-serif;
            border: 1px solid #ddd;
            font-size: 10px;
            min-height: 20px;
            /*max-width: 80px;*/
        }
    </style>

    <?php 
        $icono1 = '';
        $fin = null;
        //if(isset($this -> finales[0])) {
          //  $fin = $this->finales[0];
            /*if($fin->getTipo()=='pdf')
                $icono1 = '<i class="fas fa-file-pdf"></i>';
            else if($fin->getTipo()=='imagen')
                $icono1 = '<i class="fas fa-file-image"></i>';
            else if($fin->getTipo()=='word')
                $icono1 = '<i class="fas fa-file-word"></i>';
            else if($fin->getTipo()=='power')
                $icono1 = '<i class="fas fa-file-powerpoint"></i>';
            else if($fin->getTipo()=='video')
                $icono1 = '<i class="fas fa-file-video"></i>';
            else if($fin->getTipo()=='audio')
                $icono1 = '<i class="fas fa-file-audio"></i>';
            else if($fin->getTipo()=='zip')
                $icono1 = '<i class="fas fa-file-archive"></i>'; 
            */
           // $icono1 = '<i class="fas fa-file-pdf" style="font-size:50px;"></i>';
        //}
    ?>
    <div class="row">
        <div class="col-12">
            <table class="table fTable">
                <tr style="">
                    <th class="" colspan="3" style="padding-bottom: 2px; background-color: #6c757d;">
                        <?php 
                            echo $this->orden.' '.$this->actividad.'<br>';
                            echo $this->expo.'<br>';
                            echo $this->entregable;
                        ?>  
                    </th>
                </tr>
                <tr >
                    <th class="" colspan="4" style="padding-top: 2px;">Entregable final</th>
                </tr>
                <?php 
                $i=1;
                    foreach ($this->vers as $v) {
                        if($v->getTipoE()=='3') {
                            $externo='target="_blank"';
                            echo '<tr>';
                            echo '<td>'.$i.'</td>'; 
                            echo '<td>'.$v->getNombre().'</td>';    
                            echo '<td>';
                            echo '<div class="row"><div class="col-12"><a '.$externo.' href="'.$v->getRuta().'"><i class="fas fa-file-pdf"></i></a></div></div>';
                            echo '<div class="row"><div class="col-12">'.$v->getFecha().'</div></div>';
                            echo '</td>'; 
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table fTable">
                <tr>
                    <th class="" colspan=3>En proceso</th>
                </tr>
                <?php 
                    $i=1;
                    foreach ($this->vers as $v) {
                        if($v->getTipoE()=='2') {
                            $externo='target="_blank"';
                            echo '<tr>';
                            echo '<td>'.$i.'</td>';   
                            echo '<td>'.$v->getNombre().'</td>';    
                            echo '<td>';
                            echo '<div class="row"><div class="col-12"><a '.$externo.' href="'.$v->getRuta().'"><i class="fas fa-file-pdf"></i></a></div></div>';
                            echo '<div class="row"><div class="col-12">'.$v->getFecha().'</div></div>';
                            echo '</td>'; 
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <table class="table fTable">
                <tr>
                    <th class="" colspan=3>Entregable preliminar</th>
                </tr>
                <?php
                $i=1;
                    foreach ($this->vers as $v) {
                        if($v->getTipoE()=='1' || $v->getTipoE()==null) {
                            $externo='target="_blank"';
                            echo '<tr>';
                            echo '<td>'.$i.'</td>'; 
                            echo '<td>'.$v->getNombre().'</td>';    
                            echo '<td>';
                            echo '<div class="row"><div class="col-12"><a '.$externo.' href="'.$v->getRuta().'"><i class="fas fa-file-pdf"></i></a></div></div>';
                            echo '<div class="row"><div class="col-12">'.$v->getFecha().'</div></div>';
                            echo '</td>'; 
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </table>
        </div>
    </div>
    

    </body>
</html>