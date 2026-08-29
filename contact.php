<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Contact Us — Presbyterian Church of South Sudan</title>
<meta name="description" content="Get in touch with the Presbyterian Church of South Sudan.">
<link rel="stylesheet" href="styles.css">

<style>
/* SLIDING BIBLE SIDEBAR STYLES */
.sidebar-trigger {
    position: fixed;
    right: 0;
    top: 45%;
    transform: translateY(-50%);
    background: #c69a3b;
    color: #111;
    padding: 15px 10px;
    border: none;
    border-radius: 4px 0 0 4px;
    cursor: pointer;
    font-weight: bold;
    writing-mode: vertical-rl;
    text-orientation: mixed;
    z-index: 999;
    box-shadow: -2px 0 10px rgba(0,0,0,0.3);
}
.sidebar-trigger:hover { background: #fffcf5; }

.verse-sidebar {
    position: fixed;
    right: -350px; 
    top: 0;
    width: 350px;
    height: 100vh;
    background: #161616;
    border-left: 1px solid #2a2a2a;
    box-shadow: -5px 0 25px rgba(0,0,0,0.7);
    z-index: 1000;
    transition: right 0.4s cubic-bezier(0.05, 0.74, 0.2, 1);
    display: flex;
    flex-direction: column;
    padding: 25px;
    box-sizing: border-box;
}
.verse-sidebar.open { right: 0; }

.sidebar-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid #2a2a2a;
    padding-bottom: 15px;
    margin-bottom: 20px;
}
.sidebar-header h2 { color: #fffcf5; font-size: 1.2rem; margin: 0; }
.sidebar-close { color: #b3b3b3; font-size: 24px; cursor: pointer; }

.verse-scroll-container { flex: 1; overflow-y: auto; padding-right: 8px; }
.sidebar-verse-card { background: #222; border: 1px solid #2a2a2a; border-radius: 4px; padding: 15px; margin-bottom: 15px; }
.sidebar-verse-card blockquote { margin: 0 0 10px 0; color: #fffcf5; font-style: italic; font-size: 0.88rem; }
.sidebar-verse-card cite { color: #c69a3b; font-size: 0.8rem; display: block; margin-bottom: 10px; }
.expand-verse-btn { background: none; border: none; color: #b3b3b3; cursor: pointer; font-size: 0.78rem; text-decoration: underline; }

.verse-modal { display: none; position: fixed; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.85); z-index: 2000; align-items: center; justify-content: center; }
.verse-modal.active { display: flex; }
.verse-modal-content { background: #161616; border: 1px solid #c69a3b; padding: 30px; border-radius: 6px; max-width: 500px; width: 90%; text-align: center; position: relative; }
.verse-modal-content blockquote { font-size: 1.15rem; color: #fffcf5; font-style: italic; }
.verse-modal-content cite { font-size: 0.95rem; color: #c69a3b; font-weight: bold; }

.brand { display: flex; align-items: center; gap: 12px; }
.brand-mark-svg { width: 46px; height: 46px; flex-shrink: 0; }
</style>
</head>
<body>

<button class="sidebar-trigger" id="openSidebarBtn">📖 Daily Verses</button>

<div class="verse-sidebar" id="verseSidebar">
    <div class="sidebar-header">
        <h2>Daily Bread Archive</h2>
        <span class="sidebar-close" id="closeSidebarBtn">&times;</span>
    </div>
    <div class="verse-scroll-container" id="verseScrollContainer">
        <p style="color: #b3b3b3; text-align: center; padding-top: 20px;">Loading scriptures...</p>
    </div>
</div>

<div class="verse-modal" id="verseModal">
    <div class="verse-modal-content">
        <span class="sidebar-close" id="closeModalBtn" style="position: absolute; top: 15px; right: 20px;">&times;</span>
        <blockquote id="modalVerseText"></blockquote>
        <cite id="modalVerseReference"></cite>
    </div>
</div>

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
      <li><a href="gallery.html">Gallery</a></li>
      <li><a href="contact.html" class="nav-cta">Contact</a></li>
    </ul>
  </nav>
</header>

<section class="page-hero">
  <div class="container">
    <p class="eyebrow" style="color:#e3b95c;">Connect With Us</p>
    <h1>Get in Touch</h1>
    <p>We are here to serve, pray with you, and answer any questions you may have.</p>
  </div>
</section>

<section class="section">
  <div class="container">
    <div style="max-width: 600px; margin: 0 auto; background: #1a1a1a; padding: 30px; border-radius: 8px; border: 1px solid #2a2a2a;">
      <h2 style="margin-top: 0; color: #fffcf5;">Send Us a Message</h2>
      <div id="contactStatus" style="margin-bottom: 15px; font-weight: bold;"></div>
      <form id="contactForm">
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; color: #b3b3b3;">Full Name</label>
          <input type="text" id="name" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #333; color: #fff; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; color: #b3b3b3;">Email Address</label>
          <input type="email" id="email" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #333; color: #fff; border-radius: 4px;">
        </div>
        <div style="margin-bottom: 15px;">
          <label style="display: block; margin-bottom: 5px; color: #b3b3b3;">Message</label>
          <textarea id="message" rows="5" required style="width: 100%; padding: 10px; background: #222; border: 1px solid #333; color: #fff; border-radius: 4px;"></textarea>
        </div>
        <button type="submit" class="button button-primary" style="width: 100%;">Send Message</button>
      </form>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="container">
    <div class="footer-grid">
      <div>
        <h4>Presbyterian Church of South Sudan</h4>
        <p>A Reformed congregation gathered around the Word of God, serving South Sudanese believers at home and abroad.</p>
      </div>
      <div>
        <h4>Quick Links</h4>
        <ul>
          <li><a href="about.html">About Us</a></li>
          <li><a href="sermons.html">Sermons</a></li>
          <li><a href="events.html">Updates &amp; Events</a></li>
          <li><a href="contact.html">Give</a></li>
        </ul>
      </div>
      <div>
        <h4>Service Times</h4>
        <ul>
          <li>Sunday School — 8:00 AM</li>
          <li>Sunday Worship — 9:00 AM</li>
          <li>Wednesday Bible Study — 6:00 PM</li>
        </ul>
      </div>
      <div>
        <h4>Contact</h4>
        <ul>
          <li>Juba, South Sudan</li>
          <li>info@pcss-church.org</li>
          <li>+211 000 000 000</li>
        </ul>
      </div>
    </div>
    <div class="footer-bottom">
      <p>&copy; 2026 Presbyterian Church of South Sudan. All rights reserved.</p>
    </div>
  </div>
</footer>

<script>
const FASTAPI_BASE_URL = "https://your-fastapi-domain.com";

// Contact Form Handler
document.getElementById('contactForm').addEventListener('submit', function(e) {
  e.preventDefault();
  const statusDiv = document.getElementById('contactStatus');
  statusDiv.style.color = '#c69a3b';
  statusDiv.textContent = 'Sending message...';

  const payload = {
    name: document.getElementById('name').value,
    email: document.getElementById('email').value,
    message: document.getElementById('message').value
  };

  fetch(`${FASTAPI_BASE_URL}/api/contact`, {
    method: 'POST',
    headers: { 'Content-Type': 'application/json' },
    body: JSON.stringify(payload)
  })
  .then(res => {
    if (res.ok) {
      statusDiv.style.color = '#4caf50';
      statusDiv.textContent = 'Thank you! Your message has been sent.';
      document.getElementById('contactForm').reset();
    } else {
      throw new Error('Failed to send');
    }
  })
  .catch(err => {
    statusDiv.style.color = '#ff4d4d';
    statusDiv.textContent = 'Error sending message. Please try again.';
  });
});

// Daily Bible Sidebar Script
document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('verseSidebar');
    const openSidebarBtn = document.getElementById('openSidebarBtn');
    const closeSidebarBtn = document.getElementById('closeSidebarBtn');
    const scrollContainer = document.getElementById('verseScrollContainer');
    const modal = document.getElementById('verseModal');
    const closeModalBtn = document.getElementById('closeModalBtn');
    const modalText = document.getElementById('modalVerseText');
    const modalRef = document.getElementById('modalVerseReference');

    openSidebarBtn.addEventListener('click', () => sidebar.classList.add('open'));
    closeSidebarBtn.addEventListener('click', () => sidebar.classList.remove('open'));

    fetch(`${FASTAPI_BASE_URL}/api/verses`)
        .then(response => response.json())
        .then(data => {
            if (data.error || data.length === 0) {
                scrollContainer.innerHTML = '<p style="color: #b3b3b3; text-align: center; padding-top: 20px;">No verses uploaded yet.</p>';
                return;
            }
            scrollContainer.innerHTML = '';
            data.forEach(item => {
                const card = document.createElement('div');
                card.className = 'sidebar-verse-card';
                card.innerHTML = `
                    <blockquote>&ldquo;${item.verse}&rdquo;</blockquote>
                    <cite>${item.reference}</cite>
                    <button class="expand-verse-btn">📖 Expand View</button>
                `;
                card.querySelector('.expand-verse-btn').addEventListener('click', function() {
                    modalText.textContent = `“${item.verse}”`;
                    modalRef.textContent = item.reference;
                    modal.classList.add('active');
                });
                scrollContainer.appendChild(card);
            });
        })
        .catch(error => {
            scrollContainer.innerHTML = '<p style="color: #ff4d4d; text-align: center; padding-top: 20px;">Unable to load scriptures.</p>';
        });

    closeModalBtn.addEventListener('click', () => modal.classList.remove('active'));
});
</script>

</body>
</html>