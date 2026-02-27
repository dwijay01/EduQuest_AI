<script setup>
import { ref } from 'vue'
import { RouterLink, useRouter } from 'vue-router'
import { useAuthStore } from '@/stores/auth'

const router = useRouter()
const authStore = useAuthStore()
const step = ref(1)

const formData = ref({ name: '', email: '', phone: '', password: '' })

async function handleRegister() {
  try {
    await authStore.register({
      name: formData.value.name,
      email: formData.value.email,
      phone: formData.value.phone,
      password: formData.value.password,
    })
    router.push('/onboarding')
  } catch (err) {
    // Error is handled in store
    if (authStore.error && authStore.error.includes('email')) {
      step.value = 1 // go back to email step
    }
  }
}
</script>

<template>
  <div class="auth-layout">
    <div class="auth-card card-glass anim-fade-up">
      <div class="auth-header">
        <RouterLink to="/" class="back-link">← Home</RouterLink>
        <div class="step-indicator">
           <div class="step-dot" :class="{ active: step >= 1 }">1</div>
           <div class="step-line" :class="{ active: step >= 2 }"></div>
           <div class="step-dot" :class="{ active: step >= 2 }">2</div>
        </div>
        <h2>{{ step === 1 ? 'Buat Akun' : 'Detail Akun' }}</h2>
        <p>Mulai perjalanan belajar anak Anda.</p>
      </div>

      <div v-if="authStore.error" class="error-msg">{{ authStore.error }}</div>

      <form @submit.prevent="step === 1 ? step++ : handleRegister()" class="auth-form">
        <div v-if="step === 1" class="step-group anim-fade-up">
          <div class="form-group mb-4">
            <label>Nama Lengkap</label>
            <input v-model="formData.name" class="input-neon" placeholder="Nama Anda" required>
          </div>
          <div class="form-group mb-4">
            <label>Email</label>
            <input v-model="formData.email" type="email" class="input-neon" placeholder="email@contoh.com" required>
          </div>
          <button type="submit" class="btn btn-primary w-full">Lanjut Step 2 →</button>
        </div>

        <div v-else class="step-group anim-fade-up">
          <div class="form-group mb-4">
            <label>WhatsApp (Laporan)</label>
            <input v-model="formData.phone" type="tel" class="input-neon" placeholder="0812..." required>
          </div>
          <div class="form-group mb-4">
            <label>Password</label>
            <input v-model="formData.password" type="password" class="input-neon" placeholder="••••••••" minlength="6" required>
          </div>
          <div class="flex gap-md">
            <button type="button" @click="step--" class="btn btn-glass" style="flex:1">←</button>
            <button type="submit" class="btn btn-primary" :disabled="authStore.loading" style="flex:2">
              {{ authStore.loading ? 'Memproses...' : 'Selesai ✨' }}
            </button>
          </div>
        </div>
      </form>
      
      <p class="auth-footer">
        Sudah punya akun? <RouterLink to="/login" class="text-grad">Login</RouterLink>
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
  background: radial-gradient(circle at bottom, rgba(236,72,153,0.15) 0%, transparent 70%);
  padding: 1rem;
}

.auth-card {
  width: 100%;
  max-width: 420px;
  padding: 2.5rem;
  text-align: center;
}

.auth-header { margin-bottom: 2rem; }
.back-link { display: inline-block; color: var(--c-secondary); font-size: 0.9rem; margin-bottom: 1.5rem; text-decoration: none; }

.step-indicator {
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 1rem;
  margin-bottom: 1.5rem;
}
.step-dot {
  width: 30px; height: 30px;
  border-radius: 50%;
  background: rgba(255,255,255,0.1);
  display: flex; align-items: center; justify-content: center;
  font-weight: 700;
  font-size: 0.9rem;
  transition: 0.3s;
}
.step-dot.active { background: var(--c-primary); box-shadow: 0 0 10px var(--c-primary); }
.step-line { width: 40px; height: 2px; background: rgba(255,255,255,0.1); }
.step-line.active { background: var(--c-primary); }

.auth-form { text-align: left; }
.form-group label { display: block; margin-bottom: 0.5rem; font-weight: 600; color: #cbd5e1; font-size: 0.9rem; }
.mb-4 { margin-bottom: 1.25rem; }

.auth-footer { margin-top: 2rem; color: #94a3b8; font-size: 0.9rem; }
.auth-footer a { font-weight: 700; text-decoration: none; }

.error-msg { background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 0.8rem; border-radius: 0.5rem; margin-bottom: 1rem; font-size: 0.9rem; }

button:disabled { opacity: 0.6; cursor: not-allowed; }
</style>
