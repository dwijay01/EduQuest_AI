import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import api from '@/services/api'

export const useStudentStore = defineStore('student', () => {
    // State
    const students = ref([])
    const currentStudent = ref(null)
    const interests = ref([])
    const stars = ref(0)
    const level = ref(1)
    const cognitiveLevel = ref('beginner')
    const loading = ref(false)
    const error = ref(null)

    // Learning session state
    const currentSession = ref(null)
    const sessionProgress = ref(0)

    // Computed
    const isLoggedIn = computed(() => currentStudent.value !== null)
    const studentName = computed(() => currentStudent.value?.name || 'Pejuang Belajar')
    const studentGrade = computed(() => currentStudent.value?.grade || 1)
    const hasStudents = computed(() => students.value.length > 0)

    // Actions
    async function fetchStudents() {
        loading.value = true
        try {
            const response = await api.get('/students')
            students.value = response.data.students
            // Auto-select first student if none selected
            if (!currentStudent.value && students.value.length > 0) {
                setStudent(students.value[0])
            }
            return students.value
        } catch (err) {
            error.value = 'Gagal memuat data anak.'
            throw err
        } finally {
            loading.value = false
        }
    }

    async function createStudent(data) {
        loading.value = true
        error.value = null
        try {
            const response = await api.post('/students', data)
            const newStudent = response.data.student
            students.value.push(newStudent)
            setStudent(newStudent)
            return newStudent
        } catch (err) {
            error.value = err.response?.data?.message || 'Gagal membuat profil anak.'
            throw err
        } finally {
            loading.value = false
        }
    }

    async function saveOnboarding(studentId, data) {
        loading.value = true
        try {
            const response = await api.post(`/students/${studentId}/onboarding`, data)
            const updated = response.data.student
            // Update local state
            const idx = students.value.findIndex(s => s.id === updated.id)
            if (idx !== -1) students.value[idx] = updated
            if (currentStudent.value?.id === updated.id) {
                setStudent(updated)
            }
            return updated
        } catch (err) {
            error.value = 'Gagal menyimpan data onboarding.'
            throw err
        } finally {
            loading.value = false
        }
    }

    function setStudent(student) {
        currentStudent.value = student
        interests.value = student.interests || []
        stars.value = student.stars || 0
        level.value = student.level || 1
        cognitiveLevel.value = student.cognitive_level || 'beginner'
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
        students.value = []
        interests.value = []
        stars.value = 0
        level.value = 1
        currentSession.value = null
    }

    return {
        // State
        students,
        currentStudent,
        interests,
        stars,
        level,
        cognitiveLevel,
        currentSession,
        sessionProgress,
        loading,
        error,
        // Computed
        isLoggedIn,
        studentName,
        studentGrade,
        hasStudents,
        // Actions
        fetchStudents,
        createStudent,
        saveOnboarding,
        setStudent,
        updateStars,
        setInterests,
        startSession,
        recordAnswer,
        endSession,
        clearStudent
    }
})
