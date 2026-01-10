<script setup>
// Subscribe page placeholder
</script>

<template>
  <div class="subscribe-page">
    <div class="container">
      <h1>Subscription Plans</h1>
      <p>Choose the best plan for your family</p>
      
      <div class="plans-grid">
        <div class="plan-card card">
          <h3>Basic</h3>
          <div class="price">Free</div>
          <ul>
            <li>✓ 3 lessons per day</li>
            <li>✓ Basic subjects</li>
            <li>✓ Progress tracking</li>
          </ul>
          <button class="btn btn-secondary">Current Plan</button>
        </div>
        
        <div class="plan-card card featured">
          <span class="badge">Most Popular</span>
          <h3>Premium</h3>
          <div class="price">Rp 99.000<span>/month</span></div>
          <ul>
            <li>✓ Unlimited lessons</li>
            <li>✓ All subjects</li>
            <li>✓ AI-powered content</li>
            <li>✓ WhatsApp reports</li>
            <li>✓ Voice narration</li>
          </ul>
          <button class="btn btn-primary">Upgrade Now</button>
        </div>
        
        <div class="plan-card card">
          <h3>Family</h3>
          <div class="price">Rp 149.000<span>/month</span></div>
          <ul>
            <li>✓ Everything in Premium</li>
            <li>✓ Up to 3 children</li>
            <li>✓ Family progress report</li>
            <li>✓ Priority support</li>
          </ul>
          <button class="btn btn-secondary">Choose Plan</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.subscribe-page {
  min-height: 100vh;
  background: var(--bg-primary);
  padding: var(--space-2xl);
}

.container {
  max-width: 1000px;
  margin: 0 auto;
  text-align: center;
}

h1 {
  margin-bottom: var(--space-sm);
}

.container > p {
  color: var(--text-muted);
  margin-bottom: var(--space-2xl);
}

.plans-grid {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: var(--space-xl);
}

.plan-card {
  padding: var(--space-xl);
  text-align: center;
  position: relative;
}

.plan-card.featured {
  border-color: var(--color-primary);
  transform: scale(1.05);
}

.plan-card .badge {
  position: absolute;
  top: -12px;
  left: 50%;
  transform: translateX(-50%);
  background: var(--gradient-primary);
  padding: var(--space-xs) var(--space-md);
  border-radius: var(--radius-full);
  font-size: 0.75rem;
  font-weight: 600;
}

.plan-card h3 {
  margin-bottom: var(--space-md);
}

.price {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: var(--space-lg);
}

.price span {
  font-size: 1rem;
  font-weight: 400;
  color: var(--text-muted);
}

.plan-card ul {
  list-style: none;
  padding: 0;
  margin-bottom: var(--space-xl);
  text-align: left;
}

.plan-card li {
  padding: var(--space-sm) 0;
  color: var(--text-secondary);
}

.plan-card .btn {
  width: 100%;
}

@media (max-width: 768px) {
  .plans-grid {
    grid-template-columns: 1fr;
  }
  
  .plan-card.featured {
    transform: none;
  }
}
</style>
