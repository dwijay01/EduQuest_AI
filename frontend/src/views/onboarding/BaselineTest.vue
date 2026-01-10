<script setup>
import { ref, computed } from 'vue'
import { useRouter } from 'vue-router'
import { useStudentStore } from '@/stores/student'

const router = useRouter()
const studentStore = useStudentStore()

const currentQuestion = ref(0)
const answers = ref([])
const showFeedback = ref(false)
const feedbackCorrect = ref(false)
const isComplete = ref(false)

const questions = [
  {
    question: 'Berapa jumlah apel ini?',
    visual: '🍎🍎🍎🍎🍎',
    options: ['3', '4', '5', '6'],
    correct: '5',
    explanation: 'Ada 5 buah apel. 1, 2, 3, 4, 5!'
  },
  {
    question: '2 + 3 = ?',
    visual: '🌟🌟 + 🌟🌟🌟',
    options: ['4', '5', '6', '7'],
    correct: '5',
    explanation: '2 bintang ditambah 3 bintang jadi 5!'
  },
  {
    question: 'Pola apa yang hilang?',
    visual: '🔵🔴🔵🔴🔵❓',
    options: ['🔵', '🔴', '🟢', '🟡'],
    correct: '🔴',
    explanation: 'Polanya ganti-ganti, jadi harusnya Merah!'
  }
]

const progress = computed(() => ((currentQuestion.value + 1) / questions.length) * 100)
const currentQ = computed(() => questions[currentQuestion.value])

function selectAnswer(answer) {
  if (showFeedback.value) return
  const isCorrect = answer === currentQ.value.correct
  answers.value.push({ correct: isCorrect })
  feedbackCorrect.value = isCorrect
  showFeedback.value = true
}

function nextQuestion() {
  showFeedback.value = false
  if (currentQuestion.value < questions.length - 1) {
    currentQuestion.value++
  } else {
    isComplete.value = true
    if (studentStore.currentStudent) {
      studentStore.currentStudent.baselineScore = (answers.value.filter(a => a.correct).length / questions.length) * 100
    }
  }
}

function goToDashboard() {
  router.push('/student')
}
</script>

<template>
  <div class="baseline-page">
    <div class="game-card card-glass anim-fade-up">
      <!-- Header -->
      <div v-if="!isComplete" class="header">
        <div class="progress-track">
          <div class="progress-fill" :style="{ width: progress + '%' }"></div>
        </div>
        <div class="text-right mt-2 text-sm text-muted">Soal {{ currentQuestion + 1 }}/{{ questions.length }}</div>
      </div>

      <!-- Question -->
      <div v-if="!isComplete" class="question-area">
        <div class="mascot-dialog">
          <div class="mascot text-6xl anim-float">🤖</div>
          <div class="bubble card-glass">
            <template v-if="!showFeedback">
              <h3>{{ currentQ.question }}</h3>
            </template>
            <template v-else>
              <h3 :class="feedbackCorrect ? 'text-success' : 'text-warning'">
                {{ feedbackCorrect ? 'Benar! 🎉' : 'Ups...' }}
              </h3>
              <p>{{ currentQ.explanation }}</p>
            </template>
          </div>
        </div>

        <div class="visual-display card-glass">
          {{ currentQ.visual }}
        </div>

        <div class="options-grid">
          <button 
            v-for="(opt, idx) in currentQ.options" 
            :key="idx"
            class="opt-btn btn btn-glass"
            :class="{ 
              'correct': showFeedback && opt === currentQ.correct,
              'wrong': showFeedback && opt !== currentQ.correct && !feedbackCorrect,
              'disabled': showFeedback
            }"
            @click="selectAnswer(opt)"
          >
            {{ opt }}
          </button>
        </div>

        <button v-if="showFeedback" @click="nextQuestion" class="btn btn-primary w-full mt-4 next-btn anim-fade-up">
          {{ currentQuestion < questions.length - 1 ? 'Lanjut →' : 'Lihat Hasil 🏆' }}
        </button>
      </div>

      <!-- Result -->
      <div v-else class="result-area text-center">
        <div class="mascot-xl">🎊</div>
        <h1>Hebat!</h1>
        <p class="text-muted mb-6">Kamu sudah menyelesaikan tes.</p>
        
        <div class="score-card card-glass mb-6">
          <div class="score-val">{{ answers.filter(a=>a.correct).length }} / {{ questions.length }}</div>
          <div class="score-label">Jawaban Benar</div>
          <div class="stars mt-2">⭐⭐⭐</div>
        </div>

        <button @click="goToDashboard" class="btn btn-primary w-full">Mulai Petualangan 🚀</button>
      </div>
    </div>
  </div>
</template>

<style scoped>
.baseline-page {
  min-height: 100vh;
  display: flex;
  align-items: center;
  justify-content: center;
  background: radial-gradient(circle, rgba(99,102,241,0.2) 0%, var(--bg-deep) 70%);
  padding: 1rem;
}

.game-card {
  width: 100%;
  max-width: 600px;
  min-height: 600px;
  display: flex;
  flex-direction: column;
}

.header { margin-bottom: 2rem; }
.progress-track { height: 8px; background: rgba(255,255,255,0.1); border-radius: 4px; overflow: hidden; }
.progress-fill { height: 100%; background: var(--grad-primary); transition: width 0.5s ease; }
.text-right { text-align: right; }
.text-sm { font-size: 0.875rem; }
.text-muted { color: #94a3b8; }
.mt-2 { margin-top: 0.5rem; }
.mb-6 { margin-bottom: 1.5rem; }

.question-area { flex: 1; display: flex; flex-direction: column; }

.mascot-dialog { display: flex; gap: 1.5rem; margin-bottom: 2rem; align-items: flex-start; }
.mascot { font-size: 4rem;filter: drop-shadow(0 0 10px rgba(99,102,241,0.5)); }
.bubble { flex: 1; padding: 1.5rem; position: relative; border-color: rgba(99,102,241,0.3); }
.bubble::before {
  content: ''; position: absolute; left: -10px; top: 20px;
  border-width: 10px 10px 10px 0;
  border-style: solid;
  border-color: transparent rgba(255,255,255,0.1) transparent transparent;
}

.text-success { color: #4ade80; }
.text-warning { color: #facc15; }

.visual-display {
  font-size: 3rem;
  text-align: center;
  padding: 2rem;
  margin-bottom: 2rem;
  letter-spacing: 0.5rem;
  background: rgba(0,0,0,0.2);
}

.options-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; margin-bottom: 1rem; }
.opt-btn { font-size: 1.5rem; padding: 1.5rem; transition: 0.3s; }
.opt-btn:hover:not(.disabled) { background: rgba(255,255,255,0.1); border-color: white; }
.opt-btn.correct { background: rgba(34, 197, 94, 0.2); border-color: #22c55e; color: #4ade80; }
.opt-btn.wrong { background: rgba(239, 68, 68, 0.2); border-color: #ef4444; opacity: 0.5; }
.opt-btn.disabled { cursor: not-allowed; }

.score-card { text-align: center; padding: 2rem; }
.score-val { font-size: 3rem; font-weight: 800; color: white; }
.mascot-xl { font-size: 6rem; margin-bottom: 1rem; animation: pulse 2s infinite; }

@media (max-width: 480px) {
  .options-grid { grid-template-columns: 1fr; }
  .mascot-dialog { flex-direction: column; align-items: center; text-align: center; }
  .bubble::before { display: none; }
}
</style>
