<script setup>
import { RouterLink } from 'vue-router'
import { useStudentStore } from '@/stores/student'

const studentStore = useStudentStore()
</script>

<template>
  <div class="profile-page">
    <header class="profile-header">
      <RouterLink to="/student" class="back-btn">← Kembali</RouterLink>
      <div class="profile-avatar">
        <span class="avatar-emoji">👨‍🚀</span>
      </div>
      <h1>{{ studentStore.studentName }}</h1>
      <span class="badge-level">Lvl {{ studentStore.level }} Explorer</span>
    </header>

    <main class="profile-content container">
      <div class="stats-grid">
        <div class="stat-card">
          <span class="stat-icon">⭐</span>
          <span class="stat-value">{{ studentStore.stars }}</span>
          <span class="stat-label">Total Stars</span>
        </div>
        <div class="stat-card">
          <span class="stat-icon">🎯</span>
          <span class="stat-value">{{ studentStore.level }}</span>
          <span class="stat-label">Level</span>
        </div>
        <div class="stat-card">
          <span class="stat-icon">📚</span>
          <span class="stat-value">0</span>
          <span class="stat-label">Topik Selesai</span>
        </div>
        <div class="stat-card">
          <span class="stat-icon">🔥</span>
          <span class="stat-value">0</span>
          <span class="stat-label">Hari Streak</span>
        </div>
      </div>

      <section class="backpack-section">
        <h2>🎒 Backpack</h2>
        <p class="empty-state">Belum ada item. Selesaikan misi untuk mendapatkan hadiah!</p>
      </section>
    </main>
  </div>
</template>

<style scoped>
.profile-page {
  min-height: 100vh;
  padding-bottom: 2rem;
}

.profile-header {
  padding: 2rem;
  text-align: center;
  background: rgba(15, 23, 42, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.back-btn {
  display: inline-block;
  color: #22d3ee;
  text-decoration: none;
  font-weight: 700;
  margin-bottom: 1rem;
}

.profile-avatar {
  width: 100px;
  height: 100px;
  border-radius: 50%;
  background: rgba(99, 102, 241, 0.2);
  border: 3px solid #6366f1;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 3rem;
  margin: 0 auto 1rem;
  box-shadow: 0 0 20px rgba(99, 102, 241, 0.3);
}

.badge-level {
  display: inline-block;
  font-size: 0.8rem;
  background: #fbbf24;
  color: black;
  padding: 4px 12px;
  border-radius: 8px;
  font-weight: 800;
  text-transform: uppercase;
  margin-top: 0.5rem;
}

.profile-content { padding-top: 2rem; }

.stats-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
  gap: 1rem;
  margin-bottom: 2rem;
}

.stat-card {
  background: rgba(30, 41, 59, 0.5);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 1rem;
  padding: 1.5rem;
  text-align: center;
  display: flex;
  flex-direction: column;
  gap: 0.5rem;
}

.stat-icon { font-size: 2rem; }
.stat-value { font-size: 1.5rem; font-weight: 800; color: white; }
.stat-label { font-size: 0.8rem; color: #94a3b8; }

.backpack-section {
  background: rgba(30, 41, 59, 0.3);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 1rem;
  padding: 2rem;
}

.backpack-section h2 { margin-bottom: 1rem; }

.empty-state {
  color: #64748b;
  text-align: center;
  padding: 2rem;
  font-style: italic;
}
</style>
