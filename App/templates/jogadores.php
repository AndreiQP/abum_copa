<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jogadores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost:8080/App/util/style.css">
</head>
<body>
<div class="container img-bkground my-5">
    <div class="row">
        <?php foreach($jogadores as $jogador): ?>
            <div class="card col-5 m-4" style="width: 18rem;">
                <img src="http://localhost:8080/App/util/misterio.png" class="card-img-top" alt="<?php echo $jogador['nome']?>"">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $jogador['nome']?></h5>
                    <div class="accordion accordion-flush" id="accordionFlushExample<?php echo $jogador['id']?>">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="flush-headingOne<?php echo $jogador['id']?>">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne<?php echo $jogador['id']?>" aria-expanded="false" aria-controls="flush-collapseOne<?php echo $jogador['id']?>">
                                    Sobre
                                </button>
                            </h2>
                            <div id="flush-collapseOne<?php echo $jogador['id']?>" class="accordion-collapse collapse" aria-labelledby="flush-headingOne<?php echo $jogador['id']?>" data-bs-parent="#accordionFlushExample<?php echo $jogador['id']?>">
                                Id: <?php echo $jogador['id']?> <br>
                                Nome: <?php echo $jogador['nome']?> <br>
                                Selecao: <?php echo $jogador['id_selecao']?> <br>
                                Posicao: <?php echo $jogador['posicao']?> <br>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        <?php endforeach; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
