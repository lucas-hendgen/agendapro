'use client'

import { motion } from 'framer-motion'
import { Check, Sparkles } from 'lucide-react'
import Link from 'next/link'

const plans = [
  {
    id: 'basico',
    name: 'Básico',
    price: 'R$ 49',
    period: '/mês',
    description: 'Ideal para profissionais autônomos',
    features: [
      '50 agendamentos/mês',
      'Lembretes por e-mail',
      'Perfil do profissional',
      'Avaliações de clientes',
      'Suporte por e-mail',
    ],
    highlighted: false,
  },
  {
    id: 'profissional',
    name: 'Profissional',
    price: 'R$ 99',
    period: '/mês',
    description: 'Para quem quer crescer sem limites',
    features: [
      'Agendamentos ilimitados',
      'Lembretes por WhatsApp + E-mail',
      'Sistema de fidelidade',
      'Relatórios de faturamento',
      'Integração Google Calendar',
      'Suporte prioritário',
    ],
    highlighted: true,
  },
  {
    id: 'empresarial',
    name: 'Empresarial',
    price: 'R$ 249',
    period: '/mês',
    description: 'Multiusuários e gestão completa',
    features: [
      'Tudo do plano Profissional',
      'Multiusuários (até 10)',
      'Multiunidade',
      'Dashboard administrativo',
      'API de integração',
      'Gerenciador de fila de espera',
      'Suporte VIP',
    ],
    highlighted: false,
  },
]

export default function Pricing() {
  return (
    <section id="precos" className="py-24 gradient-bg">
      <div className="section-padding max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="text-primary font-medium text-sm uppercase tracking-wider">Planos</span>
          <h2 className="text-3xl sm:text-4xl font-bold font-poppins mt-3 text-text-primary">
            Escolha seu plano
          </h2>
          <p className="text-text-secondary mt-4 max-w-2xl mx-auto">
            Comece gratuitamente e escale conforme seu negócio cresce
          </p>
        </motion.div>

        <div className="grid md:grid-cols-3 gap-8 max-w-5xl mx-auto">
          {plans.map((plan, index) => (
            <motion.div
              key={plan.id}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.4, delay: index * 0.1 }}
              className={`relative rounded-2xl p-8 border transition-all duration-300 hover:shadow-xl ${
                plan.highlighted
                  ? 'bg-white border-primary shadow-xl shadow-primary/10 scale-105'
                  : 'bg-white border-gray-100 hover:border-primary/30'
              }`}
            >
              {plan.highlighted && (
                <div className="absolute -top-4 left-1/2 transform -translate-x-1/2 bg-primary text-white px-4 py-1 rounded-full text-sm font-medium flex items-center gap-1">
                  <Sparkles className="w-4 h-4" />
                  Mais Popular
                </div>
              )}

              <div className="text-center mb-6">
                <h3 className="text-xl font-bold text-text-primary mb-2">{plan.name}</h3>
                <p className="text-sm text-text-muted mb-4">{plan.description}</p>
                <div className="flex items-end justify-center gap-1">
                  <span className="text-4xl font-bold text-primary">{plan.price}</span>
                  <span className="text-text-muted">{plan.period}</span>
                </div>
              </div>

              <ul className="space-y-3 mb-8">
                {plan.features.map((feature) => (
                  <li key={feature} className="flex items-start gap-3 text-sm">
                    <Check className={`w-5 h-5 shrink-0 ${plan.highlighted ? 'text-primary' : 'text-green-500'}`} />
                    <span className="text-text-secondary">{feature}</span>
                  </li>
                ))}
              </ul>

              <Link
                href="/auth/register"
                className={`block text-center py-3 rounded-xl font-medium transition-all duration-300 ${
                  plan.highlighted
                    ? 'bg-primary text-white hover:bg-primary-light shadow-lg shadow-primary/30'
                    : 'bg-gray-100 text-text-primary hover:bg-primary/10'
                }`}
              >
                Assinar Agora
              </Link>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
