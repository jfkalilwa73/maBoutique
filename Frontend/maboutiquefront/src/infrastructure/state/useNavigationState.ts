import { useCallback, useMemo, useState } from 'react'
import type { NavigationPort } from '../../application/ports/NavigationPort'
import type { MerchantNavKey, PageKey } from '../../models/types'

const DEFAULT_MERCHANT: MerchantNavKey = 'tableau'

export function useNavigationState(): NavigationPort {
  const [page, setPage] = useState<PageKey>('connexion')
  const [merchantSection, setMerchantSection] = useState<MerchantNavKey>(DEFAULT_MERCHANT)

  const goTo = useCallback((target: PageKey) => {
    setPage(target)
  }, [])

  const setMerchantSectionStable = useCallback((section: MerchantNavKey) => {
    setMerchantSection(section)
  }, [])

  const applyPostLoginNavigation = useCallback(() => {
    setPage('commercant')
    setMerchantSection(DEFAULT_MERCHANT)
  }, [])

  const applyPostLogoutNavigation = useCallback(() => {
    setPage('connexion')
    setMerchantSection(DEFAULT_MERCHANT)
  }, [])

  const goToCatalogAsGuest = useCallback(() => {
    setPage('catalogue')
  }, [])

  return useMemo(
    () => ({
      page,
      merchantSection,
      goTo,
      setMerchantSection: setMerchantSectionStable,
      applyPostLoginNavigation,
      applyPostLogoutNavigation,
      goToCatalogAsGuest,
    }),
    [
      page,
      merchantSection,
      goTo,
      setMerchantSectionStable,
      applyPostLoginNavigation,
      applyPostLogoutNavigation,
      goToCatalogAsGuest,
    ],
  )
}
