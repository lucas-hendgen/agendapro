'use client'

import { motion } from 'framer-motion'
import { Scissors, Search, Star, Clock, ArrowRight, Filter } from 'lucide-react'
import Link from 'next/link'
import { useState } from 'react'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const services = [
  { id: '1', name: 'Corte de Cabelo', category: 'Cabelo', duration: '45 min', price: 'R$ 50,00', description: 'Corte moderno e personalizado para o seu estilo.', rating: 4.9, reviews: 234 },
  { id: '2', name: 'Barba', category: 'Barba', duration: '30 min', price: 'R$ 35,00', description: 'Modelagem e cuidados completos para a barba.', rating: 4.8, reviews: 189 },
  { id: '3', name: 'Corte + Barba', category: 'Combo', duration: '1h 15min', price: 'R$ 80,00', description: 'Combo completo de corte e barba com desconto.', rating: 4.9, reviews: 156 },
  { id: '4', name: 'Coloração', category: 'Cabelo', duration: '2h', price: 'R$ 150,00', description: 'Coloração profissional com produtos de alta qualidade.', rating: 4.7, reviews: 98 },
  { id: '5', name: 'Manicure', category: 'Unhas', duration: '1h', price: 'R$ 40,00', description: 'Cuidados completos para as unhas das mãos.', rating: 4.8, reviews: 312 },
  { id: '6', name: 'Pedicure', category: 'Unhas', duration: '1h', price: 'R$ 45,00', description: 'Cuidados completos para os pés e unhas.', rating: 4.7, reviews: 276 },
  { id: '7', name: 'Massagem Relaxante', category: 'Estética', duration: '1h', price: 'R$ 120,00', description: 'Massagem relaxante para aliviar o estresse.', rating: 4.9, reviews: 145 },
  { id: '8', name: 'Limpeza de Pele', category: 'Estética', duration: '1h 30min', price: 'R$ 100,00', description: 'Limpeza facial profunda e hidratação.', rating: 4.8, reviews: 167 },
]

const categories = ['Todos', 'Cabelo', 'Barba', 'Combo', 'Unhas', 'Estética']

export default function ServicosPage() {
  const [activeCategory, setActiveCategory] = useState('Todos')
  const [searchTerm, setSearchTerm] = useState('')

  const filtered = services.filter((s) => {
    const matchesCategory = activeCategory === 'Todos' || s.category === activeCategory
    const matchesSearch = s.name.toLowerCase().includes(searchTerm.toLowerCase())
    return matchesCategory && matchesSearch
  })

  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1">
          <DashboardHeader title="Serviços" subtitle="Explore todos os serviços disponíveis." />
          <main className="p-6 space-y-6">
            <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
              <div className="flex gap-2 flex-wrap">
                {categories.map((cat) => (
                  <button
                    key={cat}
                    onClick={() => setActiveCategory(cat)}
                    className={`px-4 py-2 rounded-xl text-sm font-medium transition-all ${
                      activeCategory === cat
                        ? 'bg-primary text-white shadow-lg shadow-primary/25'
                        : 'bg-white text-text-secondary hover:bg-gray-50 border border-gray-100'
                    }`}
                  >
                    {cat}
                  </button>
                ))}
              </div>
              <div className="flex items-center gap-3">
                <div className="flex items-center bg-white rounded-xl px-4 py-2 border border-gray-100">
                  <Search className="w-4 h-4 text-text-muted mr-2" />
                  <input
                    type="text"
                    placeholder="Buscar serviço..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    className="bg-transparent text-sm outline-none text-text-primary placeholder:text-text-muted w-48"
                  />
                </div>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {filtered.map((service, index) => (
                <motion.div
                  key={service.id}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: index * 0.05 }}
                  className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-primary/20 transition-all group"
                >
                  <div className="flex items-start justify-between mb-4">
                    <div className="w-12 h-12 bg-gradient-to-br from-primary/10 to-primary-light/10 rounded-xl flex items-center justify-center">
                      <Scissors className="w-6 h-6 text-primary" />
                    </div>
                    <span className="px-3 py-1 bg-gray-100 rounded-full text-xs font-medium text-text-secondary">{service.category}</span>
                  </div>
                  <h3 className="font-bold text-text-primary text-lg mb-2">{service.name}</h3>
                  <p className="text-sm text-text-secondary mb-4">{service.description}</p>
                  <div className="flex items-center gap-1 mb-4">
                    <Star className="w-4 h-4 text-yellow-500 fill-yellow-500" />
                    <span className="text-sm font-medium text-text-primary">{service.rating}</span>
                    <span className="text-xs text-text-muted">({service.reviews} avaliações)</span>
                  </div>
                  <div className="flex items-center justify-between pt-4 border-t border-gray-100">
                    <div>
                      <span className="text-xs text-text-muted flex items-center gap-1"><Clock className="w-3 h-3" /> {service.duration}</span>
                      <span className="text-lg font-bold text-primary">{service.price}</span>
                    </div>
                    <Link href="/agendamento" className="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-light transition-all group-hover:shadow-lg group-hover:shadow-primary/30">
                      Agendar
                      <ArrowRight className="w-4 h-4" />
                    </Link>
                  </div>
                </motion.div>
              ))}
            </div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
