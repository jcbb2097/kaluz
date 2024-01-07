<!DOCTYPE html>
<html>
<head>
	<title>Archivos compartidos</title>
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
    <div class="row">
        <div class="col-12">
            <table class="table fTable">
                <tr>
                    <th class="" colspan="5" style="padding-top: 2px;">Archivos <?php echo $this->tipo;?></th>
                </tr>
                <?php 
                $i=1;
                    foreach ($this->compartidos as $c) {
                        $externo='target="_blank"';
                        echo '<tr>';
                        echo '<td>'.$i.'</td>'; 
                        echo '<td>'.$c->getNombre().'</td>'; 
                        echo '<td>'.$c->getTipoE().'</td>';    
                        echo '<td>';
                        echo '<div class="row"><div class="col-12"><a '.$externo.' href="'.$c->getRuta().'"><i class="fas fa-file-pdf"></i></a></div></div>';
                        echo '<div class="row"><div class="col-12">'.$c->getFecha().'</div></div>';
                        echo '</td>'; 
                        echo '</tr>';
                        $i++;
                    }
                ?>
            </table>
        </div>
    </div>
    
    

    </body>
</html>