import type { Metadata } from 'next'
import '../styles/globals.css'
import { AuthProvider } from '@/contexts/AuthContext'

export const metadata: Metadata = {
  title: 'AgendaPro - Mais tempo para o que importa',
  description: 'Plataforma moderna de agendamento de serviços para profissionais e empresas. Agende cortes, consultas, estética e muito mais.',
  keywords: 'agendamento online, serviços, barbearia, salão de beleza, clínica, estética',
  openGraph: {
    title: 'AgendaPro - Mais tempo para o que importa',
    description: 'Plataforma moderna de agendamento de serviços',
    type: 'website',
  },
}

export default function RootLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="pt-BR">
      <head>
        <link rel="icon" href="/favicon.ico" />
      </head>
      <body>
        <AuthProvider>
          {children}
        </AuthProvider>
      </body>
    </html>
  )
}
