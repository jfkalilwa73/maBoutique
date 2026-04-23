import type { FormEvent } from 'react'
import type { MerchantNavKey, PageKey } from '../../models/types'

/**
 * I — Ségrégation d’interface : facette regroupant ce que les vues reçoivent,
 *     sans exposer l’implémentation des ports (auth / navigation).
 * L — Contrat stable : les vues peuvent substituer des mock pour les tests.
 */
export interface AppViewModel {
  readonly activePage: PageKey
  readonly isAuthenticated: boolean
  readonly merchantNav: MerchantNavKey
  submitLogin(event: FormEvent<HTMLFormElement>): void
  logout(): void
  navigate(page: PageKey): void
  setMerchantNav(key: MerchantNavKey): void
  browseCatalogAsGuest(): void
}
