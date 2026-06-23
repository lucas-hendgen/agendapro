'use client'

import { Bell, Search, User, LogOut } from 'lucide-react'
import { useAuth } from '@/contexts/AuthContext'

interface DashboardHeaderProps {
  title: string
  subtitle?: string
}

export default function DashboardHeader({ title, subtitle }: DashboardHeaderProps) {
  const { user, logout } = useAuth()

  return (
    <header className="bg-white border-b border-gray-100 px-6 py-4 sticky top-0 z-30">
      <div className="flex items-center justify-between">
        <div>
          <h1 className="text-xl font-bold text-text-primary font-poppins">{title}</h1>
          {subtitle && <p className="text-sm text-text-secondary mt-1">{subtitle}</p>}
        </div>
        <div className="flex items-center gap-4">
          <div className="hidden md:flex items-center bg-gray-50 rounded-xl px-4 py-2 border border-gray-100 focus-within:border-primary/30 focus-within:ring-2 focus-within:ring-primary/10 transition-all">
            <Search className="w-4 h-4 text-text-muted mr-2" />
            <input
              type="text"
              placeholder="Pesquisar..."
              className="bg-transparent text-sm outline-none text-text-primary placeholder:text-text-muted w-48"
            />
          </div>
          <button className="relative p-2.5 rounded-xl hover:bg-gray-50 transition-colors border border-gray-100">
            <Bell className="w-5 h-5 text-text-secondary" />
            <span className="absolute top-1.5 right-1.5 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-white" />
          </button>
          <div className="flex items-center gap-3 pl-4 border-l border-gray-100">
            <div className="w-9 h-9 bg-gradient-to-br from-primary/20 to-primary-light/20 rounded-full flex items-center justify-center border border-primary/10">
              <User className="w-5 h-5 text-primary" />
            </div>
            <div className="hidden md:block">
              <p className="text-sm font-medium text-text-primary">{user?.name || 'Usuário'}</p>
              <p className="text-xs text-text-secondary capitalize">{user?.role || 'Online'}</p>
            </div>
            <button
              onClick={logout}
              className="p-2 rounded-xl hover:bg-red-50 text-text-muted hover:text-red-500 transition-colors"
              title="Sair"
            >
              <LogOut className="w-5 h-5" />
            </button>
          </div>
        </div>
      </div>
    </header>
  )
}
