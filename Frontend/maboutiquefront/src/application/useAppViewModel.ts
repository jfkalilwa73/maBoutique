import { useCallback, useMemo, type FormEvent } from 'react'
import type { AppViewModel } from './types/AppViewModel'
import { useAuthState } from '../infrastructure/state/useAuthState'
import { useNavigationState } from '../infrastructure/state/useNavigationState'
import type { MerchantNavKey, PageKey } from '../models/types'

/**
 * O — Open/Closed : l’orchestrateur combine des ports ; on peut étendre (nouveaux ports)
 *     sans modifier les vues, seulement la composition ici.
 * S — Un seul rôle : câbler auth + navigation et exposer le ViewModel.
 */
export function useAppViewModel(): AppViewModel {
  const auth = useAuthState()
  const navigation = useNavigationState()

  const submitLogin = useCallback(
    (event: FormEvent<HTMLFormElement>) => {
      event.preventDefault()
      auth.signIn()
      navigation.applyPostLoginNavigation()
    },
    [auth, navigation],
  )

  const logout = useCallback(() => {
    auth.signOut()
    navigation.applyPostLogoutNavigation()
  }, [auth, navigation])

  const navigate = useCallback(
    (page: PageKey) => {
      navigation.goTo(page)
    },
    [navigation],
  )

  const setMerchantNav = useCallback(
    (key: MerchantNavKey) => {
      navigation.setMerchantSection(key)
    },
    [navigation],
  )

  const browseCatalogAsGuest = useCallback(() => {
    navigation.goToCatalogAsGuest()
  }, [navigation])

  return useMemo(
    () => ({
      activePage: navigation.page,
      isAuthenticated: auth.isAuthenticated,
      merchantNav: navigation.merchantSection,
      submitLogin,
      logout,
      navigate,
      setMerchantNav,
      browseCatalogAsGuest,
    }),
    [
      auth.isAuthenticated,
      navigation.page,
      navigation.merchantSection,
      submitLogin,
      logout,
      navigate,
      setMerchantNav,
      browseCatalogAsGuest,
    ],
  )
}
