<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="initial-scale=1, width=device-width">
    <title>Informações do Veículo</title>
    <link rel="stylesheet" href="../assets/css/ficha.css" />
</head>
<body>
    <div class="retangulo-azul">
        <div class="home">Home</div>
        <div class="nossos-veiculos">Nossos veículos</div>
        <div class="sobre-nos">Sobre-nós</div>
        <div class="retangulo-laranja">
            <a href="#" class="inscrever-se"><i class="icon-person"></i> Inscrever-se</a>
            <div class="barra-vertical"></div>
            <a href="#" class="entrar">Entrar</a>
        </div>
    </div>

    <!-- Exibir imagens do veículo -->
    <div class="image-container">
        <div class="carousel">
            <div class="slides">
                <?php foreach ($vehicleImages as $image): ?>
                    <div class="slide">
                        <img src="data:image/jpeg;base64,<?= base64_encode($image) ?>" alt="Imagem do Veículo">
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </div>

    <!-- Exibir informações do veículo -->
    <div class="retangulo-status">
        <h2>Status</h2>
        <strong>Disponibilidade: </strong><p2><?= htmlspecialchars($vehicleInfo['status']) ?></p2>
        <h2>Valor Diário: </h2><p2>R$ <?= htmlspecialchars($vehicleInfo['valor_diaria']) ?></p2>
        <h2>Informações adicionais</h2>
        <strong>Câmbio: </strong><p><?= htmlspecialchars($vehicleInfo['cambio']) ?></p>
        <strong>Passageiros: </strong><p><?= htmlspecialchars($vehicleInfo['capacidade_pessoas']) ?></p>
        <strong>Combustível: </strong><p><?= htmlspecialchars($vehicleInfo['combustivel']) ?></p>
        <strong>Bagageiro: </strong><p><?= htmlspecialchars($vehicleInfo['capacidade_bagageiro']) ?> Litros</p>
    </div>

    <div class="retangulo-dados">
        <h2>Informações do Veículo</h2>
        <p><strong>Marca:</strong> <?= htmlspecialchars($vehicleInfo['marca']) ?></p>
        <p><strong>Modelo:</strong> <?= htmlspecialchars($vehicleInfo['modelo']) ?></p>
        <p><strong>Ano:</strong> <?= htmlspecialchars($vehicleInfo['ano']) ?></p>
        <p><strong>Placa:</strong> <?= htmlspecialchars($vehicleInfo['placa']) ?></p>
        <h2>Alugar</h2>
        <button class="glow-on-hover">Clique Aqui</button>
    </div>

    <script>
        let slideIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = slides.children.length;

        function moveSlide(direction) {
            slideIndex = (slideIndex + direction + totalSlides) % totalSlides;
            slides.style.transform = `translateX(-${slideIndex * 100}%)`;
        }
    </script>
</body>
</html>
