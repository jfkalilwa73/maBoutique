import type { MerchantNavKey } from './types'

/** Modèle : entrées du menu latéral commerçant */
export const MERCHANT_NAV_ITEMS: { key: MerchantNavKey; label: string }[] = [
  { key: 'tableau', label: 'Tableau de bord' },
  { key: 'boutiques', label: 'Mes boutiques' },
  { key: 'commandes', label: 'Commandes globales' },
  { key: 'analytics', label: 'Analytiques' },
  { key: 'config', label: 'Configuration' },
]
