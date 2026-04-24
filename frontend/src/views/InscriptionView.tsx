export interface InscriptionViewProps {
  onGoToLogin: () => void
}

/** Vue : inscription */
export function InscriptionView({ onGoToLogin }: InscriptionViewProps) {
  return (
    <section className="auth-layout">
      <div className="auth-hero register">
        <h1>MA BOUTIQUE</h1>
        <h2>L&apos;univers de vos envies, physiques et digitales</h2>
        <p>
          Accédez à une place de marché hybride d&apos;exception. Des créations tangibles aux actifs numériques
          exclusifs.
        </p>
        <span className="badge">Produits physiques - Créations digitales - Exclusivité</span>
      </div>
      <div className="auth-form">
        <h3>Créer un compte</h3>
        <p>
          Déjà membre ?{' '}
          <button type="button" className="link-like" onClick={onGoToLogin}>
            Se connecter
          </button>
        </p>
        <div className="grid-2">
          <input placeholder="Nom" />
          <input placeholder="Postnom" />
        </div>
        <div className="grid-2">
          <input placeholder="Prénom" />
          <input placeholder="Téléphone" />
        </div>
        <input placeholder="Adresse email" />
        <input placeholder="Mot de passe" type="password" />
        <button type="button">S&apos;inscrire</button>
      </div>
    </section>
  )
}
