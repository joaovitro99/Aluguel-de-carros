<!DOCTYPE html>
< lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../public/assets/css/ficha.css" />
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
                <?php if (!empty($vehicleImages)): ?>
                    <?php foreach ($vehicleImages as $image): ?>
                        <div class="slide">
                            <img src="data:image/jpeg;base64,<?= base64_encode($image) ?>" alt="Imagem do Veículo">
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>Nenhuma imagem disponível para este veículo.</p>
                <?php endif; ?>
            </div>
            <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
            <button class="next" onclick="moveSlide(1)">&#10095;</button>
        </div>
    </div>

    <!-- Exibir detalhes do veículo -->
    <div class="retangulo-status">
        <?php if (!empty($vehicleInfo)): ?>
            <h2>Status</h2>
            <p><strong>Disponibilidade:</strong> <?= htmlspecialchars($vehicleInfo['status']) ?></p>

            <h2>Valor Diário</h2>
            <p>R$ <?= htmlspecialchars($vehicleInfo['valor_diaria']) ?></p>

            <h2>Informações Adicionais</h2>
            <p><strong>Câmbio:</strong> <?= htmlspecialchars($vehicleInfo['cambio']) ?></p>
            <p><strong>Capacidade de Passageiros:</strong> <?= htmlspecialchars($vehicleInfo['capacidade_pessoas']) ?></p>
            <p><strong>Combustível:</strong> <?= htmlspecialchars($vehicleInfo['combustivel']) ?></p>
            <p><strong>Bagageiro:</strong> <?= htmlspecialchars($vehicleInfo['capacidade_bagageiro']) ?> Litros</p>
        <?php else: ?>
            <p>Informações do veículo não encontradas.</p>
        <?php endif; ?>
    </div>

    <div class="retangulo-dados">
        <?php if (!empty($vehicleInfo)): ?>
            <h2>Informações do Veículo</h2>
            <p><strong>Marca:</strong> <?= htmlspecialchars($vehicleInfo['marca']) ?></p>
            <p><strong>Modelo:</strong> <?= htmlspecialchars($vehicleInfo['modelo']) ?></p>
            <p><strong>Ano:</strong> <?= htmlspecialchars($vehicleInfo['ano']) ?></p>
            <p><strong>Placa:</strong> <?= htmlspecialchars($vehicleInfo['placa']) ?></p>

            <h2>Alugar</h2>
            <button class="glow-on-hover" onclick="rentVehicle()">Clique Aqui</butto>
        <?php else: ?>
            <p>Informações adicionais não disponíveis.</p>
        <?php endif; ?>
    </div>

    <div class = "botao-alugar">
        
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
    <script>
function rentVehicle() {
    const vehicleInfo = {
        marca: "<?= htmlspecialchars($vehicleInfo['marca']) ?>",
        modelo: "<?= htmlspecialchars($vehicleInfo['modelo']) ?>",
        ano: "<?= htmlspecialchars($vehicleInfo['ano']) ?>",
        placa: "<?= htmlspecialchars($vehicleInfo['placa']) ?>"
    };

    // Envia a requisição Ajax para alugar o veículo
    fetch('router.php?action=rentVehicle', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(vehicleInfo)
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            alert("Mensagem de confirmação enviada pelo WhatsApp!");
        } else {
            alert("Erro: " + data.message);
        }
    })
    .catch(error => {
        console.error('Erro:', error);
        alert("Ocorreu um erro ao enviar a mensagem.");
    });
}
</script>
</body>
</html>
