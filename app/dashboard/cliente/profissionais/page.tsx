'use client'

import { motion } from 'framer-motion'
import { Users, Search, Star, Calendar, Heart, MapPin, Filter, Award } from 'lucide-react'
import Link from 'next/link'
import { useState } from 'react'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const professionals = [
  { id: '1', name: 'Carlos Silva', specialty: 'Corte Masculino', rating: 4.9, reviews: 128, location: 'Salão Beleza Total', available: true, image: 'C' },
  { id: '2', name: 'Maria Souza', specialty: 'Coloração', rating: 4.8, reviews: 96, location: 'Espaço Maria', available: true, image: 'M' },
  { id: '3', name: 'João Oliveira', specialty: 'Barba', rating: 4.9, reviews: 112, location: 'Barbearia Vintage', available: false, image: 'J' },
  { id: '4', name: 'Ana Paula', specialty: 'Manicure & Pedicure', rating: 4.7, reviews: 85, location: 'Espaço Maria', available: true, image: 'A' },
  { id: '5', name: 'Pedro Costa', specialty: 'Massagem', rating: 4.9, reviews: 67, location: 'Spa Relax', available: true, image: 'P' },
  { id: '6', name: 'Fernanda Lima', specialty: 'Limpeza de Pele', rating: 4.8, reviews: 54, location: 'Clínica Beleza', available: true, image: 'F' },
]

const specialties = ['Todos', 'Corte Masculino', 'Coloração', 'Barba', 'Manicure', 'Massagem', 'Estética']

export default function ProfissionaisPage() {
  const [activeSpecialty, setActiveSpecialty] = useState('Todos')
  const [searchTerm, setSearchTerm] = useState('')
  const [favorites, setFavorites] = useState<string[]>(['1', '2'])

  const toggleFavorite = (id: string) => {
    setFavorites(prev => prev.includes(id) ? prev.filter(f => f !== id) : [...prev, id])
  }

  const filtered = professionals.filter((p) => {
    const matchesSpecialty = activeSpecialty === 'Todos' || p.specialty === activeSpecialty
    const matchesSearch = p.name.toLowerCase().includes(searchTerm.toLowerCase()) ||
                          p.specialty.toLowerCase().includes(searchTerm.toLowerCase())
    return matchesSpecialty && matchesSearch
  })

  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1">
          <DashboardHeader title="Profissionais" subtitle="Conheça os melhores profissionais da região." />
          <main className="p-6 space-y-6">
            <div className="flex flex-col sm:flex-row gap-4 items-start sm:items-center justify-between">
              <div className="flex gap-2 flex-wrap">
                {specialties.map((spec) => (
                  <button
                    key={spec}
                    onClick={() => setActiveSpecialty(spec)}
                    className={`px-4 py-2 rounded-xl text-sm font-medium transition-all ${
                      activeSpecialty === spec
                        ? 'bg-primary text-white shadow-lg shadow-primary/25'
                        : 'bg-white text-text-secondary hover:bg-gray-50 border border-gray-100'
                    }`}
                  >
                    {spec}
                  </button>
                ))}
              </div>
              <div className="flex items-center gap-3">
                <div className="flex items-center bg-white rounded-xl px-4 py-2 border border-gray-100">
                  <Search className="w-4 h-4 text-text-muted mr-2" />
                  <input
                    type="text"
                    placeholder="Buscar profissional..."
                    value={searchTerm}
                    onChange={(e) => setSearchTerm(e.target.value)}
                    className="bg-transparent text-sm outline-none text-text-primary placeholder:text-text-muted w-48"
                  />
                </div>
              </div>
            </div>

            <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
              {filtered.map((pro, index) => (
                <motion.div
                  key={pro.id}
                  initial={{ opacity: 0, y: 20 }}
                  animate={{ opacity: 1, y: 0 }}
                  transition={{ delay: index * 0.05 }}
                  className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg hover:border-primary/20 transition-all"
                >
                  <div className="flex items-start justify-between mb-4">
                    <div className="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary/20">
                      {pro.image}
                    </div>
                    <button
                      onClick={() => toggleFavorite(pro.id)}
                      className={`p-2 rounded-full transition-all ${
                        favorites.includes(pro.id)
                          ? 'bg-red-50 text-red-500'
                          : 'bg-gray-100 text-gray-400 hover:bg-red-50 hover:text-red-500'
                      }`}
                    >
                      <Heart className={`w-5 h-5 ${favorites.includes(pro.id) ? 'fill-red-500' : ''}`} />
                    </button>
                  </div>
                  <h3 className="font-bold text-text-primary text-lg mb-1">{pro.name}</h3>
                  <div className="flex items-center gap-1 mb-2">
                    <Award className="w-4 h-4 text-primary" />
                    <span className="text-sm text-text-secondary">{pro.specialty}</span>
                  </div>
                  <div className="flex items-center gap-1 mb-4">
                    <Star className="w-4 h-4 text-yellow-500 fill-yellow-500" />
                    <span className="text-sm font-medium text-text-primary">{pro.rating}</span>
                    <span className="text-xs text-text-muted">({pro.reviews} avaliações)</span>
                  </div>
                  <div className="flex items-center gap-1 text-sm text-text-muted mb-4">
                    <MapPin className="w-4 h-4" />
                    {pro.location}
                  </div>
                  <div className="flex items-center gap-2">
                    <span className={`px-3 py-1 rounded-full text-xs font-medium ${
                      pro.available ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-500'
                    }`}>
                      {pro.available ? 'Disponível' : 'Indisponível'}
                    </span>
                    <Link href="/agendamento" className="flex-1 flex items-center justify-center gap-2 px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-light transition-all">
                      <Calendar className="w-4 h-4" />
                      Agendar
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
