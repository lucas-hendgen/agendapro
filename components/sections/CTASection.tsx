'use client'

import { motion } from 'framer-motion'
import Link from 'next/link'
import { ArrowRight, Phone, Mail, Calendar } from 'lucide-react'

export default function CTASection() {
  return (
    <section className="py-24 relative overflow-hidden">
      <div className="absolute inset-0 bg-primary" />
      <div className="absolute inset-0 bg-gradient-to-br from-primary to-primary-dark" />
      <div className="absolute -top-24 -right-24 w-96 h-96 bg-white/10 rounded-full blur-3xl" />
      <div className="absolute -bottom-24 -left-24 w-96 h-96 bg-white/10 rounded-full blur-3xl" />

      <div className="section-padding relative z-10 max-w-5xl mx-auto text-center">
        <motion.div
          initial={{ opacity: 0, y: 20 }}
          whileInView={{ opacity: 1, y: 0 }}
          viewport={{ once: true }}
          transition={{ duration: 0.6 }}
          className="space-y-8"
        >
          <h2 className="text-3xl sm:text-4xl lg:text-5xl font-bold font-poppins text-white">
            Pronto para revolucionar seus agendamentos?
          </h2>
          <p className="text-lg text-white/80 max-w-2xl mx-auto">
            Junte-se a milhares de profissionais que já economizam horas por semana com o AgendaPro.
          </p>

          <div className="flex flex-col sm:flex-row gap-4 justify-center">
            <Link
              href="/auth/register"
              className="inline-flex items-center justify-center gap-2 bg-white text-primary px-8 py-4 rounded-xl font-semibold transition-all duration-300 hover:shadow-xl hover:scale-105"
            >
              Começar Grátis
              <ArrowRight className="w-5 h-5" />
            </Link>
            <Link
              href="/auth/register-profissional"
              className="inline-flex items-center justify-center gap-2 bg-white/10 text-white border border-white/30 px-8 py-4 rounded-xl font-semibold transition-all duration-300 hover:bg-white/20"
            >
              <Calendar className="w-5 h-5" />
              Sou Profissional
            </Link>
          </div>

          <div className="flex flex-col sm:flex-row gap-6 justify-center pt-8 border-t border-white/20">
            <a href="mailto:contato@agendapro.com.br" className="flex items-center gap-2 text-white/80 hover:text-white transition-colors">
              <Mail className="w-5 h-5" />
              contato@agendapro.com.br
            </a>
            <a href="tel:+551140001234" className="flex items-center gap-2 text-white/80 hover:text-white transition-colors">
              <Phone className="w-5 h-5" />
              (11) 4000-1234
            </a>
          </div>
        </motion.div>
      </div>
    </section>
  )
}
