import { ref, computed } from 'vue'
import { defineStore } from 'pinia'

export const useAuthStore = defineStore('auth', () => {
    // State
    const user = ref(null)
    const token = ref(localStorage.getItem('auth_token') || null)
    const role = ref(null) // 'parent' or 'student'

    // Computed
    const isAuthenticated = computed(() => token.value !== null && user.value !== null)
    const isParent = computed(() => role.value === 'parent')
    const isStudent = computed(() => role.value === 'student')

    // Actions
    function setAuth(userData, authToken, userRole) {
        user.value = userData
        token.value = authToken
        role.value = userRole
        localStorage.setItem('auth_token', authToken)
        localStorage.setItem('user_role', userRole)
    }

    function setRole(newRole) {
        role.value = newRole
        localStorage.setItem('user_role', newRole)
    }

    function logout() {
        user.value = null
        token.value = null
        role.value = null
        localStorage.removeItem('auth_token')
        localStorage.removeItem('user_role')
    }

    function initAuth() {
        const savedToken = localStorage.getItem('auth_token')
        const savedRole = localStorage.getItem('user_role')
        if (savedToken) {
            token.value = savedToken
            role.value = savedRole
            // TODO: Validate token with backend and fetch user data
        }
    }

    return {
        // State
        user,
        token,
        role,
        // Computed
        isAuthenticated,
        isParent,
        isStudent,
        // Actions
        setAuth,
        setRole,
        logout,
        initAuth
    }
})
