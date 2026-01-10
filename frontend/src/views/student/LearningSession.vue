<script setup>
import { ref, computed } from 'vue'

// Mock Data
const question = ref({
  text: 'Steve ingin membuat pedang diamond! Dia butuh 2 diamond dan 1 stick. Jika Steve punya 10 diamond, berapa pedang yang bisa dibuat? ⚔️',
  options: ['3', '4', '5', '6'],
  correct: '5',
  bgImage: 'url("https://assets.codepen.io/2585/minecraft-bg.jpg")' // Placeholder valid URL or local asset
})

const selected = ref(null)
const showResult = ref(false)

function checkAnswer(opt) {
  selected.value = opt
  showResult.value = true
}
</script>

<template>
  <div class="session-layout">
    <div class="story-bg"></div>
    <div class="story-overlay"></div>
    
    <div class="session-container container">
      <!-- Story Card -->
      <div class="story-card card-glass anim-fade-up">
        <div class="story-header text-grad">
          <h1>Misi Minecraft: Blacksmith</h1>
        </div>
        
        <div class="question-box">
          <div class="mascot-avatar anim-float">🤖</div>
          <p class="question-text">{{ question.text }}</p>
        </div>

        <div class="options-grid">
          <button 
            v-for="opt in question.options" 
            :key="opt"
            class="opt-btn btn-glass"
            :class="{ 
              'correct': showResult && opt === question.correct,
              'wrong': showResult && opt === selected && selected !== question.correct
            }"
            @click="!showResult && checkAnswer(opt)"
          >
            {{ opt }}
          </button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.session-layout {
  min-height: 100vh;
  position: relative;
  display: flex;
  align-items: center;
  justify-content: center;
}

.story-bg {
  position: absolute;
  inset: 0;
  background-image: var(--bg-image, url('https://placehold.co/1920x1080/1e293b/FFF?text=Minecraft+Block+Texture')); /* Placeholder */
  background-size: cover;
  opacity: 0.3;
}

.session-container {
  position: relative;
  z-index: 10;
  width: 100%;
  max-width: 800px;
}

.story-card {
  padding: 3rem;
  text-align: center;
  border: 1px solid rgba(255,255,255,0.2);
  box-shadow: 0 20px 50px rgba(0,0,0,0.5);
}

.question-box {
  margin: 2rem 0 3rem;
  position: relative;
}

.mascot-avatar {
  font-size: 5rem;
  margin-bottom: 1rem;
}

.question-text {
  font-size: 1.5rem;
  font-weight: 600;
  line-height: 1.4;
}

.options-grid {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 1.5rem;
}

.opt-btn {
  font-size: 1.5rem;
  padding: 1.5rem;
  transition: all 0.3s;
}

.opt-btn.correct { background: var(--c-success); border-color: var(--c-success); box-shadow: 0 0 20px var(--c-success); }
.opt-btn.wrong { background: var(--c-error); border-color: var(--c-error); animation: shake 0.5s; }

@keyframes shake {
  0%, 100% { transform: translateX(0); }
  25% { transform: translateX(-10px); }
  75% { transform: translateX(10px); }
}

@media (max-width: 768px) {
  .options-grid { grid-template-columns: 1fr; }
  .story-card { padding: 1.5rem; }
}
</style>
