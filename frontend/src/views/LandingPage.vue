<script setup>
import { onMounted, ref } from 'vue'
import { RouterLink } from 'vue-router'

const features = [
  { icon: '🚀', title: 'Personalized Learning', desc: 'Kurikulum menyesuaikan pace belajar anak secara otomatis.' },
  { icon: '🎮', title: 'Game-Based', desc: 'Belajar serasa bermain game dengan poin, level, dan badge.' },
  { icon: '🤖', title: 'AI Mentor', desc: 'Teman belajar pintar yang sabar menjawab semua pertanyaan.' }
]

const heroImage = ref(null)

onMounted(() => {
  document.addEventListener('mousemove', (e) => {
    if (heroImage.value) {
      const x = (window.innerWidth - e.pageX * 2) / 100
      const y = (window.innerHeight - e.pageY * 2) / 100
      heroImage.value.style.transform = `translate(${x}px, ${y}px)`
    }
  })
})
</script>

<template>
  <div class="landing-page">
    <nav class="glass-nav">
      <div class="container flex justify-between items-center" style="height: 100%">
        <div class="logo">
          <span class="logo-emoji">🤖</span>
          <span class="logo-text">EduBridge<span class="text-grad">AI</span></span>
        </div>
        <div class="nav-links">
          <RouterLink to="/login" class="btn btn-glass">Masuk</RouterLink>
          <RouterLink to="/register" class="btn btn-primary">Daftar Sekarang</RouterLink>
        </div>
      </div>
    </nav>

    <header class="hero-section">
      <div class="container grid-2 items-center">
        <div class="hero-content">
          <div class="badge-new anim-fade-up" style="animation-delay: 0.1s">✨ Platform Belajar #1 untuk Anak</div>
          <h1 class="anim-fade-up" style="animation-delay: 0.2s">
            Belajar Jadi <br>
            <span class="text-grad">Petualangan Seru!</span>
          </h1>
          <p class="hero-desc anim-fade-up" style="animation-delay: 0.3s">
            Ubah waktu layar menjadi waktu belajar. Dengan AI yang personal, 
            materi disesuaikan dengan hobi anak—mulai dari Minecraft hingga Dinosaurus!
          </p>
          <div class="hero-actions anim-fade-up" style="animation-delay: 0.4s">
            <RouterLink to="/register" class="btn btn-primary btn-lg">Mulai Cobain Gratis 🚀</RouterLink>
            <a href="#features" class="btn btn-glass btn-lg">Pelajari Fitur</a>
          </div>
          <div class="hero-stats anim-fade-up" style="animation-delay: 0.5s">
            <div class="stat-item">
              <span class="stat-num">10k+</span>
              <span class="stat-label">Siswa Happy</span>
            </div>
            <div class="stat-item">
              <span class="stat-num">500+</span>
              <span class="stat-label">Modul AI</span>
            </div>
            <div class="stat-item">
              <span class="stat-num">4.9/5</span>
              <span class="stat-label">Rating Ortu</span>
            </div>
          </div>
        </div>
        
        <div class="hero-visual" ref="heroImage">
          <div class="visual-circle-bg"></div>
          <div class="visual-card-1 card-glass anim-float" style="animation-delay: 0s">
            <span class="emoji">🦖</span>
            <div class="card-info">
              <h4>Dinosaurus</h4>
              <div class="progress-mini"><div class="bar" style="width: 70%"></div></div>
            </div>
          </div>
          <div class="visual-card-2 card-glass anim-float" style="animation-delay: 2s">
            <span class="emoji">🚀</span>
            <div class="card-info">
              <h4>Astronomi</h4>
              <div class="progress-mini"><div class="bar" style="width: 90%"></div></div>
            </div>
          </div>
          <div class="visual-center">
            <span class="mascot-emoji">🤖</span>
          </div>
        </div>
      </div>
    </header>

    <section id="features" class="features-section">
      <div class="container">
        <div class="section-header text-center">
          <h2>Kenapa <span class="text-grad">EduBridge AI?</span></h2>
          <p>Teknologi canggih yang mengerti keunikan setiap anak.</p>
        </div>
        
        <div class="grid-3">
          <div v-for="(feat, i) in features" :key="i" class="card-glass text-center">
            <div class="feat-icon">{{ feat.icon }}</div>
            <h3>{{ feat.title }}</h3>
            <p>{{ feat.desc }}</p>
          </div>
        </div>
      </div>
    </section>

    <footer class="footer">
      <div class="container text-center">
        <p>© 2026 EduBridge AI. Dibuat dengan ❤️ untuk Masa Depan Indonesia.</p>
      </div>
    </footer>
  </div>
</template>

<style scoped>
.landing-page { overflow-x: hidden; }

/* Nav */
.glass-nav {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 80px;
  background: rgba(3, 7, 18, 0.8);
  backdrop-filter: blur(12px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
  z-index: 1000;
}
.logo { font-size: 1.5rem; font-weight: 800; display: flex; align-items: center; gap: 0.5rem; }
.logo-emoji { animation: float 3s ease-in-out infinite; }
.nav-links { display: flex; gap: 1rem; align-items: center; }

/* Hero */
.hero-section {
  padding-top: 150px;
  padding-bottom: 100px;
  background: radial-gradient(circle at top right, rgba(99,102,241,0.15), transparent 50%),
              radial-gradient(circle at bottom left, rgba(236,72,153,0.15), transparent 50%);
  min-height: 100vh;
}

.badge-new {
  display: inline-block;
  padding: 0.5rem 1rem;
  background: rgba(255,255,255,0.05);
  border-radius: 2rem;
  border: 1px solid rgba(255,255,255,0.1);
  font-size: 0.9rem;
  color: #22d3ee;
  margin-bottom: 1.5rem;
}

.hero-desc {
  font-size: 1.2rem;
  color: #94a3b8;
  margin-bottom: 2.5rem;
  max-width: 500px;
}

.hero-actions {
  display: flex;
  flex-wrap: wrap;
  gap: 1rem;
  margin-bottom: 3rem;
}

.hero-stats {
  display: flex;
  gap: 3rem;
  margin-top: 2rem;
  border-top: 1px solid rgba(255,255,255,0.1);
  padding-top: 2rem;
}
.stat-num { display: block; font-size: 2rem; font-weight: 800; color: white; }
.stat-label { font-size: 0.9rem; color: #64748b; }

/* Visuals */
.hero-visual {
  position: relative;
  height: 500px;
  display: flex;
  align-items: center;
  justify-content: center;
}
.visual-circle-bg {
  position: absolute;
  width: 400px;
  height: 400px;
  background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, transparent 70%);
  border-radius: 50%;
  animation: pulse 4s infinite;
}
.visual-center { font-size: 15rem; z-index: 2; filter: drop-shadow(0 0 50px rgba(99,102,241,0.5)); }

.visual-card-1 { position: absolute; top: 10%; left: 0; width: 220px; display: flex; align-items: center; gap: 1rem; z-index: 3; padding: 1rem; }
.visual-card-2 { position: absolute; bottom: 20%; right: 0; width: 220px; display: flex; align-items: center; gap: 1rem; z-index: 3; padding: 1rem; }
.card-info h4 { font-size: 1rem; margin: 0 0 0.5rem 0; }
.progress-mini { width: 100%; height: 6px; background: rgba(255,255,255,0.1); border-radius: 10px; }
.progress-mini .bar { height: 100%; background: linear-gradient(90deg, #6366f1, #d946ef); border-radius: 10px; }
.emoji { font-size: 2.5rem; }

/* Features */
.features-section { padding: 5rem 0; }
.section-header { margin-bottom: 4rem; }
.feat-icon {
  font-size: 3rem;
  margin: 0 auto 1.5rem;
  background: rgba(255,255,255,0.05);
  width: 80px; height: 80px;
  display: flex; align-items: center; justify-content: center;
  border-radius: 50%;
}
.footer { padding: 3rem 0; border-top: 1px solid rgba(255,255,255,0.1); color: #64748b; margin-top: auto; }

@keyframes float { 0%, 100% { transform: translateY(0); } 50% { transform: translateY(-20px); } }
@keyframes pulse { 0%, 100% { transform: scale(1); opacity: 0.5; } 50% { transform: scale(1.1); opacity: 0.8; } }

@media (max-width: 768px) {
  .hero-section { text-align: center; padding-top: 120px; }
  .nav-links { display: none; } /* Hide layout for mobile for simple fix, can add hamburger later */
  .grid-2 { grid-template-columns: 1fr; }
  .hero-actions { justify-content: center; }
  .hero-visual { display: none; }
  .hero-stats { justify-content: center; }
}
</style>
