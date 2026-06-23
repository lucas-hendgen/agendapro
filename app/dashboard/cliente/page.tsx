'use client'

import { motion } from 'framer-motion'
import {
  Calendar, Clock, MapPin, CheckCircle, XCircle, ChevronRight, Star, Heart, Scissors, Bell, Tag, Plus, ArrowRight, User, Bookmark
} from 'lucide-react'
import Link from 'next/link'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import DashboardStats from '@/components/dashboard/DashboardStats'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const upcomingAppointments = [
  { id: '1', service: 'Corte de Cabelo', professional: 'Carlos Silva', date: 'Hoje', time: '14:00', location: 'Salão Beleza Total', status: 'confirmed' as const, duration: '45 min', value: 'R$ 50,00' },
  { id: '2', service: 'Barba', professional: 'João Oliveira', date: 'Amanhã', time: '10:30', location: 'Barbearia Vintage', status: 'pending' as const, duration: '30 min', value: 'R$ 35,00' },
  { id: '3', service: 'Manicure', professional: 'Maria Souza', date: '25/06', time: '16:00', location: 'Espaço Maria', status: 'confirmed' as const, duration: '1h', value: 'R$ 40,00' },
]

const pastAppointments = [
  { id: '4', service: 'Corte de Cabelo', professional: 'Carlos Silva', date: '15/06', time: '14:00', status: 'completed' as const, value: 'R$ 50,00' },
  { id: '5', service: 'Massagem', professional: 'Ana Paula', date: '10/06', time: '11:00', status: 'completed' as const, value: 'R$ 120,00' },
]

const favoriteProfessionals = [
  { id: '1', name: 'Carlos Silva', specialty: 'Corte Masculino', rating: 4.9, reviews: 128, image: 'C' },
  { id: '2', name: 'Maria Souza', specialty: 'Coloração', rating: 4.8, reviews: 96, image: 'M' },
  { id: '3', name: 'João Oliveira', specialty: 'Barba', rating: 4.9, reviews: 112, image: 'J' },
]

const popularServices = [
  { id: '1', name: 'Corte de Cabelo', category: 'Cabelo', duration: '45 min', price: 'R$ 50,00', icon: Scissors, color: 'blue' },
  { id: '2', name: 'Barba', category: 'Barba', duration: '30 min', price: 'R$ 35,00', icon: User, color: 'purple' },
  { id: '3', name: 'Manicure', category: 'Unhas', duration: '1h', price: 'R$ 40,00', icon: Heart, color: 'pink' },
  { id: '4', name: 'Coloração', category: 'Cabelo', duration: '2h', price: 'R$ 150,00', icon: Scissors, color: 'cyan' },
]

const notifications = [
  { id: '1', message: 'Seu agendamento com Carlos Silva foi confirmado!', time: 'Há 10 min', type: 'success' as const },
  { id: '2', message: 'Lembrete: Agendamento amanhã às 10:30', time: 'Há 1h', type: 'info' as const },
  { id: '3', message: 'Promoção: 20% off em coloração este mês', time: 'Há 3h', type: 'promo' as const },
]

const promotions = [
  { id: '1', title: '20% OFF em Coloração', description: 'Aproveite 20% de desconto em qualquer serviço de coloração até o final do mês.', code: 'COLOR20', expires: '30/06', color: 'bg-gradient-to-r from-purple-500 to-pink-500' },
  { id: '2', title: 'Corte + Barba por R$ 65', description: 'Combo especial: corte de cabelo + barba com preço imperdível.', code: 'COMBO65', expires: '25/06', color: 'bg-gradient-to-r from-blue-500 to-cyan-500' },
]

const quickActions = [
  { label: 'Novo Agendamento', href: '/agendamento', icon: Plus, color: 'bg-blue-500 hover:bg-blue-600' },
  { label: 'Ver Favoritos', href: '/dashboard/cliente/favoritos', icon: Heart, color: 'bg-red-500 hover:bg-red-600' },
  { label: 'Explorar Serviços', href: '/dashboard/cliente/servicos', icon: Scissors, color: 'bg-purple-500 hover:bg-purple-600' },
  { label: 'Ver Promoções', href: '/dashboard/cliente/promocoes', icon: Tag, color: 'bg-green-500 hover:bg-green-600' },
]

const containerVariants = {
  hidden: { opacity: 0 },
  visible: {
    opacity: 1,
    transition: { staggerChildren: 0.1 }
  }
}

const itemVariants = {
  hidden: { opacity: 0, y: 20 },
  visible: { opacity: 1, y: 0 }
}

export default function ClienteDashboard() {
  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1 lg:ml-0">
          <DashboardHeader title="Dashboard do Cliente" subtitle="Bem-vindo de volta! Aqui está o resumo da sua agenda." />
          <main className="p-6 space-y-8">
            <DashboardStats role="cliente" />

            <div className="grid grid-cols-1 lg:grid-cols-3 gap-6">
              <motion.div
                variants={containerVariants}
                initial="hidden"
                animate="visible"
                className="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary font-poppins">Próximos Agendamentos</h2>
                  <Link href="/dashboard/cliente/agendamentos" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver todos <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="space-y-4">
                  {upcomingAppointments.map((apt) => (
                    <motion.div
                      key={apt.id}
                      variants={itemVariants}
                      className="flex items-center justify-between p-4 rounded-xl bg-gray-50 hover:bg-gray-100 transition-colors border border-gray-100"
                    >
                      <div className="flex items-center gap-4">
                        <div className="w-12 h-12 bg-gradient-to-br from-primary/10 to-primary-light/10 rounded-xl flex items-center justify-center">
                          <Calendar className="w-6 h-6 text-primary" />
                        </div>
                        <div>
                          <h3 className="font-semibold text-text-primary">{apt.service}</h3>
                          <p className="text-sm text-text-secondary">{apt.professional} • {apt.location}</p>
                          <div className="flex items-center gap-3 mt-1 text-xs text-text-muted">
                            <span className="flex items-center gap-1"><Clock className="w-3 h-3" /> {apt.time}</span>
                            <span className="flex items-center gap-1"><MapPin className="w-3 h-3" /> {apt.duration}</span>
                          </div>
                        </div>
                      </div>
                      <div className="text-right">
                        <span className={`inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-medium ${
                          apt.status === 'confirmed' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'
                        }`}>
                          {apt.status === 'confirmed' ? <CheckCircle className="w-3 h-3" /> : <Clock className="w-3 h-3" />}
                          {apt.status === 'confirmed' ? 'Confirmado' : 'Pendente'}
                        </span>
                        <p className="text-sm font-semibold text-text-primary mt-1">{apt.value}</p>
                      </div>
                    </motion.div>
                  ))}
                </div>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.3 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <h2 className="text-lg font-bold text-text-primary mb-6 font-poppins">Histórico</h2>
                <div className="space-y-4">
                  {pastAppointments.map((apt) => (
                    <div key={apt.id} className="flex items-center justify-between p-3 rounded-xl border border-gray-100 hover:bg-gray-50 transition-colors">
                      <div>
                        <h3 className="font-medium text-text-primary text-sm">{apt.service}</h3>
                        <p className="text-xs text-text-secondary">{apt.professional} • {apt.date}</p>
                      </div>
                      <span className="inline-flex items-center gap-1 px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                        <CheckCircle className="w-3 h-3" />
                        Concluído
                      </span>
                    </div>
                  ))}
                </div>
                <Link href="/agendamento" className="mt-6 w-full btn-primary flex items-center justify-center gap-2">
                  <Plus className="w-4 h-4" />
                  Novo Agendamento
                </Link>
              </motion.div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.4 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary font-poppins">Profissionais Favoritos</h2>
                  <Link href="/dashboard/cliente/favoritos" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver todos <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="space-y-3">
                  {favoriteProfessionals.map((pro) => (
                    <div key={pro.id} className="flex items-center gap-4 p-3 rounded-xl hover:bg-gray-50 transition-colors border border-gray-100">
                      <div className="w-12 h-12 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white font-bold text-lg shadow-lg shadow-primary/20">
                        {pro.image}
                      </div>
                      <div className="flex-1">
                        <h3 className="font-semibold text-text-primary text-sm">{pro.name}</h3>
                        <p className="text-xs text-text-secondary">{pro.specialty}</p>
                        <div className="flex items-center gap-1 mt-1">
                          <Star className="w-3 h-3 text-yellow-500 fill-yellow-500" />
                          <span className="text-xs text-text-secondary">{pro.rating} ({pro.reviews} avaliações)</span>
                        </div>
                      </div>
                      <Link href="/agendamento" className="p-2 rounded-lg bg-primary/10 text-primary hover:bg-primary hover:text-white transition-all">
                        <Calendar className="w-4 h-4" />
                      </Link>
                    </div>
                  ))}
                </div>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.5 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary font-poppins">Serviços Populares</h2>
                  <Link href="/dashboard/cliente/servicos" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver todos <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="grid grid-cols-2 gap-3">
                  {popularServices.map((service) => {
                    const Icon = service.icon
                    return (
                      <Link key={service.id} href="/agendamento" className="p-4 rounded-xl border border-gray-100 hover:border-primary/30 hover:shadow-md transition-all bg-gray-50 hover:bg-white">
                        <div className={`w-10 h-10 rounded-lg bg-${service.color}-100 flex items-center justify-center mb-3`}>
                          <Icon className={`w-5 h-5 text-${service.color}-500`} />
                        </div>
                        <h3 className="font-semibold text-text-primary text-sm">{service.name}</h3>
                        <p className="text-xs text-text-secondary mt-1">{service.category}</p>
                        <div className="flex items-center justify-between mt-2">
                          <span className="text-xs text-text-muted">{service.duration}</span>
                          <span className="text-sm font-bold text-primary">{service.price}</span>
                        </div>
                      </Link>
                    )
                  })}
                </div>
              </motion.div>
            </div>

            <div className="grid grid-cols-1 lg:grid-cols-2 gap-6">
              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.6 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary font-poppins">Notificações</h2>
                  <button className="text-xs text-primary font-medium hover:underline">Marcar todas como lidas</button>
                </div>
                <div className="space-y-3">
                  {notifications.map((notif) => (
                    <div key={notif.id} className="flex items-start gap-3 p-3 rounded-xl bg-gray-50 border border-gray-100">
                      <div className={`w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 ${
                        notif.type === 'success' ? 'bg-green-100 text-green-600' :
                        notif.type === 'promo' ? 'bg-purple-100 text-purple-600' :
                        'bg-blue-100 text-blue-600'
                      }`}>
                        {notif.type === 'success' ? <CheckCircle className="w-5 h-5" /> :
                         notif.type === 'promo' ? <Tag className="w-5 h-5" /> :
                         <Bell className="w-5 h-5" />}
                      </div>
                      <div className="flex-1">
                        <p className="text-sm text-text-primary">{notif.message}</p>
                        <p className="text-xs text-text-muted mt-1">{notif.time}</p>
                      </div>
                    </div>
                  ))}
                </div>
              </motion.div>

              <motion.div
                initial={{ opacity: 0, y: 20 }}
                animate={{ opacity: 1, y: 0 }}
                transition={{ delay: 0.7 }}
                className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
              >
                <div className="flex items-center justify-between mb-6">
                  <h2 className="text-lg font-bold text-text-primary font-poppins">Promoções & Ofertas</h2>
                  <Link href="/dashboard/cliente/promocoes" className="text-primary text-sm font-medium hover:underline flex items-center gap-1">
                    Ver todas <ChevronRight className="w-4 h-4" />
                  </Link>
                </div>
                <div className="space-y-4">
                  {promotions.map((promo) => (
                    <div key={promo.id} className="p-4 rounded-xl border border-gray-100 hover:shadow-md transition-all">
                      <div className={`${promo.color} text-white rounded-xl p-4 mb-3`}>
                        <div className="flex items-center justify-between">
                          <h3 className="font-bold text-lg">{promo.title}</h3>
                          <Tag className="w-6 h-6" />
                        </div>
                        <p className="text-white/90 text-sm mt-1">{promo.description}</p>
                      </div>
                      <div className="flex items-center justify-between">
                        <div className="flex items-center gap-2">
                          <span className="text-xs text-text-secondary">Código:</span>
                          <span className="px-2 py-1 bg-gray-100 rounded-lg text-xs font-mono font-bold text-text-primary">{promo.code}</span>
                        </div>
                        <span className="text-xs text-text-muted">Válido até {promo.expires}</span>
                      </div>
                    </div>
                  ))}
                </div>
              </motion.div>
            </div>

            <motion.div
              initial={{ opacity: 0, y: 20 }}
              animate={{ opacity: 1, y: 0 }}
              transition={{ delay: 0.8 }}
              className="bg-white rounded-2xl shadow-sm border border-gray-100 p-6"
            >
              <h2 className="text-lg font-bold text-text-primary mb-6 font-poppins">Ações Rápidas</h2>
              <div className="grid grid-cols-2 sm:grid-cols-4 gap-4">
                {quickActions.map((action) => {
                  const Icon = action.icon
                  return (
                    <Link
                      key={action.label}
                      href={action.href}
                      className={`flex flex-col items-center gap-3 p-6 rounded-xl text-white transition-all transform hover:scale-105 hover:shadow-lg ${action.color}`}
                    >
                      <Icon className="w-8 h-8" />
                      <span className="text-sm font-medium text-center">{action.label}</span>
                    </Link>
                  )
                })}
              </div>
            </motion.div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
