<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <div class="explore-page">
    <header class="explore-header">
      <RouterLink to="/student" class="back-btn">← Kembali</RouterLink>
      <h1>🗺️ Peta Belajar</h1>
      <p>Pilih mata pelajaran untuk mulai petualangan!</p>
    </header>

    <main class="explore-content container">
      <div class="subject-grid">
        <div class="subject-card" v-for="subject in subjects" :key="subject.slug">
          <span class="subject-icon">{{ subject.icon }}</span>
          <h3>{{ subject.name }}</h3>
          <p>{{ subject.description }}</p>
          <span class="badge-coming">Segera Hadir</span>
        </div>
      </div>
    </main>
  </div>
</template>

<script>
export default {
  data() {
    return {
      subjects: [
        { slug: 'matematika', name: 'Matematika', icon: '🔢', description: 'Berhitung, geometri, dan logika' },
        { slug: 'bahasa-indonesia', name: 'Bahasa Indonesia', icon: '📖', description: 'Membaca, menulis, dan berbahasa' },
        { slug: 'ipa', name: 'IPA', icon: '🔬', description: 'Alam semesta dan sains' },
        { slug: 'ips', name: 'IPS', icon: '🌍', description: 'Masyarakat dan budaya' },
        { slug: 'pkn', name: 'PKN', icon: '🇮🇩', description: 'Pancasila dan kewarganegaraan' },
        { slug: 'bahasa-inggris', name: 'Bahasa Inggris', icon: '🌐', description: 'Let\'s learn English!' },
      ]
    }
  }
}
</script>

<style scoped>
.explore-page {
  min-height: 100vh;
  padding-bottom: 2rem;
}

.explore-header {
  padding: 2rem;
  text-align: center;
  background: rgba(15, 23, 42, 0.8);
  backdrop-filter: blur(10px);
  border-bottom: 1px solid rgba(255,255,255,0.1);
}

.explore-header h1 { margin: 0.5rem 0; }
.explore-header p { color: #94a3b8; }

.back-btn {
  display: inline-block;
  color: #22d3ee;
  text-decoration: none;
  font-weight: 700;
  margin-bottom: 0.5rem;
}

.explore-content { padding-top: 2rem; }

.subject-grid {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
  gap: 1.5rem;
}

.subject-card {
  background: rgba(30, 41, 59, 0.5);
  border: 1px solid rgba(255,255,255,0.1);
  border-radius: 1.2rem;
  padding: 2rem;
  text-align: center;
  transition: all 0.3s ease;
  cursor: pointer;
}

.subject-card:hover {
  transform: translateY(-5px);
  border-color: rgba(99, 102, 241, 0.5);
  box-shadow: 0 10px 30px rgba(99, 102, 241, 0.2);
}

.subject-icon { font-size: 3rem; display: block; margin-bottom: 1rem; }
.subject-card h3 { margin-bottom: 0.5rem; }
.subject-card p { color: #94a3b8; font-size: 0.9rem; }

.badge-coming {
  display: inline-block;
  margin-top: 1rem;
  background: rgba(251, 191, 36, 0.2);
  color: #fbbf24;
  padding: 4px 12px;
  border-radius: 12px;
  font-size: 0.75rem;
  font-weight: 700;
}
</style>
