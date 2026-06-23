'use client'

import { motion } from 'framer-motion'
import { Search, UserCheck, ClipboardCheck, Bell } from 'lucide-react'

const steps = [
  {
    icon: Search,
    step: '01',
    title: 'Escolha o serviço',
    description: 'Navegue pelos serviços e escolha o que você precisa.',
    color: 'bg-blue-500',
  },
  {
    icon: UserCheck,
    step: '02',
    title: 'Escolha o profissional, data e horário',
    description: 'Veja os profissionais disponíveis e escolha o melhor horário.',
    color: 'bg-indigo-500',
  },
  {
    icon: ClipboardCheck,
    step: '03',
    title: 'Confirme seu agendamento',
    description: 'Revise os detalhes e confirme.',
    color: 'bg-violet-500',
  },
  {
    icon: Bell,
    step: '04',
    title: 'Receba lembretes e gerencie tudo pelo aplicativo',
    description: 'Receba notificações, reagende ou cancele facilmente.',
    color: 'bg-purple-500',
  },
]

export default function HowItWorks() {
  return (
    <section id="como-funciona" className="py-24 bg-white">
      <div className="section-padding max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="text-primary font-medium text-sm uppercase tracking-wider">Processo Simples</span>
          <h2 className="text-3xl sm:text-4xl font-bold font-poppins mt-3 text-text-primary">
            Como Funciona
          </h2>
          <p className="text-text-secondary mt-4 max-w-2xl mx-auto">
            Em apenas 4 passos, você agenda seu serviço de forma rápida e prática
          </p>
        </motion.div>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
          {steps.map((item, index) => (
            <motion.div
              key={item.step}
              initial={{ opacity: 0, y: 30 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.5, delay: index * 0.1 }}
              className="relative group"
            >
              <div className="bg-gray-50 rounded-2xl p-8 h-full border border-gray-100 hover:border-primary/30 hover:shadow-xl hover:shadow-primary/10 transition-all duration-300 hover:-translate-y-2">
                <div className={`w-14 h-14 ${item.color} rounded-xl flex items-center justify-center mb-6 shadow-lg shadow-blue-500/30`}>
                  <item.icon className="w-7 h-7 text-white" />
                </div>
                <span className="text-5xl font-bold text-gray-200 absolute top-4 right-4 font-poppins">
                  {item.step}
                </span>
                <h3 className="text-lg font-bold text-text-primary mb-3 relative z-10">
                  {item.title}
                </h3>
                <p className="text-text-secondary text-sm leading-relaxed relative z-10">
                  {item.description}
                </p>
              </div>

              {index < steps.length - 1 && (
                <div className="hidden lg:block absolute top-1/2 -right-4 transform -translate-y-1/2 z-10">
                  <div className="w-8 h-0.5 bg-gradient-to-r from-primary/50 to-transparent" />
                </div>
              )}
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
