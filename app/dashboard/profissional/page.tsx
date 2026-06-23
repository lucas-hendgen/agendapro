'use client'

import { motion } from 'framer-motion'
import { Calendar, Clock, CheckCircle, XCircle, User, ChevronRight, TrendingUp } from 'lucide-react'
import Link from 'next/link'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import DashboardStats from '@/components/dashboard/DashboardStats'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const todayAppointments = [
  { id: '1', client: 'Pedro Almeida', service: 'Corte de Cabelo', time: '09:00', duration: '45 min', status: 'completed' as const, value: 'R$ 50,00' },
  { id: '2', client: 'Lucas Mendes', service: 'Barba', time: '10:00', duration: '30 min', status: 'completed' as const, value: 'R$ 35,00' },
  { id: '3', client: 'Ana Paula', service: 'Corte + Barba', time: '11:00', duration: '1h 15min', status: 'pending' as const, value: 'R$ 80,00' },
  { id: '4', client: 'Fernanda Lima', service: 'Coloração', time: '14:00', duration: '2h', status: 'pending' as const, value: 'R$ 150,00' },
  { id: '5', client: 'Roberto Carlos', service: 'Corte de Cabelo', time: '16:30', duration: '45 min', status: 'pending' as const, value: 'R$ 50,00' },
]

const weeklyData = [
  { day: 'Seg', value: 6 },
  { day: 'Ter', value: 8 },
  { day: 'Qua', value: 5 },
  { day: 'Qui', value: 9 },
  { day: 'Sex', value: 7 },
  { day: 'Sáb', value: 10 },
  { day: 'Dom', value: 3 },
]

export default function ProfissionalDashboard() {
  return (
    <ProtectedRoute allowedRoles={['profissional']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="profissional" />
        <div className="flex-1 lg:ml-0">
          <DashboardHeader title="Dashboard do Profissional" subtitle="Gerencie sua agenda e acompanhe seus resultados." />
          <main className="p-6 space-y-8">
            <DashboardStats role="profissional" />

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.2 }}
                className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary">Agenda de Hoje</h2>
                  <Link href="/dashboard/profissional/agenda" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver semana <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="space-y-3">
                  {todayAppointments.map((apt, index) => (
                    <div key={apt.id} className={`flex items-center justify-between p-4 rounded-xl transition-colors ${
                      apt.status === 'completed' ? 'bg-gray-50' : 'bg-white border border-gray-100 hover:border-primary/30'
                    }`}>
                      <div className="flex items-center gap-4">
                        <div className={`w-10 h-10 rounded-xl flex items-center justify-center text-sm font-bold ${
                          apt.status === 'completed' ? 'bg-gray-200 text-gray-500' : 'bg-primary/10 text-primary'
                        }`}>
                          {index + 1}
                        </div>
                        <div>
                          <h3 className={`font-semibold text-sm ${apt.status === 'completed' ? 'text-text-muted line-through' : 'text-text-primary'}`}>
                            {apt.client}
                          </h3>
                          <p className="text-xs text-text-secondary">{apt.service} • {apt.duration}</p>
                        </div>
                      </div>
                      <div className="text-right flex items-center gap-4">
                        <div className="text-sm">
                          <p className="font-medium text-text-primary">{apt.time}</p>
                          <p className="text-xs text-text-muted">{apt.value}</p>
                        </div>
                        <span className={`inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium ${
                          apt.status === 'completed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'
                        }`}>
                          {apt.status === 'completed' ? <CheckCircle className="w-3 h-3" /> : <Clock className="w-3 h-3" />}
                          {apt.status === 'completed' ? 'Concluído' : 'Aguardando'}
                        </span>
                      </div>
                    </div>
                  ))}
                </div>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.3 }}
                className="space-y-6"
              >
                <div className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                  <h2 className="text-lg font-bold text-text-primary mb-4">Agendamentos da Semana</h2>
                  <div className="space-y-3">
                    {weeklyData.map((day) => (
                      <div key={day.day} className="flex items-center gap-3">
                        <span className="text-sm text-text-secondary w-8">{day.day}</span>
                        <div className="flex-1 h-2 bg-gray-100 rounded-full overflow-hidden">
                          <div
                            className="h-full bg-primary rounded-full transition-all duration-500"
                            style={{ width: `${(day.value / 10) * 100}%` }}
                          />
                        </div>
                        <span className="text-sm font-medium text-text-primary w-4">{day.value}</span>
                      </div>
                    ))}
                  </div>
                </div>

                <div className="bg-gradient-to-br from-primary to-primary-dark rounded-2xl p-6 text-white">
                  <div className="flex items-center gap-3 mb-4">
                    <TrendingUp className="w-6 h-6" />
                    <h3 className="font-semibold">Meta Mensal</h3>
                  </div>
                  <p className="text-3xl font-bold mb-2">R$ 4.500</p>
                  <p className="text-sm text-white/80 mb-4">de R$ 6.000</p>
                  <div className="w-full h-2 bg-white/20 rounded-full overflow-hidden">
                    <div className="h-full bg-white rounded-full" style={{ width: '75%' }} />
                  </div>
                  <p className="text-sm text-white/80 mt-2">75% concluído</p>
                </div>
              </motion.div>
            </div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
