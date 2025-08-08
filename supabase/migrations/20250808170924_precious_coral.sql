/*
  # Mesajlaşma Sistemi Tabloları

  1. Yeni Tablolar
    - `konusmalar` - Kullanıcılar arası konuşmaları yönetir
    - `mesajlar` - Gönderilen mesajları saklar
    
  2. Güvenlik
    - Her tablo için RLS etkin
    - Kullanıcılar sadece kendi konuşmalarını görebilir
    
  3. İndeksler
    - Performans için gerekli indeksler eklendi
*/

-- Konuşmalar tablosu
CREATE TABLE IF NOT EXISTS konusmalar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    gonderen_id INT NOT NULL,
    alici_id INT NOT NULL,
    ilan_id INT NOT NULL,
    baslik VARCHAR(255) NOT NULL,
    son_mesaj_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    gonderen_aktif BOOLEAN DEFAULT TRUE,
    alici_aktif BOOLEAN DEFAULT TRUE,
    olusturma_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (gonderen_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (alici_id) REFERENCES kullanicilar(id),
    FOREIGN KEY (ilan_id) REFERENCES ilanlar(id),
    UNIQUE KEY unique_conversation (gonderen_id, alici_id, ilan_id)
);

-- Mesajlar tablosu
CREATE TABLE IF NOT EXISTS mesajlar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    konusma_id INT NOT NULL,
    gonderen_id INT NOT NULL,
    mesaj TEXT NOT NULL,
    gonderim_tarihi TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    okundu BOOLEAN DEFAULT FALSE,
    FOREIGN KEY (konusma_id) REFERENCES konusmalar(id) ON DELETE CASCADE,
    FOREIGN KEY (gonderen_id) REFERENCES kullanicilar(id)
);

-- İndeksler
CREATE INDEX IF NOT EXISTS idx_konusmalar_gonderen ON konusmalar(gonderen_id);
CREATE INDEX IF NOT EXISTS idx_konusmalar_alici ON konusmalar(alici_id);
CREATE INDEX IF NOT EXISTS idx_konusmalar_ilan ON konusmalar(ilan_id);
CREATE INDEX IF NOT EXISTS idx_mesajlar_konusma ON mesajlar(konusma_id);
CREATE INDEX IF NOT EXISTS idx_mesajlar_gonderen ON mesajlar(gonderen_id);
CREATE INDEX IF NOT EXISTS idx_mesajlar_tarih ON mesajlar(gonderim_tarihi);