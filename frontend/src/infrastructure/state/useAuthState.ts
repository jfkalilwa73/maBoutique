import { useCallback, useMemo, useState } from 'react'
import type { AuthPort } from '../../application/ports/AuthPort'

/**
 * D — Adapter concret (mémoire) branché sur le port AuthPort.
 *     Remplaçable plus tard par un adaptateur API sans modifier les vues.
 */
export function useAuthState(): AuthPort {
  const [isAuthenticated, setAuthenticated] = useState(false)

  const signIn = useCallback(() => {
    setAuthenticated(true)
  }, [])

  const signOut = useCallback(() => {
    setAuthenticated(false)
  }, [])

  return useMemo(
    () => ({ isAuthenticated, signIn, signOut }),
    [isAuthenticated, signIn, signOut],
  )
}
