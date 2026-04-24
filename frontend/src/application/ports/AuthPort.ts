/**
 * S — Responsabilité unique : cycle de session d’authentification.
 * D — Inversion de dépendances : les vues / orchestrateur dépendent de cette abstraction,
 *     pas d’un store React concret.
 */
export interface AuthPort {
  readonly isAuthenticated: boolean
  signIn(): void
  signOut(): void
}
