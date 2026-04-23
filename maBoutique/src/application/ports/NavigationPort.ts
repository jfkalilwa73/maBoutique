import type { MerchantNavKey, PageKey } from '../../models/types'

/**
 * S — Un seul rôle : navigation applicative (page + section commerçant).
 * I — Interface ciblée : pas de fuite d’autres préoccupations (auth, API).
 */
export interface NavigationPort {
  readonly page: PageKey
  readonly merchantSection: MerchantNavKey
  goTo(target: PageKey): void
  setMerchantSection(section: MerchantNavKey): void
  applyPostLoginNavigation(): void
  applyPostLogoutNavigation(): void
  goToCatalogAsGuest(): void
}
