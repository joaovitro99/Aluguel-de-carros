<!DOCTYPE html>
<html>
<head>
  	<meta charset="utf-8">
  	<meta name="viewport" content="initial-scale=1, width=device-width">
  	
  	<link rel="stylesheet"  href="../assets/css/ficha.css" />
  	
  	
  	
  	
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
                            // Inclui o arquivo de conexão com o banco de dados
                            include '../includes/db_connect.php';
                            $conn = getConnection();
                            // Busca as imagens do veículo com id_veiculo = 1
                            $id_veiculo = 1; // Você pode alterar conforme o veículo que deseja exibir
                            $sql = "SELECT imagem FROM imagens_veiculo WHERE id_veiculo = :id_veiculo";
                            $stmt = $conn->prepare($sql);
                            $stmt->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
                            $stmt->execute();
            
                            // Exibe as imagens do veículo
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<div class="slide">';
                                echo '<img src="data:image/jpeg;base64,' . base64_encode($row['imagem']) . '" alt="Imagem do Veículo">';
                                echo '</div>';
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
                $sql_info = "SELECT status FROM veiculos WHERE id_veiculo = :id_veiculo";
                $stmt_info = $conn->prepare($sql_info);
                $stmt_info->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
                $stmt_info->execute();
                $vehicle = $stmt_info->fetch(PDO::FETCH_ASSOC);
                if ($vehicle) {
                    echo "<h2>Status</h2>";
                    echo "<p><strong> Disponibilidade: </strong> " . htmlspecialchars($vehicle['status']) . "</p>";
        
                } else {
                    echo "<p>Informações do veículo não encontradas.</p>";
                }
            ?>
        </div>
        <div class="retangulo-info">

        </div>
        <div class="retangulo-dados">
                <?php
                    // Busca as informações do veículo, excluindo valor_diaria, status e imagem
                    $sql_info = "SELECT marca, modelo, ano, placa FROM veiculos WHERE id_veiculo = :id_veiculo";
                    $stmt_info = $conn->prepare($sql_info);
                    $stmt_info->bindParam(':id_veiculo', $id_veiculo, PDO::PARAM_INT);
                    $stmt_info->execute();
                    $vehicle = $stmt_info->fetch(PDO::FETCH_ASSOC);
                    
                    // Exibe os dados importantes do veículo
                    if ($vehicle) {
                        echo "<h2>Informações do Veículo</h2>";
                        echo "<p><strong>Marca:</strong> " . htmlspecialchars($vehicle['marca']) . "</p>";
                        echo "<p><strong>Modelo:</strong> " . htmlspecialchars($vehicle['modelo']) . "</p>";
                        echo "<p><strong>Ano:</strong> " . htmlspecialchars($vehicle['ano']) . "</p>";
                        echo "<p><strong>Placa:</strong> " . htmlspecialchars($vehicle['placa']) . "</p>";
                    } else {
                        echo "<p>Informações do veículo não encontradas.</p>";
                    }
                ?>
        </div>
</body>
</html>