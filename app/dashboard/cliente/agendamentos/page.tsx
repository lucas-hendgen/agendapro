'use client'

import { motion } from 'framer-motion'
import { Calendar, Clock, MapPin, CheckCircle, ClockIcon, XCircle, ChevronLeft, Filter, Search } from 'lucide-react'
import Link from 'next/link'
import { useState } from 'react'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const allAppointments = [
  { id: '1', service: 'Corte de Cabelo', professional: 'Carlos Silva', date: 'Hoje', time: '14:00', location: 'Salão Beleza Total', status: 'confirmed' as const, duration: '45 min', value: 'R$ 50,00' },
  { id: '2', service: 'Barba', professional: 'João Oliveira', date: 'Amanhã', time: '10:30', location: 'Barbearia Vintage', status: 'pending' as const, duration: '30 min', value: 'R$ 35,00' },
  { id: '3', service: 'Manicure', professional: 'Maria Souza', date: '25/06', time: '16:00', location: 'Espaço Maria', status: 'confirmed' as const, duration: '1h', value: 'R$ 40,00' },
  { id: '4', service: 'Corte de Cabelo', professional: 'Carlos Silva', date: '15/06', time: '14:00', location: 'Salão Beleza Total', status: 'completed' as const, duration: '45 min', value: 'R$ 50,00' },
  { id: '5', service: 'Massagem', professional: 'Ana Paula', date: '10/06', time: '11:00', location: 'Spa Relax', status: 'completed' as const, duration: '1h', value: 'R$ 120,00' },
  { id: '6', service: 'Pedicure', professional: 'Ana Paula', date: '05/06', time: '15:00', location: 'Espaço Maria', status: 'cancelled' as const, duration: '1h', value: 'R$ 45,00' },
]

const tabs = [
  { id: 'all', label: 'Todos' },
  { id: 'upcoming', label: 'Próximos' },
  { id: 'completed', label: 'Concluídos' },
  { id: 'cancelled', label: 'Cancelados' },
]

export default function AgendamentosPage() {
  const [activeTab, setActiveTab] = useState('all')
  const [searchTerm, setSearchTerm] = useState('')

  const filtered = allAppointments.filter((apt) => {
    const matchesTab = activeTab === 'all' || apt.status === activeTab
    const matchesSearch = apt.service.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          apt.professional.toLowerCase().includes(searchTerm.toLowerCase())
    return matchesTab && matchesSearch
  })

  const statusConfig = {
    confirmed: { label: 'Confirmado', icon: CheckCircle, color: 'bg-green-100 text-green-700' },
    pending: { label: 'Pendente', icon: ClockIcon, color: 'bg-yellow-100 text-yellow-700' },
    completed: { label: 'Concluído', icon: CheckCircle, color: 'bg-blue-100 text-blue-700' },
    cancelled: { label: 'Cancelado', icon: XCircle, color: 'bg-red-100 text-red-700' },
  }

  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1">
          <DashboardHeader title="Meus Agendamentos" subtitle="Gerencie todos os seus agendamentos em um só lugar." />
          <main className="p-6 space-y-6">
            <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
              <div className="flex gap-2">
                {tabs.map((tab) => (
                  <button
                    key={tab.id}
                    onClick={() => setActiveTab(tab.id)}
                    className={`px-4 py-2 rounded-xl text-sm font-medium transition-all ${
                      activeTab === tab.id
                        ? 'bg-primary text-white shadow-lg shadow-primary/25'
                        : 'bg-white text-text-secondary hover:bg-gray-50 border border-gray-100'
                    }`}
                  >
                    {tab.label}
                  </button>
                ))}
              </div>
              <div className="flex items-center gap-3">
                <div className="flex items-center bg-white rounded-xl px-4 py-2 border border-gray-100">
                  <Search className="w-4 h-4 text-text-muted mr-2" />
                  <input
                    type="text"
                    placeholder="Buscar agendamento..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    className="bg-transparent text-sm outline-none text-text-primary placeholder:text-text-muted w-48"
                  />
                </div>
                <button className="p-2 rounded-xl bg-white border border-gray-100 hover:bg-gray-50 transition-colors">
                  <Filter className="w-4 h-4 text-text-secondary" />
                </button>
              </div>
            </div>

            <div className="space-y-4">
              {filtered.length === 0 ? (
                <div className="bg-white rounded-2xl p-12 text-center border border-gray-100">
                  <Calendar className="w-12 h-12 text-text-muted mx-auto mb-4" />
                  <h3 className="text-lg font-semibold text-text-primary mb-2">Nenhum agendamento encontrado</h3>
                  <p className="text-text-secondary mb-4">Que tal agendar um novo serviço?</p>
                  <Link href="/agendamento" className="btn-primary inline-flex items-center gap-2">
                    <Calendar className="w-4 h-4" />
                    Novo Agendamento
                  </Link>
                </div>
              ) : (
                filtered.map((apt) => {
                  const status = statusConfig[apt.status]
                  const StatusIcon = status.icon
                  return (
                    <motion.div
                      key={apt.id}
                      initial={{ opacity: 0, y: 10 }}
                      animate={{ opacity: 1, y: 0 }}
                      className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4"
                    >
                      <div className="flex items-center gap-4">
                        <div className="w-14 h-14 bg-gradient-to-br from-primary/10 to-primary-light/10 rounded-xl flex items-center justify-center">
                          <Calendar className="w-7 h-7 text-primary" />
                        </div>
                        <div>
                          <h3 className="font-semibold text-text-primary">{apt.service}</h3>
                          <p className="text-sm text-text-secondary">{apt.professional} • {apt.location}</p>
                          <div className="flex items-center gap-3 mt-2 text-xs text-text-muted">
                            <span className="flex items-center gap-1"><Calendar className="w-3 h-3" /> {apt.date}</span>
                            <span className="flex items-center gap-1"><Clock className="w-3 h-3" /> {apt.time}</span>
                            <span className="flex items-center gap-1"><MapPin className="w-3 h-3" /> {apt.duration}</span>
                          </div>
                        </div>
                      </div>
                      <div className="flex items-center gap-4">
                        <span className={`inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-medium ${status.color}`}>
                          <StatusIcon className="w-3 h-3" />
                          {status.label}
                        </span>
                        <p className="text-sm font-bold text-text-primary">{apt.value}</p>
                        {apt.status === 'pending' && (
                          <button className="text-xs text-red-500 hover:text-red-600 font-medium">Cancelar</button>
                        )}
                      </div>
                    </motion.div>
                  )
                })
              )}
            </div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
