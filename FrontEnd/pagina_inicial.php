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
                    <p><a href="#">Inscrever-se</a></p>
                    <div id="barra-divisão"></div>
                    <p><a href="#">Entrar</a></p>
                </div>
              </nav>
              <div id="pesquisa">
                <h3 id="titulo-pesquisa">Pesquise seu carro</h3>
                <div class="overlap-1">
                  <i class="fa fa-map-marker" aria-hidden="true"  style="color: #F25D3B;"></i>
                    <input type="text" name="local_retirada" id="local-retirada" placeholder="Local de retirada">
                    
                </div>
                <div class="overlap-5">
                  <i class="fa fa-calendar" aria-hidden="true" style="color: #F25D3B;"></i>
                    <input type="date" name="data_retirada" id="data-retirada" placeholder="Data de retirada">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M10 1.875C8.39303 1.875 6.82214 2.35152 5.486 3.24431C4.14985 4.1371 3.10844 5.40605 2.49348 6.8907C1.87852 8.37535 1.71762 10.009 2.03112 11.5851C2.34463 13.1612 3.11846 14.6089 4.25476 15.7452C5.39106 16.8815 6.8388 17.6554 8.4149 17.9689C9.99099 18.2824 11.6247 18.1215 13.1093 17.5065C14.594 16.8916 15.8629 15.8502 16.7557 14.514C17.6485 13.1779 18.125 11.607 18.125 10C18.1227 7.84581 17.266 5.78051 15.7427 4.25727C14.2195 2.73403 12.1542 1.87727 10 1.875ZM10 16.875C8.64026 16.875 7.31105 16.4718 6.18046 15.7164C5.04987 14.9609 4.16868 13.8872 3.64833 12.6309C3.12798 11.3747 2.99183 9.99237 3.2571 8.65875C3.52238 7.32513 4.17716 6.10013 5.13864 5.13864C6.10013 4.17716 7.32514 3.52237 8.65876 3.2571C9.99238 2.99183 11.3747 3.12798 12.631 3.64833C13.8872 4.16868 14.9609 5.04987 15.7164 6.18045C16.4718 7.31104 16.875 8.64025 16.875 10C16.8729 11.8227 16.1479 13.5702 14.8591 14.8591C13.5702 16.1479 11.8227 16.8729 10 16.875ZM15 10C15 10.1658 14.9342 10.3247 14.8169 10.4419C14.6997 10.5592 14.5408 10.625 14.375 10.625H10C9.83424 10.625 9.67527 10.5592 9.55806 10.4419C9.44085 10.3247 9.375 10.1658 9.375 10V5.625C9.375 5.45924 9.44085 5.30027 9.55806 5.18306C9.67527 5.06585 9.83424 5 10 5C10.1658 5 10.3247 5.06585 10.4419 5.18306C10.5592 5.30027 10.625 5.45924 10.625 5.625V9.375H14.375C14.5408 9.375 14.6997 9.44085 14.8169 9.55806C14.9342 9.67527 15 9.83424 15 10Z" fill="#F2542F"/>
                      </svg>
                    <input type="time" name="hora_retirada" id="hora-retirada" placeholder="Hora de retirada">
                  </div>
                  
                  <div class="overlap-3">
                
                    <i class="fa fa-calendar" aria-hidden="true" style="color: #F25D3B;"></i>
                    <input type="date" name="data_devolucao" id="data-devolucao"placeholder="Data de devolução">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                      <path d="M10 1.875C8.39303 1.875 6.82214 2.35152 5.486 3.24431C4.14985 4.1371 3.10844 5.40605 2.49348 6.8907C1.87852 8.37535 1.71762 10.009 2.03112 11.5851C2.34463 13.1612 3.11846 14.6089 4.25476 15.7452C5.39106 16.8815 6.8388 17.6554 8.4149 17.9689C9.99099 18.2824 11.6247 18.1215 13.1093 17.5065C14.594 16.8916 15.8629 15.8502 16.7557 14.514C17.6485 13.1779 18.125 11.607 18.125 10C18.1227 7.84581 17.266 5.78051 15.7427 4.25727C14.2195 2.73403 12.1542 1.87727 10 1.875ZM10 16.875C8.64026 16.875 7.31105 16.4718 6.18046 15.7164C5.04987 14.9609 4.16868 13.8872 3.64833 12.6309C3.12798 11.3747 2.99183 9.99237 3.2571 8.65875C3.52238 7.32513 4.17716 6.10013 5.13864 5.13864C6.10013 4.17716 7.32514 3.52237 8.65876 3.2571C9.99238 2.99183 11.3747 3.12798 12.631 3.64833C13.8872 4.16868 14.9609 5.04987 15.7164 6.18045C16.4718 7.31104 16.875 8.64025 16.875 10C16.8729 11.8227 16.1479 13.5702 14.8591 14.8591C13.5702 16.1479 11.8227 16.8729 10 16.875ZM15 10C15 10.1658 14.9342 10.3247 14.8169 10.4419C14.6997 10.5592 14.5408 10.625 14.375 10.625H10C9.83424 10.625 9.67527 10.5592 9.55806 10.4419C9.44085 10.3247 9.375 10.1658 9.375 10V5.625C9.375 5.45924 9.44085 5.30027 9.55806 5.18306C9.67527 5.06585 9.83424 5 10 5C10.1658 5 10.3247 5.06585 10.4419 5.18306C10.5592 5.30027 10.625 5.45924 10.625 5.625V9.375H14.375C14.5408 9.375 14.6997 9.44085 14.8169 9.55806C14.9342 9.67527 15 9.83424 15 10Z" fill="#F2542F"/>
                      </svg>
                    <input type="time" name="hora_devolucao" id="hora-devolucao" placeholder="Hora de devolução">
                
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
