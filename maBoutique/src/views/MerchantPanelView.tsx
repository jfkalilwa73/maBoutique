import {
  MERCHANT_BOUTIQUE_STATUS,
  MERCHANT_KPIS,
  MERCHANT_ORDERS,
  MERCHANT_SHOPS,
} from '../models/merchant'
import type { MerchantNavKey } from '../models/types'

export interface MerchantPanelViewProps {
  section: MerchantNavKey
}

/** Vue : contenu principal du dashboard commerçant selon la section */
export function MerchantPanelView({ section }: MerchantPanelViewProps) {
  switch (section) {
    case 'tableau':
      return (
        <>
          <h2>Tableau de Bord Commerçant</h2>
          <p className="board-lead">Synthèse de votre activité et de vos vendeurs.</p>
          <div className="stats">
            {MERCHANT_KPIS.map((k) => (
              <article key={k.label}>
                <span>{k.label}</span>
                <strong>{k.value}</strong>
              </article>
            ))}
          </div>
          <div className="list">
            <h3>Portefeuille de boutiques</h3>
            <div className="shops">
              {MERCHANT_SHOPS.map((name) => (
                <article key={name}>
                  <div className="img" />
                  <strong>{name}</strong>
                </article>
              ))}
            </div>
          </div>
        </>
      )
    case 'boutiques':
      return (
        <>
          <h2>Mes boutiques</h2>
          <p className="board-lead">Gérez les fiches, statuts et mises en avant de vos points de vente.</p>
          <ul className="merchant-placeholder-list">
            {MERCHANT_BOUTIQUE_STATUS.map((line) => (
              <li key={line}>{line}</li>
            ))}
          </ul>
        </>
      )
    case 'commandes':
      return (
        <>
          <h2>Commandes globales</h2>
          <p className="board-lead">Vue unifiée des commandes de toutes vos boutiques (démo sans backend).</p>
          <div className="table-placeholder">
            <div className="table-row table-head">
              <span>Commande</span>
              <span>Boutique</span>
              <span>Statut</span>
            </div>
            {MERCHANT_ORDERS.map((row) => (
              <div key={row.id} className="table-row">
                <span>{row.id}</span>
                <span>{row.shop}</span>
                <span>{row.status}</span>
              </div>
            ))}
          </div>
        </>
      )
    case 'analytics':
      return (
        <>
          <h2>Analytiques</h2>
          <p className="board-lead">Tendances et comparaisons (contenu de démonstration).</p>
          <div className="panel-muted">Indicateurs : trafic, conversion, panier moyen — à brancher sur vos données.</div>
        </>
      )
    case 'config':
      return (
        <>
          <h2>Configuration</h2>
          <p className="board-lead">Compte, facturation et préférences (démo).</p>
          <div className="panel-muted">Paramètres avancés disponibles une fois l&apos;API en place.</div>
        </>
      )
    default:
      return null
  }
}
