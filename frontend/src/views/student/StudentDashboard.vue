<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useStudentStore } from '@/stores/student'

const router = useRouter()
const studentStore = useStudentStore()

const topics = [
  { id: 'math', name: 'Math Magic', icon: '🧮', color: 'var(--c-primary)', progress: 65, level: 5 },
  { id: 'science', name: 'Science Quest', icon: '🔬', color: 'var(--c-secondary)', progress: 40, level: 3 },
  { id: 'language', name: 'Language Lagoon', icon: '📚', color: 'var(--c-accent)', progress: 50, level: 4 }
]

function startLearning(id) {
  router.push(`/learn/${id}`)
}
</script>

<template>
  <div class="dashboard-hud">
    <!-- Top HUD Bar -->
    <header class="hud-top">
      <div class="hud-profile flex items-center gap-md">
        <div class="avatar-frame">
          <div class="avatar-glow"></div>
          <span class="avatar-emoji">👨‍🚀</span>
        </div>
        <div class="profile-info">
          <h3>{{ studentStore.studentName }}</h3>
          <span class="badge-level">Lvl {{ studentStore.level }} Explorer</span>
        </div>
      </div>

      <div class="xp-container">
        <div class="xp-label flex justify-between">
          <span>XP Progress</span>
          <span>1250 / 2000</span>
        </div>
        <div class="xp-bar-bg">
          <div class="xp-bar-fill" style="width: 65%">
            <div class="xp-glint"></div>
          </div>
        </div>
      </div>

      <div class="currency-container flex items-center gap-sm">
        <span class="star-icon">⭐</span>
        <span class="star-count">{{ studentStore.stars }}</span>
      </div>
    </header>

    <!-- Main Mission Control -->
    <main class="hud-main container">
      <div class="section-title anim-fade-up">
        <h2>Misi Hari Ini 🚀</h2>
        <p>Selesaikan 2 misi lagi untuk buka peti harta karun!</p>
      </div>

      <div class="topics-grid grid-3">
        <div 
          v-for="(topic, i) in topics" 
          :key="topic.id" 
          class="holo-card anim-float" 
          :style="{ animationDelay: `${i * 0.2}s`, '--card-color': topic.color }"
          @click="startLearning(topic.id)"
        >
          <div class="holo-content">
            <div class="topic-icon-frame">
              <span class="topic-icon">{{ topic.icon }}</span>
            </div>
            <h3>{{ topic.name }}</h3>
            <div class="topic-stats">
              <span>Level {{ topic.level }}</span>
              <span>{{ topic.progress }}%</span>
            </div>
            <div class="mini-progress">
              <div class="mini-bar" :style="{ width: topic.progress + '%', background: topic.color }"></div>
            </div>
            <div class="holo-scanline"></div>
          </div>
          <button class="btn-play">MAIN ▶</button>
        </div>
      </div>

      <!-- Recent Achievements -->
      <div class="achievements-scroller anim-fade-up" style="animation-delay: 0.5s">
        <h3>Piala Kamu 🏆</h3>
        <div class="flex gap-md">
          <div class="badge-item card-glass"><span class="badge-icon">🔥</span><span class="badge-name">5 Day Streak</span></div>
          <div class="badge-item card-glass"><span class="badge-icon">⚡</span><span class="badge-name">Speedster</span></div>
          <div class="badge-item card-glass"><span class="badge-icon">🧠</span><span class="badge-name">Math Whiz</span></div>
        </div>
      </div>
    </main>
    
    <!-- Bottom Nav -->
    <nav class="hud-nav glass-nav">
      <RouterLink to="/student" class="nav-item active"><span class="icon">🏘️</span>Home</RouterLink>
      <RouterLink to="/learn" class="nav-item"><span class="icon">🗺️</span>Map</RouterLink>
      <RouterLink to="/profile" class="nav-item"><span class="icon">🎒</span>Backpack</RouterLink>
    </nav>
  </div>
</template>

<style scoped>
.dashboard-hud {
  min-height: 100vh;
  padding-bottom: 100px;
  background: 
    radial-gradient(circle at 10% 10%, rgba(6,182,212,0.1) 0%, transparent 40%),
    radial-gradient(circle at 90% 90%, rgba(236,72,153,0.1) 0%, transparent 40%);
}

/* HUD Top */
.hud-top {
  display: grid;
  grid-template-columns: auto 1fr auto;
  gap: 2rem;
  align-items: center;
  padding: 1rem 2rem;
  background: rgba(15, 23, 42, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid var(--border-glass);
  position: sticky;
  top: 0;
  z-index: 50;
}

.avatar-frame {
  position: relative;
  width: 60px;
  height: 60px;
  border-radius: 50%;
  background: var(--bg-surface);
  border: 2px solid var(--c-primary);
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 2rem;
}

.avatar-glow {
  position: absolute;
  inset: -4px;
  border-radius: 50%;
  background: var(--c-primary);
  opacity: 0.4;
  filter: blur(8px);
  animation: pulse-glow 2s infinite;
}

.badge-level {
  font-size: 0.8rem;
  background: var(--c-warning);
  color: black;
  padding: 2px 8px;
  border-radius: 4px;
  font-weight: 800;
  text-transform: uppercase;
}

/* XP Bar */
.xp-container {
  max-width: 400px;
  width: 100%;
}
.xp-label { font-size: 0.8rem; margin-bottom: 4px; color: #94a3b8; font-weight: 700; }
.xp-bar-bg {
  height: 12px;
  background: rgba(255,255,255,0.1);
  border-radius: 6px;
  overflow: hidden;
  border: 1px solid rgba(255,255,255,0.1);
}
.xp-bar-fill {
  height: 100%;
  background: linear-gradient(90deg, #6366f1, #22d3ee);
  border-radius: 6px;
  position: relative;
  box-shadow: 0 0 10px rgba(34, 211, 238, 0.5);
}

/* Currency */
.star-icon { font-size: 1.5rem; animation: float 2s infinite; filter: drop-shadow(0 0 5px gold); }
.star-count { font-size: 1.5rem; font-weight: 800; color: #facc15; }

/* Main Content */
.hud-main { padding-top: 2rem; }
.section-title { margin-bottom: 2rem; }
.section-title p { color: #94a3b8; }

/* Holo Cards */
.holo-card {
  background: rgba(30, 41, 59, 0.4);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 1.5rem;
  padding: 1.5rem;
  position: relative;
  overflow: hidden;
  cursor: pointer;
  transition: all 0.3s ease;
  backdrop-filter: blur(5px);
}

.holo-card:hover {
  transform: translateY(-10px) scale(1.02);
  border-color: var(--card-color);
  box-shadow: 0 0 30px var(--card-color);
  background: rgba(30, 41, 59, 0.7);
}

.topic-icon-frame {
  width: 80px;
  height: 80px;
  background: radial-gradient(circle, rgba(255,255,255,0.1), transparent);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  margin-bottom: 1rem;
  border: 1px solid rgba(255,255,255,0.1);
}

.topic-stats {
  display: flex;
  justify-content: space-between;
  font-size: 0.9rem;
  color: #94a3b8;
  margin: 1rem 0 0.5rem;
}

.mini-progress {
  height: 6px;
  background: rgba(255,255,255,0.1);
  border-radius: 3px;
  overflow: hidden;
}

.holo-scanline {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(to bottom, transparent, rgba(255,255,255,0.05), transparent);
  transform: translateY(-100%);
  animation: scanline 3s linear infinite;
  pointer-events: none;
}

@keyframes scanline {
  0% { transform: translateY(-100%); }
  100% { transform: translateY(100%); }
}

.btn-play {
  margin-top: 1.5rem;
  width: 100%;
  padding: 0.8rem;
  background: var(--card-color);
  border: none;
  border-radius: 0.8rem;
  font-weight: 800;
  color: rgba(0,0,0,0.8);
  font-family: var(--font-display);
  cursor: pointer;
  opacity: 0;
  transform: translateY(10px);
  transition: all 0.3s ease;
}

.holo-card:hover .btn-play {
  opacity: 1;
  transform: translateY(0);
}

/* Achievements */
.achievements-scroller { margin-top: 3rem; }
.badge-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 1rem;
  gap: 0.5rem;
  min-width: 120px;
}
.badge-icon { font-size: 2rem; }
.badge-name { font-size: 0.8rem; font-weight: 700; color: #cbd5e1; }

/* Bottom Nav */
.hud-nav {
  position: fixed;
  bottom: 1rem;
  left: 50%;
  transform: translateX(-50%);
  background: rgba(3, 7, 18, 0.8);
  backdrop-filter: blur(20px);
  padding: 0.8rem 2rem;
  border-radius: 2rem;
  border: 1px solid var(--border-highlight);
  display: flex;
  gap: 2rem;
  box-shadow: 0 10px 30px rgba(0,0,0,0.5);
  z-index: 100;
}

.nav-item {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-decoration: none;
  color: #94a3b8;
  font-size: 0.8rem;
  font-weight: 700;
  transition: all 0.3s ease;
}

.nav-item .icon { font-size: 1.5rem; margin-bottom: 2px; transition: transform 0.3s; }
.nav-item:hover, .nav-item.active { color: white; }
.nav-item:hover .icon { transform: translateY(-5px); }
.nav-item.active .icon { text-shadow: 0 0 10px white; }

@media (max-width: 768px) {
  .hud-top { grid-template-columns: auto 1fr; gap: 1rem; padding: 1rem; }
  .xp-container { display: none; } /* Hide XP on small mobile header, maybe move elsewhere */
  .grid-3 { grid-template-columns: 1fr; }
}
</style>
