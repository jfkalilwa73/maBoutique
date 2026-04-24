import type { FormEvent } from 'react'

export interface LoginViewProps {
  onSubmit: (event: FormEvent<HTMLFormElement>) => void
  onBrowseCatalog: () => void
}

/** Vue : page de connexion */
export function LoginView({ onSubmit, onBrowseCatalog }: LoginViewProps) {
  return (
    <section className="auth-layout">
      <div className="auth-hero">
        <h1>MA BOUTIQUE</h1>
        <h2>L&apos;art du commerce réinventé.</h2>
        <p>
          Accédez à votre espace privilégié et découvrez une sélection de pièces d&apos;exception, curatées pour
          l&apos;excellence.
        </p>
        <span className="badge">Rejoignez notre atelier</span>
      </div>
      <form className="auth-form" onSubmit={onSubmit}>
        <h3>Bienvenue</h3>
        <p>Veuillez entrer vos identifiants pour continuer votre expérience.</p>
        <label htmlFor="login-email">Email</label>
        <input id="login-email" name="email" type="email" autoComplete="username" placeholder="votre@email.com" />
        <label htmlFor="login-password">Mot de passe</label>
        <input
          id="login-password"
          name="password"
          type="password"
          autoComplete="current-password"
          placeholder="********"
        />
        <button type="submit">Connexion</button>
        <div className="social-row">
          <button type="button" className="ghost" tabIndex={-1}>
            Google
          </button>
          <button type="button" className="ghost" tabIndex={-1}>
            Apple
          </button>
        </div>
        <p className="auth-guest">
          <button type="button" className="link-like" onClick={onBrowseCatalog}>
            Parcourir le catalogue sans compte
          </button>
        </p>
      </form>
    </section>
  )
}
