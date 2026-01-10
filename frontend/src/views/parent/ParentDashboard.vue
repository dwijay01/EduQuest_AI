<script setup>
import { ref } from 'vue'
import { RouterLink } from 'vue-router'

const weeklyStats = [40, 55, 45, 70, 85, 90, 87]
const days = ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su']

const activities = [
  { text: 'Selesai Quiz Math (100%)', time: '2j lalu', icon: '🎯', color: 'var(--c-success)' },
  { text: 'Login dari Device Baru', time: '1h lalu', icon: '📱', color: 'var(--c-warning)' },
  { text: 'Mulai Modul Sains', time: 'Kemarin', icon: '🔬', color: 'var(--c-secondary)' }
]
</script>

<template>
  <div class="parent-layout">
    <!-- Glass Sidebar -->
    <aside class="sidebar card-glass">
      <div class="logo mb-2">🤖 EduBridge</div>
      <nav class="nav-menu">
        <a href="#" class="nav-link active"><span>📊</span> Dashboard</a>
        <a href="#" class="nav-link"><span>📝</span> Laporan</a>
        <a href="#" class="nav-link"><span>💳</span> Billing</a>
        <a href="#" class="nav-link"><span>⚙️</span> Settings</a>
      </nav>
      <div class="user-mini">
        <div class="avatar">S</div>
        <div class="info">
          <p class="name">Sarah J.</p>
          <p class="role">Super Mom</p>
        </div>
      </div>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <header class="top-bar">
        <h1>Overview Anak</h1>
        <div class="actions flex gap-md">
          <button class="btn-glass p-2">🔔</button>
          <button class="btn-primary">Download Report</button>
        </div>
      </header>

      <div class="stats-grid grid-3">
        <div class="stat-card card-glass">
          <div class="stat-icon" style="background: rgba(99,102,241,0.2); color: var(--c-primary)">📚</div>
          <div class="stat-info">
            <span class="label">Total Belajar</span>
            <span class="value">12.5 Jam</span>
            <span class="trend up">↗ +15%</span>
          </div>
        </div>
        <div class="stat-card card-glass">
          <div class="stat-icon" style="background: rgba(16,185,129,0.2); color: var(--c-success)">⭐</div>
          <div class="stat-info">
            <span class="label">Total Stars</span>
            <span class="value">3,450</span>
            <span class="trend up">↗ +120</span>
          </div>
        </div>
        <div class="stat-card card-glass">
          <div class="stat-icon" style="background: rgba(236,72,153,0.2); color: var(--c-accent)">🎯</div>
          <div class="stat-info">
            <span class="label">Avg Score</span>
            <span class="value">92/100</span>
            <span class="trend stable">➡ Stabil</span>
          </div>
        </div>
      </div>

      <div class="dashboard-split grid-2" style="margin-top: 2rem">
        <!-- Chart Section -->
        <div class="chart-section card-glass">
          <h3>Weekly Activity</h3>
          <div class="bar-chart">
            <div v-for="(val, i) in weeklyStats" :key="i" class="bar-col">
              <div class="bar-track">
                <div class="bar-fill" :style="{ height: val + '%' }"></div>
              </div>
              <span class="bar-label">{{ days[i] }}</span>
            </div>
          </div>
        </div>

        <!-- Recent Activity -->
        <div class="activity-section card-glass">
          <h3>Recent Updates</h3>
          <div class="activity-list">
            <div v-for="(act, i) in activities" :key="i" class="act-item">
              <div class="act-icon" :style="{ background: act.color }">{{ act.icon }}</div>
              <div class="act-text">
                <p>{{ act.text }}</p>
                <span class="act-time">{{ act.time }}</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </main>
  </div>
</template>

<style scoped>
.parent-layout {
  display: grid;
  grid-template-columns: 250px 1fr;
  min-height: 100vh;
  gap: 2rem;
  padding: 2rem;
  background: var(--bg-deep);
}

/* Sidebar */
.sidebar {
  display: flex;
  flex-direction: column;
  height: calc(100vh - 4rem);
  position: sticky;
  top: 2rem;
}

.logo {
  font-size: 1.5rem;
  font-weight: 800;
  margin-bottom: 2rem;
  padding: 0 1rem;
}

.nav-menu { flex: 1; display: flex; flex-direction: column; gap: 0.5rem; }
.nav-link {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  border-radius: 1rem;
  color: #94a3b8;
  text-decoration: none;
  transition: all 0.3s;
}
.nav-link:hover, .nav-link.active {
  background: rgba(99,102,241,0.1);
  color: white;
}
.nav-link span { font-size: 1.2rem; }

.user-mini {
  display: flex;
  align-items: center;
  gap: 1rem;
  padding: 1rem;
  background: rgba(255,255,255,0.05);
  border-radius: 1rem;
  margin-top: auto;
}
.avatar {
  width: 40px; height: 40px;
  background: var(--grad-primary);
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
}
.role { font-size: 0.8rem; color: #94a3b8; }

/* Main */
.top-bar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 2rem;
}

/* Stats */
.stat-card {
  display: flex;
  align-items: center;
  gap: 1.5rem;
  padding: 1.5rem;
}
.stat-icon {
  width: 60px; height: 60px;
  border-radius: 1rem;
  display: flex; align-items: center; justify-content: center;
  font-size: 1.5rem;
}
.stat-info { display: flex; flex-direction: column; }
.label { color: #94a3b8; font-size: 0.9rem; }
.value { font-size: 1.5rem; font-weight: 700; color: white; }
.trend { font-size: 0.8rem; font-weight: 700; margin-top: 4px; }
.trend.up { color: var(--c-success); }

/* Chart */
.bar-chart {
  display: flex;
  justify-content: space-between;
  align-items: flex-end;
  height: 200px;
  margin-top: 1rem;
}
.bar-col {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 0.5rem;
  height: 100%;
  flex: 1;
}
.bar-track {
  flex: 1;
  width: 8px;
  background: rgba(255,255,255,0.05);
  border-radius: 4px;
  display: flex;
  align-items: flex-end;
}
.bar-fill {
  width: 100%;
  background: var(--grad-primary);
  border-radius: 4px;
  transition: height 0.5s ease;
}
.bar-label { font-size: 0.8rem; color: #64748b; }

/* Activity */
.activity-list {
  display: flex;
  flex-direction: column;
  gap: 1.5rem;
  margin-top: 1.5rem;
}
.act-item { display: flex; align-items: center; gap: 1rem; }
.act-icon {
  width: 40px; height: 40px;
  border-radius: 50%;
  display: flex; align-items: center; justify-content: center;
  font-size: 1rem;
  color: rgba(0,0,0,0.5);
}
.act-time { font-size: 0.8rem; color: #64748b; }

@media (max-width: 1024px) {
  .parent-layout { grid-template-columns: 1fr; padding: 1rem; }
  .sidebar { display: none; } /* Show hamburger menu instead in real app */
}
</style>
