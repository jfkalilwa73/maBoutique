/** Modèle : données de démonstration pour le dashboard commerçant */

export const MERCHANT_KPIS = [
  { label: "Chiffre d'affaires", value: '42,850 €' },
  { label: 'Total commandes', value: '154' },
  { label: 'Vendeurs actifs', value: '24' },
] as const

export const MERCHANT_SHOPS = ["L'Atelier Cuir", 'Argile & Co.', 'Mobilier N.'] as const

export const MERCHANT_BOUTIQUE_STATUS = [
  "L'Atelier Cuir — actif",
  'Argile & Co. — en pause',
  'Mobilier N. — actif',
] as const

export const MERCHANT_ORDERS = [
  { id: '#10482', shop: "L'Atelier Cuir", status: 'Expédié' },
  { id: '#10483', shop: 'Argile & Co.', status: 'En cours' },
] as const
