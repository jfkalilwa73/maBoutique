import { ATELIER_MODERATION_NAMES, ATELIER_STATS } from '../models/atelier'

/** Vue : dashboard atelier / modération */
export function AtelierView() {
  return (
    <section className="dashboard">
      <aside className="side-nav">
        <h4>MA BOUTIQUE</h4>
        <nav>
          <a href="#tb">Tableau de bord</a>
          <a href="#prod">Mes produits</a>
          <a href="#cmd">Commandes</a>
          <a href="#msg">Messages</a>
          <a href="#set">Paramètres</a>
        </nav>
      </aside>
      <div className="board">
        <h2>Tableau de Bord</h2>
        <div className="stats">
          {ATELIER_STATS.map((s) => (
            <article key={s.label}>
              <span>{s.label}</span>
              <strong>{s.value}</strong>
            </article>
          ))}
        </div>
        <div className="moderation">
          <h3>File de modération</h3>
          <p>{ATELIER_MODERATION_NAMES}</p>
        </div>
      </div>
    </section>
  )
}
