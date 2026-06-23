'use client'

import Link from 'next/link'
import { Calendar, Mail, Phone, MapPin, ChevronRight } from 'lucide-react'

export default function Footer() {
  return (
    <footer className="bg-text-primary text-white">
      <div className="section-padding py-16">
        <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">
          <div className="space-y-6">
            <Link href="/" className="flex items-center gap-3">
              <div className="w-10 h-10 bg-primary rounded-xl flex items-center justify-center">
                <Calendar className="w-5 h-5 text-white" />
              </div>
              <span className="text-xl font-bold font-poppins">
                Agenda<span className="text-primary-light">Pro</span>
              </span>
            </Link>
            <p className="text-gray-400 text-sm leading-relaxed">
              A plataforma mais moderna de agendamento online para profissionais e empresas. Simplifique sua agenda e encante seus clientes.
            </p>
          </div>

          <div>
            <h4 className="font-semibold mb-6">Funcionalidades</h4>
            <ul className="space-y-3">
              {['Agendamento Online', 'Gestão de Clientes', 'Lembretes Automáticos', 'Relatórios', 'Multiusuários'].map((item) => (
                <li key={item}>
                  <Link href="#" className="text-gray-400 text-sm hover:text-white transition-colors flex items-center gap-2">
                    <ChevronRight className="w-4 h-4" />
                    {item}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-semibold mb-6">Empresa</h4>
            <ul className="space-y-3">
              {['Sobre Nós', 'Preços', 'Blog', 'Carreiras', 'Contato'].map((item) => (
                <li key={item}>
                  <Link href="#" className="text-gray-400 text-sm hover:text-white transition-colors flex items-center gap-2">
                    <ChevronRight className="w-4 h-4" />
                    {item}
                  </Link>
                </li>
              ))}
            </ul>
          </div>

          <div>
            <h4 className="font-semibold mb-6">Contato</h4>
            <ul className="space-y-4">
              <li className="flex items-center gap-3 text-gray-400 text-sm">
                <Mail className="w-4 h-4 text-primary-light" />
                contato@agendapro.com.br
              </li>
              <li className="flex items-center gap-3 text-gray-400 text-sm">
                <Phone className="w-4 h-4 text-primary-light" />
                (11) 4000-1234
              </li>
              <li className="flex items-center gap-3 text-gray-400 text-sm">
                <MapPin className="w-4 h-4 text-primary-light" />
                São Paulo, SP - Brasil
              </li>
            </ul>
          </div>
        </div>

        <div className="max-w-7xl mx-auto mt-12 pt-8 border-t border-gray-800 flex flex-col md:flex-row justify-between items-center gap-4">
          <p className="text-gray-500 text-sm">
            © 2024 AgendaPro. Todos os direitos reservados.
          </p>
          <div className="flex gap-6">
            <Link href="#" className="text-gray-500 text-sm hover:text-white transition-colors">Privacidade</Link>
            <Link href="#" className="text-gray-500 text-sm hover:text-white transition-colors">Termos</Link>
            <Link href="#" className="text-gray-500 text-sm hover:text-white transition-colors">Cookies</Link>
          </div>
        </div>
      </div>
    </footer>
  )
}
