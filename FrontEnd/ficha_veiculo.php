<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
  	
  	<link rel="stylesheet"  href="ficha.css" />
  	
  	
  	
  	
</head>
<body>
  	
  	<div class="retangulo-azul">
        
        <div class="home">Home</div>
        <div class="nossos-veiculos">Nossos veículos</div>
        <div class="sobre-nos">Sobre-nós</div>
        <div class="retangulo-laranja">
            <a href="#" class="inscrever-se">
                <i class="icon-person"></i> Inscrever-se
            </a>
            <div class="barra-vertical"></div>
            <a href="#" class="entrar">Entrar</a>
        </div>
  	
  	  <!-- Início do carrossel de imagens -->
        <div class="image-container">
            <div class="carousel">
                <div class="slides">
                    <?php
                            include("MySqlDataProvider.php");
                            include("config.php");
                            
                            // Cria uma nova instância da classe MySqlDataProvider com a configuração
                            $conn = new MySqlDataProvider($config);
                            
                            // Define o ID do veículo
                            $id_veiculo = 1; // Substitua pelo ID do veículo que deseja exibir
                            
                            // Prepara a consulta
                            $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = ?";
                            $stmt = $conn->prepare($sql);
                            
                            if ($stmt) {
                                // Faz o bind do parâmetro (tipo 'i' para inteiro)
                                $stmt->bind_param('i', $id_veiculo);
                                
                                // Executa a consulta
                                $stmt->execute();
                                
                                // Obtém o resultado
                                $result = $stmt->get_result();
                            
                                // Exibe as imagens do veículo
                                while ($row = $result->fetch_assoc()) {
                                    echo '<div class="slide">';
                                    echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
                                    echo '</div>';
                                }
                            
                                // Fecha a declaração
                                $stmt->close();
                            } else {
                                // Caso ocorra um erro na preparação da consulta
                                echo "Erro ao preparar a consulta: " . $conn->error;
                            }
                  ?>
                </div>
                <!-- Botões de navegação do carrossel -->
                <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
                <button class="next" onclick="moveSlide(1)">&#10095;</button>
            </div>
        </div>
        <!-- Fim do carrossel de imagens -->
    
        <script>
            let slideIndex = 0;
            const slides = document.querySelector('.slides');
            const totalSlides = slides.children.length;
    
            function moveSlide(direction) {
                slideIndex = (slideIndex + direction + totalSlides) % totalSlides;
                slides.style.transform = `translateX(-${slideIndex * 100}%)`;
            }
        </script>
        <div class="retangulo-status">
            <?php 
                
                
                // Define o ID do veículo
               // Substitua pelo ID do veículo que deseja exibir
                
                // Prepara a consulta para buscar informações do veículo
                $sql_info = "SELECT status, valor_diaria, cambio, capacidade_bagageiro, capacidade_pessoas, combustivel FROM veiculos WHERE id_veiculo = ?";
                $stmt_info = $conn->prepare($sql_info);
                
                if ($stmt_info) {
                    // Faz o bind do parâmetro (tipo 'i' para inteiro)
                    $stmt_info->bind_param('i', $id_veiculo);
                
                    // Executa a consulta
                    $stmt_info->execute();
                
                    // Obtém o resultado
                    $result_info = $stmt_info->get_result();
                    $vehicle = $result_info->fetch_assoc();
                
                    // Verifica se os dados do veículo foram encontrados
                    if ($vehicle) {
                        echo "<h2>Status</h2>";
                        echo "<strong> Disponibilidade : </strong><p2> " . htmlspecialchars($vehicle['status']) . "</p2>";
                        
                        echo "<h2>Valor Diário: </h2> <p2>R$ " . htmlspecialchars($vehicle['valor_diaria']) . "</p2>";
                        echo "<h2>Informações adicionais</h2>";
                        echo "<strong> Cambio: </strong> <p>" . htmlspecialchars($vehicle['cambio']) . "</p>";
                        echo "<strong> Passageiros: </strong><p> " . htmlspecialchars($vehicle['capacidade_pessoas']) . "</p>";
                        echo "<strong> Combustível: </strong><p> " . htmlspecialchars($vehicle['combustivel']) . "</p>";
                        echo "<strong> Bagageiro: </strong> <p>" . htmlspecialchars($vehicle['capacidade_bagageiro']) . " Litros </p>";
                    } else {
                        echo "<p>Informações do veículo não encontradas.</p>";
                    }
                
                    // Fecha a declaração
                    $stmt_info->close();
                } else {
                    // Caso ocorra um erro na preparação da consulta
                    echo "Erro ao preparar a consulta: " . $conn->error;
                }
            ?>
             
            
        </div>
        <div class="retangulo-info">

        </div>
        <div class="retangulo-dados">
                <?php
                
                $sql_info = "SELECT marca, modelo, ano, placa FROM veiculos WHERE id_veiculo = ?";
                $stmt_info = $conn->prepare($sql_info);
                
                if ($stmt_info) {
                    // Faz o bind do parâmetro (tipo 'i' para inteiro)
                    $stmt_info->bind_param('i', $id_veiculo);
                
                    // Executa a consulta
                    $stmt_info->execute();
                
                    // Obtém o resultado
                    $result_info = $stmt_info->get_result();
                    $vehicle = $result_info->fetch_assoc();
                
                    // Verifica se os dados do veículo foram encontrados
                    if ($vehicle) {
                        echo "<h2>Informações do Veículo</h2>";
                        echo "<p><strong>Marca:</strong> " . htmlspecialchars($vehicle['marca']) . "</p>";
                        echo "<p><strong>Modelo:</strong> " . htmlspecialchars($vehicle['modelo']) . "</p>";
                        echo "<p><strong>Ano:</strong> " . htmlspecialchars($vehicle['ano']) . "</p>";
                        echo "<p><strong>Placa:</strong> " . htmlspecialchars($vehicle['placa']) . "</p>";
                    } else {
                        echo "<p>Informações do veículo não encontradas.</p>";
                    }
                
                    // Fecha a declaração
                    $stmt_info->close();
                } else {
                    // Caso ocorra um erro na preparação da consulta
                    echo "Erro ao preparar a consulta: " . $conn->error;
                }
                ?>
                <h2>Alugar</h2>
                    <button class="glow-on-hover">Clique Aqui</button>
                
        </div>
        <div class = "retangulo-footer">

        </div>

</body>
</html>