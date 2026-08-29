<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Media Gallery — Presbyterian Church of South Sudan</title>
<meta name="description" content="View photos, videos, and recent activities from the Presbyterian Church of South Sudan ministries.">
<link rel="stylesheet" href="styles.css">
<style>
    /* Custom spacing and layout for the gallery section */
    .gallery-section {
        max-width: 1200px;
        margin: 60px auto;
        padding: 0 20px;
    }
    .gallery-heading {
        color: #fffcf5;
        font-size: 2.5rem;
        margin-bottom: 10px;
        text-align: center;
    }
    .gallery-subheading {
        color: #c69a3b;
        text-align: center;
        margin-bottom: 40px;
        font-size: 1.1rem;
        text-transform: uppercase;
        letter-spacing: 1px;
    }
    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }
    .gallery-card {
        background: #161616;
        border: 1px solid #2a2a2a;
        border-radius: 4px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0,0,0,0.5);
        transition: transform 0.3s ease, border-color 0.3s ease;
    }
    .gallery-card:hover {
        transform: translateY(-5px);
        border-color: #c69a3b;
    }
    .gallery-media img, .gallery-media video {
        width: 100%;
        height: 240px;
        object-fit: cover;
        display: block;
        background: #000;
        cursor: pointer;
    }
    .gallery-info {
        padding: 20px;
    }
    .gallery-info h3 {
        margin: 0 0 10px 0;
        font-size: 1.3rem;
        color: #fffcf5;
    }
    .gallery-info p {
        margin: 0;
        color: #b3b3b3;
        font-size: 0.95rem;
        line-height: 1.6;
    }
    .empty-message {
        color: #b3b3b3;
        text-align: center;
        grid-column: 1 / -1;
        padding: 40px;
        border: 1px dashed #333;
    }

    /* ===================== UNIFIED LIGHTBOX SYSTEM ===================== */
    .media-modal {
        display: none; 
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.95);
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    .media-modal.active {
        display: flex;
        opacity: 1;
    }
    .modal-content-wrapper {
        max-width: 90%;
        max-height: 75vh;
        display: flex;
        align-items: center;
        justify-content: center;
        perspective: 1000px;
    }
    .modal-media-item {
        max-width: 100%;
        max-height: 75vh;
        border-radius: 4px;
        box-shadow: 0 0 20px rgba(198, 154, 59, 0.2);
        
        transform: scale(0.1);
        transition: transform 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275), transform-custom 0.3s ease; 
        display: none;
    }
    .media-modal.active .modal-media-item.spinning-active {
        transform: scale(1);
    }
    
    .modal-controls {
        position: absolute;
        top: 20px;
        right: 30px;
        display: flex;
        align-items: center;
        gap: 25px;
        z-index: 10000;
    }
    .rotate-btn {
        background: rgba(198, 154, 59, 0.2);
        border: 1px solid #c69a3b;
        color: #fffcf5;
        padding: 8px 14px;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
        font-size: 0.9rem;
        display: none;
        transition: background 0.2s;
    }
    .rotate-btn:hover {
        background: #c69a3b;
        color: #000;
    }
    .modal-close {
        color: #fffcf5;
        font-size: 40px;
        font-weight: bold;
        cursor: pointer;
        transition: color 0.2s;
        user-select: none;
        line-height: 1;
    }
    .modal-close:hover {
        color: #c69a3b;
    }
    .modal-caption {
        position: absolute;
        bottom: 25px;
        color: #fffcf5;
        font-size: 1.2rem;
        text-align: center;
        width: 100%;
        padding: 0 20px;
        box-sizing: border-box;
        letter-spacing: 0.5px;
    }

    .brand {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    .brand-mark-svg {
        width: 46px;
        height: 46px;
        flex-shrink: 0;
    }
</style>
</head>
<body>

<header class="site-header">
  <nav class="nav">
    <a href="index.html" class="brand">
      <svg class="brand-mark-svg" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg" aria-label="Presbyterian Church of South Sudan Logo">
        <polygon points="100,5 195,100 100,195 5,100" fill="#ffffff" stroke="#2e7d32" stroke-width="4"/>
        <polygon points="100,45 155,100 100,155 45,100" fill="#ffffff" stroke="#2e7d32" stroke-width="3"/>
        <text x="50" y="55" fill="#1565c0" font-size="13" font-weight="900" font-family="sans-serif" transform="rotate(-45 50 55)">PRESBYTERIAN</text>
        <text x="130" y="40" fill="#1565c0" font-size="13" font-weight="900" font-family="sans-serif" transform="rotate(45 130 40)">CHURCH</text>
        <text x="45" y="150" fill="#1565c0" font-size="13" font-weight="900" font-family="sans-serif" transform="rotate(45 45 150)">OF SOUTH</text>
        <text x="140" y="140" fill="#1565c0" font-size="13" font-weight="900" font-family="sans-serif" transform="rotate(-45 140 140)">SUDAN</text>
        <path d="M100 52 V145 M78 82 H122" stroke="#d32f2f" stroke-width="12" stroke-linecap="square"/>
        <text x="73" y="76" fill="#1565c0" font-size="5" font-weight="bold" font-family="sans-serif">MY WORDS</text>
        <text x="71" y="88" fill="#1565c0" font-size="4.5" font-weight="bold" font-family="sans-serif">WILL NEVER</text>
        <text x="104" y="76" fill="#1565c0" font-size="5" font-weight="bold" font-family="sans-serif">PASS AWAY</text>
        <path d="M72 110 Q100 104 100 115 Q100 104 128 110 L128 126 Q100 120 100 128 Q100 120 72 126 Z" fill="#ffffff" stroke="#000000" stroke-width="1.5"/>
        <line x1="100" y1="115" x2="100" y2="128" stroke="#000000" stroke-width="1.5"/>
        <line x1="77" y1="114" x2="95" y2="112" stroke="#000000" stroke-width="1"/>
        <line x1="77" y1="118" x2="95" y2="116" stroke="#000000" stroke-width="1"/>
        <line x1="77" y1="122" x2="95" y2="120" stroke="#000000" stroke-width="1"/>
        <line x1="105" y1="112" x2="123" y2="114" stroke="#000000" stroke-width="1"/>
        <line x1="105" y1="116" x2="123" y2="118" stroke="#000000" stroke-width="1"/>
        <line x1="105" y1="120" x2="123" y2="122" stroke="#000000" stroke-width="1"/>
      </svg>
      PCOSS
      <span>Equatoria Presbytery | Juba Parish</span>
    </a>
    <input type="checkbox" id="nav-toggle" class="nav-toggle">
    <label for="nav-toggle" class="nav-toggle-label" aria-label="Open menu">&#9776;</label>
    <ul class="nav-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="live.html">Live Stream</a></li>
        <li><a href="sermons.html">Sermons</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="events.html">Updates</a></li>
        <li><a href="gallery.php">Gallery</a></li>
        <li><a href="contact.html" class="nav-cta">Contact</a></li>
    </ul>
  </nav>
</header>

<main class="gallery-section">
    <h1 class="gallery-heading">Our Ministries &amp; Activities</h1>
    <p class="gallery-subheading">Capturing Moments of Faith, Community, and Service</p>

    <div class="gallery-grid">
        <?php
        $conn = new mysqli("localhost", "root", "", "pcss_church_db");
        
        if ($conn->connect_error) {
            echo '<p class="empty-message" style="color: #ff4d4d;">Database connection error. Please verify XAMPP is running.</p>';
        } else {
            $result = $conn->query("SELECT * FROM activities ORDER BY created_at DESC");
            
            if ($result && $result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                    echo '<div class="gallery-card">';
                    echo '<div class="gallery-media">';
                    
                    if ($row['media_type'] == 'video') {
                        echo '<video class="gallery-item-trigger" data-type="video" src="' . htmlspecialchars($row['file_path']) . '" muted loop playsinline></video>';
                    } else {
                        echo '<img class="gallery-item-trigger" data-type="image" src="' . htmlspecialchars($row['file_path']) . '" alt="' . htmlspecialchars($row['title']) . '">';
                    }
                    
                    echo '</div>';
                    echo '<div class="gallery-info">';
                    echo '<h3>' . htmlspecialchars($row['title']) . '</h3>';
                    echo '<p>' . nl2br(htmlspecialchars($row['description'])) . '</p>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<p class="empty-message">No photos or videos have been published to the gallery archive yet.</p>';
            }
            $conn->close();
        }
        ?>
    </div>
</main>

<div id="mediaModal" class="media-modal" role="dialog" aria-modal="true">
    <div class="modal-controls">
        <button id="rotateVideoBtn" class="rotate-btn">🔄 Rotate Video</button>
        <span class="modal-close" id="closeModal">&times;</span>
    </div>
    <div class="modal-content-wrapper">
        <img id="modalImg" class="modal-media-item" alt="Enlarged view">
        <video id="modalVideo" class="modal-media-item" controls autocomplete="off"></video>
    </div>
    <div class="modal-caption" id="modalCaption"></div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('mediaModal');
    const modalImg = document.getElementById('modalImg');
    const modalVideo = document.getElementById('modalVideo');
    const captionText = document.getElementById('modalCaption');
    const closeBtn = document.getElementById('closeModal');
    const rotateBtn = document.getElementById('rotateVideoBtn');
    const galleryItems = document.querySelectorAll('.gallery-item-trigger');

    let currentRotation = 0;

    galleryItems.forEach(item => {
        item.addEventListener('click', function() {
            const mediaType = this.getAttribute('data-type');
            const cardElement = this.closest('.gallery-card');
            const headline = cardElement.querySelector('h3').textContent;

            currentRotation = 0;
            modalVideo.style.transform = 'scale(1) rotate(0deg)';
            rotateBtn.style.display = 'none';

            modalImg.classList.remove('spinning-active');
            modalVideo.classList.remove('spinning-active');
            modalImg.style.display = 'none';
            modalVideo.style.display = 'none';
            modalVideo.pause();
            modalVideo.src = '';

            if (mediaType === 'video') {
                modalVideo.src = this.src;
                modalVideo.style.display = 'block';
                rotateBtn.style.display = 'inline-block';
            } else {
                modalImg.src = this.src;
                modalImg.style.display = 'block';
            }

            captionText.textContent = headline || '';
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';

            setTimeout(() => {
                if(mediaType === 'video') {
                    modalVideo.classList.add('spinning-active');
                    modalVideo.play();
                } else {
                    modalImg.classList.add('spinning-active');
                }
            }, 50);
        });
    });

    rotateBtn.addEventListener('click', function() {
        currentRotation = (currentRotation + 90) % 360;
        if (currentRotation === 90 || currentRotation === 270) {
            modalVideo.style.transform = `scale(0.7) rotate(${currentRotation}deg)`;
        } else {
            modalVideo.style.transform = `scale(1) rotate(${currentRotation}deg)`;
        }
    });

    function closeModalWindow() {
        modalImg.classList.remove('spinning-active');
        modalVideo.classList.remove('spinning-active');
        modal.classList.remove('active');
        modalVideo.pause();
        modalVideo.src = '';
        document.body.style.overflow = '';
    }

    closeBtn.addEventListener('click', closeModalWindow);

    modal.addEventListener('click', function(e) {
        if (e.target === modal || e.target.classList.contains('modal-content-wrapper')) {
            closeModalWindow();
        }
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('active')) {
            closeModalWindow();
        }
    });
});
</script>

</body>
</html>