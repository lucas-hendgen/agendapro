'use client'

import { useState } from 'react'
import Link from 'next/link'
import { usePathname } from 'next/navigation'
import {
  Calendar, LayoutDashboard, Users, Scissors, Settings, Menu, X, LogOut, Heart, Star, Bell, Tag
} from 'lucide-react'
import { motion, AnimatePresence } from 'framer-motion'
import { useAuth } from '@/contexts/AuthContext'

interface DashboardSidebarProps {
  role: 'cliente' | 'profissional' | 'admin'
}

const menuItems = {
  cliente: [
    { href: '/dashboard/cliente', label: 'Dashboard', icon: LayoutDashboard },
    { href: '/dashboard/cliente/agendamentos', label: 'Meus Agendamentos', icon: Calendar },
    { href: '/dashboard/cliente/profissionais', label: 'Profissionais', icon: Users },
    { href: '/dashboard/cliente/servicos', label: 'Serviços', icon: Scissors },
    { href: '/dashboard/cliente/favoritos', label: 'Favoritos', icon: Heart },
    { href: '/dashboard/cliente/promocoes', label: 'Promoções', icon: Tag },
    { href: '/dashboard/cliente/configuracoes', label: 'Configurações', icon: Settings },
  ],
  profissional: [
    { href: '/dashboard/profissional', label: 'Dashboard', icon: LayoutDashboard },
    { href: '/dashboard/profissional/agenda', label: 'Minha Agenda', icon: Calendar },
    { href: '/dashboard/profissional/clientes', label: 'Meus Clientes', icon: Users },
    { href: '/dashboard/profissional/servicos', label: 'Serviços', icon: Scissors },
    { href: '/dashboard/profissional/relatorios', label: 'Relatórios', icon: Star },
    { href: '/dashboard/profissional/configuracoes', label: 'Configurações', icon: Settings },
  ],
  admin: [
    { href: '/dashboard/admin', label: 'Dashboard', icon: LayoutDashboard },
    { href: '/dashboard/admin/agendamentos', label: 'Agendamentos', icon: Calendar },
    { href: '/dashboard/admin/clientes', label: 'Clientes', icon: Users },
    { href: '/dashboard/admin/profissionais', label: 'Profissionais', icon: Scissors },
    { href: '/dashboard/admin/financeiro', label: 'Financeiro', icon: Star },
    { href: '/dashboard/admin/relatorios', label: 'Relatórios', icon: Bell },
    { href: '/dashboard/admin/configuracoes', label: 'Configurações', icon: Settings },
  ],
}

export default function DashboardSidebar({ role }: DashboardSidebarProps) {
  const pathname = usePathname()
  const [isMobileOpen, setIsMobileOpen] = useState(false)
  const { logout } = useAuth()

  const items = menuItems[role]

  return (
    <>
      <button
        onClick={() => setIsMobileOpen(true)}
        className="lg:hidden fixed top-4 left-4 z-50 p-2 bg-white rounded-lg shadow-lg border border-gray-100"
      >
        <Menu className="w-6 h-6 text-text-primary" />
      </button>

      <AnimatePresence>
        {isMobileOpen && (
          <motion.div
            initial={{ opacity: 0 }}
            animate={{ opacity: 1 }}
            exit={{ opacity: 0 }}
            className="lg:hidden fixed inset-0 z-40 bg-black/50"
            onClick={() => setIsMobileOpen(false)}
          />
        )}
      </AnimatePresence>

      <motion.aside
        initial={{ x: -280 }}
        animate={{ x: isMobileOpen ? 0 : undefined }}
        className={`fixed lg:sticky top-0 left-0 z-50 h-screen w-72 bg-white border-r border-gray-200 flex flex-col ${
          isMobileOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'
        } transition-transform duration-300`}
      >
        <div className="p-6 border-b border-gray-100 flex items-center justify-between">
          <Link href="/" className="flex items-center gap-3">
            <div className="w-10 h-10 bg-gradient-to-br from-primary to-primary-light rounded-xl flex items-center justify-center shadow-lg shadow-primary/30">
              <Calendar className="w-5 h-5 text-white" />
            </div>
            <span className="text-xl font-bold font-poppins text-text-primary">
              Agenda<span className="text-gradient">Pro</span>
            </span>
          </Link>
          <button
            onClick={() => setIsMobileOpen(false)}
            className="lg:hidden p-1 hover:bg-gray-100 rounded-lg transition-colors"
          >
            <X className="w-5 h-5 text-text-primary" />
          </button>
        </div>

        <nav className="flex-1 p-4 space-y-1 overflow-y-auto">
          {items.map((item) => {
            const isActive = pathname === item.href
            const Icon = item.icon
            return (
              <Link
                key={item.href}
                href={item.href}
                onClick={() => setIsMobileOpen(false)}
                className={`flex items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium transition-all ${
                  isActive
                    ? 'bg-gradient-to-r from-primary to-primary-light text-white shadow-lg shadow-primary/25'
                    : 'text-text-secondary hover:bg-gray-50 hover:text-text-primary'
                }`}
              >
                <Icon className="w-5 h-5" />
                {item.label}
              </Link>
            )
          })}
        </nav>

        <div className="p-4 border-t border-gray-100">
          <button
            onClick={logout}
            className="flex w-full items-center gap-3 px-4 py-3 rounded-xl text-sm font-medium text-red-500 hover:bg-red-50 transition-all"
          >
            <LogOut className="w-5 h-5" />
            Sair
          </button>
        </div>
      </motion.aside>
    </>
  )
}
