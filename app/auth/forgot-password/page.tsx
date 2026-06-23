'use client'

import { useState } from 'react'
import Link from 'next/link'
import { Calendar, Mail, ArrowLeft, ArrowRight, CheckCircle } from 'lucide-react'
import { motion, AnimatePresence } from 'framer-motion'

export default function ForgotPasswordPage() {
  const [email, setEmail] = useState('')
  const [submitted, setSubmitted] = useState(false)

  const handleSubmit = (e: React.FormEvent) => {
    e.preventDefault()
    setSubmitted(true)
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
            <h1 className="text-2xl font-bold text-text-primary mb-2">Recuperar senha</h1>
            <p className="text-text-secondary">Enviaremos um link para redefinir sua senha</p>
          </div>

          <AnimatePresence mode="wait">
            {!submitted ? (
              <motion.form
                key="form"
                initial={{ opacity: 0 }}
                animate={{ opacity: 1 }}
                exit={{ opacity: 0 }}
                onSubmit={handleSubmit}
                className="space-y-5"
              >
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

                <button type="submit" className="w-full btn-primary flex items-center justify-center gap-2">
                  Enviar link
                  <ArrowRight className="w-4 h-4" />
                </button>
              </motion.form>
            ) : (
              <motion.div
                key="success"
                initial={{ opacity: 0, scale: 0.9 }}
                animate={{ opacity: 1, scale: 1 }}
                className="text-center py-8"
              >
                <div className="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                  <CheckCircle className="w-8 h-8 text-green-600" />
                </div>
                <h3 className="text-lg font-semibold text-text-primary mb-2">Email enviado!</h3>
                <p className="text-text-secondary text-sm mb-6">
                  Verifique sua caixa de entrada e siga as instruções para redefinir sua senha.
                </p>
                <Link href="/auth" className="btn-primary inline-flex items-center gap-2">
                  <ArrowLeft className="w-4 h-4" />
                  Voltar ao login
                </Link>
              </motion.div>
            )}
          </AnimatePresence>

          {!submitted && (
            <div className="mt-6 text-center">
              <Link href="/auth" className="text-sm text-primary hover:text-primary-dark transition-colors inline-flex items-center gap-1">
                <ArrowLeft className="w-4 h-4" />
                Voltar ao login
              </Link>
            </div>
          )}
        </div>
      </motion.div>
    </div>
  )
}
