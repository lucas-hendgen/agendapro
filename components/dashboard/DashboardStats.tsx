import StatCard from './StatCard'
import { Calendar, Users, Heart, Star } from 'lucide-react'

interface DashboardStatsProps {
  role: 'cliente' | 'profissional' | 'admin'
}

const statsData = {
  cliente: [
    { title: 'Agendamentos', value: '12', change: '3 este mês', changeType: 'positive' as const, icon: Calendar, color: 'blue' },
    { title: 'Profissionais', value: '8', change: '2 novos', changeType: 'positive' as const, icon: Users, color: 'purple' },
    { title: 'Favoritos', value: '5', change: '1 novo', changeType: 'positive' as const, icon: Heart, color: 'red' },
    { title: 'Avaliação', value: '4.8', change: 'Média geral', changeType: 'neutral' as const, icon: Star, color: 'orange' },
  ],
  profissional: [
    { title: 'Agendamentos Hoje', value: '6', change: '2 concluídos', changeType: 'positive' as const, icon: Calendar, color: 'blue' },
    { title: 'Clientes', value: '45', change: '8 novos', changeType: 'positive' as const, icon: Users, color: 'purple' },
    { title: 'Receita Hoje', value: 'R$ 450,00', change: '15% vs ontem', changeType: 'positive' as const, icon: Star, color: 'green' },
    { title: 'Avaliação', value: '4.9', change: '12 avaliações', changeType: 'positive' as const, icon: Star, color: 'orange' },
  ],
  admin: [
    { title: 'Total Agendamentos', value: '1.234', change: '12% este mês', changeType: 'positive' as const, icon: Calendar, color: 'blue' },
    { title: 'Clientes Ativos', value: '856', change: '45 novos', changeType: 'positive' as const, icon: Users, color: 'purple' },
    { title: 'Faturamento', value: 'R$ 45.6K', change: '8% vs mês passado', changeType: 'positive' as const, icon: Star, color: 'green' },
    { title: 'Profissionais', value: '32', change: '3 pendentes', changeType: 'neutral' as const, icon: Star, color: 'orange' },
  ],
}

export default function DashboardStats({ role }: DashboardStatsProps) {
  const stats = statsData[role]

  return (
    <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
      {stats.map((stat) => (
        <StatCard key={stat.title} {...stat} />
      ))}
    </div>
  )
}
