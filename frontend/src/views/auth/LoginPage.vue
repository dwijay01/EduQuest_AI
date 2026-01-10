<script setup>
import { ref } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()
const email = ref('')
const password = ref('')

function handleLogin() {
  authStore.setAuth({ id: 1, name: 'User' }, 'token', 'parent')
  router.push('/parent')
}
</script>

<template>
  <div class="auth-layout">
    <div class="auth-card card-glass anim-fade-up">
      <div class="auth-header">
        <RouterLink to="/" class="back-link">← Home</RouterLink>
        <span class="emoji-header">👋</span>
        <h2>Selamat Datang!</h2>
        <p>Lanjutkan petualangan belajar putra-putri Anda.</p>
      </div>

      <form @submit.prevent="handleLogin" class="auth-form">
        <div class="form-group">
          <label>Email</label>
          <input v-model="email" type="email" class="input-neon" placeholder="bunda@contoh.com">
        </div>
        <div class="form-group">
          <label>Password</label>
          <input v-model="password" type="password" class="input-neon" placeholder="••••••••">
        </div>
        
        <button type="submit" class="btn btn-primary w-full">Masuk Sekarang</button>
      </form>
      
      <p class="auth-footer">
        Belum punya akun? <RouterLink to="/register" class="text-grad">Daftar Gratis</RouterLink>
      </p>
    </div>
  </div>
</template>

<style scoped>
.auth-layout {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: radial-gradient(circle, rgba(99,102,241,0.15) 0%, transparent 70%);
  padding: 1rem;
}

.auth-card {
  width: 100%;
  max-width: 420px;
  padding: 2.5rem;
  text-align: center;
}

.auth-header { margin-bottom: 2rem; }
.emoji-header { font-size: 3rem; display: block; margin-bottom: 0.5rem; animation: wave 2s infinite; }
.back-link { display: inline-block; color: var(--c-secondary); font-size: 0.9rem; margin-bottom: 1.5rem; text-decoration: none; }
.auth-header h2 { margin-bottom: 0.5rem; }
.auth-header p { color: #94a3b8; font-size: 0.95rem; }

.auth-form { display: flex; flex-direction: column; gap: 1.5rem; text-align: left; }
.form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #cbd5e1; font-size: 0.9rem; }

.auth-footer { margin-top: 2rem; color: #94a3b8; font-size: 0.9rem; }
.auth-footer a { font-weight: 700; text-decoration: none; }

@keyframes wave { 0%, 100% { transform: rotate(0deg); } 25% { transform: rotate(-10deg); } 75% { transform: rotate(10deg); } }
</style>
