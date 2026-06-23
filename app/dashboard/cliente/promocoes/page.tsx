'use client'

import { motion } from 'framer-motion'
import { Tag, Calendar, Copy, CheckCircle, Gift, Percent, ArrowRight } from 'lucide-react'
import { useState } from 'react'
import DashboardSidebar from '@/components/dashboard/DashboardSidebar'
import DashboardHeader from '@/components/dashboard/DashboardHeader'
import ProtectedRoute from '@/components/auth/ProtectedRoute'

const promotions = [
  { id: '1', title: '20% OFF em Coloração', description: 'Aproveite 20% de desconto em qualquer serviço de coloração até o final do mês.', code: 'COLOR20', expires: '30/06', color: 'bg-gradient-to-r from-purple-500 to-pink-500', icon: Gift },
  { id: '2', title: 'Corte + Barba por R$ 65', description: 'Combo especial: corte de cabelo + barba com preço imperdível.', code: 'COMBO65', expires: '25/06', color: 'bg-gradient-to-r from-blue-500 to-cyan-500', icon: Tag },
  { id: '3', title: '15% OFF na primeira visita', description: 'Desconto exclusivo para novos clientes em qualquer serviço.', code: 'PRIMEIRA15', expires: '31/12', color: 'bg-gradient-to-r from-green-500 to-emerald-500', icon: Percent },
  { id: '4', title: 'Manicure + Pedicure por R$ 70', description: 'Combo de cuidados para unhas com preço especial.', code: 'UNHAS70', expires: '15/07', color: 'bg-gradient-to-r from-orange-500 to-red-500', icon: Gift },
]

export default function PromocoesPage() {
  const [copied, setCopied] = useState<string | null>(null)

  const copyCode = (code: string) => {
    navigator.clipboard.writeText(code)
    setCopied(code)
    setTimeout(() => setCopied(null), 2000)
  }

  return (
    <ProtectedRoute allowedRoles={['cliente']}>
      <div className="flex min-h-screen bg-background">
        <DashboardSidebar role="cliente" />
        <div className="flex-1">
          <DashboardHeader title="Promoções & Ofertas" subtitle="Aproveite as melhores ofertas disponíveis." />
          <main className="p-6">
            <div className="grid grid-cols-1 md:grid-cols-2 gap-6">
              {promotions.map((promo, index) => {
                const Icon = promo.icon
                return (
                  <motion.div
                    key={promo.id}
                    initial={{ opacity: 0, y: 20 }}
                    animate={{ opacity: 1, y: 0 }}
                    transition={{ delay: index * 0.1 }}
                    className="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-lg transition-all"
                  >
                    <div className={`${promo.color} text-white p-6`}>
                      <div className="flex items-center justify-between mb-3">
                        <Icon className="w-8 h-8" />
                        <span className="px-3 py-1 bg-white/20 rounded-full text-xs font-medium backdrop-blur-sm">Válido até {promo.expires}</span>
                      </div>
                      <h3 className="font-bold text-xl mb-2">{promo.title}</h3>
                      <p className="text-white/90 text-sm">{promo.description}</p>
                    </div>
                    <div className="p-6">
                      <div className="flex items-center justify-between">
                        <div>
                          <span className="text-xs text-text-muted block mb-1">Código do cupom</span>
                          <span className="px-3 py-2 bg-gray-100 rounded-lg text-sm font-mono font-bold text-text-primary">{promo.code}</span>
                        </div>
                        <button
                          onClick={() => copyCode(promo.code)}
                          className="flex items-center gap-2 px-4 py-2 bg-primary text-white rounded-xl text-sm font-medium hover:bg-primary-light transition-all"
                        >
                          {copied === promo.code ? (
                            <><CheckCircle className="w-4 h-4" /> Copiado!</>
                          ) : (
                            <><Copy className="w-4 h-4" /> Copiar</>
                          )}
                        </button>
                      </div>
                    </div>
                  </motion.div>
                )
              })}
            </div>
          </main>
        </div>
      </div>
    </ProtectedRoute>
  )
}
