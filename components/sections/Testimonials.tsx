'use client'

import { motion } from 'framer-motion'
import { Star, Quote } from 'lucide-react'

const testimonials = [
  {
    name: 'Ana Carolina',
    role: 'Proprietária de Salão',
    image: 'AC',
    content: 'O AgendaPro transformou a forma como gerencio meu salão. Reduzi as faltas em 70% e meus clientes adoram a praticidade.',
    rating: 5,
  },
  {
    name: 'Ricardo Mendes',
    role: 'Barbeiro',
    image: 'RM',
    content: 'Finalmente tenho controle total da minha agenda. O sistema de lembretes automáticos é um diferencial enorme.',
    rating: 5,
  },
  {
    name: 'Dra. Juliana Costa',
    role: 'Médica Dermatologista',
    image: 'JC',
    content: 'Como médica, preciso de organização. O AgendaPro me permite focar no que realmente importa: meus pacientes.',
    rating: 5,
  },
  {
    name: 'Marcos Oliveira',
    role: 'Dono de Oficina',
    image: 'MO',
    content: 'Integrei o sistema em minha oficina e os resultados foram impressionantes. Clientes mais satisfeitos e agenda sempre cheia.',
    rating: 5,
  },
]

export default function Testimonials() {
  return (
    <section className="py-24 bg-white">
      <div className="section-padding max-w-7xl mx-auto">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="text-center mb-16"
        >
          <span className="text-primary font-medium text-sm uppercase tracking-wider">Depoimentos</span>
          <h2 className="text-3xl sm:text-4xl font-bold font-poppins mt-3 text-text-primary">
            O que nossos clientes dizem
          </h2>
          <p className="text-text-secondary mt-4 max-w-2xl mx-auto">
            Profissionais e empresas que confiam no AgendaPro para gerenciar seus agendamentos
          </p>
        </motion.div>

        <div className="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
          {testimonials.map((testimonial, index) => (
            <motion.div
              key={testimonial.name}
              initial={{ opacity: 0, y: 20 }}
              whileInView={{ opacity: 1, y: 0 }}
              viewport={{ once: true }}
              transition={{ duration: 0.4, delay: index * 0.1 }}
              className="bg-gray-50 rounded-2xl p-6 border border-gray-100 hover:shadow-lg transition-all duration-300 relative"
            >
              <Quote className="absolute top-4 right-4 w-8 h-8 text-primary/10" />
              
              <div className="flex items-center gap-1 mb-4">
                {[...Array(testimonial.rating)].map((_, i) => (
                  <Star key={i} className="w-4 h-4 fill-yellow-400 text-yellow-400" />
                ))}
              </div>

              <p className="text-text-secondary text-sm leading-relaxed mb-6">
                "{testimonial.content}"
              </p>

              <div className="flex items-center gap-3">
                <div className="w-10 h-10 bg-primary rounded-full flex items-center justify-center text-white font-semibold text-sm">
                  {testimonial.image}
                </div>
                <div>
                  <p className="font-semibold text-text-primary text-sm">{testimonial.name}</p>
                  <p className="text-xs text-text-muted">{testimonial.role}</p>
                </div>
              </div>
            </motion.div>
          ))}
        </div>
      </div>
    </section>
  )
}
