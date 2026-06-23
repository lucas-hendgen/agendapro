'use client'

import { motion } from 'framer-motion'
import { Calendar, MapPin, MessageCircle, CreditCard, Landmark, Cloud } from 'lucide-react'

const integrations = [
  { name: 'Google Calendar', icon: Calendar, description: 'Sincronize com seu Google Calendar' },
  { name: 'Outlook Calendar', icon: Cloud, description: 'Integração com Microsoft Outlook' },
  { name: 'Google Maps', icon: MapPin, description: 'Localização do estabelecimento' },
  { name: 'WhatsApp API', icon: MessageCircle, description: 'Lembretes e confirmações automáticas' },
  { name: 'Stripe', icon: CreditCard, description: 'Pagamentos online seguros' },
  { name: 'Mercado Pago', icon: CreditCard, description: 'Cobranças e PIX integrados' },
  { name: 'PIX', icon: Landmark, description: 'Pagamento instantâneo brasileiro' },
]

export default function Integrations() {
  return (
    <section id="integracoes" className="py-24 bg-white">
      <div className="section-padding max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="text-primary font-medium text-sm uppercase tracking-wider">Conectividade</span>
          <h2 className="text-3xl sm:text-4xl font-bold font-poppins mt-3 text-text-primary">
            Integrações Poderosas
          </h2>
          <p className="text-text-secondary mt-4 max-w-2xl mx-auto">
            Conecte o AgendaPro com as ferramentas que você já usa
          </p>
        </motion.div>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 max-w-5xl mx-auto">
          {integrations.map((integration, index) => (
            <motion.div
              key={integration.name}
              initial={{ opacity: 0, scale: 0.9 }}
              whileInView={{ opacity: 1, scale: 1 }}
              viewport={{ once: true }}
              transition={{ duration: 0.4, delay: index * 0.05 }}
              className="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:border-primary/30 hover:shadow-lg transition-all duration-300 text-center group"
            >
              <div className="w-14 h-14 mx-auto bg-white rounded-xl flex items-center justify-center mb-4 shadow-sm group-hover:scale-110 transition-transform">
                <integration.icon className="w-7 h-7 text-primary" />
              </div>
              <h3 className="font-semibold text-text-primary mb-1">{integration.name}</h3>
              <p className="text-sm text-text-muted">{integration.description}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
