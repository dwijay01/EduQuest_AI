<script setup>
import { ref } from 'vue'
import { useRouter } from 'vue-router'
import { useStudentStore } from '@/stores/student'

const router = useRouter()
const studentStore = useStudentStore()

const step = ref(1)
const totalSteps = 4

const childData = ref({ name: '', age: '', grade: '' })

const availableInterests = [
  { id: 'minecraft', icon: '🎮', label: 'Minecraft' },
  { id: 'football', icon: '⚽', label: 'Sepak Bola' },
  { id: 'dinosaurs', icon: '🦖', label: 'Dinosaurus' },
  { id: 'space', icon: '🚀', label: 'Luar Angkasa' },
  { id: 'music', icon: '🎵', label: 'Musik' },
  { id: 'art', icon: '🎨', label: 'Seni' },
  { id: 'animals', icon: '🐾', label: 'Hewan' },
  { id: 'cooking', icon: '🍳', label: 'Memasak' },
  { id: 'robots', icon: '🤖', label: 'Robot' },
  { id: 'nature', icon: '🌿', label: 'Alam' }
]

const selectedInterests = ref([])
const error = ref('')

function toggleInterest(id) {
  const index = selectedInterests.value.indexOf(id)
  if (index === -1) {
    if (selectedInterests.value.length < 5) selectedInterests.value.push(id)
  } else {
    selectedInterests.value.splice(index, 1)
  }
}

function isSelected(id) { return selectedInterests.value.includes(id) }

function validateStep() {
  error.value = ''
  if (step.value === 2) {
    if (!childData.value.name) { error.value = 'Mohon isi nama anak'; return false }
    if (!childData.value.age) { error.value = 'Mohon isi umur'; return false }
  }
  if (step.value === 3 && selectedInterests.value.length < 3) {
    error.value = 'Pilih minimal 3 minat'; return false
  }
  return true
}

function nextStep() {
  if (validateStep() && step.value < totalSteps) step.value++
}

function finishOnboarding() {
  router.push('/baseline-test')
}
</script>

<template>
  <div class="onboarding-page">
    <div class="onboarding-card card-glass anim-fade-up">
      <!-- Header -->
      <div class="header">
        <div class="step-counter">Step {{ step }} / {{ totalSteps }}</div>
        <div class="progress-track">
          <div class="progress-fill" :style="{ width: `${(step/totalSteps)*100}%` }"></div>
        </div>
      </div>
      
      <!-- Content -->
      <div class="step-content">
        <!-- Step 1: Welcome -->
        <div v-if="step === 1" class="text-center">
          <div class="mascot-lg anim-float">🎉</div>
          <h2>Selamat Datang!</h2>
          <p class="desc">Siapkan akun anak hanya dalam 2 menit.</p>
          <div class="features-list">
            <div class="feat-item card-glass"><span class="icon">📝</span> Profil</div>
            <div class="feat-item card-glass"><span class="icon">🎯</span> Minat</div>
            <div class="feat-item card-glass"><span class="icon">📊</span> Tes Awal</div>
          </div>
        </div>
        
        <!-- Step 2: Form -->
        <div v-if="step === 2">
          <h2 class="text-center">Tentang Anak</h2>
          <p class="desc text-center mb-6">Siapa nama jagoan kecil Ayah/Bunda?</p>
          
          <div class="form-grid">
            <div class="form-group">
              <label>Nama Panggilan</label>
              <input v-model="childData.name" class="input-neon" placeholder="Contoh: Budi">
            </div>
            <div class="grid-2">
              <div class="form-group">
                <label>Umur</label>
                <input v-model="childData.age" type="number" class="input-neon" placeholder="7">
              </div>
              <div class="form-group">
                <label>Kelas</label>
                <select v-model="childData.grade" class="input-neon">
                  <option value="">Pilih</option>
                  <option v-for="i in 6" :key="i" :value="i">Kelas {{ i }}</option>
                </select>
              </div>
            </div>
          </div>
        </div>

        <!-- Step 3: Interests -->
        <div v-if="step === 3">
          <h2 class="text-center">Minat & Hobi</h2>
          <p class="desc text-center mb-6">Pilih minimal 3 hobi yang disukai.</p>
          
          <div class="interests-grid">
            <button 
              v-for="item in availableInterests"
              :key="item.id"
              class="interest-card card-glass"
              :class="{ active: isSelected(item.id) }"
              @click="toggleInterest(item.id)"
            >
              <span class="icon">{{ item.icon }}</span>
              <span class="label">{{ item.label }}</span>
            </button>
          </div>
          <p class="text-center mt-4 text-muted">{{ selectedInterests.length }} / 5 dipilih</p>
        </div>

        <!-- Step 4: Summary -->
        <div v-if="step === 4" class="text-center">
          <div class="mascot-lg anim-float">🚀</div>
          <h2>Siap Meluncur!</h2>
          <p class="desc">Profil {{ childData.name }} sudah lengkap.</p>
          
          <div class="summary-card card-glass">
            <div class="row"><span>Nama</span> <strong>{{ childData.name }}</strong></div>
            <div class="row"><span>Umur</span> <strong>{{ childData.age }} Thn</strong></div>
            <div class="row"><span>Minat</span> <strong>{{ selectedInterests.length }} Topik</strong></div>
          </div>
        </div>

        <!-- Error -->
        <div v-if="error" class="error-msg">{{ error }}</div>
      </div>
      
      <!-- Footer -->
      <div class="footer flex justify-between mt-8">
        <button v-if="step > 1" @click="step--" class="btn btn-glass">Kembali</button>
        <div v-else></div>
        
        <button v-if="step < totalSteps" @click="nextStep" class="btn btn-primary">Lanjut</button>
        <button v-else @click="finishOnboarding" class="btn btn-primary">Mulai Tes ✨</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.onboarding-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  padding: 1rem;
  background: var(--bg-deep);
}

.onboarding-card {
  width: 100%;
  max-width: 600px;
  min-height: 500px;
  display: flex;
  flex-direction: column;
}

.header { margin-bottom: 2rem; }
.step-counter { text-align: right; color: #94a3b8; font-size: 0.8rem; margin-bottom: 0.5rem; }
.progress-track { height: 6px; background: rgba(255,255,255,0.1); border-radius: 3px; overflow: hidden; }
.progress-fill { height: 100%; background: var(--grad-primary); transition: width 0.3s ease; }

.step-content { flex: 1; }
.mascot-lg { font-size: 4rem; margin-bottom: 1rem; }
.desc { color: #94a3b8; margin-bottom: 1.5rem; }
.mb-6 { margin-bottom: 1.5rem; }
.mt-8 { margin-top: 2rem; }

/* Features */
.features-list { display: flex; gap: 1rem; justify-content: center; margin-top: 2rem; }
.feat-item { padding: 1rem; display: flex; flex-direction: column; align-items: center; gap: 0.5rem; min-width: 100px; }
.feat-item .icon { font-size: 1.5rem; }

/* Form */
.form-grid { display: flex; flex-direction: column; gap: 1.5rem; }
.form-group label { display: block; margin-bottom: 0.5rem; color: #cbd5e1; font-weight: 600; }
select.input-neon { appearance: none; color: white; }
select.input-neon option { background: var(--bg-surface); }

/* Interests */
.interests-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
  gap: 1rem;
}
.interest-card {
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 1rem;
  cursor: pointer;
  transition: 0.3s;
  border: 2px solid transparent;
}
.interest-card:hover { transform: translateY(-3px); background: rgba(255,255,255,0.1); }
.interest-card.active { border-color: var(--c-primary); background: rgba(99, 102, 241, 0.2); }
.interest-card .icon { font-size: 2rem; margin-bottom: 0.5rem; }

/* Summary */
.summary-card { padding: 1.5rem; }
.row { display: flex; justify-content: space-between; border-bottom: 1px solid rgba(255,255,255,0.1); padding: 0.8rem 0; }
.row:last-child { border-bottom: none; }

.error-msg { background: rgba(239, 68, 68, 0.2); color: #fca5a5; padding: 0.8rem; border-radius: 0.5rem; margin-top: 1rem; text-align: center; }
.text-muted { color: #64748b; font-size: 0.9rem; }

@media (max-width: 480px) {
  .grid-2 { grid-template-columns: 1fr; }
  .features-list { flex-direction: column; }
}
</style>
