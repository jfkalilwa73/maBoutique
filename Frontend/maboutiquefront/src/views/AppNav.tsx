import type { PageKey } from '../models/types'

export interface AppNavProps {
  activePage: PageKey
  isAuthenticated: boolean
  onNavigate: (page: PageKey) => void
  onLogout: () => void
}

/** Vue : barre de navigation principale */
export function AppNav({ activePage, isAuthenticated, onNavigate, onLogout }: AppNavProps) {
  return (
    <header className="app-top-nav">
      <div className="app-top-nav-inner">
        <button type="button" className="app-logo" onClick={() => onNavigate('catalogue')}>
          MA BOUTIQUE
        </button>
        <nav className="app-top-links" aria-label="Principale">
          <button
            type="button"
            className={activePage === 'catalogue' ? 'is-active' : undefined}
            onClick={() => onNavigate('catalogue')}
          >
            Découvrir
          </button>
          <button
            type="button"
            onClick={() => (isAuthenticated ? onNavigate('commercant') : onNavigate('connexion'))}
          >
            {isAuthenticated ? 'Espace commerçant' : 'Se connecter'}
          </button>
          <button
            type="button"
            className={activePage === 'atelier' ? 'is-active' : undefined}
            onClick={() => onNavigate('atelier')}
          >
            Espace atelier
          </button>
        </nav>
        <div className="app-nav-actions" role="group" aria-label="Compte">
          <button
            type="button"
            className={activePage === 'inscription' ? 'nav-ghost is-active' : 'nav-ghost'}
            onClick={() => onNavigate('inscription')}
          >
            S&apos;inscrire
          </button>
          {isAuthenticated && (
            <button type="button" className="nav-logout" onClick={onLogout}>
              Déconnexion
            </button>
          )}
        </div>
      </div>
    </header>
  )
}
