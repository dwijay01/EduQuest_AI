import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import api from '@/services/api'

export const useAuthStore = defineStore('auth', () => {
    // State
    const user = ref(null)
    const token = ref(localStorage.getItem('auth_token') || null)
    const role = ref(localStorage.getItem('user_role') || null)
    const loading = ref(false)
    const error = ref(null)

    // Computed
    const isAuthenticated = computed(() => token.value !== null && user.value !== null)
    const isParent = computed(() => role.value === 'parent')
    const isStudent = computed(() => role.value === 'student')

    // Actions
    async function login(email, password) {
        loading.value = true
        error.value = null
        try {
            const response = await api.post('/login', { email, password })
            setAuth(response.data.user, response.data.token, response.data.user.role)
            return response.data
        } catch (err) {
            error.value = err.response?.data?.message || 'Login gagal. Periksa email dan password.'
            throw err
        } finally {
            loading.value = false
        }
    }

    async function register(data) {
        loading.value = true
        error.value = null
        try {
            const response = await api.post('/register', data)
            setAuth(response.data.user, response.data.token, response.data.user.role)
            return response.data
        } catch (err) {
            const errors = err.response?.data?.errors
            if (errors) {
                error.value = Object.values(errors).flat().join(' ')
            } else {
                error.value = err.response?.data?.message || 'Registrasi gagal.'
            }
            throw err
        } finally {
            loading.value = false
        }
    }

    async function fetchUser() {
        if (!token.value) return null
        try {
            const response = await api.get('/user')
            user.value = response.data.user
            role.value = response.data.user.role
            localStorage.setItem('user_role', response.data.user.role)
            return response.data.user
        } catch (err) {
            logout()
            return null
        }
    }

    async function logoutAction() {
        try {
            await api.post('/logout')
        } catch {
            // Ignore errors on logout
        } finally {
            clearAuth()
        }
    }

    function setAuth(userData, authToken, userRole) {
        user.value = userData
        token.value = authToken
        role.value = userRole
        localStorage.setItem('auth_token', authToken)
        localStorage.setItem('user_role', userRole)
    }

    function clearAuth() {
        user.value = null
        token.value = null
        role.value = null
        localStorage.removeItem('auth_token')
        localStorage.removeItem('user_role')
    }

    function logout() {
        clearAuth()
    }

    async function initAuth() {
        const savedToken = localStorage.getItem('auth_token')
        if (savedToken) {
            token.value = savedToken
            role.value = localStorage.getItem('user_role')
            await fetchUser()
        }
    }

    return {
        // State
        user,
        token,
        role,
        loading,
        error,
        // Computed
        isAuthenticated,
        isParent,
        isStudent,
        // Actions
        login,
        register,
        fetchUser,
        logout: logoutAction,
        setAuth,
        initAuth
    }
})
