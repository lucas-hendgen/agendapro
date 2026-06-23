'use client'

import { motion } from 'framer-motion'
import { Calendar, Users, DollarSign, TrendingUp, ChevronRight, ArrowUpRight, CheckCircle, Clock } from 'lucide-react'
import Link from 'next/link'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import DashboardStats from '@/components/dashboard/DashboardStats'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const recentAppointments = [
  { id: '1', client: 'Pedro Almeida', professional: 'Carlos Silva', service: 'Corte de Cabelo', date: 'Hoje', time: '09:00', value: 'R$ 50,00', status: 'completed' as const },
  { id: '2', client: 'Ana Paula', professional: 'Maria Souza', service: 'Manicure', date: 'Hoje', time: '10:00', value: 'R$ 40,00', status: 'pending' as const },
  { id: '3', client: 'Lucas Mendes', professional: 'João Oliveira', service: 'Barba', date: 'Hoje', time: '11:00', value: 'R$ 35,00', status: 'pending' as const },
  { id: '4', client: 'Fernanda Lima', professional: 'Carlos Silva', service: 'Coloração', date: 'Hoje', time: '14:00', value: 'R$ 150,00', status: 'pending' as const },
]

const revenueData = [
  { month: 'Jan', value: 28000 },
  { month: 'Fev', value: 32000 },
  { month: 'Mar', value: 35000 },
  { month: 'Abr', value: 31000 },
  { month: 'Mai', value: 38000 },
  { month: 'Jun', value: 45600 },
]

const topProfessionals = [
  { name: 'Carlos Silva', appointments: 156, revenue: 'R$ 8.450', rating: 4.9 },
  { name: 'Maria Souza', appointments: 142, revenue: 'R$ 7.200', rating: 4.8 },
  { name: 'João Oliveira', appointments: 138, revenue: 'R$ 6.800', rating: 4.9 },
  { name: 'Ana Paula', appointments: 125, revenue: 'R$ 12.500', rating: 4.7 },
]

export default function AdminDashboard() {
  return (
    <ProtectedRoute allowedRoles={['admin']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="admin" />
        <div className="flex-1 lg:ml-0">
          <DashboardHeader title="Painel Administrativo" subtitle="Visão geral da plataforma e métricas principais." />
          <main className="p-6 space-y-8">
            <DashboardStats role="admin" />

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.2 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary">Faturamento Mensal</h2>
                  <span className="flex items-center gap-1 text-green-600 text-sm font-medium">
                    <ArrowUpRight className="w-4 h-4" />
                    +12%
                  </span>
                </div>
                <div className="flex items-end gap-3 h-48">
                  {revenueData.map((item) => (
                    <div key={item.month} className="flex-1 flex flex-col items-center gap-2">
                      <div className="w-full bg-primary/10 rounded-lg relative" style={{ height: '100%' }}>
                        <motion.div
                          initial={{ height: 0 }}
                          animate={{ height: `${(item.value / 50000) * 100}%` }}
                          transition={{ duration: 1, delay: 0.3 }}
                          className="absolute bottom-0 left-0 right-0 bg-primary rounded-lg"
                        />
                      </div>
                      <span className="text-xs text-text-secondary">{item.month}</span>
                    </div>
                  ))}
                </div>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.3 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary">Agendamentos Recentes</h2>
                  <Link href="/dashboard/admin/agendamentos" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver todos <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="space-y-3">
                  {recentAppointments.map((apt) => (
                    <div key={apt.id} className="flex items-center justify-between p-3 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors">
                      <div className="flex items-center gap-3">
                        <div className={`w-2 h-2 rounded-full ${apt.status === 'completed' ? 'bg-green-500' : 'bg-yellow-500'}`} />
                        <div>
                          <p className="text-sm font-medium text-text-primary">{apt.client}</p>
                          <p className="text-xs text-text-secondary">{apt.service} • {apt.professional}</p>
                        </div>
                      </div>
                      <div className="text-right">
                        <p className="text-sm font-medium text-text-primary">{apt.value}</p>
                        <p className="text-xs text-text-muted">{apt.time}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </motion.div>
            </div>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.4 }}
              className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
            >
              <div className="flex items-center justify-between mb-6">
                <h2 className="text-lg font-bold text-text-primary">Top Profissionais</h2>
                <Link href="/dashboard/admin/profissionais" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                  Ver todos <ChevronRight className="w-4 h-4" />
                </Link>
              </div>
              <div className="overflow-x-auto">
                <table className="w-full">
                  <thead>
                    <tr className="border-b border-gray-100">
                      <th className="text-left py-3 px-4 text-sm font-medium text-text-secondary">Profissional</th>
                      <th className="text-left py-3 px-4 text-sm font-medium text-text-secondary">Agendamentos</th>
                      <th className="text-left py-3 px-4 text-sm font-medium text-text-secondary">Faturamento</th>
                      <th className="text-left py-3 px-4 text-sm font-medium text-text-secondary">Avaliação</th>
                    </tr>
                  </thead>
                  <tbody>
                    {topProfessionals.map((pro, index) => (
                      <tr key={index} className="border-b border-gray-50 hover:bg-gray-50 transition-colors">
                        <td className="py-3 px-4">
                          <div className="flex items-center gap-3">
                            <div className="w-8 h-8 bg-primary/10 rounded-full flex items-center justify-center text-sm font-bold text-primary">
                              {pro.name.charAt(0)}
                            </div>
                            <span className="text-sm font-medium text-text-primary">{pro.name}</span>
                          </div>
                        </td>
                        <td className="py-3 px-4 text-sm text-text-secondary">{pro.appointments}</td>
                        <td className="py-3 px-4 text-sm font-medium text-green-600">{pro.revenue}</td>
                        <td className="py-3 px-4">
                          <span className="flex items-center gap-1 text-sm text-yellow-600">
                            <TrendingUp className="w-4 h-4" />
                            {pro.rating}
                          </span>
                        </td>
                      </tr>
                    ))}
                  </tbody>
                </table>
              </div>
            </motion.div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
