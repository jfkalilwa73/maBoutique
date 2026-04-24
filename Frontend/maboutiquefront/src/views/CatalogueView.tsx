import { CATALOG_PRODUCT_NAMES } from '../models/catalog'

/** Vue : catalogue produits */
export function CatalogueView() {
  return (
    <section className="catalog-layout">
      <aside className="filters">
        <h4>Filtres</h4>
        <p>Catégories</p>
        <ul>
          <li>Artisanat</li>
          <li>Mode &amp; Luxe</li>
          <li>Maison</li>
          <li>Papeterie</li>
        </ul>
        <button type="button" className="cta-small">
          Devenez vendeur
        </button>
      </aside>
      <div className="catalog-main">
        <header>
          <h2>L&apos;élégance à la française.</h2>
          <p>Découvrez une sélection minutieuse de pièces uniques façonnées par les meilleurs artisans.</p>
        </header>
        <div className="product-grid">
          {CATALOG_PRODUCT_NAMES.map((item) => (
            <article key={item} className="card">
              <div className="img" />
              <strong>{item}</strong>
              <span>Design d&apos;exception</span>
            </article>
          ))}
        </div>
        <button type="button" className="cta-load">
          Voir plus d&apos;articles
        </button>
      </div>
    </section>
  )
}
