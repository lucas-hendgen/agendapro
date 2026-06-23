'use client'

import { motion } from 'framer-motion'
import { Calendar, Bell, Star, MessageSquare, Clock, Shield, Smartphone, Zap, Gift, Moon, Building2, BarChart3 } from 'lucide-react'

const features = [
  {
    icon: Calendar,
    title: 'Agendamento Online',
    description: 'Seus clientes agendam 24h por dia, 7 dias por semana, sem precisar ligar.',
  },
  {
    icon: Bell,
    title: 'Lembretes Automáticos',
    description: 'Notificações por e-mail, WhatsApp e push para reduzir faltas em até 80%.',
  },
  {
    icon: Star,
    title: 'Sistema de Avaliação',
    description: 'Clientes avaliam o atendimento e você recebe feedbacks valiosos.',
  },
  {
    icon: MessageSquare,
    title: 'Chat Integrado',
    description: 'Comunicação direta entre cliente e profissional dentro da plataforma.',
  },
  {
    icon: Clock,
    title: 'Lista de Espera',
    description: 'Preencha cancelamentos de última hora automaticamente.',
  },
  {
    icon: Shield,
    title: 'Pagamento Seguro',
    description: 'Integração com Stripe, Mercado Pago e PIX para cobranças online.',
  },
  {
    icon: Smartphone,
    title: 'App Mobile',
    description: 'Gerencie sua agenda de qualquer lugar pelo celular.',
  },
  {
    icon: Zap,
    title: 'Agendamento com IA',
    description: 'Inteligência artificial sugere os melhores horários disponíveis.',
  },
  {
    icon: Gift,
    title: 'Fidelidade e Cupons',
    description: 'Programa de pontos e cupons de desconto para fidelizar clientes.',
  },
  {
    icon: Moon,
    title: 'Dark Mode',
    description: 'Interface adaptável para trabalho noturno com conforto visual.',
  },
  {
    icon: Building2,
    title: 'Multiempresa',
    description: 'Gerencie múltiplas unidades e empresas em uma única conta.',
  },
  {
    icon: BarChart3,
    title: 'Relatórios Avançados',
    description: 'Dashboards completos com métricas de crescimento e faturamento.',
  },
]

export default function Features() {
  return (
    <section id="funcionalidades" className="py-24 gradient-bg">
      <div className="section-padding max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="text-primary font-medium text-sm uppercase tracking-wider">Recursos</span>
          <h2 className="text-3xl sm:text-4xl font-bold font-poppins mt-3 text-text-primary">
            Funcionalidades Principais
          </h2>
          <p className="text-text-secondary mt-4 max-w-2xl mx-auto">
            Tudo que você precisa para gerenciar sua agenda e encantar seus clientes
          </p>
        </motion.div>

        <div className="grid sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
          {features.map((feature, index) => (
            <motion.div
              key={feature.title}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.4, delay: index * 0.05 }}
              className="group bg-white rounded-2xl p-6 border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-1"
            >
              <div className="w-12 h-12 bg-primary/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-primary group-hover:scale-110 transition-all duration-300">
                <feature.icon className="w-6 h-6 text-primary group-hover:text-white transition-colors" />
              </div>
              <h3 className="font-semibold text-text-primary mb-2">{feature.title}</h3>
              <p className="text-sm text-text-secondary leading-relaxed">{feature.description}</p>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
