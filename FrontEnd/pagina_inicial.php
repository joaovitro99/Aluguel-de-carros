<?php
require_once(__DIR__.'/'.'../BackEnd/app/app.php');
require_once(__DIR__.'/'.'../BackEnd/repositories/CarRepository.php');

$i=0;
$id=1;
$carros=[];


while ($i < 5) {
  $model = $car_repository->getCar($id);

  // Verifica se $model é um array e não é null
  if (is_array($model) && !empty($model)) {
      $carro = [
          "marca" => $model['marca'],
          "modelo" => $model['modelo'],
          "capacidade_pessoas" => $model['capacidade_pessoas'],
          "ano" => $model['ano'],
          "cambio" => $model['cambio'],
          "id"=>$model['id_veiculo']
      ];
      
      array_push($carros, $carro);
      $i++; // Incrementa $i para sair do loop se um carro válido foi adicionado
  }

  // Sempre incrementa o ID para tentar pegar o próximo carro
  $id++;
}



?>


<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    
    <link rel="stylesheet" href="assets/css/pagina_inicial.css" />
    <link rel="stylesheet" href="assets/css/pagina_inicial.scss">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="assets/js/pagina_inicial.js" defer></script>
    <script src="assets/js/pagina_inicial_pesquisa.js" defer></script>
  </head>
  <body>
    <main>
        <div id="capa-inicial">
          
            <div class="overlap-group">
              <nav id="barra-de-pesquisa">
                <div id="nav-1">
                    <p>Home</p>
                    <p>Nossos veículos</p>
                    <p>Sobre nós</p>
                    
                </div>
                <div id="nav-2">
                    <p><a href="Cadastro.php">Inscrever-se</a></p>
                    <div id="barra-divisão"></div>
                    <p><a href="Login.php">Entrar</a></p>
                </div>
              </nav>
              <div id="pesquisa">
                <h3 id="titulo-pesquisa">Pesquise seu carro</h3>
                <div class="overlap-1">
                  
                    <i class="fa fa-map-marker" aria-hidden="true"  style="color: #F25D3B;"></i>
                      <input type="text" name="local_retirada" id="local-retirada" placeholder="Local de retirada">
                  
                    
                </div>
                <div class="overlap-5">
                <div>
                  <p>Data de retirada</p>
                    <i class="fa fa-calendar" aria-hidden="true" style="color: #F25D3B;"></i>
                   <input type="date" name="data_retirada" id="data-retirada" placeholder="Data de retirada">
                </div>
                <div>
                  <p>Hora de retirada</p>
                <i class="fa fa-clock" aria-hidden="true" style="color: #F25D3B;"></i>                
                        
                                            <input type="time" name="hora_retirada" id="hora-retirada" placeholder="Hora de retirada">
                      </div>
                  </div>
                  
                  <div class="overlap-3">
                
                    <div>
                      <i class="fa fa-calendar" aria-hidden="true" style="color: #F25D3B;"></i>
                      <p>Data de devolução</p>
                      <input type="date" name="data_devolucao" id="data-devolucao"placeholder="Data de devolução">
                    </div>
                    <div>
                    
                      
                        <p>Hora de devolução</p>
                        <i class="fa fa-clock" aria-hidden="true" style="color: #F25D3B;"></i>  
                                            <input type="time" name="hora_devolucao" id="hora-devolucao" placeholder="Hora de devolução">
                      </div>
                  </div>
                  <button onclick="pesquisaRapida()"> Continuar</button>

                  
                
              </div>

              <div class="overlap-6">
               
                <p id="seu-carro">
                  <span class="span">Seu carro ideal, na hora certa, pelo</span>
                  <span class="text-wrapper-12">&nbsp;</span>
                  <span id="estilo-texto-vermelho">melhor preço</span>
                  <span class="text-wrapper-12">.</span>
                </p>
                <img src="assets/images/pictures/SAVE.png" alt="" srcset="" id="img-carro">
              </div>
            </div>
         
        </div>
        <h3 id="titulo-carrossel">Nossos veículos</h3>
        <div class="slider-container">

          <div class="slider-content">
      
           
                <?php foreach ($carros as $carro): ?>
                  <div class="slider-single">
                    <p id="marca_modelo"><?= $carro['marca'] .' '. $carro['modelo'] ?></p>
                    <p id="ano"><?= $carro['ano'] ?></p>
                    
                      <img class="slider-single-image" src="assets/images/pictures/SAVE.png" />

                     <button><a href="ficha_veiculo.php?id=<?= $carro["id"]?>" style="text-decoration: none; color:black
                     ">Mais detalhes</a></button>

                      <div class="info-carro">
                        <p id="capacidade_passageiros" ><span><i class="fa fa-users" aria-hidden="true"></i></span><?= $carro['capacidade_pessoas'] ?></p>
                        <p id="direção"><span><i class="fa fa-car" aria-hidden="true"></i></span><?= $carro['cambio'] ?></p>
                      </div>
        
                  </div>
                  <?php endforeach; ?> 
            </div>         
                  
                    
          
      </div>
      <div id="btn-carrossel">
        <a href="BuscaCarros.php"><button> Confira todos os modelos </button></a>
        
      </div>
      

        <section id="sobre-nos">
          <h3>Sobre nós</h3>
          <p>A [nome] é uma empresa inovadora e dedicada a oferecer as melhores soluções de mobilidade para seus clientes. Com uma vasta frota de veículos que vai desde carros compactos para uso urbano até SUVs robustos para longas viagens, nosso compromisso é proporcionar uma experiência de aluguel de carros prática, segura e personalizada. Fundada com o objetivo de simplificar o processo de locação, a [nome] garante que você tenha acesso a um veículo em qualquer lugar e a qualquer momento, com facilidade e conveniência.

            Nosso atendimento é ágil e transparente, com uma equipe preparada para atender suas necessidades e oferecer as melhores opções de veículos, para que você possa viajar com conforto, segurança e sem complicações..</p>
          <ul id="ul1">
            <li>Frota variada e veículos novos</li>
            <li>Atendimento rápido e simplificado</li>
          </ul>
          

          <ul id="ul2">
            <li>Preços competitivos e sem surpresas:</li>
            <li>Assistência 24 horas em todo o país:</li>
          </ul>


        </section>
        <h3 id="header-coment">O que nossos clientes 
          estão dizendo</h3>
        <section id="comentarios">

          
            <div class="bloco-de-comentario">

              <img src="assets/images/pictures/image2.png" alt="" class="imagem-coment">
              <div class="comentario">
                <h4>Carlos</h4>
                <p>Excelente serviço! O processo de reserva foi rápido e fácil, e o carro estava em ótimas condições. A equipe foi muito atenciosa e me ajudou a encontrar a melhor opção para minha viagem. Com certeza alugarei novamente com eles.</p>
              </div>
            </div>
            <div class="bloco-de-comentario">

              <img src="assets/images/pictures/image.png" alt="" class="imagem-coment">
              <div class="comentario">
                <h4>Mariana</h4>
                <p>Gostei bastante da experiência. O atendimento foi super cordial e os preços são acessíveis. O único ponto que poderia melhorar é o tempo de espera para retirar o carro, mas de resto, tudo perfeito. Recomendo!</p>
              </div>
            </div>
            <div class="bloco-de-comentario">

              <img src="assets/images/pictures/image1.png" alt="" class="imagem-coment">
              <div class="comentario">
                <h4>Renato</h4>
                <p>Fiquei muito satisfeito com o aluguel. O carro era novinho e extremamente confortável. O atendimento foi impecável, tanto na retirada quanto na devolução. Me senti muito seguro e tranquilo durante todo o processo.</p>
              </div>
            </div>
            
        </section>
        
    </main>
  </body>
</html>
