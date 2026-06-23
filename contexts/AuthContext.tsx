'use client'

import { createContext, useContext, useState, useEffect, ReactNode } from 'react'
import { useRouter } from 'next/navigation'

interface User {
  id: string
  name: string
  email: string
  role: 'admin' | 'profissional' | 'cliente'
}

interface AuthContextType {
  user: User | null
  login: (email: string, password: string) => Promise<{ success: boolean; error?: string }>
  logout: () => void
  register: (data: { name: string; email: string; phone: string; password: string; role: string }) => Promise<{ success: boolean; error?: string }>
  loading: boolean
}

const AuthContext = createContext<AuthContextType | undefined>(undefined)

export function AuthProvider({ children }: { children: ReactNode }) {
  const [user, setUser] = useState<User | null>(null)
  const [loading, setLoading] = useState(true)
  const router = useRouter()

  useEffect(() => {
    // Inicializar usuário admin padrão
    initDefaultUsers()

    // Carregar usuário logado do localStorage
    const storedUser = localStorage.getItem('agendapro_user')
    if (storedUser) {
      try {
        setUser(JSON.parse(storedUser) as User)
      } catch {
        localStorage.removeItem('agendapro_user')
      }
    }
    setLoading(false)
  }, [])

  const initDefaultUsers = () => {
    const existingUsers = JSON.parse(localStorage.getItem('agendapro_users') || '[]')
    const hasAdmin = existingUsers.some((u: any) => u.email === 'admin@agendapro.com')

    if (!hasAdmin) {
      const adminUser = {
        id: 'admin-1',
        name: 'Administrador',
        email: 'admin@agendapro.com',
        password: 'admin123',
        phone: '(11) 99999-9999',
        role: 'admin',
        createdAt: new Date().toISOString(),
      }
      existingUsers.push(adminUser)
      localStorage.setItem('agendapro_users', JSON.stringify(existingUsers))
      console.log('Usuário admin padrão criado: admin@agendapro.com / admin123')
    }
  }

  const login = async (email: string, password: string): Promise<{ success: boolean; error?: string }> => {
    const users = JSON.parse(localStorage.getItem('agendapro_users') || '[]')
    const user = users.find((u: any) => u.email === email && u.password === password)

    if (!user) {
      return { success: false, error: 'Email ou senha incorretos' }
    }

    const userData = {
      id: user.id,
      name: user.name,
      email: user.email,
      role: user.role as User['role'],
    }

    localStorage.setItem('agendapro_user', JSON.stringify(userData))
    setUser(userData)

    return { success: true }
  }

  const logout = () => {
    localStorage.removeItem('agendapro_user')
    setUser(null)
    router.push('/auth/login')
  }

  const register = async (data: { name: string; email: string; phone: string; password: string; role: string }): Promise<{ success: boolean; error?: string }> => {
    const users = JSON.parse(localStorage.getItem('agendapro_users') || '[]')

    if (users.some((u: any) => u.email === data.email)) {
      return { success: false, error: 'Este email já está cadastrado' }
    }

    const newUser = {
      id: `user-${Date.now()}`,
      ...data,
      createdAt: new Date().toISOString(),
    }

    users.push(newUser)
    localStorage.setItem('agendapro_users', JSON.stringify(users))

    const userData = {
      id: newUser.id,
      name: newUser.name,
      email: newUser.email,
      role: newUser.role as User['role'],
    }

    localStorage.setItem('agendapro_user', JSON.stringify(userData))
    setUser(userData)

    return { success: true }
  }

  return (
    <AuthContext.Provider value={{ user, login, logout, register, loading }}>
      {children}
    </AuthContext.Provider>
  )
}

export function useAuth() {
  const context = useContext(AuthContext)
  if (context === undefined) {
    throw new Error('useAuth must be used within an AuthProvider')
  }
  return context
}
