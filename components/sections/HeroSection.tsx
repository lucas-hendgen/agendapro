'use client'

import { motion } from 'framer-motion'
import Link from 'next/link'
import { ArrowRight, Calendar, Clock, Users, CheckCircle } from 'lucide-react'

export default function HeroSection() {
  const stats = [
    { icon: Users, value: '50K+', label: 'Profissionais' },
    { icon: Calendar, value: '2M+', label: 'Agendamentos' },
    { icon: Clock, value: '99.9%', label: 'Uptime' },
    { icon: CheckCircle, value: '4.9', label: 'Avaliação' },
  ]

  return (
    <section className="relative min-h-screen flex items-center overflow-hidden gradient-bg pt-20">
      <div className="absolute inset-0 overflow-hidden">
        <div className="absolute -top-40 -right-40 w-96 h-96 bg-primary/20 rounded-full blur-3xl" />
        <div className="absolute -bottom-40 -left-40 w-96 h-96 bg-primary-light/20 rounded-full blur-3xl" />
      </div>

      <div className="section-padding relative z-10 max-w-7xl mx-auto w-full">
        <div className="grid lg:grid-cols-2 gap-12 items-center">
          <motion.div
            initial={{ opacity: 0, x: -30 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.6 }}
            className="space-y-8"
          >
            <div className="inline-flex items-center gap-2 bg-primary/10 text-primary px-4 py-2 rounded-full text-sm font-medium">
              <span className="w-2 h-2 bg-primary rounded-full animate-pulse" />
              Novidade: IA para sugerir horários
            </div>

            <h1 className="text-4xl sm:text-5xl lg:text-6xl font-bold font-poppins leading-tight text-text-primary">
              Mais tempo para{' '}
              <span className="text-gradient">o que importa</span>
            </h1>

            <p className="text-lg text-text-secondary leading-relaxed max-w-lg">
              A plataforma mais moderna de agendamento online. Conecte seus clientes aos seus serviços de forma simples, rápida e profissional.
            </p>

            <div className="flex flex-col sm:flex-row gap-4">
              <Link href="/agendamento" className="btn-primary flex items-center justify-center gap-2 group">
                Agendar Agora
                <ArrowRight className="w-4 h-4 group-hover:translate-x-1 transition-transform" />
              </Link>
              <Link href="/auth/register-profissional" className="btn-secondary flex items-center justify-center gap-2">
                Sou Profissional
              </Link>
            </div>

            <div className="grid grid-cols-2 sm:grid-cols-4 gap-6 pt-8 border-t border-gray-200">
              {stats.map((stat, index) => (
                <motion.div
                  key={stat.label}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: 0.3 + index * 0.1 }}
                  className="text-center sm:text-left"
                >
                  <div className="flex items-center justify-center sm:justify-start gap-2 mb-1">
                    <stat.icon className="w-4 h-4 text-primary" />
                    <span className="text-xl font-bold text-text-primary">{stat.value}</span>
                  </div>
                  <p className="text-sm text-text-muted">{stat.label}</p>
                </motion.div>
              ))}
            </div>
          </motion.div>

          <motion.div
            initial={{ opacity: 0, x: 30 }}
            animate={{ opacity: 1, x: 0 }}
            transition={{ duration: 0.6, delay: 0.2 }}
            className="relative"
          >
            <div className="relative mx-auto w-full max-w-md">
              <div className="absolute inset-0 bg-gradient-to-br from-primary/30 to-primary-light/30 rounded-3xl blur-2xl transform rotate-6" />
              <div className="relative bg-white rounded-3xl shadow-2xl shadow-primary/20 p-6 border border-gray-100">
                <div className="flex items-center gap-3 mb-6 pb-4 border-b border-gray-100">
                  <div className="w-12 h-12 bg-primary/10 rounded-full flex items-center justify-center">
                    <Calendar className="w-6 h-6 text-primary" />
                  </div>
                  <div>
                    <p className="font-semibold text-text-primary">Agendamento Rápido</p>
                    <p className="text-sm text-text-muted">Escolha seu serviço</p>
                  </div>
                </div>

                <div className="space-y-3">
                  {['Corte de Cabelo', 'Barba', 'Manicure', 'Estética Facial', 'Massagem'].map((service, i) => (
                    <motion.div
                      key={service}
                      initial={{ opacity: 0, x: 20 }}
                      animate={{ opacity: 1, x: 0 }}
                      transition={{ delay: 0.5 + i * 0.1 }}
                      className="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-primary/5 hover:border-primary/20 border border-transparent transition-all cursor-pointer group"
                    >
                      <div className="flex items-center gap-3">
                        <div className="w-8 h-8 rounded-lg bg-primary/10 flex items-center justify-center text-primary font-semibold text-sm">
                          {i + 1}
                        </div>
                        <span className="font-medium text-text-primary">{service}</span>
                      </div>
                      <ArrowRight className="w-4 h-4 text-text-muted group-hover:text-primary group-hover:translate-x-1 transition-all" />
                    </motion.div>
                  ))}
                </div>

                <div className="mt-6 pt-4 border-t border-gray-100">
                  <div className="flex items-center justify-between text-sm">
                    <span className="text-text-muted">Próximo passo:</span>
                    <span className="text-primary font-medium">Escolher profissional →</span>
                  </div>
                </div>
              </div>

              <motion.div
                animate={{ y: [0, -10, 0] }}
                transition={{ duration: 4, repeat: Infinity, ease: 'easeInOut' }}
                className="absolute -top-6 -right-6 bg-white rounded-2xl shadow-xl p-4 border border-gray-100"
              >
                <div className="flex items-center gap-2">
                  <div className="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center">
                    <CheckCircle className="w-4 h-4 text-green-600" />
                  </div>
                  <div>
                    <p className="text-xs font-medium text-text-primary">Agendamento confirmado!</p>
                    <p className="text-xs text-text-muted">Hoje às 14:00</p>
                  </div>
                </div>
              </motion.div>
            </div>
          </motion.div>
        </div>
      </div>
    </section>
  )
}
