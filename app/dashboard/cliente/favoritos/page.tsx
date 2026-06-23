'use client'

import { motion } from 'framer-motion'
import { Heart, Star, Calendar, MapPin, Trash2, ArrowRight } from 'lucide-react'
import Link from 'next/link'
import { useState } from 'react'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const initialFavorites = [
  { id: '1', name: 'Carlos Silva', specialty: 'Corte Masculino', rating: 4.9, reviews: 128, location: 'Salão Beleza Total', image: 'C' },
  { id: '2', name: 'Maria Souza', specialty: 'Coloração', rating: 4.8, reviews: 96, location: 'Espaço Maria', image: 'M' },
  { id: '3', name: 'João Oliveira', specialty: 'Barba', rating: 4.9, reviews: 112, location: 'Barbearia Vintage', image: 'J' },
]

export default function FavoritosPage() {
  const [favorites, setFavorites] = useState(initialFavorites)

  const removeFavorite = (id: string) => {
    setFavorites(prev => prev.filter(f => f.id !== id))
  }

  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1">
          <DashboardHeader title="Meus Favoritos" subtitle="Profissionais e serviços que você favoritou." />
          <main className="p-6">
            {favorites.length === 0 ? (
              <div className="bg-white rounded-2xl p-12 text-center border border-gray-100">
                <Heart className="w-12 h-12 text-text-muted mx-auto mb-4" />
                <h3 className="text-lg font-semibold text-text-primary mb-2">Nenhum favorito ainda</h3>
                <p className="text-text-secondary mb-4">Explore profissionais e favorite os seus preferidos.</p>
                <Link href="/dashboard/cliente/profissionais" className="btn-primary inline-flex items-center gap-2">
                  <ArrowRight className="w-4 h-4" />
                  Explorar Profissionais
                </Link>
              </div>
            ) : (
              <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {favorites.map((pro, index) => (
                  <motion.div
                    key={pro.id}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: index * 0.05 }}
                    className="bg-white rounded-2xl p-6 shadow-sm border border-gray-100 hover:shadow-lg transition-all"
                  >
                    <div className="flex items-start justify-between mb-4">
                      <div className="w-14 h-14 rounded-full bg-gradient-to-br from-primary to-primary-light flex items-center justify-center text-white font-bold text-xl shadow-lg shadow-primary/20">
                        {pro.image}
                      </div>
                      <button
                        onClick={() => removeFavorite(pro.id)}
                        className="p-2 rounded-full bg-red-50 text-red-500 hover:bg-red-100 transition-colors"
                      >
                        <Trash2 className="w-5 h-5" />
                      </button>
                    </div>
                    <h3 className="font-bold text-text-primary text-lg mb-1">{pro.name}</h3>
                    <p className="text-sm text-text-secondary mb-2">{pro.specialty}</p>
                    <div className="flex items-center gap-1 mb-4">
                      <Star className="w-4 h-4 text-yellow-500 fill-yellow-500" />
                      <span className="text-sm font-medium text-text-primary">{pro.rating}</span>
                      <span className="text-xs text-text-muted">({pro.reviews} avaliações)</span>
                    </div>
                    <div className="flex items-center gap-1 text-sm text-text-muted mb-4">
                      <MapPin className="w-4 h-4" />
                      {pro.location}
                    </div>
                    <Link href="/agendamento" className="w-full flex items-center justify-center gap-2 px-4 py-3 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-light transition-all">
                      <Calendar className="w-4 h-4" />
                      Agendar
                    </Link>
                  </motion.div>
                ))}
              </div>
            )}
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
