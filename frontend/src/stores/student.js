import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useStudentStore = defineStore('student', () => {
    // State
    const currentStudent = ref(null)
    const interests = ref([])
    const stars = ref(0)
    const level = ref(1)
    const cognitiveLevel = ref('beginner')

    // Learning session state
    const currentSession = ref(null)
    const sessionProgress = ref(0)

    // Computed
    const isLoggedIn = computed(() => currentStudent.value !== null)
    const studentName = computed(() => currentStudent.value?.name || 'Pejuang Belajar')
    const studentGrade = computed(() => currentStudent.value?.grade || 1)

    // Actions
    function setStudent(student) {
        currentStudent.value = student
        interests.value = student.interests || []
        stars.value = student.stars || 0
        level.value = student.level || 1
        cognitiveLevel.value = student.cognitiveLevel || 'beginner'
    }

    function updateStars(newStars) {
        stars.value += newStars
    }

    function setInterests(newInterests) {
        interests.value = newInterests
    }

    function startSession(topic, theme) {
        currentSession.value = {
            topic,
            theme,
            startTime: new Date(),
            answers: [],
            score: 0
        }
        sessionProgress.value = 0
    }

    function recordAnswer(questionIndex, isCorrect, timeSpent, answer) {
        if (currentSession.value) {
            currentSession.value.answers.push({
                questionIndex,
                isCorrect,
                timeSpent,
                answer
            })
            if (isCorrect) {
                currentSession.value.score++
            }
        }
    }

    function endSession() {
        const session = currentSession.value
        currentSession.value = null
        sessionProgress.value = 0
        return session
    }

    function clearStudent() {
        currentStudent.value = null
        interests.value = []
        stars.value = 0
        level.value = 1
        currentSession.value = null
    }

    return {
        // State
        currentStudent,
        interests,
        stars,
        level,
        cognitiveLevel,
        currentSession,
        sessionProgress,
        // Computed
        isLoggedIn,
        studentName,
        studentGrade,
        // Actions
        setStudent,
        updateStars,
        setInterests,
        startSession,
        recordAnswer,
        endSession,
        clearStudent
    }
})
