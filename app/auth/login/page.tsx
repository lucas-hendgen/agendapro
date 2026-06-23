'use client'

import { useState } from 'react'
import Link from 'next/link'
import { useRouter } from 'next/navigation'
import { Calendar, Mail, Lock, Eye, EyeOff, ArrowRight } from 'lucide-react'
import { motion } from 'framer-motion'

export default function LoginPage() {
  const router = useRouter()
  const [showPassword, setShowPassword] = useState(false)
  const [email, setEmail] = useState('')
  const [password, setPassword] = useState('')
  const [role, setRole] = useState('cliente')
  const [error, setError] = useState('')
  const [loading, setLoading] = useState(false)

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    setError('')
    setLoading(true)

    // Simular delay de autenticação
    setTimeout(() => {
      const users = JSON.parse(localStorage.getItem('agendapro_users') || '[]')
      const user = users.find((u: any) => u.email === email && u.password === password)

      if (!user && email !== 'admin@agendapro.com') {
        setError('Email ou senha incorretos')
        setLoading(false)
        return
      }

      let userData = user

      // Login do admin padrão
      if (email === 'admin@agendapro.com' && password === 'admin123') {
        userData = {
          id: 'admin-1',
          name: 'Administrador',
          email: 'admin@agendapro.com',
          role: 'admin',
        }
      }

      if (!userData) {
        setError('Email ou senha incorretos')
        setLoading(false)
        return
      }

      localStorage.setItem('agendapro_user', JSON.stringify(userData))

      // Redirecionar baseado no role
      if (userData.role === 'admin') {
        router.push('/dashboard/admin')
      } else if (userData.role === 'profissional') {
        router.push('/dashboard/profissional')
      } else {
        router.push('/dashboard/cliente')
      }
      setLoading(false)
    }, 800)
  }

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary/5 via-background to-primary/10 flex items-center justify-center p-4">
      <motion.div
        initial={{ opacity: 0, y: 20 }}
        animate={{ opacity: 1, y: 0 }}
        transition={{ duration: 0.5 }}
        className="w-full max-w-md"
      >
        <div className="bg-white rounded-2xl shadow-xl p-8">
          <div className="text-center mb-8">
            <Link href="/" className="inline-flex items-center gap-3 mb-6">
              <div className="w-12 h-12 bg-primary rounded-xl flex items-center justify-center">
                <Calendar className="w-6 h-6 text-white" />
              </div>
              <span className="text-2xl font-bold font-poppins text-text-primary">
                Agenda<span className="text-primary">Pro</span>
              </span>
            </Link>
            <h1 className="text-2xl font-bold text-text-primary mb-2">Bem-vindo de volta</h1>
            <p className="text-text-secondary">Entre na sua conta para continuar</p>
          </div>

          {error && (
            <div className="mb-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-600 text-sm text-center">
              {error}
            </div>
          )}

          <form onSubmit={handleSubmit} className="space-y-5">
            <div>
              <label className="block text-sm font-medium text-text-primary mb-2">Email</label>
              <div className="relative">
                <Mail className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" />
                <input
                  type="email"
                  value={email}
                  onChange={(e) => setEmail(e.target.value)}
                  className="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                  placeholder="seu@email.com"
                  required
                />
              </div>
            </div>

            <div>
              <label className="block text-sm font-medium text-text-primary mb-2">Senha</label>
              <div className="relative">
                <Lock className="absolute left-3 top-1/2 -translate-y-1/2 w-5 h-5 text-text-muted" />
                <input
                  type={showPassword ? 'text' : 'password'}
                  value={password}
                  onChange={(e) => setPassword(e.target.value)}
                  className="w-full pl-10 pr-12 py-3 rounded-xl border border-gray-200 focus:border-primary focus:ring-2 focus:ring-primary/20 outline-none transition-all"
                  placeholder="••••••••"
                  required
                />
                <button
                  type="button"
                  onClick={() => setShowPassword(!showPassword)}
                  className="absolute right-3 top-1/2 -translate-y-1/2 text-text-muted hover:text-primary transition-colors"
                >
                  {showPassword ? <EyeOff className="w-5 h-5" /> : <Eye className="w-5 h-5" />}
                </button>
              </div>
            </div>

            <div>
              <label className="block text-sm font-medium text-text-primary mb-2">Tipo de Acesso</label>
              <div className="grid grid-cols-3 gap-2">
                {[
                  { value: 'cliente', label: 'Cliente' },
                  { value: 'profissional', label: 'Profissional' },
                  { value: 'admin', label: 'Admin' },
                ].map((option) => (
                  <button
                    key={option.value}
                    type="button"
                    onClick={() => setRole(option.value)}
                    className={`py-2 px-3 rounded-lg text-sm font-medium transition-all ${
                      role === option.value
                        ? 'bg-primary text-white'
                        : 'bg-gray-100 text-text-secondary hover:bg-gray-200'
                    }`}
                  >
                    {option.label}
                  </button>
                ))}
              </div>
            </div>

            <div className="flex items-center justify-between text-sm">
              <label className="flex items-center gap-2 cursor-pointer">
                <input type="checkbox" className="rounded border-gray-300 text-primary focus:ring-primary" />
                <span className="text-text-secondary">Lembrar-me</span>
              </label>
              <Link href="/auth/forgot-password" className="text-primary hover:text-primary-dark transition-colors">
                Esqueceu a senha?
              </Link>
            </div>

            <button
              type="submit"
              disabled={loading}
              className="w-full btn-primary flex items-center justify-center gap-2 disabled:opacity-50"
            >
              {loading ? 'Entrando...' : 'Entrar'}
              <ArrowRight className="w-4 h-4" />
            </button>
          </form>

          <div className="mt-6 text-center">
            <p className="text-text-secondary text-sm">
              Não tem uma conta?{' '}
              <Link href="/auth/register" className="text-primary font-medium hover:text-primary-dark transition-colors">
                Cadastre-se
              </Link>
            </p>
          </div>
        </div>
      </motion.div>
    </div>
  )
}
