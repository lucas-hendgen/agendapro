export interface Service {
  id: string
  name: string
  icon: string
  category: string
}

export interface Professional {
  id: string
  name: string
  photo: string
  specialty: string
  rating: number
  reviews: number
  appointments: number
}

export interface Appointment {
  id: string
  service: string
  professional: string
  date: string
  time: string
  duration: string
  value: string
  status: 'pending' | 'confirmed' | 'completed' | 'cancelled'
}

export interface Plan {
  id: string
  name: string
  price: string
  period: string
  description: string
  features: string[]
  highlighted?: boolean
}

export interface DashboardStats {
  totalClients: number
  totalProfessionals: number
  totalCompanies: number
  totalAppointments: number
  monthlyRevenue: string
}
