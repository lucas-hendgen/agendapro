'use client'

import { useState } from 'react'
import Link from 'next/link'
import { motion, AnimatePresence } from 'framer-motion'
import {
  Calendar, Clock, MapPin, User, ChevronLeft, ChevronRight, Check, Scissors, Star, ArrowRight
} from 'lucide-react'

const services = [
  { id: '1', name: 'Corte de Cabelo', category: 'Cabelo', duration: '45 min', price: 'R$ 50,00', icon: Scissors },
  { id: '2', name: 'Barba', category: 'Barba', duration: '30 min', price: 'R$ 35,00', icon: User },
  { id: '3', name: 'Corte + Barba', category: 'Combo', duration: '1h 15min', price: 'R$ 80,00', icon: Scissors },
  { id: '4', name: 'Coloração', category: 'Cabelo', duration: '2h', price: 'R$ 150,00', icon: Scissors },
  { id: '5', name: 'Manicure', category: 'Unhas', duration: '1h', price: 'R$ 40,00', icon: Scissors },
  { id: '6', name: 'Pedicure', category: 'Unhas', duration: '1h', price: 'R$ 45,00', icon: Scissors },
]

const professionals = [
  { id: '1', name: 'Carlos Silva', specialty: 'Corte Masculino', rating: 4.9, reviews: 128, image: 'C' },
  { id: '2', name: 'Maria Souza', specialty: 'Coloração', rating: 4.8, reviews: 96, image: 'M' },
  { id: '3', name: 'João Oliveira', specialty: 'Barba', rating: 4.9, reviews: 112, image: 'J' },
  { id: '4', name: 'Ana Paula', specialty: 'Manicure', rating: 4.7, reviews: 85, image: 'A' },
]

const timeSlots = [
  '09:00', '09:30', '10:00', '10:30', '11:00', '11:30',
  '14:00', '14:30', '15:00', '15:30', '16:00', '16:30', '17:00', '17:30'
]

export default function AgendamentoPage() {
  const [step, setStep] = useState(1)
  const [selectedService, setSelectedService] = useState<string | null>(null)
  const [selectedProfessional, setSelectedProfessional] = useState<string | null>(null)
  const [selectedDate, setSelectedDate] = useState('')
  const [selectedTime, setSelectedTime] = useState('')

  const steps = [
    { number: 1, label: 'Serviço' },
    { number: 2, label: 'Profissional' },
    { number: 3, label: 'Data' },
    { number: 4, label: 'Confirmação' },
  ]

  const getSelectedService = () => services.find(s => s.id === selectedService)
  const getSelectedProfessional = () => professionals.find(p => p.id === selectedProfessional)

  const canProceed = () => {
    if (step === 1) return selectedService !== null
    if (step === 2) return selectedProfessional !== null
    if (step === 3) return selectedDate !== '' && selectedTime !== ''
    return true
  }

  const handleNext = () => {
    if (step < 4) setStep(step + 1)
  }

  const handleBack = () => {
    if (step > 1) setStep(step - 1)
  }

  const handleConfirm = () => {
    alert('Agendamento confirmado com sucesso!')
    window.location.href = '/dashboard/cliente'
  }

  const today = new Date()
  const days = Array.from({ length: 14 }, (_, i) => {
    const date = new Date(today)
    date.setDate(today.getDate() + i)
    return {
      date: date.toISOString().split('T')[0],
      day: date.getDate().toString().padStart(2, '0'),
      weekday: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'][date.getDay()],
    }
  })

  return (
    <div className="min-h-screen bg-gradient-to-br from-primary/5 via-background to-primary/10">
      <div className="max-w-3xl mx-auto px-4 py-8">
        <div className="mb-8">
          <Link href="/" className="inline-flex items-center gap-2 text-text-secondary hover:text-primary transition-colors mb-4">
            <ChevronLeft className="w-4 h-4" />
            Voltar para home
          </Link>
          <h1 className="text-2xl font-bold text-text-primary font-poppins">Agendar Serviço</h1>
          <p className="text-text-secondary">Siga os passos para agendar seu serviço</p>
        </div>

        <div className="bg-white rounded-2xl shadow-xl p-6 md:p-8">
          {/* Steps */}
          <div className="flex items-center justify-between mb-8">
            {steps.map((s) => (
              <div key={s.number} className="flex flex-col items-center">
                <div className={`w-10 h-10 rounded-full flex items-center justify-center font-bold text-sm transition-all ${
                  step === s.number
                    ? 'bg-primary text-white shadow-lg shadow-primary/30'
                    : step > s.number
                    ? 'bg-green-500 text-white'
                    : 'bg-gray-100 text-gray-400'
                }`}>
                  {step > s.number ? <Check className="w-5 h-5" /> : s.number}
                </div>
                <span className={`text-xs mt-2 font-medium ${
                  step === s.number ? 'text-primary' : step > s.number ? 'text-green-500' : 'text-gray-400'
                }`}>
                  {s.label}
                </span>
              </div>
            ))}
          </div>

          <AnimatePresence mode="wait">
            {step === 1 && (
              <motion.div
                key="step1"
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -20 }}
                className="space-y-4"
              >
                <h2 className="text-lg font-bold text-text-primary mb-4">Escolha o serviço</h2>
                <div className="grid grid-cols-1 md:grid-cols-2 gap-4">
                  {services.map((service) => {
                    const Icon = service.icon
                    return (
                      <button
                        key={service.id}
                        onClick={() => setSelectedService(service.id)}
                        className={`p-4 rounded-xl border-2 text-left transition-all ${
                          selectedService === service.id
                            ? 'border-primary bg-primary/5 shadow-lg shadow-primary/10'
                            : 'border-gray-100 hover:border-gray-300 hover:bg-gray-50'
                        }`}
                      >
                        <div className="flex items-start justify-between">
                          <div className="flex items-center gap-3">
                            <div className={`w-10 h-10 rounded-xl flex items-center justify-center ${
                              selectedService === service.id ? 'bg-primary text-white' : 'bg-gray-100 text-text-secondary'
                            }`}>
                              <Icon className="w-5 h-5" />
                            </div>
                            <div>
                              <h3 className="font-semibold text-text-primary">{service.name}</h3>
                              <p className="text-xs text-text-secondary">{service.category}</p>
                            </div>
                          </div>
                          <div className="text-right">
                            <p className="font-bold text-primary">{service.price}</p>
                            <p className="text-xs text-text-muted">{service.duration}</p>
                          </div>
                        </div>
                      </button>
                    )
                  })}
                </div>
              </motion.div>
            )}

            {step === 2 && (
              <motion.div
                key="step2"
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -20 }}
                className="space-y-4"
              >
                <h2 className="text-lg font-bold text-text-primary mb-4">Escolha o profissional</h2>
                <div className="space-y-3">
                  {professionals.map((pro) => (
                    <button
                      key={pro.id}
                      onClick={() => setSelectedProfessional(pro.id)}
                      className={`w-full p-4 rounded-xl border-2 text-left transition-all flex items-center gap-4 ${
                        selectedProfessional === pro.id
                          ? 'border-primary bg-primary/5 shadow-lg shadow-primary/10'
                          : 'border-gray-100 hover:border-gray-300 hover:bg-gray-50'
                      }`}
                    >
                      <div className={`w-12 h-12 rounded-full flex items-center justify-center text-lg font-bold ${
                        selectedProfessional === pro.id ? 'bg-primary text-white' : 'bg-gray-200 text-text-secondary'
                      }`}>
                        {pro.image}
                      </div>
                      <div className="flex-1">
                        <h3 className="font-semibold text-text-primary">{pro.name}</h3>
                        <p className="text-sm text-text-secondary">{pro.specialty}</p>
                        <div className="flex items-center gap-1 mt-1">
                          <Star className="w-3 h-3 text-yellow-500 fill-yellow-500" />
                          <span className="text-xs text-text-secondary">{pro.rating} ({pro.reviews} avaliações)</span>
                        </div>
                      </div>
                      {selectedProfessional === pro.id && <Check className="w-6 h-6 text-primary" />}
                    </button>
                  ))}
                </div>
              </motion.div>
            )}

            {step === 3 && (
              <motion.div
                key="step3"
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -20 }}
                className="space-y-6"
              >
                <div>
                  <h2 className="text-lg font-bold text-text-primary mb-4">Escolha a data</h2>
                  <div className="flex gap-2 overflow-x-auto pb-2">
                    {days.map((day) => (
                      <button
                        key={day.date}
                        onClick={() => setSelectedDate(day.date)}
                        className={`flex flex-col items-center gap-1 min-w-[60px] p-3 rounded-xl border-2 transition-all ${
                          selectedDate === day.date
                            ? 'border-primary bg-primary/5 text-primary'
                            : 'border-gray-100 hover:border-gray-300 text-text-primary'
                        }`}
                      >
                        <span className="text-xs font-medium">{day.weekday}</span>
                        <span className="text-lg font-bold">{day.day}</span>
                      </button>
                    ))}
                  </div>
                </div>

                <div>
                  <h2 className="text-lg font-bold text-text-primary mb-4">Escolha o horário</h2>
                  <div className="grid grid-cols-4 sm:grid-cols-7 gap-2">
                    {timeSlots.map((time) => (
                      <button
                        key={time}
                        onClick={() => setSelectedTime(time)}
                        className={`py-2 px-3 rounded-xl text-sm font-medium transition-all ${
                          selectedTime === time
                            ? 'bg-primary text-white shadow-lg shadow-primary/25'
                            : 'bg-gray-100 text-text-secondary hover:bg-gray-200'
                        }`}
                      >
                        {time}
                      </button>
                    ))}
                  </div>
                </div>
              </motion.div>
            )}

            {step === 4 && (
              <motion.div
                key="step4"
                initial={{ opacity: 0, x: 20 }}
                animate={{ opacity: 1, x: 0 }}
                exit={{ opacity: 0, x: -20 }}
                className="space-y-6"
              >
                <h2 className="text-lg font-bold text-text-primary mb-4">Confirme seu agendamento</h2>
                <div className="bg-gray-50 rounded-xl p-6 space-y-4">
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                      <Scissors className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm text-text-secondary">Serviço</p>
                      <p className="font-semibold text-text-primary">{getSelectedService()?.name}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                      <User className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm text-text-secondary">Profissional</p>
                      <p className="font-semibold text-text-primary">{getSelectedProfessional()?.name}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                      <Calendar className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm text-text-secondary">Data e hora</p>
                      <p className="font-semibold text-text-primary">{selectedDate} às {selectedTime}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                      <Clock className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm text-text-secondary">Duração</p>
                      <p className="font-semibold text-text-primary">{getSelectedService()?.duration}</p>
                    </div>
                  </div>
                  <div className="flex items-center gap-4">
                    <div className="w-10 h-10 bg-primary/10 rounded-xl flex items-center justify-center">
                      <MapPin className="w-5 h-5 text-primary" />
                    </div>
                    <div>
                      <p className="text-sm text-text-secondary">Valor</p>
                      <p className="font-semibold text-primary text-lg">{getSelectedService()?.price}</p>
                    </div>
                  </div>
                </div>
              </motion.div>
            )}
          </AnimatePresence>

          <div className="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
            <button
              onClick={handleBack}
              disabled={step === 1}
              className={`flex items-center gap-2 px-6 py-3 rounded-xl font-medium transition-all ${
                step === 1
                  ? 'text-gray-300 cursor-not-allowed'
                  : 'text-text-secondary hover:bg-gray-100'
              }`}
            >
              <ChevronLeft className="w-4 h-4" />
              Voltar
            </button>
            {step < 4 ? (
              <button
                onClick={handleNext}
                disabled={!canProceed()}
                className={`flex items-center gap-2 px-6 py-3 rounded-xl font-medium transition-all ${
                  canProceed()
                    ? 'bg-primary text-white hover:bg-primary-dark shadow-lg shadow-primary/25'
                    : 'bg-gray-200 text-gray-400 cursor-not-allowed'
                }`}
              >
                Próximo
                <ArrowRight className="w-4 h-4" />
              </button>
            ) : (
              <button
                onClick={handleConfirm}
                className="flex items-center gap-2 px-6 py-3 rounded-xl font-medium bg-green-500 text-white hover:bg-green-600 shadow-lg shadow-green-500/25 transition-all"
              >
                <Check className="w-4 h-4" />
                Confirmar Agendamento
              </button>
            )}
          </div>
        </div>
      </div>
    </div>
  )
}
