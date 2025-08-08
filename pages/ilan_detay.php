<?php
$ilan_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

if (!$ilan_id) {
    header("Location: index.php");
    exit;
}

$ilan = getIlan($ilan_id);
if (!$ilan) {
    header("Location: index.php");
    exit;
}

$fotograflar = getIlanFotograflari($ilan_id);
?>

<div class="container my-4">
    <div class="row">
        <!-- Fotoğraflar -->
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body p-0">
                  <?php if (!empty($fotograflar)): ?>
    <div id="ilanCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php foreach ($fotograflar as $index => $foto): ?>
                <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                    <img src="<?php echo $foto['fotograf_yolu']; ?>"
                         class="d-block w-100" style="height: 400px; object-fit: cover;"
                         alt="<?php echo $ilan['ilan_ismi']; ?>">
                </div>
            <?php endforeach; ?>
        </div>

        <?php if (count($fotograflar) > 1): ?>
            <button class="carousel-control-prev" type="button" data-bs-target="#ilanCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#ilanCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <div class="carousel-indicators">
                <?php foreach ($fotograflar as $index => $foto): ?>
                    <button type="button" data-bs-target="#ilanCarousel"
                            data-bs-slide-to="<?php echo $index; ?>"
                            <?php echo $index === 0 ? 'class="active"' : ''; ?>></button>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
<?php else: ?>
    <div class="bg-light d-flex align-items-center justify-content-center" style="height: 400px;">
        <i class="fas fa-motorcycle fa-5x text-muted"></i>
    </div>
<?php endif; ?>

            <!-- Açıklama -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-info-circle me-2"></i>Açıklama</h5>
                </div>
                <div class="card-body">
                    <?php if ($ilan['aciklama']): ?>
                        <p class="mb-0"><?php echo nl2br($ilan['aciklama']); ?></p>
                    <?php else: ?>
                        <p class="text-muted mb-0">Bu ilan için açıklama eklenmemiş.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <!-- Ürün Bilgileri -->
        <div class="col-lg-4">
            <!-- Temel Bilgiler -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-body">
                    <h4 class="card-title"><?php echo $ilan['ilan_ismi']; ?></h4>

                    <div class="mb-3">
                        <span class="badge bg-primary me-1"><?php echo $ilan['marka_adi']; ?></span>
                        <span class="badge bg-secondary"><?php echo $ilan['model_adi']; ?></span>
                    </div>

                    <div class="price-tag mb-3" style="font-size: 2rem;">
                        <?php echo number_format($ilan['fiyat'], 0, ',', '.'); ?> ₺
                    </div>

                    <div class="mb-3">
                        <small class="text-muted">İlan No: <?php echo $ilan['ilan_no']; ?></small><br>
                        <small class="text-muted">İlan Tarihi: <?php echo date('d.m.Y', strtotime($ilan['ilan_tarihi'])); ?></small>
                    </div>

                    <?php if ($ilan['konum']): ?>
                        <div class="mb-3">
                            <i class="fas fa-map-marker-alt text-primary me-2"></i>
                            <span><?php echo $ilan['konum']; ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if ($ilan['takas']): ?>
                        <div class="mb-3">
                            <span class="badge bg-success">
                                <i class="fas fa-exchange-alt me-1"></i>Takas Kabul Edilir
                            </span>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Teknik Özellikler -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-cogs me-2"></i>Teknik Özellikler</h6>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-borderless">
                        <?php if ($ilan['tipi']): ?>
                            <tr>
                                <td class="text-muted">Tip:</td>
                                <td><strong><?php echo $ilan['tipi']; ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['km']): ?>
                            <tr>
                                <td class="text-muted">KM:</td>
                                <td><strong><?php echo number_format($ilan['km'], 0, ',', '.'); ?> km</strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['motor_hacmi']): ?>
                            <tr>
                                <td class="text-muted">Motor Hacmi:</td>
                                <td><strong><?php echo $ilan['motor_hacmi']; ?> cc</strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['motor_gucu']): ?>
                            <tr>
                                <td class="text-muted">Motor Gücü:</td>
                                <td><strong><?php echo $ilan['motor_gucu']; ?> HP</strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['zamanlama_tipi']): ?>
                            <tr>
                                <td class="text-muted">Zamanlama:</td>
                                <td><strong><?php echo $ilan['zamanlama_tipi']; ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['silindir_sayisi']): ?>
                            <tr>
                                <td class="text-muted">Silindir:</td>
                                <td><strong><?php echo $ilan['silindir_sayisi']; ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['sogutma']): ?>
                            <tr>
                                <td class="text-muted">Soğutma:</td>
                                <td><strong><?php echo $ilan['sogutma']; ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['renk']): ?>
                            <tr>
                                <td class="text-muted">Renk:</td>
                                <td><strong><?php echo $ilan['renk']; ?></strong></td>
                            </tr>
                        <?php endif; ?>

                        <?php if ($ilan['plaka_uyruk']): ?>
                            <tr>
                                <td class="text-muted">Plaka:</td>
                                <td><strong><?php echo $ilan['plaka_uyruk']; ?></strong></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>

            <!-- İletişim -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white">
                    <h6 class="mb-0"><i class="fas fa-phone me-2"></i>İletişim</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong><?php echo $ilan['ad'] . ' ' . $ilan['soyad']; ?></strong>
                    </div>

                    <?php if ($ilan['telefon']): ?>
                        <div class="mb-3">
                            <a href="tel:<?php echo $ilan['telefon']; ?>" class="btn btn-primary w-100">
                                <i class="fas fa-phone me-2"></i><?php echo $ilan['telefon']; ?>
                            </a>
                        </div>
                    <?php endif; ?>

                    <?php if ($ilan['iletisim_bilgi']): ?>
                        <div class="alert alert-info">
                            <small><?php echo nl2br($ilan['iletisim_bilgi']); ?></small>
                        </div>
                    <?php endif; ?>

                    <div class="text-center">
                        <a href="https://wa.me/90<?php echo $ilan['telefon']; ?>?text=Merhaba,%20<?php echo urlencode($ilan['ilan_ismi']); ?>%20ilanınızla%20ilgileniyorum." target="_blank" class="btn btn-success w-100 mb-2">
                            <i class="fab fa-whatsapp me-2"></i>WhatsApp ile İletişim
                        </a>
                        <button class="btn btn-outline-primary w-100" onclick="shareAd()">
                            <i class="fas fa-share me-2"></i>İlanı Paylaş
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function shareAd() {
    const ilanBaslik = '<?php echo addslashes($ilan["ilan_ismi"]); ?>';
    const ilanUrl = window.location.href;
    const ilanFiyat = '<?php echo number_format($ilan["fiyat"], 0, ",", "."); ?> ₺';
    const shareText = `${ilanBaslik} - ${ilanFiyat}\n${ilanUrl}`;

    if (navigator.share) {
        navigator.share({
            title: ilanBaslik,
            text: shareText,
            url: ilanUrl
        }).catch(console.error);
    } else {
        // Fallback - metni panoya kopyala
        navigator.clipboard.writeText(shareText).then(() => {
            alert('İlan linki panoya kopyalandı!');
        }).catch(() => {
            // Eski tarayıcılar için fallback
            const textArea = document.createElement('textarea');
            textArea.value = shareText;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('İlan linki panoya kopyalandı!');
        });
    }
}
</script>